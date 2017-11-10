<?php 

namespace Server\Controller;
use Think\Controller;
use Think\Upload;
date_default_timezone_set('Australia/South');
class OrderController extends Controller{ 
    /*
    * 未处理订单列表
    * 2017.6.27
    */
    public function norderlist(){
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
//            $nowss = date("Y-m-d H:i:s",time());
//            $orderedit =M('orders')->where(['state'=>1])->select();
//            foreach($orderedit as $vaa){
//                if($vaa['lifetime'] < $nowss){
//                    if($vaa['statu'] == 2){
//                        $afda = array(
//                        'statu'=>1,
//                    );
//                    $resultor = M("orders")->where(['orderid'=>$vaa['orderid']])->save($afda);
//                    $mingxi = M('mingxi')->where(['orderid'=>$vaa['orderid']])->find();
//                    if($mingxi['flag'] == 1){
//                        $abdd = array(
//                        'flag'=>2,
//                    );
//                    $res = M("mingxi")->where(['orderid'=>$vaa['orderid']])->save($abdd);
//                    }
//                    
//                    }
//                    
//                }
//            }
            //当前商铺所有订单
            $info = M('orders')->where(array("state"=>array("in","1,2")))->where(['shopid'=>$shopid,'statu'=>2]) -> select();
            foreach($info as $ke => $gv){
                //订单下所有商品
                $goodsinfo = M('ordergoods')->where(['orderid'=>$gv['orderid']])->select();
                $array = array();
                foreach ($goodsinfo as $k => $v){
                    //每个商品信息
                    $goodsresult = M('shopgoods')->where(['goodsid'=>$v['goodsid']])->field("goodsname,goodsprice")->find();
                    $array[$k]['num']= $v['num'];
                    $array[$k]['goodsname']= $goodsresult['goodsname'];
                    $array[$k]['goodsprice']= $goodsresult['goodsprice'];
                    }
                $info[$ke]['goods'] = $array;
            }
            if($info){
                $this->ajaxReturn(['status'=>1,"msg"=>$info]);
            }else{
                $this->ajaxReturn(['status'=>1,"msg"=>array()]);
            }
        }
    }
    /*
    * 已处理订单列表
    * 2017.6.28
    */
    public function yorderlist(){
        if (IS_POST) {
            $post = I('post.');
            $page = $post['page'];
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
//            $nowss = date("Y-m-d H:i:s",time());
//            $orderedit =M('orders')->where(['state'=>1])->select();
//            foreach($orderedit as $vaa){
//                if($vaa['lifetime'] < $nowss){
//                    if($vaa['statu'] == 2){
//                        $afda = array(
//                        'statu'=>1,
//                    );
//                    $resultor = M("orders")->where(['orderid'=>$vaa['orderid']])->save($afda);
//                    $mingxi = M('mingxi')->where(['orderid'=>$vaa['orderid']])->find();
//                    if($mingxi['flag'] == 1){
//                        $abdd = array(
//                        'flag'=>2,
//                    );
//                    $res = M("mingxi")->where(['orderid'=>$vaa['orderid']])->save($abdd);
//                    }
//                    
//                    }
//                    
//                }
//            }
            //当前商铺所有订单
            $info = M('orders')->where("(statu = 2 and state in (3,4,5)) or (statu in (1,3) and state in (1,2))")->where(array('shopid'=>$shopid,"states"=>1))->order("addtime desc") ->page($page.",8") -> select();
            foreach($info as $ke => $gv){
                //订单下所有商品
                $goodsinfo = M('ordergoods')->where(['orderid'=>$gv['orderid']])->select();
                $array = array();
                foreach ($goodsinfo as $k => $v){
                    //每个商品信息
                    $goodsresult = M('shopgoods')->where(['goodsid'=>$v['goodsid']])->field("goodsname,goodsprice")->find();
                    $array[$k]['num']= $v['num'];
                    $array[$k]['goodsname']= $goodsresult['goodsname'];
                    $array[$k]['goodsprice']= $goodsresult['goodsprice'];
                    }
                $info[$ke]['goods'] = $array;
            }
            if($info){
                $this->ajaxReturn(['status'=>1,"msg"=>$info]);
            }else{
                $this->ajaxReturn(['status'=>1,"msg"=>array()]);
            }
        }
    }
/*
    * 明细列表
    * 2017.6.28
    */
    public function mingxi(){
        if (IS_POST) {
            $post = I('post.');
            $page = $post['page'];
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //所有明细
            $info = M('mingxi')->where(['shopid'=>$shopid,'flag'=>1])->order("addtime desc")->page($page.",8")->select();
            if($info){
                $this->ajaxReturn(['status'=>1,"msg"=>$info]);
            }else{
                $this->ajaxReturn(['status'=>1,"msg"=>array()]);
            }
        }
    }
