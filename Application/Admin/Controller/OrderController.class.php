<?php 

namespace Home\Controller;
use Think\Controller;
use Think\Upload;

class OrderController extends Controller{ 
     //构造函数
    public function _initialize(){
        if(!session('username')){
            $this -> redirect('Login/loadlogin');exit(0);
        }
    }
    /*
    * 客户下单
    * 2017.6.23
    */
    public function addorder(){
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $goodsid = $post['goods'];
            $cometime = $post['cometime'];
            $address = $post['address'];
            $beizhu = $post['beizhu'];
            $money = $post['money'];
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
//            $goodsid = array(
//                array(
//                    'goodsid' => 1,
//                    'num'=> 2,
//                ),
//                array(
//                    'goodsid' => 2,
//                    'num' => 3,
//                ),
//                array(
//                    'goodsid' => 3,
//                    'num' => 2,
//                ),
//            );
            $allprice = 0;
            foreach ($goodsid as $val){
                $price = M('shopgoods')->field('goodsprice')->where(['goodsid'=>$val['goodsid']])->find();
                $allprice += $price['goodsprice'] * $val['num'];
            }
            $allmoney = $allprice + $money;
            //开启事物
            $order = M('orders');
            $order->startTrans();
            $mobile = M('user')->field('mobile')->where(['uid'=>1])->find();
            $orderid = $mobile['mobile'].time();
            $data = array(
                'orderid'=>$orderid,
                'uid' => $userid,
                'shopid' => $shopid,
                'money'=>$money,
                'cometime'=>$comtime,
                'address'=>$address,
                'beizhu'=>$beizhu,
                'allprice'=>$allmoney,
                'state' => 1,
                'addtime'=>date('Y-m-d H:i:s', time()),
            );
            $addorder = $order->add($data);
            if(!$addorder){
                //失败回滚
                $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'订单添加失败']);
            }
            foreach($goodsid as $vv){
                $datas = array(
                    'orderid' => $orderid,
                    'goodsid' => $vv['goodsid'],
                    'num' => $vv['num'],
                    'addtime' => date('Y-m-d H:i:s', time()),
                );
                $ordergoods = M('ordergoods')->add($datas);
                if(!$ordergoods){
                    //失败回滚
                    $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'订单商品信息添加失败']);
                }
            }
            //全部成功执行通过
            $order->commit();
            $this->ajaxReturn(['status'=>1,'msg'=>'']);
        }
    }
    /*
    * 订单列表
    * 2017.6.23
    */
    public function orderlist(){
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            $info = M('orders') ->where(['uid'=>$userid])->order('addtime desc') -> select();
            $shopmessage = array();
            foreach($info as $key => $val){
                $shopm = M("shopmessage")->where(['shopid'=>$val['shopid']])->find();
                $shopmessage[] = $shopm;
                $ordergoods = M('ordergoods') -> where(['orderid'=>$val['orderid']])->select();
                $erwei = array();
                foreach($ordergoods as $k => $v){
                    $goods = M('shopgoods') -> where(['goodsid'=>$v['goodsid']]) -> find();
                    $erwei[]= $goods;
                }
                $shopmessage[$key]['goods']=$erwei;
                
            }
            $this->ajaxReturn(['status'=>1,'msg'=>$shopmessage]);
        }
    }
   /**
    * 订单详情
    * 2017.6.23
    */
   public function orderdetails(){
       if (IS_POST) {
            $post = I('post.');
            $orderid = $post['orderid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            $info = M('orders') ->where(['orderid'=>$orderid]) -> find();
            $orderinfo = M('ordergoods') ->where(['orderid'=>$orderid]) -> select();
            $shop = M('shopmessage') ->where(['shopid'=>$info['shopid']]) -> find();
            $array = array();
            $array['shopname'] = $shop['shopname'];
            $array['phone'] = $shop['phone'];
            $array['cometime'] = $info['cometime'];
            $array['money'] = $info['money'];
            $array['allprice'] = $info['allprice'];
            $array['orderid'] = $orderid;
            $array['address'] = $info['address'];
            $array['beizhu'] = $info['beizhu'];
            $array['beizhu'] = $info['beizhu'];
            foreach ($orderinfo as $k => $v){
                $goods = M('shopgoods')->field('goodsname,goodsphoto,goodsprice') ->where(['goodsid'=>$v['goodsid']])->find();
                $goods['num'] = $v['num'];
                $array['goods'][] = $goods;
            }
            $this->ajaxReturn(['status'=>1,'msg'=>$array]);
        }
   }
}