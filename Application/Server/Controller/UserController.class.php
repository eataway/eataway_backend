<?php

namespace Server\Controller;

use Think\Controller;
use Think\Upload;
date_default_timezone_set('Australia/South');
class UserController extends Controller {
    public $path="http://wm.sawfree.com/";
    /**
     * 服务端注册
     * @2017.6.26
     */
    public function register() {
        if (IS_POST) {
            $post = I('post.');
            $phone = $post['phone'];
            $pwd = $post['password'];
            //检查手机号是否已经注册
            $vmobi = M('shop')->field("shopid")->where(['phone' => $phone])->find();
            if (!empty($vmobi)) {
                //手机号已经注册
                $this->ajaxReturn(['status' => 2, 'userid' => '', 'token' => '']);
            }
            $time = date("Y-m-d H:i:s",time());
            $shopid = M('shop')->add(['phone' => $phone, 'password' => $pwd, 'flag' => '1','addtime'=>$time]);
            if ($shopid) {
                $token = md5('EA_' . $phone . time());
                $this->ajaxReturn(['status' => 1, 'shopid' => $shopid, 'token' => $token]);
            } else {
                $this->ajaxReturn(['status' => 0, 'shopid' => '', 'token' => '']);
            }
        }
    }

    /**
     * 用户登录
     * @2017.6.26
     */
    public function login() {
        if (IS_POST) {
            $post = I('post.');
            $phone = $post['phone'];
            $pwd = $post['password'];
            $info = M('shop')->field("shopid")->where(['phone' => $phone, 'password' => $pwd])->find();
            if (empty($info)) {
                //输入有误
                $this->ajaxReturn(['status' => 0, 'userid' => '', 'token' => '']);
            } else {
                //登录成功
                $token = md5($phone . time());
                S("token" . $info['shopid'], $token);
                $this->ajaxReturn(['status' => 1, 'shopid' => $info['shopid'], 'token' => $token]);
            }
        }
    }

    /*
     * 找回密码
     * 2017.6.26
     */

