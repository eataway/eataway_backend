<?php
namespace Home\Controller;
use Think\Controller;
date_default_timezone_set('Australia/South'); 
class IndexController extends Controller {
    public function index() {
       $this->display("/index");
    }
    public function gettime(){
        $time = date("Y-m-d H:i:s",time());
        echo $time;
    }
}
