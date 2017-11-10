<?php 
namespace Home\Controller;
use Think\Controller;
use Think\Upload;
date_default_timezone_set('Australia/South');
class EvaluateController extends Controller{ 
    public $path = "http://wm.sawfree.com/";
    public $rows = 15;
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
        M('evaluate')->startTrans(); 
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
            $das =array(
                'state'=>5,
            );
            $orderinfo = M('orders')->where(['orderid'=>$orderid])->save($das);
            if($orderinfo){
                    M('evaluate')->commit();
                $this->ajaxReturn(['status'=>1,'msg'=>'']);
            }else{
                M('evaluate')->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'修改订单状态失败']);
            }
            
        }else{
                M('evaluate')->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'添加评价失败']);
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
            $page = $post['page'];
            $info = M('shopmessage')->field('shopname,shopphoto')->where(['shopid'=>$shopid])->find();
            $info['shopphoto'] = $this->path . $info['shopphoto'];
            $pingjia = M('evaluate')->where(['shopid'=>$shopid])->page($page,$this->rows)->select();
            foreach($pingjia as $kk => $val){
                $userinfo = M('user')->field('username,head_photo')->where(['uid'=>$val['uid']])->find();
                $userinfo['eid'] = $val['eid'];
                $userinfo['pingjia'] = $val['pingjia'];
                $userinfo['content'] = $val['content'];
                
                if($userinfo['head_photo'] == null){
                    $userinfo['head_photo'] = "";
                }else{
                    $userinfo['head_photo'] = $this->path . $userinfo['head_photo'];
                }
                if($pingjia[$kk]['photo1'] == null){
                    $userinfo['photo1'] = "";
                }else{
                    $userinfo['photo1'] = $this->path . $val['photo1'];
                }
                if($pingjia[$kk]['photo2'] == null){
                    $userinfo['photo2'] = "";
                }else{
                    $userinfo['photo2'] = $this->path . $val['photo2'];
                }
                
                $userinfo['state'] = $val['state'];
                $userinfo['addtime'] = $val['addtime'];
                $backpingjia = M('backevaluate')->field('backpingjia')->where(['shopid'=>$shopid,'uid'=>$val['uid'],"eid"=>$val['eid']])->find();
                if(empty($backpingjia)){
                    $userinfo['backpingjia'] = "";
                }else{
                    $userinfo['backpingjia'] = $backpingjia['backpingjia'];
                }
                
                $info['userspingjia'][] = $userinfo;
            }
            if($info){
                if($pingjia){
                    $this->ajaxReturn(['status'=>1,"msg"=>$info]);
                }else{
                    $info['userspingjia']=array();
                    $this->ajaxReturn(['status'=>1,"msg"=>$info]);
                }
                
            }else{
                 $this->ajaxReturn(['status'=>1,"msg"=>array()]);
            }
        }
   }
   /**
    * 用户反馈
    */
   public function back(){
       if(IS_POST){
           $post = I('post.');
           $userid = $post['userid'];
           $content = $post['content'];
           $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            $data = array(
              'userid'=>$userid,
                'content'=>$content,
                'state'=>1,
                'addtime' => date('Y-m-d H:i:s',time()),
            );
           $result = M('backtalk')->add($data);
           if($result){
               $this->ajaxReturn(['status'=>1,'msg'=>"成功"]);
           }else{
               $this->ajaxReturn(['status'=>0,'msg'=>"失败"]);
           }
       }
   }
}