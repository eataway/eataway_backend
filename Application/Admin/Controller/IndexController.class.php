<?php

namespace Admin\Controller;

use Think\Controller;

class IndexController extends Controller {
    public $pages = 9;

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
    public function index(){
        $results = M('shopmessage')->where(['state'=>3])->select();
        $orderinfo = M('orders')->where(array("state"=>array("in","1,2")))->where(['states'=>1,'statu'=>1])->select();
        $tuidan = count($orderinfo);
        $renzheng = count($results);
        $page = new \Think\Page($renzheng,10);
        $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
        $page -> setConfig('prev', '上一页');
        $page -> setConfig('next', '下一页');
        $page -> setConfig('last', '末页');
        $page -> setConfig('first', '首页');
        $page -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;     //最后一页不显示为总页数
        $page->rollPage = 10;          //分页栏每页显示的页数

        $show = $page -> show(); 
        $result = M('shopmessage') 
    			->where(['state'=>3])
    			-> limit( $page->firstRow, $page->listRows)
    			-> select();
        $resultaa = M('shopmessage') 
    			->where(array("state"=>array("in","1,2")))
    			-> select();
        foreach ($resultaa as $k => $val){
            $orderinfo = M('orders')->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2])->select();
            $money = 0;
            foreach ($orderinfo as $va){
                $money += $va['allprice'];
        }
        $resultaa[$k]['money'] = $money;
         if(empty($orderinfo)){
                unset($resultaa[$k]);
            }
        }
        $allorders = M('orders')->count();
        $jiaoyi = count($resultaa);
        $session = session('username');
        $this->assign("result",$result);
        $this->assign("session",$session);
        $this->assign("allorders",$allorders);
        $this->assign("renzheng",$renzheng);
        $this->assign("jiaoyi",$jiaoyi);
        $this->assign("tuidan",$tuidan);
        $this -> assign('show',$show);
        $this->display();
    }
    /**
     * 首页模糊搜索
     */
    public function indexs(){
        if(IS_GET){
            $get = I('get.shopname');
            $where['shopname']=array('like','%'.$get.'%');
            $result = M('shopmessage') 
    			->where(['state'=>3])
                        ->where($where)
    			-> select();
           $results = M('shopmessage')->where(['state'=>3])->select();
        $orderinfo = M('orders')->where(array("state"=>array("in","1,2")))->where(['states'=>1,'statu'=>1])->select();
        $tuidan = count($orderinfo);
        $renzheng = count($results);
        $resultaa = M('shopmessage') 
    			->where(array("state"=>array("in","1,2")))
    			-> select();
        foreach ($resultaa as $k => $val){
            $orderinfo = M('orders')->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2])->select();
            $money = 0;
            foreach ($orderinfo as $va){
                $money += $va['allprice'];
        }
        $resultaa[$k]['money'] = $money;
         if(empty($orderinfo)){
                unset($resultaa[$k]);
            }
        }
        $jiaoyi = count($resultaa);
        $session = session('username');
        $this->assign("result",$result);
        $this->assign("session",$session);
        $this->assign("renzheng",$renzheng);
        $this->assign("jiaoyi",$jiaoyi);
        $this->assign("tuidan",$tuidan);
        $allorders = M('orders')->count();
        $this->assign("allorders",$allorders);
        $this -> assign('show',$show);
        $this->assign('shopname',$get);
        $this->display('index');
        }
    }
    /**
    * 引入登录模板
    * @2017.6.29
    */
    public function loadlogin(){
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
   /*
    * 
    */
    
    
/**
    * 引入交易额模版
    * @2017.6.30
    */
    public function jiaoyi(){
        $listinfo = M("shopmessage")->where(array("state"=>array("in","1,2")))->select();
        foreach ($listinfo as $kk => $vav){
            $orderlist = M('orders')->where(['shopid'=>$vav['shopid'],'states'=>1,'statu'=>2])->where(array("state"=>array("in","3,4,5")))->select();
            if(empty($orderlist)){
                unset($listinfo[$kk]);
            }
        }
        $count = count($listinfo);
        $page = new \Think\Page($count,10);
        $page -> setConfig('header', '<span class="rows">共<b class="blue">%TOTAL_ROW%</b>条记录&nbsp;第<b class="blue">%NOW_PAGE%</b>页/共<b class="blue">%TOTAL_PAGE%</b>页</span>');
        $page -> setConfig('prev', '上一页');
        $page -> setConfig('next', '下一页');
        $page -> setConfig('last', '末页');
        $page -> setConfig('first', '首页');
        $page -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;     //最后一页不显示为总页数
        $page->rollPage = 10;          //分页栏每页显示的页数

        $show = $page -> show(); 
        $result = M('shopmessage') 
    		->where(array("et_shopmessage.state"=>array("in","1,2")))
                ->field('et_shopmessage.shopid,et_shopmessage.shopname,et_shopmessage.mobile,et_shopmessage.addtime')
                ->distinct(true)
                ->join("et_orders ON et_shopmessage.shopid = et_orders.shopid")
                ->select();
        foreach ($result as $k => $val){
            $orderinfo = M('orders')->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2])->select();
            $money = 0;
            foreach ($orderinfo as $va){
                $money += $va['allprice'];
        }
        $result[$k]['money'] = $money;
            $weixin = M("orders")->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2,'pay'=>1])->select();
            $weixinmoney = 0;
            foreach($weixin as $tyyu){
                $weixinmoney += $tyyu['allprice'];
            }
            $result[$k]['weixin'] = $weixinmoney;
            $zhifu = M("orders")->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2,'pay'=>2])->select();
            $zhifumoney =0;
            foreach($zhifu as $rtr){
                $zhifumoney += $rtr['allprice'];
            }
            $result[$k]['zhifumoney'] = $zhifumoney;
            $brain = M("orders")->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2,'pay'=>3])->select();
            $brainmoney =0;
            foreach($brain as $rtrs){
                $brainmoney += $rtrs['allprice'];
            }
            $result[$k]['brainmoney'] = $brainmoney;
            if(empty($orderinfo)){
            unset($result[$k]);
        }
        }
        $resultss = M('shopmessage') 
    			->where(array("state"=>array("in","1,2")))
    			-> select();
        foreach ($resultss as $k => $val){
            $orderinfo = M('orders')->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2])->select();
            $money = 0;
            foreach ($orderinfo as $va){
                $money += $va['allprice'];
        }
        $resultss[$k]['money'] = $money;
         if(empty($orderinfo)){
                unset($resultss[$k]);
            }
        }
        $results = M('shopmessage')->where(['state'=>3])->select();
        $jiaoyi = count($resultss);
        $orderinfo = M('orders')->where(array("state"=>array("in","1,2")))->where(['states'=>1,'statu'=>1])->select();
        $tuidan = count($orderinfo);
        $renzheng = count($results);
        $allorders = M('orders')->count();
        $this->assign("allorders",$allorders);
        $session = session('username');
        $this->assign("session",$session);
        $this->assign("renzheng",$renzheng);
        $this->assign("jiaoyi",$jiaoyi);
        $this->assign("tuidan",$tuidan);
        $this ->assign("result",$result);
        $this->assign("time",date("Y-m-d H:i:s",time()));
        $this->assign("show",$show);
        $this->display("tradingVolume");
    }
    /**
     * 交易额模糊搜索
     */
    public function jiaoyis(){
        if(IS_GET){
            $get = I("get.shopname");
            $where['shopname']=array('like','%'.$get.'%');
            $result = M("shopmessage")->where($where)->where(array("state"=>array("in","1,2")))->select();
        foreach ($result as $kk => $vav){
            $orderlist = M('orders')->where(['shopid'=>$vav['shopid'],'states'=>1,'statu'=>2])->where(array("state"=>array("in","3,4,5")))->select();
            if(empty($orderlist)){
                unset($result[$kk]);
            }
        }
        $count = count($result);
        foreach ($result as $k => $val){
            $orderinfo = M('orders')->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2])->select();
            $money = 0;
            foreach ($orderinfo as $va){
                $money += $va['allprice'];
        }
        $result[$k]['money'] = $money;
            $weixin = M("orders")->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2,'pay'=>1])->select();
            $weixinmoney = 0;
            foreach($weixin as $tyyu){
                $weixinmoney += $tyyu['allprice'];
            }
            $result[$k]['weixin'] = $weixinmoney;
            $zhifu = M("orders")->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2,'pay'=>2])->select();
            $zhifumoney =0;
            foreach($zhifu as $rtr){
                $zhifumoney += $rtr['allprice'];
            }
            $result[$k]['zhifumoney'] = $zhifumoney;
            $brain = M("orders")->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2,'pay'=>3])->select();
            $brainmoney =0;
            foreach($brain as $rtrs){
                $brainmoney += $rtrs['allprice'];
            }
            $result[$k]['brainmoney'] = $brainmoney;
            if(empty($orderinfo) && empty($weixin) && empty($zhifu) && empty($brain)){
                unset($result[$k]);
            }
        }
        $resultss = M('shopmessage') 
    			->where(array("state"=>array("in","1,2")))
    			-> select();
        foreach ($resultss as $k => $val){
            $orderinfo = M('orders')->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2])->select();
            $money = 0;
            foreach ($orderinfo as $va){
                $money += $va['allprice'];
        }
        $resultss[$k]['money'] = $money;
         if(empty($orderinfo)){
                unset($resultss[$k]);
            }
        }
        $results = M('shopmessage')->where(['state'=>3])->select();
        $jiaoyi = count($resultss);
        $orderinfo = M('orders')->where(array("state"=>array("in","1,2")))->where(['states'=>1,'statu'=>1])->select();
        $tuidan = count($orderinfo);
        $allorders = M('orders')->count();
        $this->assign("allorders",$allorders);
        $renzheng = count($results);
        $session = session('username');
        $this->assign("session",$session);
        $this->assign("renzheng",$renzheng);
        $this->assign("jiaoyi",$jiaoyi);
        $this->assign("tuidan",$tuidan);
        $this ->assign("result",$result);
        $this->assign("time",date("Y-m-d H:i:s",time()));
        $this->assign('shopname',$get);
        $this->display("tradingVolume");
        }
        
    }
