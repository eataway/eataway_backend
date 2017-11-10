<?php 

namespace Server\Controller;
use Think\Controller;
use Think\Upload;
date_default_timezone_set('Australia/South');
class EvaluateController extends Controller{ 
    public $path = "http://wm.sawfree.com/";
    /*
    * 商户回复
    * 2017.6.28
    */
    public function backpingjia(){
        if (IS_POST) {
            $post = I('post.');
            $eid = $post['eid'];
            $userid = $post['userid'];
            $shopid = $post['shopid'];
            $backpingjia = $post['backpingjia'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            $data = array(
                'eid' => $eid,
                'uid' => $userid,
                'shopid'=>$shopid,
                'backpingjia'=>$backpingjia,
                'backtime'=>date('Y-m-d H:i:s',time()),
            );
            $result = M('backevaluate')->add($data);
            if($result){
                $this->ajaxReturn(['status'=>1,'msg'=>'']);
            }else{
                $this->ajaxReturn(['status'=>0,'msg'=>'回复失败']);
            }
        }
    }
   /**
    * 商户评价列表
    * 2017.6.28
    */
   public function pingjialist(){
       if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $page = $post['page'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            $pingjia = M('evaluate')->where(['shopid'=>$shopid])->page($page.",8")->select();
            $info = array();
            foreach($pingjia as $k => $val){
                $userinfo = M('user')->field('uid,username,head_photo')->where(['uid'=>$val['uid']])->find();
                $userinfo['eid'] = $val['eid'];
                $userinfo['pingjia'] = $val['pingjia'];
                $userinfo['content'] = $val['content'];
                if($val['photo1'] == null){
                    $userinfo['photo1'] = "";
                }else{
                    $userinfo['photo1'] = $this->path.$val['photo1'];
                }
                if($val['photo2'] == null){
                    $userinfo['photo2'] = "";
                }else{
                    $userinfo['photo2'] = $this->path.$val['photo2'];
                }
                $userinfo['state'] = $val['state'];
                $userinfo['addtime'] = $val['addtime'];
                $backpingjia = M('backevaluate')->field('backpingjia')->where(['shopid'=>$shopid,'uid'=>$val['uid'],"eid"=>$val['eid']])->find();
                if(empty($backpingjia)){
                    $userinfo['backpingjia'] = "";
                }else{
                    $userinfo['backpingjia'] = $backpingjia['backpingjia'];
                }
                $info[$k] = $userinfo;
            }
            if($info){
                $this->ajaxReturn(['status'=>1,"msg"=>$info]);
            }else{
                $this->ajaxReturn(['status'=>1,"msg"=>array()]);
            }
        }
   }
   /**
    * 商铺反馈
    */
   public function shopback(){
       if(IS_POST){
           $post = I("post.");
           $shopid = $post['shopid'];
           $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
           $data = array(
               'shopid'=>$post['shopid'],
               'backmessage'=>$post['backmessage'],
               'addtime'=>date("Y-m-d H:i:s",time()),
           );
           $result = M("backmessage")->add($data);
           if($result){
               $this->ajaxReturn(['status'=>1]);
               
           }else{
               $this->ajaxReturn(['status'=>0]);
           }
       }
   }
}