<?php

namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller {
     //构造函数
    public function _initialize(){
        if(!session('username')){
            $this -> redirect('Login/loadlogin');exit(0);
        }
    }
    
    /**
    * 引入首页模板
    * @2017.6.29
    */
    public function left(){
        
        $this->display("/left");
    }


}