/*
 * 通过认证
 */
   public function passrenzheng(){
       if(IS_POST){
           $post = I("post.");
           //修改认证状态(
           $data = array(
             'state'=>2,  
           );
           if(is_array($post.id)){
               
           }else{
               $result = M('shopmessage')->where(['shopid'=>$post['id']])->save($data);
           }
           
           if($result){
               $this->ajaxReturn(['status'=>1]);//成功
           }else{
               $this->ajaxReturn(['status'=>2]);//失败
           }
       }
   }
/*
 * 拒绝认证
 */
   public function deleterenzheng(){
       if(IS_POST){
           $post = I("post.");
           M('shopmessage')->startTrans();
           $result = M('shopmessage')->delete($post['id']);
           if($result){
               $shopinfo = M('shop')->delete($post['id']);
               if($shopinfo){
                   // 提交事务
                M('shopmessage')->commit();
                 $this->ajaxReturn(['status'=>1]);//成功
               }else{
                   // 事务回滚
                M('shopmessage')->rollback();
                 $this->ajaxReturn(['status'=>3]);//失败
               }
           }else{
               // 事务回滚
                M('shopmessage')->rollback();
               $this->ajaxReturn(['status'=>2]);//失败
           }
       }
   }
   /**
    * 结算
    */
   public function passok(){
       if(IS_POST){
           $post = I("post.");
           //修改认证状态(
           $data = array(
             'states'=>2,  
           );
            	$map['addtime'] = array('lt',$post['time']);
                
               $result = M('orders')->where(['shopid'=>$post['id']])->where($map)->where(array("state"=>array("in","3,4,5")))->save($data);
           
           
           if($result){
               $this->ajaxReturn(['status'=>1]);//成功
           }else{
               $this->ajaxReturn(['status'=>2]);//失败
           }
       }
   }
   /**
    * 引入退单申请
    */
   public function tuidan(){
       $resultsa = M("orders")->where(array('state'=>array("in","1,2")))->where(['states'=>1,'statu'=>1])->select();
       $count = count($resultsa);
        $page = new \Org\Page\Page($count,$this->pages);
        $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
        $page -> setConfig('prev', '上一页');
        $page -> setConfig('next', '下一页');
        $page -> setConfig('last', '末页');
        $page -> setConfig('first', '首页');
        $page -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;     //最后一页不显示为总页数
        $page->rollPage = 10;          //分页栏每页显示的页数

        $show = $page -> show(); 
        $result = M('orders') 
    			->where(array("state"=>array("in","1,2")))
    			->where(['states'=>1,'statu'=>1])
    			-> limit( $page->firstRow, $page->listRows)
    			-> select();
        foreach ($result as $k=> $val){
            $userinfo = M("user")->where(['uid'=>$val['uid']])->field("username,mobile")->find();
            $result[$k]['username'] = $userinfo['username'];
            $result[$k]['userphone'] = $userinfo['mobile'];
            $shopinfo = M('shopmessage')->where(['shopid'=>$val['shopid']])->field("shopname")->find();
            $result[$k]['shopname'] = $shopinfo['shopname'];
        }
        $results = M('shopmessage')->where(['state'=>3])->select();
        $resultall = M('shopmessage') 
    			->where(array("state"=>array("in","1,2")))
    			-> select();
        foreach ($resultall as $k => $val){
            $orderinfo = M('orders')->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2])->select();
            $money = 0;
            foreach ($orderinfo as $va){
                $money += $va['allprice'];
        }
        $resultall[$k]['money'] = $money;
         if(empty($orderinfo)){
                unset($resultall[$k]);
            }
        }
        $jiaoyi = count($resultall);
        $renzheng = count($results);
        $session = session('username');
        $this->assign("session",$session);
        $allorders = M('orders')->count();
        $this->assign("allorders",$allorders);
        $this->assign("renzheng",$renzheng);
        $this->assign("jiaoyi",$jiaoyi);
        $this->assign("tuidan",$count);
        $this ->assign("result",$result);
        $this->assign("show",$show);
        $this->display("untreated");
   }
   /**
    * 退单模糊搜索
    */
   public function tuidans(){
       if(IS_GET){
           $get = I("get.shopname");
           $resultsa = M("orders")->where(array('state'=>array("in","1,2")))->where(['states'=>1,'statu'=>1])->select();
       $count = count($resultsa);
       $where['shopname']=array('like','%'.$get.'%');
       $result = M('orders') 
    			->where(array("state"=>array("in","1,2")))
    			->where(['states'=>1,'statu'=>1])
    			-> select();
       foreach ($result as $k=> $val){
            $userinfo = M("user")->where(['uid'=>$val['uid']])->field("username,mobile")->find();
            $result[$k]['username'] = $userinfo['username'];
            $result[$k]['userphone'] = $userinfo['mobile'];
            $shopinfo = M('shopmessage')->where($where)->where(['shopid'=>$val['shopid']])->field("shopname")->find();
            if(empty($shopinfo)){
                unset($result[$k]);
            }else{
                $result[$k]['shopname'] = $shopinfo['shopname'];
            }
            
        }
        $results = M('shopmessage')->where(['state'=>3])->select();
        $resultall = M('shopmessage') 
    			->where(array("state"=>array("in","1,2")))
    			-> select();
        foreach ($resultall as $k => $val){
            $orderinfo = M('orders')->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2])->select();
            $money = 0;
            foreach ($orderinfo as $va){
                $money += $va['allprice'];
        }
        $resultall[$k]['money'] = $money;
         if(empty($orderinfo)){
                unset($resultall[$k]);
            }
        }
        $jiaoyi = count($resultall);
        $renzheng = count($results);
        $session = session('username');
        $this->assign("session",$session);
        $this->assign("renzheng",$renzheng);
        $allorders = M('orders')->count();
        $this->assign("allorders",$allorders);
        $this->assign("jiaoyi",$jiaoyi);
        $this->assign("tuidan",$count);
        $this ->assign("result",$result);
        $this->assign('shopname',$get);
        $this->display("untreated");
       }
       
   }
   /**
    * 通过退单
    */
   public function passtuidan(){
       if(IS_POST){
           $post = I("post.id");
           $post = trim($post);
           $data = array(
             'statu'=>3,  
           );
           $result = M("orders")->where(['orderid'=>$post])->save($data);
           if($result){
               $this->ajaxReturn(['status'=>1]);//退单成功
           }else{
               $this->ajaxReturn(['status'=>0]);//失败
           }
       }
   }
   /**
    * 拒绝退单
    */
   public function notuidan(){
       if(IS_POST){
           $post = I("post.id") *1;
           $data = array(
             'statu'=>2,
               'addtime'=>  date("Y-m-d H:i:s",time()),
           );
           $result = M("orders")->where(['orderid'=>$post])->save($data);
           if($result){
               $this->ajaxReturn(['status'=>1,"msg"=>$result]);//拒绝成功
           }else{
               $this->ajaxReturn(['status'=>0,'msg'=>$post]);//失败
           }
       }
   }
   /**
    * 客服
    */
   public function kefu(){
       header("Location:http://wm.sawfree.com/server"); 
   }
   /**
    * 订单明细
    */
   public function ordermingxi(){
       $results = M('shopmessage')->where(['state'=>3])->select();
        $orderinfo = M('orders')->where(array("state"=>array("in","1,2")))->where(['states'=>1,'statu'=>1])->select();
        $tuidan = count($orderinfo);
        $renzheng = count($results);
       $resultaa = M('shopmessage') 
    			->where(array("state"=>array("in","1,2")))
    			-> select();
        foreach ($resultaa as $k => $val){
            $orderinfo = M('orders')->where(array("state"=>array("in","3,4,5")))->where(['states'=>1,"shopid"=>$val['shopid'],'statu'=>2])->select();
            $money = 0;
            foreach ($orderinfo as $va){
                $money += $va['allprice'];
        }
        $resultaa[$k]['money'] = $money;
         if(empty($orderinfo)){
                unset($resultaa[$k]);
            }
        }
        $jiaoyi = count($resultaa);
        $allorders = M('orders')->count();
        $get = I('get.');
        if(empty($get) || ($get['states'] ==1 && $get['times'] == 1)){
            $time  = time() - 300;
            $result = $this->results($time);
            $show = $this->resultss($time);
            $count = $this->resultd($time);
        }else if($get['states'] ==1 && $get['times'] == 2){
            $time  = time() - 15*60;
            $result = $this->results($time);
            $show = $this->resultss($time);
            $count = $this->resultd($time);
        }else if($get['states'] ==1 && $get['times'] == 3){
            $time  = time() - 60*60;
            $result = $this->results($time);
            $show = $this->resultss($time);
            $count = $this->resultd($time);
        }else if($get['states'] ==1 && $get['times'] == 4){
            $today = date("Y-m-d",time());
            $time = strtotime($today);
            $result = $this->results($time);
            $show = $this->resultss($time);
            $count = $this->resultd($time);
        }else if($get['states'] ==1 && $get['times'] == 5){
            $time  = 0;
            $result = $this->results($time);
            $show = $this->resultss($time);
            $count = $this->resultd($time);
        }else if($get['states'] ==2 && $get['times'] == 1){
            $time  = time() - 300;
            $result = $this->yijiedan($time);
            $show = $this->yijiedans($time);
            $count = $this->yijiedanc($time);
        }else if($get['states'] ==2 && $get['times'] == 2){
            $time  = time() - 15*60;
            $result = $this->yijiedan($time);
            $show = $this->yijiedans($time);
            $count = $this->yijiedanc($time);
        }else if($get['states'] ==2 && $get['times'] == 3){
            $time  = time() - 60*60;
            $result = $this->yijiedan($time);
            $show = $this->yijiedans($time);
            $count = $this->yijiedanc($time);
        }else if($get['states'] ==2 && $get['times'] == 4){
            $today = date("Y-m-d",time());
            $time = strtotime($today);
            $result = $this->yijiedan($time);
            $show = $this->yijiedans($time);
            $count = $this->yijiedanc($time);
        }else if($get['states'] ==2 && $get['times'] == 5){
            $time  = 0;
            $result = $this->yijiedan($time);
            $show = $this->yijiedans($time);
            $count = $this->yijiedanc($time);
        }else if($get['states'] ==3 && $get['times'] == 1){
            $time  = time() - 300;
            $result = $this->wancheng($time);
            $show = $this->wanchengs($time);
            $count = $this->wanchengc($time);
        }else if($get['states'] ==3 && $get['times'] == 2){
            $time  = time() - 15*60;
            $result = $this->wancheng($time);
            $show = $this->wanchengs($time);
            $count = $this->wanchengc($time);
        }else if($get['states'] ==3 && $get['times'] == 3){
            $time  = time() - 60*60;
            $result = $this->wancheng($time);
            $show = $this->wanchengs($time);
            $count = $this->wanchengc($time);
        }else if($get['states'] ==3 && $get['times'] == 4){
            $today = date("Y-m-d",time());
            $time = strtotime($today);
            $result = $this->wancheng($time);
            $show = $this->wanchengs($time);
            $count = $this->wanchengc($time);
        }else if($get['states'] ==3 && $get['times'] == 5){
            $time  = 0;
            $result = $this->wancheng($time);
            $show = $this->wanchengs($time);
            $count = $this->wanchengc($time);
        }
       $session = session('username');
        $this->assign("session",$session);
        $this->assign("renzheng",$renzheng);
        $this->assign("jiaoyi",$jiaoyi);
        $this->count = $count;
        $this->result = $result;
        $this->show = $show;
        $this->getstates = $get['states'];
        $this->gettimes = $get['times'];
        $this->assign("tuidan",$tuidan);
        $this->allorders=$allorders;
       $this->display('ordermingxi');
   }
   /**
    * 已完成订单明细
    */
   public function wanchengs($time) {
            $datatime = date("Y-m-d H:i:s",$time);
       $count = M("orders")->where(['statu'=>2,"states"=>1])->where(array("state"=>array("in","3,4,5")))->where("addtime > '{$datatime}'")->count();
            $page = new \Org\Page\Page($count,$this->pages);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page -> setConfig('prev', '上一页');
            $page -> setConfig('next', '下一页');
            $page -> setConfig('last', '末页');
            $page -> setConfig('first', '首页');
            $page -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page -> show(); 
            return $show; 
   }
   /**
    * 已完成订单明细
    */
   public function wancheng($time) {
            $datatime = date("Y-m-d H:i:s",$time);
       $count = M("orders")->where(['statu'=>2,"states"=>1])->where(array("state"=>array("in","3,4,5")))->where("addtime > '{$datatime}'")->count();
            $page = new \Org\Page\Page($count,$this->pages);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page -> setConfig('prev', '上一页');
            $page -> setConfig('next', '下一页');
            $page -> setConfig('last', '末页');
            $page -> setConfig('first', '首页');
            $page -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page -> show(); 
            $result = M('orders') 
    			->where(['statu'=>2,"states"=>1])->where(array("state"=>array("in","3,4,5")))->where("addtime > '{$datatime}'")
    			-> limit( $page->firstRow, $page->listRows)
    			-> select();
            foreach($result as $k=>$v){
                $shop = M('shopmessage')->where(['shopid'=>$v['shopid']])->find();
                $result[$k]['shopname'] = $shop['shopname'];
                $result[$k]['mobile'] = $shop['mobile'];
                $result[$k]['detailed_address'] = $shop['detailed_address'];
            }
            return $result; 
   }
   /**
    * 已完成订单数量
    */
   public function wanchengc($time) {
            $datatime = date("Y-m-d H:i:s",$time);
       $count = M("orders")->where(['statu'=>2,"states"=>1])->where(array("state"=>array("in","3,4,5")))->where("addtime > '{$datatime}'")->count();
       return $count;
   }
   /**
    * 已接订单明细
    */
   public function yijiedans($time) {
            $datatime = date("Y-m-d H:i:s",$time);
       $count = M("orders")->where(['statu'=>2,"states"=>1,"state"=>2])->where("addtime > '{$datatime}'")->count();
            $page = new \Org\Page\Page($count,$this->pages);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page -> setConfig('prev', '上一页');
            $page -> setConfig('next', '下一页');
            $page -> setConfig('last', '末页');
            $page -> setConfig('first', '首页');
            $page -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page -> show(); 
            return $show; 
   }
   /**
    * 已接订单明细
    */
   public function yijiedan($time) {
            $datatime = date("Y-m-d H:i:s",$time);
       $count = M("orders")->where(['statu'=>2,"states"=>1,"state"=>2])->where("addtime > '{$datatime}'")->count();
            $page = new \Org\Page\Page($count,$this->pages);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page -> setConfig('prev', '上一页');
            $page -> setConfig('next', '下一页');
            $page -> setConfig('last', '末页');
            $page -> setConfig('first', '首页');
            $page -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page -> show(); 
            $result = M('orders') 
    			->where(['statu'=>2,"states"=>1,"state"=>2])->where("addtime > '{$datatime}'")
    			-> limit( $page->firstRow, $page->listRows)
    			-> select();
            foreach($result as $k=>$v){
                $shop = M('shopmessage')->where(['shopid'=>$v['shopid']])->find();
                $result[$k]['shopname'] = $shop['shopname'];
                $result[$k]['mobile'] = $shop['mobile'];
                $result[$k]['detailed_address'] = $shop['detailed_address'];
            }
            return $result; 
   }
   /**
    * 已接订单数量
    */
   public function yijiedanc($time) {
            $datatime = date("Y-m-d H:i:s",$time);
       $count = M("orders")->where(['statu'=>2,"states"=>1,"state"=>2])->where("addtime > '{$datatime}'")->count();
       return $count;
   }
   /**
    * 未接订单明细
    */
   public function resultss($time) {
            $datatime = date("Y-m-d H:i:s",$time);
       $count = M("orders")->where(['statu'=>2,"states"=>1,"state"=>1])->where("addtime > '{$datatime}'")->count();
            $page = new \Org\Page\Page($count,$this->pages);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page -> setConfig('prev', '上一页');
            $page -> setConfig('next', '下一页');
            $page -> setConfig('last', '末页');
            $page -> setConfig('first', '首页');
            $page -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page -> show(); 
            return $show; 
   }
   /**
    * 未接订单明细
    */
   public function results($time) {
            $datatime = date("Y-m-d H:i:s",$time);
       $count = M("orders")->where(['statu'=>2,"states"=>1,"state"=>1])->where("addtime > '{$datatime}'")->count();
            $page = new \Org\Page\Page($count,$this->pages);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page -> setConfig('prev', '上一页');
            $page -> setConfig('next', '下一页');
            $page -> setConfig('last', '末页');
            $page -> setConfig('first', '首页');
            $page -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page -> show(); 
            $result = M('orders') 
    			->where(['statu'=>2,"states"=>1,"state"=>1])->where("addtime > '{$datatime}'")
    			-> limit( $page->firstRow, $page->listRows)
    			-> select();
            foreach($result as $k=>$v){
                $shop = M('shopmessage')->where(['shopid'=>$v['shopid']])->find();
                $result[$k]['shopname'] = $shop['shopname'];
                $result[$k]['mobile'] = $shop['mobile'];
                $result[$k]['detailed_address'] = $shop['detailed_address'];
            }
            return $result; 
   }
   /**
    * 未接订单数量
    */
   public function resultd($time) {
            $datatime = date("Y-m-d H:i:s",$time);
       $count = M("orders")->where(['statu'=>2,"states"=>1,"state"=>1])->where("addtime > '{$datatime}'")->count();
       return $count;
   }
}
