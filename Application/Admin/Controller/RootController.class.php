<?php

namespace Admin\Controller;

use Think\Controller;

class RootController extends Controller {
  public $rows = 7;
  //构造函数
    public function _initialize(){
        if(!session('username')){
            $this -> redirect('Login/loadlogin');exit(0);
        }
    }
    /**
    * 后台管理人员
    * @2017.7.26
    */
    public function roots(){
         $count = M('root')->count();
        $page = new \Think\Page($count, 10);
           $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page->setConfig('prev', '上一页' );
            $page->setConfig('next', '下一页');
            $page->setConfig('last', '末页');
            $page->setConfig('first', '首页');
            $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page->show();
            $userinfo = M('root')
                    ->order('uid desc')
                    ->limit($page->firstRow, $page->listRows)
                    ->select();
            $session = session('username');
            $this->assign('session',$session);
            $this->assign('result',$userinfo);
            $this->assign('show',$show);
            $this->display('install');
    }
    /**
    * 修改管理员信息
    * @2017.7.26
    */
    
    public function editroot(){
       if(IS_GET){
           $get = I('get.');
           $result = M("root")->where(['uid'=>$get['uid']])->find();
           $session = session('username');
            $this->assign('session',$session);
           $this->assign('result',$result);
           $this->assign('uid',$get['uid']);
           $this->display('install1');
       }
    }
    /**
     * 修改密码账号
     */
    public function esit(){
        if(IS_POST){
            $post = I("post.");
            $uid = $post['uid'];
            $username = $post['name'];
            $password = $post['pwd'];
            $oldpass = $post['old'];
            $news = $post['news'];
            if($password !== $news){
                $this->ajaxReturn(['status'=>0,"msg"=>"两次输入密码不一致。"]);
            }
            $result = M('root')->where(['uid'=>$uid])->find();
            if($result['password'] == md5($oldpass) ){
                $datas= array(
                    'username'=>$username,
                    'password'=>md5($password),
                );
                $userinfo =  M('root')->where(['uid'=>$uid])->save($datas);
                if($userinfo){
                    if($result['state'] == 2){
                        $this->ajaxReturn(['status'=>2,"msg"=>"修改成功。"]);
                    }else{
                        $this->ajaxReturn(['status'=>1,"msg"=>"修改成功。"]);
                    }
                    
                }else{
                    $this->ajaxReturn(['status'=>0,"msg"=>"修改失败。"]);
                }
            }else{
                $this->ajaxReturn(['status'=>0,"msg"=>"原密码不正确。"]);
            }
        }
    }
    /**
     * 删除管理员
     */
    public function deletes(){
        if(IS_POST){
            $post = I('post.');
            $result = M('root')->where(['uid'=>$post['uid']])->delete();
            if($result){
                $this->ajaxReturn(['status'=>1,"msg"=>"删除成功。"]);
            }else{
                $this->ajaxReturn(['status'=>0,"msg"=>"删除失败。"]);
            }
        }
    }
  /*
   * 引入添加模板
   */
    public function addroot(){
        $this->display('install2');
    }
  /*
   * 添加管理员
   */
    public function addrootin(){
        if(IS_POST){
            $post = I('post.');
            if($post['pwd'] !==$post['news']){
                $this->ajaxReturn(['status'=>0,"msg"=>"密码输入不一致。"]);
            }
            $user = M("root")->where(['username'=>$post['name']])->find();
            if($user){
                $this->ajaxReturn(['status'=>2,"用户名已存在。"]);
            }
            $data = array(
                'username'=>$post['name'],
                'password'=>md5($post['pwd']),
                'addtime'=>date("Y-m-d H:i:s",time())
            );
            $reuslt = M('root')->add($data);
            if($reuslt){
                $this->ajaxReturn(['status'=>1,"msg"=>"添加成功。"]);
            }else{
                $this->ajaxReturn(['status'=>0,"msg"=>"添加失败。"]);
            }
        }
        
    }
    /**
     * 优惠码列表
     */
    
    public function youhuilist(){
        $count = M("youhui")->count();
        $page = new \Org\Page\Page($count,$this->rows);
        $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
        $page -> setConfig('prev', '上一页');
        $page -> setConfig('next', '下一页');
        $page -> setConfig('last', '末页');
        $page -> setConfig('first', '首页');
        $page -> setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;     //最后一页不显示为总页数
        $page->rollPage = 10;          //分页栏每页显示的页数
        $show = $page -> show(); 
        $result = M('youhui') 
                    -> limit( $page->firstRow, $page->listRows)
                    -> select();
        $shangxian = M("shangxian")->where(['sid'=>1])->find();
        $this->shangxian = $shangxian['shangxian'];
        $session = session('username');
            $this->assign('session',$session);
            $this->count = $count;
            $this->show= $show;
            $this->result = $result;
            $this->display('system6');
    }
    /**
     * 禁用优惠码
     */
    public function jinyong(){
        $post = I('post.yid');
        $yid = trim($post);
        $result = M('youhui')->where(['yid'=>$yid])->save(['flag'=>2]);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>2]);
        }
    }
    /**
     * 全部禁用优惠码
     */
    public function alltingyong(){
        $result = M('youhui')->where(['flag'=>1])->save(['flag'=>2]);
        if($result == true){
            $this->ajaxReturn(['status'=>1]);
        }elseif($result == 0){
            $this->ajaxReturn(['status'=>2]);
        }elseif($result == false){
            $this->ajaxReturn(['status'=>3]);
        }
    }
    /**
     * 启用优惠码
     */
    public function qiyong(){
        $post = I('post.yid');
        $yid = trim($post);
        $result = M('youhui')->where(['yid'=>$yid])->save(['flag'=>1]);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>2]);
        }
    }
    /**
     * 修改优惠码使用上限
     */
    public function editshangxian(){
        $post = I("post.shangxian");
        $result = M('shangxian')->where(['sid'=>1])->save(['shangxian'=>$post]);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 优惠码添加页面
     */
    public function addyouhui(){
        $session = session('username');
            $this->assign('session',$session);
        $this->display('promoCode');
    }
    /**
     * 优惠码添加
     */
    public function addcodema(){
        $post = I("post.");
        $data = array(
            'codema'=>$post['youhuima'],
            'state'=>$post['asd'],
            'money'=>$post['money'],
            'addtime'=>date("Y-m-d H:i:s",time())
        );
        $result = M('youhui')->add($data);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 修改优惠信息模板
     */
    public function edityouhui(){
        $get = I("get.yid");
        $yid = trim($get);
        $result = M("youhui")->where(['yid'=>$yid])->find();
        $session = session('username');
            $this->assign('session',$session);
        $this->result = $result;
        $this->display('promoCodeDelete');
        
    }
    /**
     * 修改优惠码
     */
    public function editma(){
        $post = I("post.");
        $data = array(
            'codema'=>$post['codema'],
            'state'=>$post['asd'],
            'money'=>$post['money']
        );
        $result = M('youhui')->where(['yid'=>$post['yid']])->save($data);
        if($result == true){
            $this->ajaxReturn(['status'=>1]);
        }elseif($result == 0){
            $this->ajaxReturn(['status'=>2]);
        }elseif($result == false){
            $this->ajaxReturn(['status'=>3]);
        }
    }
    /**
     * 删除优惠码
     */
    public function deletema(){
        $post = I("post.yid");
        $yid = trim($post);
        $result = M("youhui")->delete($yid);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>2]);
        }
                
    }
            
}