    public function replay_password() {
        if (IS_POST) {
            $post = I('post.');
            $phone = $post['phone'];
            $pwd = $post['password'];
            $user = M('shop');
            $veri = $user->field("shopid")->where(['phone' => $phone])->find();
            if (empty($veri)) {
                //该手机号未注册
                $this->ajaxReturn(['status' => 3]);
            }
            $rst = $user->where(['phone' => $phone])->setField('password', $pwd);
            if ($rst !== false) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /**
     * 验证手机号是否注册
     * @2017.6.12
     */
    public function veri_mobile() {
        if (IS_POST) {
            $post = I('post.');
            $phone = $post['phone'];
            $phone = $phone * 1;
            if (empty($phone)) {
                //手机号为空
                $this->ajaxReturn(['status' => 4]);
            }
            if (!is_numeric($phone)) {
                $this->ajaxReturn(['status' => 5]);
            }
            //检查手机号是否已经注册
            $vmobi = M('shop')->field("shopid")->where(['phone' => $phone])->find();
            if (!empty($vmobi)) {
                //手机号已经注册
                $this->ajaxReturn(['status' => 2]);
            } else {
                //手机号可以注册
                $this->ajaxReturn(['status' => 3]);
            }
        }
    }
/**
 * 添加商户基本信息
 */
//    public function addmessage(){
//        if(IS_POST){
//            $post = I('post.');
//            $shopid = $post['shopid'];
//            $mobile = $post['mobile'];
//            $shopname = $post['shopname'];
//            $detailed_address = $post['detailed_address'];
//            $coordinate = $post['coordinate'];
//            $token = $post['token'];
//            if ($token != S("token" . $shopid)) {
//                $this->ajaxReturn(['status' => 9, 'msg' => []]);
//            }
//                //图片信息接收
//        if($_FILES){
//            $array = array();
//            foreach ($_FILES as $k => $fileInfo) {
//            $array[] =$this->uploadFile($fileInfo);
//        }
//        }
//        $data = array(
//            'shopid'=>$shopid,
//            'mobile'=>$mobile,
//            'shopname'=>$shopname,
//            'detailed_address'=>$detailed_address,
//            'coordinate'=>$coordinate,
//            'shophead'=>$array[0],
//            'shopphoto' =>$array[1],
//        );
//        $result = M('shopmessage')->add($data);
//        if($result){
//            $this->ajaxReturn(['status'=>1]);
//        }else{
//            $this->ajaxReturn(['status'=>0]);
//        }
//        }
//    }
    /*
     * 添加商户基本信息
     * 2017.6.26
     */

    public function addshop() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $mobile = $post['mobile'];
            $shopname = $post['shopname'];
            $detailed_address = $post['detailed_address'];
            $coordinate = $post['coordinate'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $info = M('shop')->where(['shopid'=>$shopid])->find();
            //图片信息接收上传
            if($_FILES){
            $array = array();
            foreach ($_FILES as $k => $fileInfo) {
            $array[] =$this->uploadFile($fileInfo);
        }
        }
            if($info){
            $data = array(
                'shopid' => $shopid,
                'shopname' => $shopname,
                'mobile' => $mobile,
                'coordinate' => $coordinate,
                'detailed_address' => $detailed_address,
                "shophead" => $array[0],
                "shopphoto" => $array[1],
                'addtime'=>date("Y-m-d H:i:s",time()),
            );
            $result = M("shopmessage")->add($data);
            if($result){
                $this->ajaxReturn(['status'=>1]);
            }else{
                $this->ajaxReturn(['status'=>0]);
            }
            }
            
        }
    }

    /*
     * 添加商铺简介
     * 2017.6.26
     */

    public function addjianjie() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $shopname = $post['shopname'];
            $content = $post['content'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //旧图片封装到变量
            $picture = M('shopmessage')->where(['shopid' => $shopid])->find();
            //图片信息接收上传
            if ($_FILES) {
                foreach ($_FILES as $k => $fileInfo) {
                    $files[$k] = $this->uploadFile($fileInfo);
                }
            }
            if (!empty($files)) {
                $data = array(
                    'content' => $content,
                    'shopname' => $shopname,
                    'shophead' => $files['myFile'],
                );
                $result = M('shopmessage')->where(['shopid' => $shopid])->field('content,shopname,shophead')->save($data);
                if ($result) {
                    $shophead = M("shopmessage")->where(['shopid' => $shopid])->field('shophead')->find();
                    if ($shophead) {
                        //删除旧图片
                        unlink($_SERVER['DOCUMENT_ROOT'] . "/" . $picture['shophead']);
                        $this->ajaxReturn(['status' => 1, 'msg' => $this->path . $shophead['shophead']]);
                    } else {
                        $this->ajaxReturn(['status' => 0, 'msg' => ""]);
                    }
                } else {
                    $this->ajaxReturn(['status' => 0, 'msg' => ""]);
                }
            } else {
                $data = array(
                    'content' => $content,
                    'shopname' => $shopname,
                    'shophead' =>$picture['shophead'],
                );
                $result = M('shopmessage')->where(['shopid' => $shopid])->field('content,shopname,shophead')->save($data);
                if ($result) {
                    $shophead = M("shopmessage")->where(['shopid' => $shopid])->field('shophead')->find();
                    if ($shophead) {
                        $this->ajaxReturn(['status' => 1, 'msg' => $this->path . $shophead['shophead']]);
                    } else {
                        $this->ajaxReturn(['status' => 0, 'msg' => ""]);
                    }
                } else {
                    $this->ajaxReturn(['status' => 1, 'msg' => $this->path . $picture['shophead']]);
                }
            }
        }
    }
    /*
     * 商铺主图修改
     * 2017.6.26
     */

    public function editzhutu() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //图片信息接收上传
            if ($_FILES) {
                foreach ($_FILES as $k => $fileInfo) {
                    $files[$k] = $this->uploadFile($fileInfo);
                }
            }