/*
    * 删除明细
    * 2017.6.28
    */
    public function deletemingxi(){
        if (IS_POST) {
            $post = I('post.');
            $id = $post['id'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //删除明细
            $info = M('mingxi')->delete($id);
            if($info){
                $this->ajaxReturn(['status'=>1,"msg"=>""]);
            }else{
                $this->ajaxReturn(['status'=>0,"msg"=>""]);
            }
        }
    }
    /*
    * 今日销售额
    * 2017.6.28
    */
    public function todaymingxi(){
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $page = $post['page'];
            $times = strtotime(date('Y-m-d',time())); 
            $time = date("Y-m-d H:i:s",$times);
            $now = date("Y-m-d H:i:s",time());
//            echo $now;die;
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //查询当天明细
            $map = array();
            $map['addtime']=array('between',array($time,$now));
            $info = M('mingxi')->where($map)->where(['shopid'=>$shopid,'flag'=>1])->order("addtime desc")->page($page.",8")->select();
            if($info){
                $this->ajaxReturn(['status'=>1,"msg"=>$info]);
            }else{
                $this->ajaxReturn(['status'=>1,"msg"=>array()]);
            }
        }
    }
     /*
    * 今日已处理订单
    * 2017.6.28
    */
    public function todayorderlist(){
        if (IS_POST) {
            $post = I('post.');
            $page = $post['page'];
            $shopid = $post['shopid'];
            $times = strtotime(date('Y-m-d',time())); 
            $time = date("Y-m-d H:i:s",$times);
            $now = date("Y-m-d H:i:s",time());
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //当天商铺所有订单
            $map = array();
            $map['addtime']=array('between',array($time,$now));
            $info = M('orders')->where($map)->where(array("state"=>array("in","3,4,5"),'shopid'=>$shopid,"states"=>1))->order("addtime desc") ->page($page.",8") -> select();
            foreach($info as $ke => $gv){
                //订单下所有商品
                $goodsinfo = M('ordergoods')->where(['orderid'=>$gv['orderid']])->select();
                $array = array();
                foreach ($goodsinfo as $k => $v){
                    //每个商品信息
                    $goodsresult = M('shopgoods')->where(['goodsid'=>$v['goodsid']])->field("goodsname,goodsprice")->find();
                    $array[$k]['num']= $v['num'];
                    $array[$k]['goodsname']= $goodsresult['goodsname'];
                    $array[$k]['goodsprice']= $goodsresult['goodsprice'];
                    }
                $info[$ke]['goods'] = $array;
            }
            if($info){
                $this->ajaxReturn(['status'=>1,"msg"=>$info]);
            }else{
                $this->ajaxReturn(['status'=>1,"msg"=>array()]);
            }
        }
    }
    /**
     * 确认接单
     */
    public function queren(){
        if(IS_POST){
            $post = I('post.');
            $shopid = $post['shopid'];
            $orderid = $post['orderid'];
            $aftertime = $post['aftertime'];
             $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
//            $nowss = date("Y-m-d H:i:s",time());
//            $orderedit =M('orders')->where(['state'=>1])->select();
//            foreach($orderedit as $vaa){
//                if($vaa['lifetime'] < $nowss){
//                    if($vaa['statu'] == 2){
//                        $afda = array(
//                        'statu'=>1,
//                    );
//                    $resultor = M("orders")->where(['orderid'=>$vaa['orderid']])->save($afda);
//                    $mingxi = M('mingxi')->where(['orderid'=>$vaa['orderid']])->find();
//                    if($mingxi['flag'] == 1){
//                        $abdd = array(
//                        'flag'=>2,
//                    );
//                    $res = M("mingxi")->where(['orderid'=>$vaa['orderid']])->save($abdd);
//                    }
//                    
//                    }
//                    
//                }
//            }
            $orderinfos = M("orders")->where(['orderid'=>$orderid])->find();
            if($orderinfos['statu'] !=2){
                $this->ajaxReturn(['status'=>3,"msg"=>"订单已过期。"]);
            }
            $bnow = time();
            if($aftertime !==null){
                $latertime = $aftertime * 60;
                $latertime = $latertime + $bnow;
                $yuji = date("Y-m-d H:i:s",$latertime);
            }
            $data = array(
                'state'=>2,
                'aftertime'=>$yuji,
            );
            $result = M("orders")->where(['orderid'=>$orderid,'statu'=>2])->save($data);
            if($result){
                $this->ajaxReturn(['status'=>1]);
            }else{
                $this->ajaxReturn(['status'=>0]);
            }
        }
    }
    /**
     * 确认送达
     */
    public function songda(){
         if(IS_POST){
            $post = I('post.');
            $shopid = $post['shopid'];
            $orderid = $post['orderid'];
             $token = $post['token'];
            if ($token != S("token".$shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'state'=>3,
                'updatetime'=>date("Y-m-d H:i:s",time())
            );
            $result = M("orders")->where(['orderid'=>$orderid])->save($data);
            if($result){
                $this->ajaxReturn(['status'=>1]);
            }else{
                $this->ajaxReturn(['status'=>0]);
            }
        }
    }
    /**
     * 申请退单
     */
    public function backorder(){
         if(IS_POST){
            $post = I('post.');
            $shopid = $post['shopid'];
            $orderid = $post['orderid'];
             $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $orderinfos = M("orders")->where(['orderid'=>$orderid])->find();
            if($orderinfos['statu'] == 1){
                $this->ajaxReturn(['status'=>3,"超过十五分钟已经自动退单。"]);
            }else if($orderinfos['statu'] == 3){
                $this->ajaxReturn(['status'=>3,"已经通过退单。"]);
            }else if($orderinfos['statu'] == 2){
                $data = array(
                'statu'=>1,
            );
            $result = M("orders")->where(['orderid'=>$orderid])->save($data);
            if($result){
                $mingxi = M('mingxi')->where(['orderid'=>$orderid])->find();
                if($mingxi['flag']==1){
                    $infoming = M("mingxi")->where(['orderid'=>$orderid])->save(['flag'=>2]);
                    if($infoming){
                        $this->ajaxReturn(['status'=>1]);
                    }
                }else{
                    $this->ajaxReturn(['status'=>1]);
                }
                
            }else{
                $this->ajaxReturn(['status'=>0]);
            }
            }
            
            
            
        }
    }
    
}