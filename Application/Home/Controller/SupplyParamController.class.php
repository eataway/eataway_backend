<?php
namespace Home\Controller;
use Think\Cache\Driver\Memcache;

class SupplyParamController extends ParamController
{
    /**
     * 补充：首页搜索功能，先搜索，再排序，入参：名称，优先级，店铺名称，菜品名称，菜品分类，店铺地址
     */
    public function getShopMsgBySearchMsg($city,$lng1,$lat1,$content){
        $result['shops'] = $this->getShopMsgBySearchShops($city,$content,$lng1,$lat1);
        return $result;
    }
    /**
     * 辅助方法一：通过搜索内容获=店铺名称OR=菜品名称，返回店铺信息和部分菜品信息
     */
    public function getShopMsgBySearchShops($city,$content,$lng1,$lat1){
       $shopname['city'] = $city;
       $shopname['shopname'] = array('like','%'.$content.'%');
       $shopname['category'] = array('neq',3);
       $goodsname['goodsname'] = array('like','%'.$content,'%');
       $kindname['city'] = $city;
       $kindname['name'] = array('like','%'.$content.'%');
       $data['all'] = M('shop')->where(['city'=>$city])->select();
       $data['shop'] = M('shop')->where($shopname)->select();
       $result = $this->getPaixuByShopsJuli($data['shop'],$lng1,$lat1);
       // 判断是否已经找完符合条件的数据，如果找完则返回相应数据
        if(count($data['all']) == count($data['shop'])){
            // 调用方法二
            return $result;
        }
       // goodsname
        $kid = 0;
        foreach ($data['all'] as $k){
            $goodsname['shopid'] = $k['shopid'];
          //  dump($goodsname);
            $dt = M('goods')->where($goodsname)->limit(3)->select();
           // dump($dt);
            if($dt){
                //不为空
                $msg[$kid]['shopid'] = $k['shopid'];
                // 营业状态
                $msg[$kid]['flag'] = $this->getShopStatus($k['shopid']);
                $msg[$kid]['shophead'] = $k["shophead"];
                $msg[$kid]['shopname'] = $k["shopname"];
                $msg[$kid]['fenshu'] = $this->getStar($k["shopid"]);    // 星级
                $msg[$kid]['pingjun'] = $this->getPersonOne($k["shopid"]);   //人均
                $msg[$kid]['salenum'] = $this->getMouthOrder($k['shopid']); //月销售
                $msg[$kid]['hui'] = $this->getHui($k['shopid']);  //优惠活动
                $msg[$kid]['manjian'] = $this->getManJian($k['shopid']);  //满减活动
                $du = explode(',',$k["coordinator"]);
                $msg[$kid]["juli"] = $this->getJuLi($lng1,$lat1,$du[0],$du[1]);
                $msg[$kid]['gotime'] = round(($data[$kid]["juli"]/$this->sudu)*60);  // 时间 单位：分钟
                if($k['category']==2||$k['category']==4){
                    // 是外卖
                    $msg[$kid]['qsmoney'] = $k['qsmoney'];   //起送费
                    if($k['calculatedDistance']<=3){
                        $msg[$kid]['psmoney'] = 4; //配送费
                    }else{
                        $msg[$kid]['psmoney'] = 4 + round($k['calculatedDistance']) - 3;
                    }
                }else{
                    $msg[$kid]['qsmoney'] = '';
                    $msg[$kid]['psmoney'] = '';
                }
                $vid = 0;
                foreach ($dt as $v){
                    $msg[$kid]['goods'][$vid]['goodsid'] = $v['goodsid'];
                    $msg[$kid]['goods'][$vid]['image'] = $v['image'];
                    $msg[$kid]['goods'][$vid]['goodsname'] = $v['goodsname'];
                    $msg[$kid]['goods'][$vid]['goodsprice'] = $v['goodsprice'];
                    $vid ++;
                }
                for ($i = count($dt);$i<3;$i++){
                    $msg[$kid]['goods'][$i]['goodsid'] = '';
                    $msg[$kid]['goods'][$i]['goodsname'] = '';
                    $msg[$kid]['goods'][$i]['goodsprice'] = '';
                    $msg[$kid]['goods'][$i]['image'] = '';
                }
                $kid ++;
            }
        }
        // 排序
        $msg = $this->getPaixuByShopsJuliHasShopGoods($msg);
        //msg and result 去重复
        // 获取相同
        $kid = 0;//dump($result);dump($msg);
        foreach ($result as $k){
            $vid = 0;
            foreach ($msg as $v){
               // dump($k['shopid']);dump($v['shopid']);
                if($k['shopid'] == $v['shopid']){
                    $msgs[$kid] = $v;
                    unset($result[$kid]);
                    unset($msg[$vid]);
                    $kid ++;
                }
                $vid ++;
            }

        }
        sort($result);
        sort($msg);
        // 拼接上不同的
        if($result) {
            $count = count($msgs);
            for ($i=0;$i<count($result);$i++){
                $msgs[$count] = $result[$i];
                $count ++;
            }
        }
        if($msg) {
            $count = count($msgs);
            for ($i=0;$i<count($msg);$i++){
                $msgs[$count] = $msg[$i];
                $count ++;
            }
        }
        $msgs = $this->getPaixuByShopsJuliHasShopGoods($msgs);
        return $msgs;
    }
    /**
     * 辅助方法二：对店铺进行距离排序，排序完成后，选择前三样商品返回
     */
    public function getPaixuByShopsJuli($result,$lng1,$lat1){
        // 对数据进行选择
        $kid = 0;
        foreach ($result as $k){
            $data[$kid]['shopid'] = $k['shopid'];
            // 营业状态
            $data[$kid]['flag'] = $this->getShopStatus($k['shopid']);
            $data[$kid]['shophead'] = $this->path.$k["shophead"];
            $data[$kid]['shopname'] = $k["shopname"];
            $data[$kid]['fenshu'] = $this->getStar($k["shopid"]);    // 星级
            $data[$kid]['pingjun'] = $this->getPersonOne($k["shopid"]);   //人均
            $data[$kid]['salenum'] = $this->getMouthOrder($k['shopid']); //月销售
            $data[$kid]['hui'] = $this->getHui($k['shopid']);  //优惠活动
            $data[$kid]['manjian'] = $this->getManJian($k['shopid']);  //满减活动
            $du = explode(',',$k["coordinator"]);
            $data[$kid]["juli"] = $this->getJuLi($lng1,$lat1,$du[0],$du[1]);
            $data[$kid]['gotime'] = round(($data[$kid]["juli"]/$this->sudu)*60);  // 时间 单位：分钟
            if($k['category']==2||$k['category']==4){
                // 是外卖
                $data[$kid]['qsmoney'] = $k['qsmoney'];   //起送费
                if($k['calculatedDistance']<=3){
                    $data[$kid]['psmoney'] = 4; //配送费
                }else{
                    $data[$kid]['psmoney'] = 4 + round($k['calculatedDistance']) - 3;
                }
            }else{
                $data[$kid]['qsmoney'] = '';
                $data[$kid]['psmoney'] = '';
            }
            $kid ++;
        }
      // 排序
        $count = count($data);
        for ($i = 1; $i < $count; $i++) {
            for ($j = 0; $j < $count - $i; $j++) {
                if($data[$j]['juli']>$result[$j+1]['juli']){
                    $data2= $this->exchangeArray($data[$j],$data[$j+1]);
                    $data[$j] = $data2['arr1'];
                    $data[$j+1] = $data2['arr2'];
                }
            }
        }
        //每个店铺携带三个菜品
        $kid = 0;
        foreach ($data as $k){
            $goods = M('goods')->where(['shopid'=>$k['shopid']])->limit(3)->select();
            $vid = 0;
            if(count($goods)==0){
                $data[$kid]['goods'] = array();
            }else {
                for ($countid = 0; $countid < count($goods); $countid++) {
                    $img = M('goodsimg')->where(['goodsid' => $k['goodsid']])->field('img')->select();
                    $data[$kid]['goods'][$vid]['goodsid'] = $k['goodsid'];
                    $data[$kid]['goods'][$vid]['image'] = $this->path . $img[0]['img'];
                    $data[$kid]['goods'][$vid]['goodsname'] = $k['goodsname'];
                    $data[$kid]['goods'][$vid]['goodsprice'] = $k['goodsprice'];
                    if ($vid == 2) {
                        break;
                    }
                    $vid++;
                }
            }
                $kid ++;
          //  $data[$kid]['goods'] =
        }
        return $data;
    }
    /**
     * 辅助方法三：对通过与菜品名称对比获取的店铺名称和菜品名称排序
     */
    public function getPaixuByShopsJuliHasShopGoods($result){
        $count = count($result);
        for ($i = 1; $i < $count; $i++) {
            for ($j = 0; $j < $count - $i; $j++) {
                if($result[$j]['juli'] > $result[$j+1]['juli']){
                    $data = $this->exchangeArray($result[$j],$result[$j+1]);
                    $result[$j] = $data['arr1'];
                    $result[$j+1] = $data['arr2'];
                    // 商品之间的互换
                    for($i = 0;$i< 3;$i++){
                       $ls =  $this->exchangeGoodsMsg($result[$j]['goods'][$i],$result[$j+1]['goods'][$i]);
                       $result[$j]['goods'][$i] = $ls[0];
                       $result[$j+1]['goods'][$i] = $ls[1];
                    }
                }
            }
        }
        return $result;
    }
    /**
     * 辅助方法三一：对菜品ID，名称，价格，图片互换
     */
    public function exchangeGoodsMsg($arr1,$arr2){
        $one['goodsid'] = $arr1['goodsid'];
        $one['goodsname'] = $arr1['goodsname'];
        $one['goodsprice'] = $arr1['goodsprice'];
        $one['image'] = $arr1['image'];

        $arr1['goodsid'] = $arr2['goodsid'];
        $arr1['goodsname'] = $arr2['goodsname'];
        $arr1['goodsprice'] = $arr2['goodsprice'];
        $arr1['image'] = $arr2['image'];

        $arr2['goodsid'] = $one['goodsid'];
        $arr2['goodsname'] = $one['goodsname'];
        $arr2['goodsprice'] = $one['goodsprice'];
        $arr2['image'] = $one['image'];
        $data[0] = $arr1;
        $data[1] = $arr2;
        return $data;
    }

}