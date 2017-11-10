<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/8/15
 * Time: 10:58
 */
namespace Home\Controller;

// 商品详情页
use Think\Controller;

class ShopDetailsController extends Controller
{
    public $path = 'http://192.168.2.117/waimai/';
    public $numPage = 3;
    /**
     * 商户详情页
     * 需要的参数：shopid(店铺ID);
     * 输出内容：data，包含的信息有shopphoto店铺图片，phphead店铺logo，shopname店铺名称，salesnum月销售，pingjun人均，口味，环境，服务
     */
    public function index(){
        if(IS_POST){
            // 利用店铺ID获取店铺信息
            $posts = I('post.');
            // 利用post获取的数据
            $postDshopid = $posts['shopid'];
            $postDlng = $posts['lng1'];
            $postDlat = $posts['lat1'];
            $postDuserid = $posts['userid'];
            $postDtoken = $posts['token'];
            // 测试数据开始
//           $postDshopid = 5;
//           $postDuserid = 9;
            // 测试数据结束
            if($postDshopid==null){
                $this->ajaxReturn(['status'=>2]);
            }
            $sx = new ParamController();
            $result = $sx->getShopDetailsByShopId($postDshopid,$postDlng,$postDlat,$postDuserid,$postDtoken);
            if(!empty($result['shopid'])){
                $result['status'] = 1;
            }else{
                unset($result);
                $result['status'] = 0;
            }
            $this->ajaxReturn($result);
        }
    }
    /**
     * 商品详情页
     */
    public function goodsDetails(){
        if(IS_POST){
            $post = I('post.');
            $postDgoodsid = $post['goodsid'];
            $postDuserid = $post['userid'];  //判断是否领取过优惠劵
            $postDtoken = $post['token'];
            $postDlng = $post['lng1'];
            $postDlat= $post['lat1'];
            // 测试数据开始
           // $postDgoodsid = 1;
            //测试数据结束
            // 判断是否为空，返回错误0
            if(empty($postDgoodsid)){
                $this->ajaxReturn(['status'=>0]);
            }
            $goods = M('goods')->where(['goodsid'=>$postDgoodsid])->field('shopid,goodsname,addtime,goodscontent,goodsprice,flag')->select();
            $wx = new ParamController();
           // $goodsDetails['fenshu'] = $wx->getStar($postDshopid);
            // 获取图片
            $goodsDetails['image'] = M('goodsimg')->where(['goodsid'=>$postDgoodsid])->limit(1)->field('img')->select();
            $kid =0;
            foreach ($goodsDetails['image'] as $k){
                $goodsDetails['image'][$kid]['img'] = $k['img'];
            }
            $goodsDetails['shopid'] = $goods[0]['shopid'];
            $shopmsg = M('shop')->where(['shopid'=>$goods[0]['shopid']])->select();
            $goodsDetails['shopname'] = $shopmsg[0]['shopname'];
            $goodsDetails['shophead'] = $shopmsg[0]['shophead'];
//            $star = new ParamController();
//            $goodsDetails['fenshu'] = $star->getStar($goods[0]['shopid']);  // 星级
            $goodsDetails['flag'] = $goods[0]['flag'];
            $goodsDetails['image'] =  $goodsDetails['image'][$kid]['img'];
            $goodsDetails['goodsname'] = $goods[0]['goodsname'];
         //   $goodsDetails['']
            // 获取月销售
            $ordermsg['shopid'] = $goods[0]['shopid'];
            $date = mktime(0,0,0,date('m'),1,date('Y'));
            $date2 = strtotime($goods[0]['addtime']);
            if($date<$date2){
                // 该月修改过商品，商品该月销售从修改时间算起
                $date = $date2;
            }
            $date = date('Y-m-d H:i:s',$date);
            $ordermsg['addtime'] = array('gt',$date);
            $ordermsg['state'] = array('in',array('4','5'));
            $shops = M('orders')->where($ordermsg)->field('orderid,goodsinfo')->select();
            // 统计数量
            $tj = 0;
            foreach ($shops as $k){
                // 将商品信息拆分
                $goodsarray = explode('|',$k['goodsinfo']);
                $count = count($goodsarray);
                $kbid = 0;
                foreach ($goodsarray as $kb){
                    // 再次拆分
                    $goodsarr = explode(',',$kb[$kbid]);
                    //判断是否是该商品，是则累积，
                    if($goodsarr[0] == $postDgoodsid){
                        $tj ++;
                    }
                    $kbid ++;
                }
            }
        }
        $goodsDetails['salenum'] = $tj;
        $goodsDetails['content'] = $goods[0]['goodscontent'];
        $goodsDetails['goodsprice'] = $goods[0]['goodsprice'];
        $guiges = M('goodsguige')->where(['goodsid'=>$postDgoodsid])->field('gid,gname,gcontent,price')->select();   //商品规格
        $goodsDetails['goodsguige'] = $guiges;
        $tuijianmsg['shopid'] = $goods[0]['shopid'];
        $tuijianmsg['goodsid'] = $postDgoodsid;
        $goodstuijian = M('user_goods')->where($tuijianmsg)->field('userid')->select();
        $goodsDetails['recommendnum'] = count($goodstuijian);
        $goodsDetails['otherpic'] = M('goodsimg')->where(['goodsid'=>$postDgoodsid])->field('img')->select();
        //去掉第一个图片
        $kid = 0;
        foreach ($goodsDetails['otherpic'] as $k){
            if($kid==0) {
                unset($goodsDetails['otherpic'][$kid]);
            }else{
                $goodsDetails['otherpic'][$kid] = $k['img'];
            }
            $kid ++;
        }
        sort($goodsDetails['otherpic']);
        $goodsDetails['otherpic'] = $goodsDetails['otherpic'];
        // 10.6 添加满减优惠劵和起送费和配送费
        // 10.6.1 满减
        $manjianmsg['shopid'] = $goods[0]['shopid'];
        $manjianmsg['sts'] = 1;
        $manjianmsg['state'] = 1;
        $manjianmsg['starttime'] = array('elt',date('Y-m-d H:i:s',time()));
        $manjianmsg['endtime'] = array('egt',date('Y-m-d H:i:s',time()));
        $manjian = M('manjian')->where($manjianmsg)->field('yid,title,manmoney,jianmoney')->select();
        $goodsDetails['manjian'] = $manjian;
        // 10.6.2 优惠劵
        $manjianmsg['state'] = 2;
        $yh = M('manjian')->where($manjianmsg)->field('yid,title,manmoney,jianmoney')->select();
        if(S('token'.$postDuserid) == $postDtoken){
            // 登录后判断是否是领取过或者使用过的
            $kid = 0;
            foreach ($yh as $k){
                    // 判断该劵是否已经使用过和领取过
                     $usedmsg['userid'] = $postDuserid;
                     $usedmsg['shopid'] = $goods['shopid'];
                     $usedmsg['yid'] = $k['yid'];
                     $used = M('userquan')->where($usedmsg)->field('state')->select();
                        if(empty($used)){
                            // 空说明没有符合要求的劵，说明未领取
                            $yh[$kid]['juanstate'] = 0;
                        }elseif($used[0]['state'] == 1){
                            // 说明未使用
                            $yh[$kid]['juanstate'] = 1;
                        }elseif($used[0]['state'] == 2){
                            // 说明已经使用
                            $yh[$kid]['juanstate'] = 2;
                        }
                        $usedmsg['starttime'] = array('elt',date('Y-m-d H:i:s',time()));
                         $usedmsg['endtime'] = array('egt',date('Y-m-d H:i:s',time()));
                         $used = M('userquan')->where($usedmsg)->select();
                         if(empty($used)){
                             // 说明劵已经过期
                             $yh[$kid]['juanstate'] = 3;
                         }
                     $kid ++;
                }
        }else{
            // 不登录统一是领取过的
            $kid = 0;
            foreach ($yh as $k){
                $yh[$kid]['juanstate'] = 0;
                $kid ++;
            }
        }
        $goodsDetails['yh'] = $yh;
        // 10.6 该店铺的配送费和起送费
        $qs = M('shop')->where(['shopid'=>$goods[0]['shopid']])->field('sat,category,qsmoney,coordinator')->select();
        $goodsDetails['sat'] = $qs[0]['sat'];
        $goodsDetails['shopkind'] = $qs[0]['category'];
        $goodsDetails['qsmoney'] = $qs[0]['qsmoney'];
        // 配送费需要用到坐标
//        $postDlat = 39;
//        $postDlng = 116;
        if($postDlat&&$postDlng){
            $ps = new ParamController();
            // 获取店铺的经纬度
            if($qs[0]['coordinator'] == null){
                $goodsDetails['psmoney'] = 0;  // 店铺没有坐标
            }else{
                $coor = explode(',',$qs[0]['coordinator']);
                $psjulli = $ps->getJuLi($postDlng,$postDlat,$coor[0],$coor[1]);
                $goodsDetails['psmoney'] = 4 + round($psjulli) - 3;
            }
        }else{
            $goodsDetails['psmoney'] = 0;
        }

        $this->ajaxReturn(['status'=>1,'goodsDetails'=>$goodsDetails]);
    }
    /**
     * 代金券、优惠券列表
     */
    public function cashCouPons(){
        if(IS_POST){
            $post = I('post.');
            $postDshopid = $post['shopid'];
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            // 测试数据开始
//            $postDshopid = 5;
//            $postDuserid = 9;
            //测试数据结束
            if(empty($postDshopid)){
                $this->ajaxReturn(['status'=>0]);
            }
            // 获取未过期的代金券
            $msg['shopid'] = $postDshopid;
            $msg['starttime'] = array('elt',date('Y-m-d H:i:s',time()));
            $msg['endtime'] = array('egt',date('Y-m-d H:i:s',time()));
            $msg['state'] = 2;   // 优惠劵
            $msg['sts'] = 1;  // 启用

            $quan = M('manjian')->where($msg)->field('yid,title,manmoney,jianmoney,starttime,endtime')->select();
            if(S('token'.$postDuserid) == $postDtoken){
                $userquanmsg['userid'] = $postDuserid;
                $userquanmsgp['shopid'] = $postDshopid;
                $userquan = M('userquan')->where($userquanmsg)->field('yid,state,starttime,endtime')->select();
                //dump($userquan);exit;
                $kid = 0;
                foreach ($quan as $k){
                    if(!empty($userquan)) {
                        foreach ($userquan as $v) {
                            if ($k['yid'] == $v['yid']) {
                                unset($quan[$kid]['juanstate']);
                                if ($v['state'] == 2) {
                                    // 使用过
                                    $quan[$kid]['juanstate'] = 2;
                                } elseif ($v['starttime'] > date('Y-m-d H:i:s', time()) || $v['endtime'] < date('Y-m-d H:i:s', time()) || $k['starttime'] > date('Y-m-d H:i:s', time()) || $k['endtime'] < date('Y-m-d H:i:s', time())) {
                                    $quan[$kid]['juanstate'] = 3; //过期
                                } elseif ($v['state'] == 1) {
                                    // 未使用
                                    $quan[$kid]['juanstate'] = 1;
                                }

                            }
                        }
                        $kid++;
                    }
                }
                // 没有领过的劵
                    // 用户没有领券
                    $kid = 0;
                    foreach ($quan as $k){
                        if($quan[$kid]['juanstate']){}else {
                            if ($k['starttime'] > date('Y-m-d H:i:s', time()) || $k['endtime'] < date('Y-m-d H:i:s', time())) {
                                // 过期
                                $quan[$kid]['juanstate'] = 3;
                            } else {
                                // 没有领取
                                $quan[$kid]['juanstate'] = 0;
                            }
                        }
                        $kid ++;
                    }
               // dump($quan);exit;
            }else{
                $kid = 0;
                foreach ($quan as $k){
                    unset($quan[$kid]['juanstate']);
                    $quan[$kid]['juanstate'] = 0;
                    $kid ++;
                }
            }
            if($quan){
                $this->ajaxReturn(['status'=>1,'coupons'=>$quan]);
            }else{
                $this->ajaxReturn(['status'=>2]);
            }
        }
    }
    /**
     * 点击领劵
     */
    public function CouPons(){
        if (IS_POST){
            $post = I('post.');
            $postDyid = $post['yid'];
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            // 测试数据开始
//            $postDuserid = 1;
//            $postDyid = 2;
            // 测试数据结束
            if(empty($postDuserid)||empty($postDtoken)||empty($postDyid)){
                $this->ajaxReturn(['status'=>0]);
            }
            if(S('token'.$postDuserid) != $postDtoken){
                $this->ajaxReeturn(['status'=>1]);
            }
           // 判断是否领取
            $usermanjianmsg['userid'] = $postDuserid;
            $yrn = M('userquan')->where($usermanjianmsg)->field('yid')->select();
            $kid = 0;
            foreach ($yrn as $k){
                if($k['yid'] == $postDyid){
                    $kid ++;
                    break;
                }
            }
            if($kid == 1){
                // 领取过
                $this->ajaxReturn(['status'=>2]);
            }elseif($kid == 0){
                // 未领取,判断是否过期
                $goqimsg['yid'] = $postDyid;
                $guoqi = M('manjian')->where($goqimsg)->field('sts')->select();
                if($guoqi[0]['sts'] == 2){
                    $this->ajaxReturn(['status'=>6]);
                }
                // 将该优惠劵插入数据库中
                $ydetails = M('manjian')->where(['yid'=>$postDyid])->field('shopid,manmoney,jianmoney,starttime,endtime')->select();
                $result = M('userquan')->add([
                    'shopid'=>$ydetails[0]['shopid'],
                    'userid'=>$postDuserid,
                    'yid'=>$postDyid,
                    'manmoney'=>$ydetails[0]['manmoney'],
                    'jianmoney'=>$ydetails[0]['jianmoney'],
                    'state'=>1,
                    'starttime'=>$ydetails[0]['starttime'],
                    'endtime'=>$ydetails[0]['endtime'],
                    'addtime'=>date('Y-m-d H:i:s',time())
                ]);
                if($result){
                    $this->ajaxReturn(['status'=>4]);
                }else{
                    $this->ajaxReturn(['status'=>5]);
                }
            }else{
                $this->ajaxReturn(['status'=>3]);
            }

        }
    }
    /**
     * 切换堂食和外卖
     */
    public function exChangeShopKind(){
        if(IS_POST){
            $post = I('post.');
            $postDshopid = $post['shopid'];
            $postDkindid = $post['shopkindid'];
            // 测试数据开始
//            $postDshopid = 5;
//            $postDkindid = 2;
            // 测试数据结束
            if(!$postDkindid){
                $this->ajaxReturn(['status'=>0]);
            }
            $sx = new ParamController();
            if($postDkindid == 1){
                // 堂食
                $result = $sx->getShopTSByShopId($postDshopid);
            }elseif($postDkindid == 2){
                // 外卖
                $result = $sx->getShopWMByShopId($postDshopid);
            }else{
                $this->ajaxReturn(['status'=>0]);
            }
            $result['status'] = 1;
            $this->ajaxReturn($result);
        }
    }
    /**
     * 切换商品分类
     */
    public function exChangeGoodsKind(){
        if(IS_POST){
            // 通过分类ID获取商品信息
            $post = I('post.');
            $postDkindid = $post['cid'];
            // 测试数据开始
//            $postDkindid = 13;
            // 测试数据结束
            if(!$postDkindid){
                $this->ajaxReturn(['status'=>0]);
            }
            $sx = new ParamController();
            $result = $sx->getExchangeGoodsKinds($postDkindid);
            if($result == 2){
                $this->ajaxReturn(['status'=>2]);
            }
            $result['status'] = 1;
            $this->ajaxReturn($result);
        }
    }
    /**
     * 查看该店铺是否已经收藏
     */
    public function selectCollect(){
        if(IS_POST){
            $post = I('post.');
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            $postDshopid = $post['shopid'];
            // 测试数据开始
//            $postDtoken = '1';
//            $postDuserid = 14;
//            $postDshopid = 5;
            // 测试数据结束
            if(empty($postDuserid)||empty($postDshopid)||empty($postDtoken)){
                $this->ajaxReturn(['status'=>0]);
            }
            if(S('token'.$postDuserid) != $postDtoken){
                $this->ajaxReturn(['status'=>1]);
            }
            $msg['shopid'] = $postDshopid;
            $msg['userid'] = $postDuserid;
            $result = M('user_collect')->where($msg)->select();
            if($result){
                $status = 2;
            }else{
                $status = 3;
            }
            $this->ajaxReturn(['status'=>$status]);
        }
    }
    /**
     * 收藏店铺
     */
    public function collectShop(){
        if(IS_POST){
            // 获取登陆用户信息
            $post = I('post.');
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            $postDshopid = $post['shopid'];
            // 测试信息开始
//            $postDuserid = 1;
//            $postDshopid = 1;
            if($postDtoken==null||$postDuserid==null||$postDshopid==null){
                $this->ajaxReturn(['status'=>4]);
            }
            // 测试信息结束
            if(S('token'.$postDuserid) == $postDtoken){
                $cl = new ParamController();
                $result = $cl->collectShop($postDuserid,$postDshopid);
            }else{
                // 没有登录
             $result = 3;
            }
            $this->ajaxReturn(['status'=>$result]);
        }
    }
    /**
     * 获取店铺图片组
     */
    public function shopImgs(){
        if(IS_POST){
            $post = I('post.');
            $postDshopid = $post['shopid'];
            // 测试数据开始
//            $postDshopid = 1;
            // 测试数据结束
            $get = new ParamController();
            $result = $get->getShopImgs($postDshopid);
            if($result == 2){
                // 为空
               $this->ajaxReturn(['status'=>0]);
            }
            $result['status'] = 1;
            $this->ajaxReturn($result);
        }
    }
    // 店铺内搜索
    public function searchGoods(){
        if(IS_POST){
            $post = I('post.');
            $postDshopid = $post['shopid'];
            $postDgoodsname = $post['goodsname'];
            // 测试数据开始
//            $postDgoodsname  = 'J';
//            $postDshopid = '1';
            //测试数据结束
            if(!$postDshopid){
                $this->ajaxReturn(['status'=>0]);
            }
            $msg['shopid'] = $postDshopid;
            if(!$postDgoodsname){
                $msg['goodsname'] = array('like','%'.$postDgoodsname.'%');
            }
            $data['goods'] = M('goods')->where($msg)->field('goodsid,goodsname')->select();
            if (!$data['goods']){
                $this->ajaxReturn(['status'=>2]);
            }
            // 配图
            $kid = 0;
            foreach ($data['goods'] as $k){
                $img = M('goodsimg')->where(['goodsid'=>$k['goodsid']])->limit(1)->field('img')->select();
                $data['goods'][$kid]['image'] = $img[0]['image'];
                $num = M('user_goods')->where(['goodsid'=>$k['goodsid']])->select();
                $data['goods'][$kid]['recommendid'] = count($num);
                $kid ++;
            }
            $data['status'] = 1;
            $this->ajaxReturn($data);
        }
    }
    /**
     * 推荐菜品默认显示
     */
    public function recommendGoods(){
        if(IS_POST){
            $post = I('post.');
            $postDshopid = $post['shopid'];
            $postDpage = $post['page'];
            // 测试数据开始
//            $postDshopid = 5;
//            $postDpage = 1;
            // 测试数据结束
            if($postDshopid==null||$postDpage==null){
                $this->ajaxReturn(['status'=>0]);
            }
            $msg = M('user_goods')->where(['status'=>$postDshopid])->distinct(true)->field('goodsid')->select();
            if(!$msg){
                //没有推荐
                $this->ajaxReturn(['status'=>2]);
            }
            // 判断用户是否登陆
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
        //    $postDuserid = 17;
//            $postDtoken = 'd404b23dbd264357a20afb63ec0d615e';

            if(S('token'.$postDuserid) == $postDtoken){
                $kkid = 1;
            }else{
                $kkid = 0;
            }
            $data['kid'] = $kkid;
            // 获取推荐的商品的具体信息和图片

            $kid = 0;
            foreach($msg as $k){
                $cmsg['shopid'] = $postDshopid;
                $cmsg['goodsid'] = $k['goodsid'];

                $num = M('user_goods')->where(['goodsid'=>$k['goodsid']])->select();
                $count = count($num);
                $goodsdetails = M('goods')->where(['goodsid'=>$k['goodsid']])->field('goodsname,goodsprice')->select();
                $img = M('goodsimg')->where(['goodsid'=>$k['goodsid']])->field('img')->select();
                // 输出详细信息
                $data['goods'][$kid]['goodsid'] = $k['goodsid'];
                $data['goods'][$kid]['image'] = $img[0]['img'];
                $data['goods'][$kid]['goodsname'] = $goodsdetails[0]['goodsname'];
                $data['goods'][$kid]['goodsprice'] = $goodsdetails[0]['goodsprice'];
                $data['goods'][$kid]['recommendnum'] = $count;
                if($kkid == 1){
                    $remsg['goodsid'] = $k['goodsid'];
                    $remsg['userid'] = $postDuserid;
                    $re = M('user_goods')->where($remsg)->select();
                    if($re){
                        $data['goods'][$kid]['heartstatus'] = 2;
                    }else{
                        $data['goods'][$kid]['heartstatus'] = 1;
                    }
                }else{
                    $data['goods'][$kid]['heartstatus'] = '';
                    $data['goods'][$kid]['kkid'] = $kkid;
                }
                $kid ++;
            }
            // 排序
            $cou = count($data['goods']);
            for($i = 1;$i<$cou;$i++){
                for($j=0;$j<$cou-$i;$j++){
                    if($data['goods'][$j]['recommendnum']<$data['goods'][$j+1]['recommendnum']){
                        $result = $this->exchangeRecommendGoods($data['goods'][$j],$data['goods'][$j+1]);
                        $data['goods'][$j] = $result[0];
                        $data['goods'][$j+1] = $result[1];
                    }
                }
            }
                $pg = new SuanFaController();
                $data['goods'] = $pg->goPage($postDpage,$this->numPage,$data['goods']);
                if(empty($data['goods'])){
                    $data['status'] = 2;
                }else{
                    $data['status'] = 1;
                }

                $this->ajaxReturn($data);
        }
    }
    /**
     * 辅助方法一：商品ID，图片，名称，价格，推荐数量互换
     */
    public function exchangeRecommendGoods($arr1,$arr2){

            $one['goodsid'] = $arr1['goodsid'];
            $one['image'] = $arr1['image'];
            $one['goodsname'] = $arr1['goodsname'];
            $one['goodsprice'] = $arr1['goodsprice'];
            $one['recommendnum'] = $arr1['recommendnum'];

            $arr1['goodsid'] = $arr2['goodsid'];
            $arr1['image'] = $arr2['image'];
            $arr1['goodsname'] = $arr2['goodsname'];
            $arr1['goodsprice'] = $arr2['goodsprice'];
            $arr1['recommendnum'] = $arr2['recommendnum'];

            $arr2['goodsid'] = $one['goodsid'];
            $arr2['image'] = $one['image'];
            $arr2['goodsname'] = $one['goodsname'];
            $arr2['goodsprice'] = $one['goodsprice'];
            $arr2['recommendnum'] = $one['recommendnum'];

            $data[0] = $arr1;
            $data[1] = $arr2;

            return $data;
    }
    /**
     * 点击推荐
     */
    public function clickHeart(){
        if(IS_POST){
            $post = I('post.');
            $postDgoodsid = $post['goodsid'];
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            if(!$postDgoodsid||!$postDuserid){
                $this->ajaxReturn(['status'=>0]);
            }
            if(S('token'.$postDuserid) != $postDtoken){
                $this->ajaxReturn(['status'=>1]);
            }
            $msg['goodsid'] = $postDgoodsid;
            $msg['userid'] = $postDuserid;
            // 存入店铺ID
            $shopid = M('goods')->where(['goodsid'=>$postDgoodsid])->field('shopid')->select();
            $msg['shopid'] = $shopid[0]['shopid'];
            $result = M('user_goods')->where($msg)->select();
            if(!$result){
                // 为空说明没有该数据插入
                $msg['date'] = date('Y-m-d H:i:s',time());
                $result2 = M('user_goods')->add($msg);
            }else{
                // 删除该记录
                $result2 = M('user_goods')->where($msg)->delete();
            }
            if($result2){
                $this->ajaxReturn(['status'=>2]);
            }else{
                $this->ajaxReturn(['status'=>3]);
            }
        }
    }
    /**
     * 我的推荐
     */
    public function recommendGoodsOfMine(){
        if(IS_POST){
            $post = I('post.');
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            $postDshopid = $post['userid'];
            $postDpage = $post['page'];
            // 测试数据开始
//            $postDuserid = 5;
//            $postDshopid = 1;
//            $postDpage  = 1;
            // 测试数据结束
            if($postDshopid==null||$postDpage==null){
                $this->ajaxReturn(['status'=>0]);
            }
            if(S('token'.$postDuserid) != $postDtoken){
                // 不等返回
                $this->ajaxReturn(['status'=>1]);
            }
            $msg['shipid'] = $postDshopid;
            $msg['userid'] = $postDuserid;
            $result = M('user_goods')->where($msg)->distinct(true)->order('date desc')->field('goodsid')->select();
            if(!$result){
                $this->ajaxReturn(['status'=>2]);
            }
            $kid = 0;
            foreach ($result as $k){
                $result2 = M('goods')->where(['goodsid'=>$k['goodsid']])->field('goodsname,goodsprice')->select();
                $result3 = M('goodsimg')->where(['goodsid'=>$k['goodsid']])->field('img')->select();
                $data['goods'][$kid]['goodsid'] = $k['goodsid'];
                $data['goods'][$kid]['image'] = $result3[0]['img'];
                $data['goods'][$kid]['goodsname'] = $result2[0]['goodsname'];
                $data['goods'][$kid]['goodsprice'] = $result2[0]['goodsprice'];
                $kid ++;
            }
            $data['status'] = 3;
            $pg = new SuanFaController();
            $data['goods'] = $pg->goPage($postDpage,$this->numPage,$data['goods']);
            if(empty($data['goods'])){
                $data['status'] = 4;
            }
            $this->ajaxReturn($data);
        }
    }
    /**
     * 查看推荐菜品的详情
     */
    public function recommendGoodsDetails(){
        if(IS_POST){
            $post = I('post.');
            $postDgoodsid = $post['goodsid'];
            // 测试数据开始
//          $postDgoodsid = 9;
            // 测试数据结束
            if(!$postDgoodsid){
                $this->ajaxReturn(['status'=>0]);
            }
            $goodsDetails = M('goods')->where(['goodsid'=>$postDgoodsid])->field('goodsprice,goodsname')->select();
            if(!$goodsDetails){
                // 该商品不存在
                $this->ajaxReturn(['status'=>1]);
            }
            $recommendnum = M('user_goods')->where(['goodsid'=>$postDgoodsid])->select();
            $recommendnum = count($recommendnum);
            $goodsimages = M('recommend_img')->where(['status'=>$postDgoodsid])->field('img')->select();
            $data['status'] = 2;
            $data['goods'][0]['goodsname'] = $goodsDetails[0]['goodsname'];
            $data['goods'][0]['goodsprice'] = $goodsDetails[0]['goodsprice'];
            $data['goods'][0]['recommendnum'] = $recommendnum;
            $kid = 0;
            foreach ($goodsimages as $k){
                $data['goods'][0]['images'][$kid] = $k['img'];
                $kid ++;
            }
            $this->ajaxReturn($data);

        }
    }
    public function recommendGoodsDetailsOfMine(){
        if(IS_POST){
            $post = I('post.');
            $postDgoodsid = $post['goodsid'];
            $postDtoken = $post['token'];
            $postDuserid = $post['userid'];
            // 测试数据开始
        //    $postDgoodsid = 9;
            // 测试数据结束
            if(!$postDgoodsid||!$postDtoken){
                $this->ajaxReturn(['status'=>0]);
            }
            if(S('token'.$postDuserid)!=$postDtoken){
                $this->ajaxReturn(['status'=>3]);
            }
            $goodsDetails = M('goods')->where(['goodsid'=>$postDgoodsid])->field('goodsprice,goodsname')->select();
            if(!$goodsDetails){
                // 该商品不存在
                $this->ajaxReturn(['status'=>1]);
            }
            $recommendnum = M('user_goods')->where(['goodsid'=>$postDgoodsid])->select();
            $recommendnum = count($recommendnum);
            $goodsimages = M('recommend_img')->where(['status'=>$postDgoodsid])->field('img')->select();
            $data['status'] = 2;
            $data['goods'][0]['goodsid'] = $postDgoodsid;
            $data['goods'][0]['goodsname'] = $goodsDetails[0]['goodsname'];
            $data['goods'][0]['goodsprice'] = $goodsDetails[0]['goodsprice'];
            $data['goods'][0]['recommendnum'] = $recommendnum;
            $kid = 0;
            foreach ($goodsimages as $k){
                $goodsimages[$kid]['img'] = $k['img'];
                $kid ++;
            }
            $data['goods'][0]['images'] = $goodsimages;

            $this->ajaxReturn($data);

        }
    }
    /**
     * 选择推荐的菜品
     */
    public function shopGoods(){
        if(IS_POST){
            $post = I('post.');
            $postDshopid = $post['shopid'];
            if(!$postDshopid){
                $this->ajaxReturn(['status'=>0]);
            }
            // 获取
        }
    }
    /**
     * 上传图片
     */
    public function uploadRecommendPic(){
        if(IS_POST){
            $post = I('post.');
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            $postDgoodsid = $post['goodsid'];
            if(empty($postDuserid)||empty($postDgoodsid)||empty($postDtoken)||empty($_FILES)){
                $this->ajaxReturn(['status'=>0]);
            }
            if(S('token'.$postDuserid != $postDtoken)){
                $this->ajaxReturn(['status'=>1]);
            }
            //图片信息接收上传
            if ($_FILES) {
                foreach ($_FILES as $k => $fileInfo) {
                    $files[$k] = $this->uploadFile($fileInfo);
                }
            }
            // 插入数据
            $kid = 0;
           foreach ($files as $k){
                if($k){
                    $result[$kid] = M('recommend_img')->add([
                        'userid'=>$postDuserid,
                        'goodsid'=>$postDgoodsid,
                        'img'=>$k,
                        'date'=>time()
                    ]);
                }
               $kid ++;
           }
         if($result){
               $this->ajaxReturn(['status'=>2]);
         }else{
             $this->ajaxReturn(['status'=>3]);
         }

        }
    }
    /**
     * 评论列表
     */
    public function showEvaluate(){
        if(IS_POST){
            $post = I('post.');
            $postDshopid = $post['shopid'];
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            $postDpage = $post['page'];
            // 测试数据开始
//            $postDuserid = 1;
//            $postDshopid = 1;
//            $postDpage = 2;
            // 测试数据结束
            if(empty($postDshopid)||empty($postDpage)){
                $this->ajaxReturn(['status'=>0]);
            }

            if(S('token'.$postDuserid) != $postDtoken){
                $ulogin = 0;
            }else{
                $ulogin = 1;
            }
            // 获取所有关于此店铺的评论
            $data = M('evaluate')->where(['shopid'=>$postDshopid])->order('addtime desc')->field('eid,userid,addtime,content,looknum')->select();
            if(!$data){
                $this->ajaxReturn(['status'=>1]);
            }
            $kid = 0;
            foreach ($data as $k){
                $user = M('user')->where(['userid'=>$k['userid']])->field('userhead,username')->select();
                $result['evaluate'][$kid]['eid'] = $k['eid'];
                $result['evaluate'][$kid]['user'][0]['userid'] = $k['userid'];
                $result['evaluate'][$kid]['user'][0]['image'] = $user[0]['userhead'];
                $result['evaluate'][$kid]['user'][0]['username'] = $user[0]['username'];
                // 星级
                $star = new ParamController();
                $result['evaluate'][$kid]['fenshu'] = $star->getStar($postDshopid);
                // 人均
                $pingjun = new ParamController();
                $result['evaluate'][$kid]['pingjun'] = $pingjun->getPersonOne($postDshopid);
                // 时间
                $result['evaluate'][$kid]['timestamp'] = time()-strtotime($k['addtime']);
                // 评论内容
                $result['evaluate'][$kid]['content'] = $k['content'];
                // 获取图片
                $imgs = M('evaluateimg')->where(['eid'=>$k['eid']])->field('pic')->select();
                $imkid = 0;
                if(empty($imgs)){
                    $result['evaluate'][$kid]['images'] = array();
                }else{
                    foreach ($imgs as $imk){
                        $result['evaluate'][$kid]['images'][$imkid]['image'] = $imk['pic'];
                        $imkid ++;
                    }
                }
                $result['evaluate'][$kid]['looknum'] = $k['looknum'];
                // 赞的数量
                $zanmsg['shopid'] = $postDshopid;
              //  $zanmsg['userid'] = $k['userid'];
                $zanmsg['eid'] = $k['eid'];
                if($zanmsg['userid']!=null){
                    unset($zanmsg['userid']);
                }
             //   dump($zanmsg);
                $zan = M('zan')->where($zanmsg)->select();
                $result['evaluate'][$kid]['zannum'] = count($zan);
                if($ulogin == 1){
                    // 登录
                    $zanmsg['userid'] = $postDuserid;
                    $resu = M('zan')->where($zanmsg)->select();
                    if($resu){
                        $result['evaluate'][$kid]['userstate'] = 1;
                    }else{
                        $result['evaluate'][$kid]['userstate'] = 2;
                    }
                }else{
                    $result['evaluate'][$kid]['userstate'] = 0;
                }
                $kid ++;
            }
            $result['status'] = 2;
            $pg = new SuanFaController();
            $result['evaluate'] = $pg->goPage($postDpage,$this->numPage,$result['evaluate']);
            if(empty($result['evaluate'])){
                $result['status'] = 3;
            }
            $this->ajaxReturn($result);

        }
    }
    /**
     * 点赞
     */
    public function clickEvaluate(){
        if(IS_POST){
            $post = I('post.');
//            $post['userid'] = 17;
//            $post['token'] = 1;
//            $post['eid'] = 2;
//            $post['shopid'] = 1;
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            $postDeid = $post['eid'];
            $postDshopid = $post['shopid'];
            // 测试数据开始
//            $postDshopid = 1;
//            $postDuserid = 1;
//            $postDeid = 1;
//            $postDtoken =1;
            // 测试数据结束
            if(empty($postDshopid)||empty($postDeid)||empty($postDtoken)||empty($postDuserid)){
                $this->ajaxReturn(['status'=>0]);
            }
            if(S('token'.$postDuserid) != $postDtoken){
                $this->ajaxReturn(['status'=>1]);
            }
            $msg['eid'] = $postDeid;
            $msg['userid'] = $postDuserid;
            $zanYRN = M('zan')->where($msg)->select();
            if($zanYRN){
                // 已经点赞，取消点赞
                $result = M('zan')->where($msg)->delete();
            }else{
                // 没有点赞，点赞
                $result = M('zan')->add([
                    'eid'=>$postDeid,
                    'userid'=>$postDuserid,
                    'shopid'=>$postDshopid,
                    'date'=>time()
                ]);
            }
            if($result){
                $this->ajaxReturn(['status'=>2]);
            }else{
                $this->ajaxReturn(['status'=>3]);
            }

        }
    }
    /**
     * 评论详情
     */
    public function evaluateDetails(){
        if(IS_POST){
            $post = I('post.');
            $postDeid = $post['eid'];
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            // 测试数据开始
//            $postDeid = 15;
            // 测试数据结束
            if(empty($postDeid)){
                $this->ajaxReturn(['status'=>0]);
            }
            if(S('token'.$postDuserid) != $postDtoken){
               $ulogin = 0;
            }else{
                $ulogin = 1;
            }
            // 给该评论加一次浏览量
            $looknum = M('evaluate')->where(['eid'=>$postDeid])->field('userid,looknum,addtime,content,shopid')->select();
            if(!$looknum){
                $this->ajaxReturn(['status'=>1]);
            }
            $num = $looknum[0]['looknum'] + 1;
            $re = M('evaluate')->where(['eid'=>$postDeid])->save(['looknum'=>$num]);
            // 获取相关信息
            $result['evaluate'][0]['eid'] = $postDeid;
            $result['evaluate'][0]['user'][0]['userid'] = $looknum[0]['userid'];;
            // 获取相关信息
            $user = M('user')->where(['userid'=>$looknum[0]['userid']])->field('username,userhead')->select();
            $result['evaluate'][0]['user'][0]['username'] = $user[0]['username'];
            $result['evaluate'][0]['user'][0]['userhead'] = $user[0]['userhead'];
            // 星级
            $star = new ParamController();
            $result['evaluate'][0]['fenshu'] = $star->getStar($looknum[0]['shopid']);
            // 人均
            $pingjun = new ParamController();
            $result['evaluate'][0]['pingjun'] = $pingjun->getPersonOne($looknum[0]['shopid']);
            // 时间戳
            $result['evaluate'][0]['timestamp'] = time()-strtotime($looknum[0]['addtime']);
            $result['evaluate'][0]['content'] = $looknum[0]['content'];
            // 获取图片
            $imgs = M('evaluateimg')->where(['eid'=>$postDeid])->field('pic')->select();
            if(empty($imgs)){
                $result['evaluate'][0]['images'] = array();
            }else{
                $imkid = 0;
                foreach ($imgs as $imk){
                    $result['evaluate'][0]['images'][$imkid]['image'] = $imk['pic'];
                    $imkid ++;
                }
            }

            $result['evaluate'][0]['looknum'] = $looknum[0]['looknum'];
            // 赞的数量
            $zanmsg['shopid'] = $looknum[0]['shopid'];
         //   $zanmsg['userid'] = $looknum[0]['userid'];
            $zanmsg['eid'] = $postDeid;
            $zan = M('zan')->where($zanmsg)->select();
            $result['evaluate'][0]['zannum'] = count($zan);
            if($ulogin == 1){
                // 登录
                $zanmsg['userid'] = $postDuserid;
                $resu = M('zan')->where($zanmsg)->select();
                if($resu){
                    $result['evaluate'][0]['userstate'] = 1;
                }else{
                    $result['evaluate'][0]['userstate'] = 2;
                }

            }else{
                $result['evaluate'][0]['userstate'] = 0;
            }
            // 获取店铺信息
            $shopDetails = M('shop')->where(['shopid'=>$looknum[0]['shopid']])->field('shopname,shophead,city,shopkindidf')->select();
            $result['shop'][0]['shopid'] = $looknum[0]['shopid'];
            $result['shop'][0]['logo'] = $shopDetails[0]['shophead'];
            $result['shop'][0]['shopname'] = $shopDetails[0]['shopname'];
            $result['shop'][0]['city'] = $shopDetails[0]['city'];
            $kindname = M('shopkind')->where(['status'=>$shopDetails[0]['shopkindidf']])->field('kindname')->select();
            $result['shop'][0]['shopkind'] = $kindname[0]['kindname'];
            $result['shop'][0]['pingjun'] = $pingjun->getPersonOne($looknum[0]['shopid']);

            $result['status'] = 2;
            $this->ajaxReturn($result);
        }
    }
    /**
     * 写点评之前的默认菜品
     */
    public function addEvaluateShow(){
        if(IS_POST){
            $post = I('post.');
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            $postDorderid = $post['orderid'];
            // 测试数据开始
//            $postDuserid = 1;
//            $postDtoken = 1;
//            $postDorderid = 1;
            // 测试数据结束
            if(empty($postDorderid)||empty($postDtoken)||empty($postDuserid)){
                $this->ajaxReturn(['status'=>0]);
            }
            $shopid = M('orders')->where(['orderid'=>$postDorderid])->field('shopid')->select();
            $goodsids = M('user_goods')->where(['shopid'=>$shopid[0]['shopid']])->field('goodsid')->select();
            $goodsdetails = M('goods')->where(['shopid'=>$shopid[0]['shopid']])->field('goodsid,goodsname')->select();
            $kid = 0;
            foreach ($goodsdetails as $k){
                foreach ($goodsids as $v){
                    if($v['goodsid'] == $k['goodsid']){
                        $goodsdetails[$kid]['state'] = 1;
                    }
                }
                $kid ++;
            }
            $kid = 0;
            foreach ($goodsdetails as $k){
                if(empty($k['state'])){
                    $goodsdetails[$kid]['state'] = 0;
                }
                $kid ++;
            }
            if($goodsdetails){
                $this->ajaxReturn(['status'=>1,'goods'=>$goodsdetails]);
            }else{
                $this->ajaxReturn(['status'=>2]);
            }
        }
    }
    /**
     * 写点评
     */
    public function addEvaluate(){
        if(IS_POST){
            $post = I('post.');
            $postDorderid = $post['orderid'];
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
            $postDshopid = $post['shopid'];
            $postDfenshu = $post['fenshu'];
            $postDcontent = $post['content'];
            $postDpingjun = $post['pingjun'];

            // 测试数据开始
//            $postDtoken = 1;
//            $postDuserid = 1;
//            $postDshopid = 1;
//            $postDfenshu = 4;
//            $postDcontent = 'hao';
//            $postDorderid = 1;
//            $postDpingjun = 88;
            //测试数据结束
            if(empty($postDshopid)||empty($postDuserid)||empty($postDtoken)||empty($postDcontent)||empty($postDfenshu)){
                $this->ajaxReturn(['status'=>0]);
            }
        /*   if(S('token'.$postDuserid) == $postDtoken){
                $this->ajaxReturn(['status'=>1]);
            }*/
            //图片信息接收上传
            if ($_FILES) {
                foreach ($_FILES as $k => $fileInfo) {
                    $files[$k] = $this->uploadFile($fileInfo);
                }
            }
            // 插入数据
            // 获取该订单的店铺ID
            $shopid = M('orders')->where(['orderid'=>$postDorderid])->field('shopid,usernum,allprice')->select();
         //   $pingjun = $shopid[0]['allprice']/$shopid[0]['usernum'];
            //开启事物
            M('evaluate')->startTrans();
            $eid= M('evaluate')->add([
                    'shopid'=>$shopid[0]['shopid'],
                    'orderid'=>$postDorderid,
                    'userid'=>$postDuserid,
                    'fenshu'=>$postDfenshu,
                    'pingjun'=>$postDpingjun,
                    'content'=>$postDcontent,
                    'looknum'=>0,
                    'addtime'=>date('Y-m-d H:i:s',time())
                ]);
            if($eid){
                $files = array();
                if ($_FILES) {
                    foreach ($_FILES as $k => $fileInfo) {
                        $files[$k] = $this->uploadFile($fileInfo);
                    }
                }
                if(empty($files)){
                    //成功
                    M('evaluate')->commit();
                    $this->ajaxReturn(['status'=>3]);
                }
                $j = count($files);
                for($i=1;$i<=$j;$i++){
                    $data = array(
                        'eid'=>$eid,
                        'pic'=>$files['myFile'.$i],
                        'addtime'=>date("Y-m-d H:i:s",time()),
                    );
                    $result = M("evaluateimg")->add($data);
                }
                if($result){
                    //处理成功
                    M('evaluate')->commit();
                    $this->ajaxReturn(['status'=>3]);
                }else{
                    //回滚
                    M("evaluate")->rollback();
                    $this->ajaxReturn(['status'=>2]);
                }
            }else{
                //事物回滚
                M('evaluate')->rollback();
                $this->ajaxReturn(['status'=>2]);
            }

        }
    }
    /**
     * 堂食-订座
     */
    public function tsReservation(){
        if(IS_POST){
            $post = I('post.');
            $postDuserid = $post['userid'];
            $postDtoken = $post['token'];
           // $postD
        }
    }
    /**
     * 获取举报信息，不需要登陆
     */
    public function reportShow(){
        if(IS_POST){
            $post = I('post.');
            if($post['belong'] == null){
                $this->ajaxReturn(['status'=>0]);
            }
            $msg = M('list_report')->where(['belong'=>0])->field('reportid,name')->select();
            if($msg){
                $this->ajaxReturn(['status'=>2,'data'=>$msg]);
            }else{
                $this->ajaxReturn(['status'=>1]);
            }
        }
    }
    /**
     * 举报，需要登陆
     */
    public function userReport(){
        if(IS_POST){
            $post = I('post.');
            
            if($post['userid']==null||$post['token']==null || $post['reportid']==null||$post['shopid'] ==null){
                $this->ajaxReturn(['status'=>0]);
            }
            if(S('token',$post['userid']) != $post['token']){
                $this->ajaxReturn(['status'=>1]);
            }
            $msg = M('list_report')->where(['reportid'=>$post['reportid']])->select();
            if(empty($msg)){
                $this->ajaxReturn(['status'=>2]);
            }
            $result = M('user_report')->add([
                'userid'=>$post['userid'],
                'shopid'=>$post['shopid'],
                'reportid'=> $post['reportid'],
                'name'=>'id为'.$post['shopid'].'商铺被举报，举报信息为：'.$msg[0]['name'],
                'addtime'=>date('Y-m-d H:i:s',time())
            ]);
            if($result){
                $this->ajaxReturn(['status'=>3]);
            }else{
                $this->ajaxReturn(['status'=>2]);
            }
        }
    }
}