            $data = array(
                'shopphoto' => $files['myFile'],
            );
            $result = M('shopmessage')->where(['shopid' => $shopid])->field('shopphoto')->save($data);
            if ($result) {
                $shop = M("shopmessage")->where(['shopid'=>$shopid])->field('shopphoto')->find();
                if($shop['shopphoto'] == null){
                    $this->ajaxReturn(['status' => 1, 'msg' => ""]);
                }else{
                    $this->ajaxReturn(['status' => 1, 'msg' => $this->path.$shop['shopphoto']]);
                }
                
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 送餐时间添加修改
     * 2017.6.26
     */

    public function edittime() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            if($post['week'] == "0"){
                $data = array(
                    'monday'=>$post['gotime'],
                    'tuesday'=>$post['gotime'],
                    'wednesday'=>$post['gotime'],
                    'thursday'=>$post['gotime'],
                    'friday'=>$post['gotime'],
                    'saturday'=>$post['gotime'],
                    'sunday'=>$post['gotime'],
                );
            }else if($post['week'] == "1"){
                    $data = array(
                        'monday'=>$post['gotime'],
                );
            }else if($post['week'] == "2"){
                $data = array(
                        'tuesday'=>$post['gotime'],
                );
            }else if($post['week'] == "3"){
                $data = array(
                        'wednesday'=>$post['gotime'],
                );
            }else if($post['week'] == "4"){
                $data = array(
                        'thursday'=>$post['gotime'],
                );
            }else if($post['week'] == "5"){
                $data = array(
                        'friday'=>$post['gotime'],
                );
            }else if($post['week'] == "6"){
                $data = array(
                        'saturday'=>$post['gotime'],
                );
            }else if($post['week'] == "7"){
                $data = array(
                        'sunday'=>$post['gotime'],
                );
            }
            $result = M("shopmessage")->where(['shopid'=>$shopid])->save($data);
                if($data == true){
                    $this->ajaxReturn(['status'=>1]);
                }else if($data == 0){
                    $this->ajaxReturn(['status'=>2]);
                }else if($data == false){
                    $this->ajaxReturn(['status'=>0]);
                }
        }
    }

    /*
     * 配送距离添加修改
     * 2017.6.26
     */

    public function editlong() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $long = $post['long'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'long' => $long,
            );
            $result = M('shopmessage')->where(['shopid' => $shopid])->field('long')->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }
    /*
     * 每千米单价修改
     * 2017.6.26
     */

    public function editlkmoney() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $lkmoney = $post['lkmoney'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'lkmoney' => $lkmoney,
            );
            $result = M('shopmessage')->where(['shopid' => $shopid])->field('lkmoney')->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 免配送费最小金额
     * 2017.6.26
     */

    public function editprice() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $maxprice = $post['maxprice'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'maxprice' => $maxprice,
            );
            $result = M('shopmessage')->where(['shopid' => $shopid])->field('maxprice')->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 免配送费最大距离
     * 2017.6.27
     */

    public function editmaxlong() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $maxlong = $post['maxlong'];
//            $maxmoney = $post['maxmoney'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'maxlong' => $maxlong,
//                'maxmoney' => $maxmoney,
            );
            $result = M('shopmessage')->where(['shopid' => $shopid])->field('maxlong')->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => $result['maxlong']]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }
    /*
     * 免配送费最大距离
     * 2017.6.27
     */

    public function editmaxmoney() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
