<?php 

namespace Admin\Controller;
use Think\Controller;
use Think\Upload;

class ShopController extends Controller{
     //构造函数
    public function _initialize(){
        if(!session('username')){
            $this -> redirect('Login/loadlogin');exit(0);
        }
    }

 /**
  * 用户列表
  */
    public function userlist(){
        $count = M('user')->count();
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
            $userinfo = M('user')
                    ->limit($page->firstRow, $page->listRows)
                    ->order("uid desc")
                    ->select();
            foreach($userinfo as $k =>$v){
                $orderinfo = M("orders")->where(['uid'=>$v['uid'],'statu'=>2])->select();
                $userinfo[$k]['num'] = count($orderinfo);
                $userinfo[$k]['money'] = 0;
                foreach($orderinfo as $val){
                    $userinfo[$k]['money'] += $val['allprice'];
                }
            }
            $session = session('username');
        $this->assign("session", $session);
            $this->assign('count',$count);
            $this->assign('userinfo',$userinfo);
            $this->assign('show',$show);
            $this->display('party');
    }
    /**
     * 用户列表模糊搜索
     */
    public function userlists(){
        if(IS_GET){
            $get = I("get.username");
            $count = M('user')->count();
            $where['username']=array('like','%'.$get.'%');
            $userinfo = M('user')
                    ->where($where)
                    ->order("uid desc")
                    ->select();
            foreach($userinfo as $k =>$v){
                $orderinfo = M("orders")->where(['uid'=>$v['uid'],'statu'=>2])->select();
                $userinfo[$k]['num'] = count($orderinfo);
                $userinfo[$k]['money'] = 0;
                foreach($orderinfo as $val){
                    $userinfo[$k]['money'] += $val['allprice'];
                }
            }
            $session = session('username');
        $this->assign("session", $session);
            $this->assign('count',$count);
            $this->assign('userinfo',$userinfo);
            $this->assign('username',$get);
            $this->display('party');
        }
    }
    /**
     * 禁用用户
     */
    public function stops(){
        $post = I('post.uid');
        $uid = $post * 1;
        $result = M("user")->where(['uid'=>$uid])->save(['flag'=>0]);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 禁用用户
     */
    public function starts(){
        $post = I('post.uid');
        $uid = $post * 1;
        $result = M("user")->where(['uid'=>$uid])->save(['flag'=>1]);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 用户详情
     */
    public function userdetail(){
        $get= I("get.uid");
        $result = M("user")->where(['uid'=>$get])->find();
        $address = M('shipping_address')->where(['userid'=>$result['uid']])->select();
        $session = session('username');
        $this->assign("session", $session);
        $this->assign("address", $address);
        $this->assign("result", $result);
        $this->display('party1');
    }
    /**
     * 用户订单列表
     */
    public function orderlist(){
        $get= I("get.");
        $result = M("user")->where(['uid'=>$get['uid']])->find();
        $count = M('orders')->where(['uid'=>$get['uid']])->count();
         $page = new \Think\Page($count, 10);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('last', '末页');
            $page->setConfig('first', '首页');
            $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page->show();
            $orderinfo = M('orders')
                    ->where(['uid'=>$get['uid']])
                    ->order('addtime desc')
                    ->limit($page->firstRow, $page->listRows)
                    ->select();
            $session = session('username');
        $this->assign("session", $session);
            $this->assign('show',$show);
            $this->assign('count',$count);
            $this->assign('orderinfo',$orderinfo);
            $this->assign('result',$result);
            $this->display('party2');
            
    }
    /**
     * 删除订单
     */
    public function deleteorder(){
        $post = I('post.orderid');
        $info = M('orders')->where(['orderid'=>$post])->find();
            if($info['states'] == 1){
                $this->ajaxReturn(['status'=>2]);
            }
        $result = M("orders")->where(['orderid'=>$post])->delete();
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 用户评论列表
     */
    public function pingjialist(){
        $get = I("get.");
        $count = M("evaluate")->where(['uid'=>$get['uid']])->count();
        $page = new \Think\Page($count, 10);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('last', '末页');
            $page->setConfig('first', '首页');
            $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page->show();
            $pingjiainfo = M('evaluate')
                    ->where(['uid'=>$get['uid']])
                    ->order('addtime desc')
                    ->limit($page->firstRow, $page->listRows)
                    ->select();
            foreach($pingjiainfo as $ki=> $val){
                $users = M("user")->where(['uid'=>$val['uid']])->find();
                $pingjiainfo[$ki]['username'] = $users['username'];
            }
            $result = M("user")->where(['uid'=>$get['uid']])->find();
            $session = session('username');
        $this->assign("session", $session);
        $this->assign("show", $show);
        $this->assign("pingjiainfo", $pingjiainfo);
        $this->assign("count", $count);
        $this->assign("result", $result);
            $this->display('party3');
    }
    public function pingjiadetail(){
        $get = I('get.');
        $result = M("user")->where(['uid'=>$get['uid']])->find();
        $pingjia = M("evaluate")->where(['eid'=>$get['eid']])->find();
         $session = session('username');
        $this->assign("session", $session);
        $this->assign('result',$result);
        $this->assign('evaluate',$pingjia);
        $this->display('party4');
        
    }
    public function deleteuser(){
        if(IS_POST){
            $post  = I('post.');
            $result = M('user')->where(['uid'=>$post['uid']])->delete();
           
                $orderinfo = M('orders')->where(['uid'=>$post['uid']])->delete();
               
                    $address = M('shipping_address')->where(['userid'=>$post['uid']])->delete();
                   $back = M("backtalk")->where(['userid'=>$post['uid']])->delete();
                        $pingjia = M("evaluate")->where(['uid'=>$post['uid']])->delete();
                      if($result){
                          S("token" . $post['uid'], null);
                           $this->ajaxReturn(['status'=>1,"msg"=>"删除用户信息成功"]);
                      }else{
                          $this->ajaxReturn(['status'=>0,"msg"=>"删除用户信息失败"]);
                      }
                           
                       
                   
               
            
        }
    }
    public function deltepingjia(){
        if(IS_POST){
            $post  = I('post.');
            $result = M('evaluate')->where(['eid'=>$post['eid']])->delete();
            if($result){
                $this->ajaxReturn(['status'=>1]);
            }else{
                $this->ajaxReturn(['status'=>0]);
            }
        }
    }
    /**
     * 删除客户反馈
     */
    public function deleteback(){
        if(IS_POST){
            $post  = I('post.');
            $result = M('backtalk')->where(['id'=>$post['id']])->delete();
            if($result){
                $this->ajaxReturn(['status'=>1]);
            }else{
                $this->ajaxReturn(['status'=>0]);
            }
        }
    }
    /**
     * 删除商户反馈
     */
    public function deletemessage(){
        if(IS_POST){
            $post  = I('post.');
            $result = M('backmessage')->where(['id'=>$post['id']])->delete();
            if($result){
                $this->ajaxReturn(['status'=>1]);
            }else{
                $this->ajaxReturn(['status'=>0]);
            }
        }
    }
    /*
     * 客户端推荐
     */
    public function tuilist(){
        $result = M('shopmessage')->where(['states'=>2])->select();
        $count = count($result);
        foreach ($result as $k =>$val){
            $orders = M('orders')->where(['shopid'=>$val['shopid'],'statu'=>2])->where(array('state'=>array("in","3,4,5")))->select();
            $result[$k]['orders'] = count($orders);
            $result[$k]['money'] = 0;
            foreach ($orders as $v){
                $result[$k]['money'] += $v['allprice'];
            }
            
        }
        $tuichu = M("shopmessage")->where(['state'=>4])->count();
        $this->assign('tuichu',$tuichu);
        $backtalk = M("backtalk")->count();
        $backtalks = M("backmessage")->count();
        $back = $backtalk + $backtalks;
        $session = session('username');
        $this->assign("session", $session);
        $this->assign('count',$count);
        $this->assign('result',$result);
        $this->assign('backtalk',$back);
        $this->display('system');
    }
    /**
     * 反馈列表
     */
    public function backlist(){
        $back = M("backtalk")->count();
        $results = M('shopmessage')->where(['states'=>2])->select();
        $count = count($results);
        $page = new \Think\Page($back, 10);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('last', '末页');
            $page->setConfig('first', '首页');
            $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page->show();
            $result = M('backtalk')
                    ->order('addtime desc')
                    ->limit($page->firstRow, $page->listRows)
                    ->select();
        foreach($result as $k => $v){
            $user = M("user")->where(['uid'=>$v['userid']])->field('uid,username,mobile')->find();
            $result[$k]['username'] = $user['username'];
            $result[$k]['uid'] = $user['uid'];
            $result[$k]['mobile'] = $user['mobile'];
        }
        $backmes = M('backmessage')->count();
        $back = $back + $backmes;
        $tuichu = M("shopmessage")->where(['state'=>4])->count();
        $this->assign('tuichu',$tuichu);
        $session = session('username');
        $this->assign("session", $session);
        $this->assign('result',$result);
        $this->assign('back',$back);
        $this->assign('count',$count);
        $this->assign('show',$show);
        $this->display('system1');
    }
    /**
     * 反馈列表
     */
    public function backlistsp(){
        $back = M("backmessage")->count();
        $results = M('shopmessage')->where(['states'=>2])->select();
        $count = count($results);
        $page = new \Think\Page($back, 10);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('last', '末页');
            $page->setConfig('first', '首页');
            $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page->show();
            $result = M('backmessage')
                    ->order('addtime desc')
                    ->limit($page->firstRow, $page->listRows)
                    ->select();
        foreach($result as $k => $v){
            $user = M("shopmessage")->where(['shopid'=>$v['shopid']])->field('shopid,shopname,mobile')->find();
            $result[$k]['shopname'] = $user['shopname'];
            $result[$k]['shopid'] = $user['shopid'];
            $result[$k]['mobile'] = $user['mobile'];
        }
        $xs = 2;
        $tuichu = M("shopmessage")->where(['state'=>4])->count();
        $backmes = M('backtalk')->count();
        $back = $back + $backmes;
        $this->assign('tuichu',$tuichu);
        $session = session('username');
        $this->assign("session", $session);
        $this->assign('result',$result);
        $this->assign('back',$back);
        $this->assign('count',$count);
        $this->assign('show',$show);
        $this->assign('xs',$xs);
        $this->display('systems');
    }
    /**
     * 反馈列表模糊搜索
     */
    public function backlists(){
        if(IS_GET){
            $get= I("get.username");
            $back = M("backtalk")->count();
        $results = M('shopmessage')->where(['states'=>2])->order("addtime desc")->select();
        $count = count($results);
         $where['username']=array('like','%'.$get.'%');
            $result = M('backtalk')->order('addtime desc')
                    ->select();
        foreach($result as $k => $v){
            $user = M("user")->where(['uid'=>$v['userid']])->where($where)->field('uid,username,mobile')->find();
            if(empty($user)){
                unset($result[$k]);
            }else{
                 $result[$k]['username'] = $user['username'];
            $result[$k]['uid'] = $user['uid'];
            $result[$k]['mobile'] = $user['mobile'];
            }
           
        }
        $xs = 2;
        $tuichu = M("shopmessage")->where(['state'=>4])->count();
        $this->assign('tuichu',$tuichu);
        $session = session('username');
        $this->assign("session", $session);
        $this->assign('result',$result);
        $bas = M("backmessage")->count();
        $back = $bas + $back;
        $this->assign('back',$back);
        $this->assign('count',$count);
        $this->assign('xs',$xs);
        $this->assign('username',$get);
        $this->display('system1');
        }
    }
    /**
     * 商铺反馈列表模糊搜索
     */
    public function backlistspw(){
        if(IS_GET){
            $get= I("get.shopname");
            $back = M("backmessage")->count();
        $results = M('shopmessage')->where(['states'=>2])->order("addtime desc")->select();
        $count = count($results);
         $where['shopname']=array('like','%'.$get.'%');
            $result = M('backmessage')->order('addtime desc')
                    ->select();
        foreach($result as $k => $v){
            $user = M("shopmessage")->where(['shopid'=>$v['shopid']])->where($where)->field('shopid,shopname,mobile')->find();
            if(empty($user)){
                unset($result[$k]);
            }else{
                $result[$k]['shopname'] = $user['shopname'];
            $result[$k]['shopid'] = $user['shopid'];
            $result[$k]['mobile'] = $user['mobile'];
            }
            
        }
        $bacs = M('backtalk')->count();
        $xs =2;
        $tuichu = M("shopmessage")->where(['state'=>4])->count();
        $this->assign('tuichu',$tuichu);
        $session = session('username');
        $this->assign("session", $session);
        $this->assign('result',$result);
        $back = $back + $bacs;
        $this->assign('back',$back);
        $this->assign('count',$count);
        $this->assign('xs',$xs);
        $this->assign('shopname',$get);
        $this->display('systems');
        }
    }
    /**
     * 反馈详情
     */
    public function backdetail(){
        $get= I("get.");
        $user =M('user')->where(['uid'=>$get['uid']])->find();
        $back = M("backtalk")->where(['id'=>$get['id']])->find();
        $session = session('username');
        $this->assign("session", $session);
        $this->assign("user", $user);
        $this->assign("back", $back);
        $this->display('system3');
    }
    /**
     * 商铺反馈详情
     */
    public function backdetailsp(){
        $get= I("get.");
        $user =M('shopmessage')->where(['shopid'=>$get['shopid']])->find();
        $back = M("backmessage")->where(['id'=>$get['id']])->find();
        $session = session('username');
        $this->assign("session", $session);
        $this->assign("user", $user);
        $this->assign("back", $back);
        $this->display('systems3');
    }
    /**
     * 退出申请列表
     */
    public function outthis(){
        $count = M("shopmessage")->where(['state'=>4])->count();
        $page = new \Think\Page($count, 10);
            $page -> setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('last', '末页');
            $page->setConfig('first', '首页');
            $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page->show();
            $result = M('shopmessage')
                    ->where(['state'=>4])
                    ->order('addtime desc')
                    ->limit($page->firstRow, $page->listRows)
                    ->select();
            $tuijian = M('shopmessage')->where(['states'=>2])->count();
            $back = M("backtalk")->count();
            $aba =  M("backmessage")->count();
            $back = $back + $aba;
            $this->assign('back',$back);
            $tuichu = M("shopmessage")->where(['state'=>4])->count();
        $this->assign('tuichu',$tuichu);
            $this->assign('tuijian',$tuijian);
            $yijian = M("backtalk")->count();
            $this->assign('yijian',$yijian);
             $session = session('username');
        $this->assign("session", $session);
            $this->assign('result',$result);
            $this->assign('show',$show);
            $this->assign('count',$count);
            $this->display('system5');
    }
    /**
     * 退出模糊搜索
     */
    public function outthiss(){
        if(IS_GET){
            $get = I('get.shopname');
             $count = M("shopmessage")->where(['state'=>4])->count();
             $where['shopname']=array('like','%'.$get.'%');
              $result = M('shopmessage')
                    ->where(['state'=>4])
                    ->where($where)
                      ->order('addtime desc')
                    ->select();
            $tuijian = M('shopmessage')->where(['states'=>2])->count();
            $this->assign('tuijian',$tuijian);
            $yijian = M("backtalk")->count();
            $this->assign('yijian',$yijian);
             $session = session('username');
        $this->assign("session", $session);
            $this->assign('result',$result);
            $this->assign('count',$count);
            $this->assign('shopname',$get);
            $this->display('system5');
        }
    }
    /**
     * 商铺退出
     */
    public function outshop(){
        if(IS_POST){
            $post = I('post.shopid');
            $result = M("shopmessage")->where(['shopid'=>$post])->delete();
            if($result){
                $info = M('shop')->where(['shopid'=>$post])->delete();
                if($info){
                    S("token" . $post, null);
                    $this->ajaxReturn(['status'=>1]);
                }else{
                    $this->ajaxReturn(['status'=>0]);
                }
            }else{
                $this->ajaxReturn(['status'=>2]);
            }
            
        }
    }
       /**
     * 删除商铺信息
     */
    public function deleteshop() {
        if (IS_POST) {
            $post = I("post.");
            $result = M('shopmessage')->delete($post['uid']);
            if ($result) {
                $info = M('shop')->delete($post['uid']);
                if($info){
                    S("token" . $post, null);
                    $this->ajaxReturn(['status'=>1]);
                }
                
            }else{
                $this->ajaxReturn(['status'=>0]);
            }
        }
    }
    /**
     * 拒绝退出加盟
     */
    public function noback(){
       if (IS_POST) {
            $post = I("post.");
            $shopid = $post['shopid'];
            $data = array(
                'state'=>1,
            );
            $result = M("shopmessage")->where(['shopid'=>$shopid])->save($data);
            if ($result) {
                    $this->ajaxReturn(['status'=>1]);
            }else{
                $this->ajaxReturn(['status'=>0]);
            }
        }
    }
   
    
}