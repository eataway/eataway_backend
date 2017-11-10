<?php

namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller {
  
    /**
    * 引入登录模板
    * @2017.6.29
    */
    public function loadlogin(){
         layout(false); 
        $this->display("/login");
    }
    /**
    * 用户登录
    * @2017.6.29
    */
    
    public function login(){
        if (IS_POST) {
           $post = I("post.");
           if($post['username'] !== null && $post['password'] !== null){
               $result = M('root')->where(['username'=>$post['username']])->find();
               if($result){
                   if($result['password'] == md5($post['password'])){
                       session(['statrt']);
                       session('username',$post['username']);
                       session('state',$result['state']);
                       $this->ajaxReturn(['status'=>1]);//成功
                   }else{
                       $this->ajaxReturn(['status'=>4]);//密码不正确
                   }
               }else{
                   $this->ajaxReturn(['status'=>2]);//查无此用户
               }
           }else{
               $this->ajaxReturn(['status'=>3]);//用户名或密码不能为空
           }
        }
    }
    /**
     * 退出登录
     */
    public function logout(){
        session(null);
		$this -> redirect('Login/loadlogin', array(), 1, '正在退出登录...');exit;
    }
  
}
