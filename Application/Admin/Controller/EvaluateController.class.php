<?php 

namespace Home\Controller;
use Think\Controller;
use Think\Upload;

class EvaluateController extends Controller{ 
    //构造函数
    public function _initialize(){
        if(!session('username')){
            $this -> redirect('Login/loadlogin');exit(0);
        }
    }
    /*
    * 用户评价
    * 2017.6.23
    */
    public function addpingjia(){
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $orderid = $post['orderid'];
            $state = $post['state'];
            $shopid = $post['shopid'];
            $pingjia = $post['pingjia'];
            $content = $post['content'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            //图片信息接收
        if($_FILES){
            $array = array();
            foreach ($_FILES as $k => $fileInfo) {
            $array[] =$this->uploadFile($fileInfo);
        }
        }
        $data =array(
            'uid' => $userid,
            'shopid' => $shopid,
            'orderid'=>$orderid,
            'pingjia'=>$pingjia,
            'content'=>$content,
            'state'=>$state,
            'photo1'=>$array[0],
            'photo2'=>$array[1],
            'addtime'=>date('Y-m-d H:i:s',time())
        );
        $result= M('evaluate')->add($data);
        if($result){
            $this->ajaxReturn(['status'=>1,'msg'=>'']);
        }
        }
    }
    /*
    * 商户回复
    * 2017.6.24
    */
    public function backpingjia(){
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $shopid = $post['shopid'];
            $orderid = $post['orderid'];
            $backpingjia = $post['backpingjia'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            $data = array(
                'uid' => $userid,
                'shopid'=>$shopid,
                'orderid'=>$orderid,
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
    * 2017.6.24
    */
   public function pingjialist(){
       if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $orderid = $post['orderid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            $info = M('shopmessage')->field('shopname,shopphoto')->where(['shopid'=>$shopid])->find();
            $pingjia = M('evaluate')->where(['shopid'=>$shopid])->select();
            foreach($pingjia as $val){
                $userinfo = M('user')->field('username,head_photo')->where(['uid'=>$val['uid']])->find();
                $pingjiainfo = M('evaluate')->field('pingjia,content,photo1,photo2,state,addtime')->where(['shopid'=>$shopid,'uid'=>$val['uid']])->find();
                $userinfo['pingjia'] = $pingjiainfo['pingjia'];
                $userinfo['content'] = $pingjiainfo['content'];
                $userinfo['photo1'] = $pingjiainfo['photo1'];
                $userinfo['photo2'] = $pingjiainfo['photo2'];
                $userinfo['state'] = $pingjiainfo['state'];
                $userinfo['addtime'] = $pingjiainfo['addtime'];
                $backpingjia = M('backevaluate')->field('backpingjia')->where(['shopid'=>$shopid,'uid'=>$val['uid'],'orderid'=>$orderid])->find();
                $userinfo['backpingjia'] = $backpingjia['backpingjia'];
                $info['userspingjia'][] = $userinfo;
            }
            if($info){
                $this->ajaxReturn(['status'=>1,"msg"=>$info]);
            }
        }
   }
}