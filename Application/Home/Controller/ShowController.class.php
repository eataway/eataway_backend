<?php
namespace Home\Controller;


use Think\Controller;

// 无须登陆即可查看
class ShowController extends Controller
{
    public $shopnum = 5;  //首页返回默认商铺的数量
    public $path = 'http://jyg.sawfree.com/';

    /**
         * @desc：一：APP首页默认显示：获取城市，经纬度，分页数，二：APP首页下拉加载：获取分页数
         */
    public function index(){
            if(IS_POST){
                $post = I('post.');
                $postDcity = $post['city'];  // 获取城市名称，根据城市名称获取店铺
                $postDlng1 = $post['lng1'];  // 获取经度值，定位算距离
                $postDlat1 = $post['lat1'];  // 获取纬度值，定位算距离
                $postDpage = $post['page'];  //
                $postDtown = $post['town'];  // 区县
                // 测试数据开始
//                $postDcity = '石家庄市';
//                $postDlng1 = 116;
//                $postDlat1 = 39;
//                $postDpage = 1;
//                $postDtown = '裕华区';
                // 测试数据终止
                // 1.0 判断是否全部获取到了必填参数
                if(!$postDcity||!$postDlng1||!$postDlat1||!$postDpage){
                    $this->ajaxReturn(['status'=>0]);  // 参数值没有完全取到
                }
                // 2.0 获取轮播图，不同的区县显示不同的轮播图，有过期时间限制，原先是根据shop表的推荐字段获取轮播图
                // $arr['images'] = M('shop')->where(['status'=>1])->field()
                if($postDpage<2) {                    // 获取首页轮播图
                   // $arr["images"] = M("shop")->where('tuijian=1')->field('shopid')->select();
                    $lbmsg['tuijian'] = 1;
                    $lbmsg['xian'] = $postDtown;
                    $shopmsg = M('shop')->where($lbmsg)->field('shopid,image')->select();
                    $lbgmsg['tuijian'] = 1; //商品被推荐
                    $lbgmsg['tuijiantime'] = array('gt',date('Y-m-d H:i:s',time()));  // 时间筛选
                    $goodsmsg = M('goods')->where($lbmsg)->field('goodsid,image')->select();
                    if(empty($goodsmsg)&&empty($shopmsg)){
                        $arr['images'] = array();
                    }else{
                        $countshopmsg = count($shopmsg);
                        if($countshopmsg!=0){
                            $kid = 0;
                            foreach ($shopmsg as $k){
                                $shopmsg[$kid]['kindid'] = 1;
                                $kid ++;
                            }
                            $arr['images'] = $shopmsg;
                        }
                        if($countshopmsg<4){
                            $kid = 0;
                            foreach ($goodsmsg as $k){
                                $goodsmsg[$kid]['kindid'] = 2;
                                $kid ++;
                            }
                            $arr['images'] = array_merge($shopmsg,$goodsmsg);
                        }
                    }
                    $data['banners'] = array_slice($arr['images'],0,4);
                }
                // 3.0 获取默认一级分类
                if($postDpage<2) {
                    // 获取店铺分类
                    $shopkinds = M('shopkind')->where(['fatherid'=>0])->select();
                    $kindid = 0;
                    if ($shopkinds) {
                        foreach ($shopkinds as $k => $v) {
//                        foreach ($k as $v) {
                            $data['shopkind'][$kindid]['shopkindid'] = $v['shopkindid'];
                            $data['shopkind'][$kindid]['kindname'] = $v['kindname'];
                            $data['shopkind'][$kindid]['image'] =  $v['image'];
                            $kindid++;
//                        }
                        }
                    } else {
                        $data['shopkind'] = array();
                    }
                }
                // 4.0 判断是否有该城市的商家
                $paiXu = new ParamController();
                $data['shops'] = $paiXu->getShopsDetailsApaixuByJuLi($postDcity,$postDlng1,$postDlat1);
                // 4.1 没有则返回
                if(!$data['shops']){
                    // 该城市没有店铺
                    if($postDpage<2){
                        $this->ajaxReturn(['status'=>1,'banners'=>$data['banners'],'shopkind'=>$data['shopkind']]);
                    }else{
                        $this->ajaxReturn(['status'=>3]);
                    }

                }
                // 4.2 有则对店铺数据分页输出
                $page2 = new SuanFaController();
                $data['shops'] = $page2->goPage($postDpage,$this->shopnum,$data["shops"]);
               // 该城市有店铺，返回店铺信息
                if($postDpage<2){
                    $data['status'] = 2;    //返回轮播图和分类和店铺
                }else{
                    $data['status'] = 4;    //返回店铺
                }
                $this->ajaxReturn($data);
            }
        }
    /**
     * @desc:APP首页筛选
     */
    public function indexShaiXuan(){
        if(IS_POST){
            // 判断是否是post请求
            $post = I('post.');
            // 获取判断条件--城市和坐标和距离
            $postDcity = $post['city'];     // 定位到的城市
            $postDlat1 = $post['lat1'];     // 定位坐标的纬度
            $postDlng1 = $post['lng1'];     // 定位坐标的经度
            $postDjuli = $post["juli"];     // 筛选条件1：距离长度，单位：km
            $postDshopkindid = $post['foodkindid'];  // 筛选条件2：店铺分类一级分类的分类ID
            $postDzhineng = $post['zhineng'];    // 筛选条件3：智能排序的条件，int型
            $postDlast = $post['last'];           // 筛选条件4：堂食1，外卖2
            $postDprice = $post['price'];          //  筛选条件5，价格
            $postDpage = $post['page'];      // 要获取的数据所在的页数

            // 测试数据开始
//            $postDcity = '石家庄市';
//            $postDlat1=23.1323;
//            $postDlng1=113.314221;
//            $postDjuli = 0.5;
//            $postDshopkindid = '';
//            $postDzhineng = '';
//            $postDlast = '';
//            $postDprice = '';
//
//            $postDpage = 1;
            // 测试数据完成

            // 筛选条件1
            if($postDjuli&&$postDcity&&$postDlat1&&$postDlng1){
                $sx = new ParamController();
                $result =  $sx->sXByJuLi($postDcity,$postDlng1,$postDlat1,$postDjuli);
                if(!$result){
                    // 第一个筛选条件已筛选不到数据，直接返回
                    $this->ajaxReturn(['status'=>2]);
                }
            }
            //筛选条件2
            if($postDshopkindid&&$postDcity&&$postDlat1&&$postDlng1){
                // 判断是否有筛选出的数据
                if(empty($result)){
                   $result = array();
                }
                $sx = new ParamController();
                $result = $sx->sXByShopKindId($result,$postDshopkindid,$postDcity,$postDlng1,$postDlat1);
                if(!$result){
                    // 筛选条件没有数据，直接返回
                    $this->ajaxReturn(['status'=>2]);
                }
            }
            // 筛选条件3
            if($postDzhineng&&$postDcity&&$postDlat1&&$postDlng1){
                // 判断result是否为空
                if(empty($result)){
                    $result=array();
                }
                $sx = new ParamController();
                $result = $sx->sXByZhiNengId($result,$postDzhineng,$postDcity,$postDlng1,$postDlat1);
                if(!$result){
                    // 筛选条件没有数据，直接返回
                    $this->ajaxReturn(['status'=>2]);
                }
                if($result == 2){
                    // 筛选条件格式错误
                    $this->ajaxReturn(['status'=>3]);
                }
            }
            // 判断是否有堂食，外卖，要求
            if($postDlast&&$postDcity&&$postDlat1&&$postDlng1){
                // 判断result是否为空
                if(empty($result)){
                    $result = array();
                }
                $sx = new ParamController();
                $result = $sx->sXByLastId($result,$postDlast,$postDcity,$postDlng1,$postDlat1);
                if(!$result){
                    // 筛选条件没有数据，直接返回
                    $this->ajaxReturn(['status'=>2]);
                }
                if($result == 2){
                    // 筛选条件格式错误
                    $this->ajaxReturn(['status'=>3]);
                }
            }
            // 判断是否有价格的要求  10.6
            if($postDprice&&$postDcity&&$postDlat1&&$postDlng1){
                // 对价格进行筛选
                if(empty($result)){
                    $result = array();
                }
                $sx = new ParamController();
                $result = $sx->getShopsDetailsByPrice($result,$postDprice);
                if(!$result){
                    // 筛选条件没有数据，直接返回
                    $this->ajaxReturn(['status'=>2]);
                }
            }
            if(empty($result)){
                $this->ajaxReturn(['status'=>0]);
            }else{
                if($result){
                    // 对数组分页处理
                    $page2 = new SuanFaController();
                    $result['city'] = $page2->goPage($postDpage,$this->shopnum,$result);
                    if($result['city']){
                        $this->ajaxReturn(['status'=>1,'shops'=>$result['city']]);
                    }else{
                        $this->ajaxReturn(['status'=>2]);
                    }

                }else{
                    $this->ajaxReturn(['status'=>2]);
                }
            }
        }
    }
    /**
     * 默认搜索页面内容
     */
    public function searchMoRen(){
        if(IS_POST){
            $post = I('post.');
            $postDcity = $post['city'];
            $postDlng1 = $post['lng1'];
            $postDlat1 = $post['lat1'];
            $postDpage = $post['page'];
            $postDshopkindid = $post['shopkindid'];
            // 测试数据开始
//            $postDpage = 1;
//            $postDcity = '石家庄市';
//            $postDlng1 = 116;
//            $postDlat1 = 39;
//            $postDshopkindid = 1;
            // 测试数据结束
            if(!$postDlat1||!$postDlng1||!$postDcity||!$postDpage){
                $this->ajaxReturn(['status'=>0]);
            }
            if($postDpage<2) {
                // 搜索分类
                if (!$postDshopkindid) {
                    //为空，搜索一级分类
                    $kinds = M('shopkind')->where(['fatherid' => 0])->field('shopkindid,kindname')->select();
                } else {
                    $kinds = M('shopkind')->where(['fatherid' => $postDshopkindid])->field('shopkindid,kindname')->select();
                }
                $data['kinds'] = $kinds;
            }
            // 从近到远显示店铺
            $sx = new ParamController();
            $sx = $sx->getShopsDetailsApaixuByJuLi($postDcity,$postDlng1,$postDlat1);

            if(!empty($postDpage)){
                $px = new SuanFaController();
                $px = $px->goPage($postDpage,$this->shopnum,$sx);
            }else{
                $px = array();
            }
            $data['shops'] = $px;
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }
    /**
     * 搜索，搜索店铺，菜品，菜品分类
     */
    public function showSearch(){
        if(IS_POST){
            $post = I('post.');
            $postDcity = $post['city'];
            $postDlng1 = $post['lng1'];
            $postDlat1 = $post['lat1'];
            $postDcontent = $post['content'];
            $postDpage = $post['page'];
            $postDfoodkindid = $post['foodkindid'];
            $postDjuli = $post['juli'];
            $postDzhineng = $post['zhineng'];
            $postDlast = $post['last'];
            $postDprice = $post['price'];
            // 测试数据开始
//            $postDcity = '石家庄市';
//            $postDlng1 = 116;
//            $postDlat1 = 39;
//            $postDcontent = 'Y';
//            $postDpage = 1;

//            $postDfoodkindid = 1;
        //    $postDjuli = 1686820000;
//            $postDzhineng = 3;
//            $postDlast = 3;
//            $postDprice = '0-100';
            // 测试数据结束
            if(!$postDlat1||!$postDlng1||!$postDcity||!$postDcontent){
                $this->ajaxReturn(['status'=>0]);
            }
            $dt = new SupplyParamController();
            $dt = $dt->getShopMsgBySearchMsg($postDcity,$postDlng1,$postDlat1,$postDcontent);
            if(!$dt){
                $this->ajaxReturn(['status'=>2]);
            }
            $kid = 0;
            if(!empty($postDfoodkindid)){   // 对店铺种类进行筛选
                foreach ($dt['shops'] as $k){
                    $remsg['shopid'] = $k['shopid'];
                    $remsg['shopkindidf'] = $postDfoodkindid;
                    $re = M('shop')->where($remsg)->select();
                    if(empty($re)){
                        $remsg2['shopid'] = $k['shopid'];
                        $remsg2['shopkindids'] = $postDfoodkindid;
                        $re = M('shop')->where($remsg2)->select();
                        if(empty($re)){
                            unset($dt['shops'][$kid]);
                        }
                    }
                    $kid ++;
                }
            }
            ksort($dt['shops']);
            $kid = 0;
            if(!empty($postDjuli)){  // 距离
                foreach ($dt['shops'] as $k){
                    if($k['juli']>$postDjuli){
                        unset($dt['shops'][$kid]);
                    }
                    $kid ++;
                }
            }
            ksort($dt['shops']);
            if(!empty($postDzhineng)){
                $zn = new ParamController();
                if($postDzhineng == 1){  // 评价由低到高
                   $dt['shops'] = $zn->getShopsDetailsApaixuByPJDG($dt['shops']);
                }elseif($postDzhineng == 2){
                    $dt['shops'] = $zn->getShopsDetailsApaixuByPJGD($dt['shops']);
                }elseif($postDzhineng == 3){
                    $dt['shops'] = $zn->getShopsDetailsApaixuByJuLiJDY($dt['shops']);
                }elseif($postDzhineng == 4){
                    $dt['shops'] = $zn->getShopsDetailsApaixuByJuLiYDJ($dt['shops']);
                }elseif($postDzhineng == 5){
                    $dt['shops'] = $zn->getShopsDetailsApaixuByJJDG($dt['shops']);
                }else{
                    $dt['shops'] = $zn->getShopsDetailsApaixuByJJGD($dt['shops']);
                }
            }
            if(!empty($postDlast)){
                if($postDlast == 1){  // 删除不是堂食的
                    $kid = 0;
                    foreach ($dt['shops'] as $k){
                        $res = M('shop')->where(['shopid'=>$k['shopid']])->select();
                        if($res[0]['category'] != 1&&$res[0]['category'] != 4){
                            unset($dt['shops'][$kid]);
                        }
                        $kid ++;
                    }
                }elseif($postDlast == 2){   // 删除不是外卖的
                    $kid = 0;
                    foreach ($dt['shops'] as $k){
                        $res = M('shop')->where(['shopid'=>$k['shopid']])->select();
                        if($res[0]['category'] != 2&&$res[0]['category'] != 4){
                            unset($dt['shops'][$kid]);
                        }
                        $kid ++;
                    }
                }
                 // 删除人均不合适的
                    if(!empty($postDprice)){   //审核价格
                        $arr = explode('-',$postDprice);
                        if($arr[0]>$arr[1]){  // 只使用第一个参数
                            $kid = 0;
                            foreach ($dt['shops'] as $k){
                                if($k['pingjun']<$arr[0]){
                                    unset($dt['shops'][$kid]);
                                }
                                $kid ++;
                            }
                        }else{
                            $kid = 0;
                            foreach ($dt['shops'] as $k){
                                if($k['pingjun']>$arr[1]||$k['pingjun']<$arr[0]){
                                    unset($dt['shops'][$kid]);
                                }
                                $kid ++;
                            }
                        }
                    }
                }
               // dump($dt);
            ksort($dt['shops']); // dump($dt);exit;
            // 对数据进行筛选
            // 分页处理
            if(!empty($dt['shops'])){
                $page2 = new SuanFaController();
                if(count($dt['shops'])>$this->shopnum){
                    $dt['shops'] = $page2->goPage($postDpage,$this->shopnum,$dt['shops']);
                }else{
                    $dt['shops'] = $page2->goPage($postDpage,count($dt['shops']),$dt['shops']);
                }

            }else{
                $this->ajaxReturn(['status'=>2]);
            }
            if(empty($dt['shops'])){
                $this->ajaxReturn(['status'=>2]);
            }
            $dt['status'] = 1;
            $this->ajaxReturn($dt);
        }
    }
    /**
     *  保存当前用户定位的位置
     */
    public function position(){
        if(IS_POST){
            $post = I('post.');
            if(!$post['state']||!$post['city']||!$post['userid']||!$post['token']){
                $this->ajaxReturn(['status'=>0]);
            }
            $state = explode('省',$post['state'])[1];
            $city = explode('市',$post['city'])[1];
            if(!$city){
                $city = explode('区',$post['city'])[1];
            }
            if(!$city){
                $city = explode('县',$post['city'])[1];
            }
            if($post['town']){
                $town = explode('区',$post['town'])[1];
                if(!$town){
                    $town = explode('县',$post['town'])[1];
                }
                if(!$state||!$city){
                    $this->ajaxReturn(['status'=>1]);
                }
                if(S('token',$post['userid'])==$post['token']){
                    $this->ajaxReturn(['status'=>2]);
                }
            }
            if($post['town']){
                $result = M('user')->where(['userid'=>$post['userid']])->save([
                    'state'=>$post['state'],
                    'city'=>$post['city'],
                    'town'=>$post['town']
                ]);
            }else{
                $result = M('user')->where(['userid'=>$post['userid']])->save([
                    'state'=>$post['state'],
                    'city'=>$post['city'],
                ]);
            }

            if($result){
                $this->ajaxReturn(['status'=>3]);
            }else{
                $this->ajaxReturn(['status'=>4]);
            }

        }
    }

}
