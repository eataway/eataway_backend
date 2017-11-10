<?php
namespace Rider\Controller;
use Think\Controller;
use Think\Upload;
class UserController extends Controller
{
    public function index(){
        $this->display('/login');
    }

    //登录
    public function login(){
        if(IS_POST){
            //获取手机手机号
            $mobile = I('post.mobile');
            if(empty($mobile)){
                $data['status'] = 1; //传值失败,手机号为空
                $this->ajaxReturn($data);
            }
            if(!is_numeric($mobile)){
                $data['status'] = 2; //手机号格式错误
                $this->ajaxReturn($data);
            }
            //判断手机号是否在数据库
            $user = M('rider');
            $flag = $user->where(['phone' => $mobile])->field("id,nickname")->find();
            if(empty($flag)){
                $data['status'] = 3; //手机号不存在，用户未注册
                $data['userid'] = '';
                $data['token'] = '';
                $this->ajaxReturn($data);
            }else{
                $token = md5($flag['nickname'].time());
                $data['status'] = 4; //登录成功
                $data['userid'] = $flag['id'];
                $data['token'] = $token;
                S("token".$flag['id'],$token);
                $this->ajaxReturn($data);
            }
        }
    }

    //验证手机号是否注册
    public function veri_mobile() {
        if (IS_POST) {
            $phone = I('post.mobile');
            if(empty($phone)) {
                //手机号为空
                $this->ajaxReturn(['status' => 0]);
            }
            if (!is_numeric($phone)) {
                $this->ajaxReturn(['status' => 1]);
            }
            //检查手机号是否已经注册
            $vmobi = M('rider')->where(['phone' => $phone])->find();
            if (!empty($vmobi)) {
                //手机号已经注册
                $this->ajaxReturn(['status' => 2]);
            } else {
                //手机号可以注册
                $this->ajaxReturn(['status' => 3]);
            }
        }
    }

    //注册
    public function register(){
        if(IS_POST){
            $mobile = I('post.mobile');
            if(empty($mobile)){
                $data['status'] = 1; //手机号为空
                $this->ajaxReturn($data);
            }
            if(!is_numeric($mobile)){
                $data['status'] = 2; //手机号格式错误
                $this->ajaxReturn($data);
            }
            $user = M('rider');
            $flag = $user->where(['phone' => $mobile])->field('id')->find();
            if(!empty($flag)){
                $data['status'] = 3;  //手机号已注册
                $data['rid'] = '';
                $data['token'] = '';
                $this->ajaxReturn($data);
            }
            $msg = ['phone'=>$mobile,
                'nickname'=>$mobile,
                'overage'=>0,
                'images'=>"uploads/c44803e4ea9a661e1ebbfe04d21b2002.jpg",
                'created_date'=>time()];
            $add_rid = $user->add($msg); //新增数据id
            if($add_rid){
                $token = md5($mobile.time());
                $data['status'] = 5; //注册成功
                $data['rid'] = $add_rid;
                $data['token'] = $token;
                S("token".$flag['id'],$token);
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 4; //注册失败
                $data['rid'] = '';
                $data['token'] = '';
                $this->ajaxReturn($data);
            }
        }
    }

    //退出登录
    public function logout() {
        $userid = I('post.rid');
        S("token" . $userid, null);
    }
}