//            $maxlong = $post['maxlong'];
            $maxmoney = $post['maxmoney'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
//                'maxlong' => $maxlong,
                'maxmoney' => $maxmoney,
            );
            $result = M('shopmessage')->where(['shopid' => $shopid])->field('maxmoney')->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => $result['maxmoney']]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 短距离配送配送规则
     * 2017.6.27
     */

    public function shortruler() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $lkm = $post['lkm'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'lkm' => $lkm,
            );
            $result = M('shopmessage')->where(['shopid' => $shopid])->field('lkm')->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 长距离配送配送规则
     * 2017.6.27
     */

    public function longruler() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $bkm = $post['bkm'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'bkm' => $bkm,
            );
            $result = M('shopmessage')->where(['shopid' => $shopid])->field('bkm')->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 用户退出登录
     * @date 2017.6.27
     */

    public function logout() {
        $post = I('post.');
        $shopid = $post['shopid'];
        $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
        $info = M('shopmessage')->where(['shopid'=>$shopid])->find();
        if($info['state'] == 2){
             S("token" . $shopid, null);
             if(S("token".$shopid) == null){
                    $this->ajaxReturn(['status'=>1,"退出成功。"]);
                }else{
                    $this->ajaxReturn(['status'=>1,"失败"]);
                }
        }else if($info['state'] == 1){
             $result = M('shopmessage')->where(['shopid'=>$shopid])->save(['state'=>2]);
            if($result){
                S("token" . $shopid, null);
                if(S("token".$shopid) == null){
                    $this->ajaxReturn(['status'=>1,"退出成功。"]);
                }else{
                    $this->ajaxReturn(['status'=>1,"失败"]);
                }
            }else{
                $this->ajaxReturn(['status'=>0,"失败。"]);
            }
        }else if($info['state'] == 3){
            S("token" . $shopid, null);
             if(S("token".$shopid) == null){
                    $this->ajaxReturn(['status'=>1,"退出成功。"]);
                }else{
                    $this->ajaxReturn(['status'=>1,"失败"]);
                }
        }else if(empty($info)){
            S("token" . $shopid, null);
             if(S("token".$shopid) == null){
                    $this->ajaxReturn(['status'=>1,"退出成功。"]);
                }else{
                    $this->ajaxReturn(['status'=>1,"失败"]);
                }
        }
    }

    /*
     * 商铺营业状态修改
     * 2017.6.28
     */

    public function editstate() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $flag = $post['state'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'state' => $flag,
            );
            $result = M('shopmessage')->where(['shopid' => $shopid])->field('state')->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 商铺认证
     * 2017.6.28
     */

    public function addrenzheng() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $shopname = $post['shopname'];
            $mobile = $post['mobile'];
            $coordinate = $post['coordinate'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'shopid' => $shopid,
                'shopname' => $shopname,
                'mobile' => $mobile,
                'coordinate' => $coordinate,
                'addtime' => date("Y-m-d H:i:s", time()),
            );
            $result = M('shopmessage')->add($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 商铺认证状态
     * 2017.6.28
     */

    public function renzheng() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $result = M('shopmessage')->where(['shopid' => $shopid])->field("shopname,state,mobile,coordinate")->find();
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => $result]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 商铺退出加盟
     * 2017.6.28
     */

    public function out() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                "state" => 4,
            );
            $result = M('shopmessage')->where(['shopid' => $shopid])->field("state")->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 意见反馈
     * 2017.6.28
     */

    public function backmessage() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $backmessage = $post['backmessage'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                "shopid" => $shopid,
                "backmessage" => $backmessage,
                "addtime" => date("Y-m-d H:i:s", time()),
            );
            $result = M('backmessage')->add($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /*
     * 商家信息接口
     * 2017.6.28
     */

    public function shopmesa() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $times = strtotime(date('Y-m-d', time()));
            $time = date("Y-m-d H:i:s", $times);
            $now = date("Y-m-d H:i:s", time());
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $result = M('shopmessage')->where(['shopid' => $shopid])->field("lmoney,content,gotime,long,maxprice,maxmoney,maxlong,lkmoney,shophead,shopphoto,shopname,state,coordinate,detailed_address,mobile")->find();
            if ($result) {
                //查询当天明细
                $map = array();
                $map['addtime'] = array('between', array($time, $now));
                $info = M('mingxi')->where($map)->where(['shopid' => $shopid,"flag"=>1])->select();
                $allmoney = 0;
                foreach($info as $val){
                    $allmoney += $val['money'];
                }
                //当天商铺所有订单
                $info = M('orders')->where($map)->where(array("state"=>array("in","3,4,5"),'shopid'=>$shopid)) -> select();
                $nums = count($info);
                if($result['shophead'] == null){
                    $result['shophead'] = "";
                }else{
                    $result['shophead'] = $this->path.$result['shophead'];
                }
                if($result['shopphoto'] == null){
                    $result['shopphoto'] = "";
                }else{
                    $result['shopphoto']= $this->path.$result['shopphoto'];
                }
                 
                $result['allmoney'] = $allmoney;
                $result['nums'] = $nums;
                $this->ajaxReturn(['status'=>1,"msg"=>$result]);
            }else{
                $this->ajaxReturn(['status'=>2,"msg"=>"未认证"]);
            }
        }
    }
     /**
     * 测试用接口修改商铺菜单上下级
     */
    public function editcategoryceshi(){
        $post = I("post.category");
        $array = array();
        foreach($post as $k=>$v){
            $data = array(
                'up'=>$v[1],
                'end'=>$v[2]
            );
            $result = M("category")->where(['cid'=>$v[0]])->save($data);
            if($result){
                $array[$k] = 1;
            }else{
                $array[$k] = 0;
            }
        }
        $this->ajaxReturn(['msg'=>$array]);
    }

}
