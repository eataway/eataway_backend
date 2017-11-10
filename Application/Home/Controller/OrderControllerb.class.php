<?php 

namespace Home\Controller;
use Think\Controller;
use Think\Upload;
date_default_timezone_set('Australia/South');
class OrderController extends Controller{ 
    public $path = "http://wm.sawfree.com/";

    /*
     * 客户端令牌请求
     * 2017.07.06
     */
    public function brtoken(){
        $token=braintoken();
        $result = array(
            'token'=>$token,
        );
         echo  json_encode($result);
    }
    /*
    * 客户下单
    * 2017.6.23
    */
    public function addorder(){
        if (IS_POST) {
            $post = I('post.');
//            $nonce = "fake-valid-nonce";
            $messages = $post['messages'];
            $nonce = $post['nonce'];
            $shopid = $post['shopid'];
            $goodsid = $post['goods'];
            $allprices = $post['allprices'];
            $cometime = $post['cometime'];
            $name = $post['name'];
            $sex = $post['sex'];
            $phone = $post['phone'];
            $address = $post['address'];
            $beizhu = $post['beizhu'];
            $money = $post['money'];
            $userid = $post['userid'];
            $juli = $post['juli'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            $shopmesag = M('shopmessage')->where(['shopid'=>$shopid])->field('state,long')->find();
            if($shopmesag['state'] == 2){
                $this->ajaxReturn(['status'=>4,"msg"=>"商铺未营业。"]);
            }
            if($juli > $shopmesag['long']){
                $this->ajaxReturn(['status'=>5,"msg"=>"超出最大配送范围。"]);
            }
            $allprice = 0;
            foreach ($goodsid as $val){
                $price = M('shopgoods')->field('goodsprice')->where(['goodsid'=>$val[0]])->find();
                $allprice += $price['goodsprice'] * $val[1];
            }
            $goodsresult = "";
            foreach ($goodsid as $v){
                $goodsinfo = M('shopgoods')->where(['goodsid'=>$v[0]])->field('goodsid,goodsname,goodsprice,goodsphoto')->find();
                if($goodsinfo['goodsphoto'] == null){
                    $goodsinfo['goodsphoto'] = "";
                }else{
                    $goodsinfo['goodsphoto'] = $this->path.$goodsinfo['goodsphoto'];
                }
                $aaa = implode(',', $goodsinfo);
                $aaa = $aaa.",".$v[1];
                $goodsresult .=$aaa."|"; 
            }
            
            $allmoney = $allprice + $money;
            $allprices = $allprices * 1;
            if(bccomp($allprices,$allmoney,2)){
                $this->ajaxReturn(['status'=>0,'msg'=>'商品价格有变动，请重新下单']);
            }
            //开启事物
            $order = M('orders');
            $order->startTrans();
//            $mobile = M('user')->field('mobile')->where(['uid'=>2])->find();
            $orderid = $post['phone'].time();
            $lingchen =  strtotime(date('Y-m-d',time()));
            $lingchen = date("Y-m-d H:i:s",$lingchen);
            $now = time();
            $now = date("Y-m-d H:i:s",time());
            $maps['addtime']  = array('between',array($lingchen,$now));
            $ordernums =M('orders')->where($maps)->where(['shopid'=>$shopid])->count();
            $ordernums = $ordernums + 1;
            $lifetime = time() + 900;
            $lifetime = date("Y-m-d H:i:s",$lifetime);
            $data = array(
                'orderid'=>$orderid,
                'uid' => $userid,
                'shopid' => $shopid,
                'money'=>$money,
                'cometime'=>$cometime,
                'name'=>$name,
                'sex'=>$sex,
                'phone'=>$phone,
                'address'=>$address,
                'beizhu'=>$beizhu,
                'allprice'=>$allmoney,
                'juli'=>$juli,
                'pay' => 3,
                'goodsinfo' => $goodsresult,
                'state' => 1,
                'todaynums' => $ordernums,
                'lifetime' => $lifetime,
                'addtime'=>date('Y-m-d H:i:s', time()),
            );
            $addorder = $order->add($data);
            if(!$addorder){
                //失败回滚
                $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'订单添加失败']);
            }
            
            if(!empty($goodsid)){
                foreach($goodsid as $vv){
                $datas = array(
                    'orderid' => $orderid,
                    'goodsid' => $vv[0],
                    'num' => $vv[1],
                    'addtime' => date('Y-m-d H:i:s', time()),
                );
                $ordergoods = M('ordergoods')->add($datas);
                if(!$ordergoods){
                    //失败回滚
                    $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'订单商品信息添加失败']);
                }
            }
            }else{
                 $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'商品信息不能为空']);
            }
            
            
            $dasta = array(
                "orderid"=>$orderid,
                "shopid" => $shopid,
                "money" => $allmoney,
                "addtime" => date("Y-m-d H:i:s",time()),
            );
            $mingxi = M('mingxi')->add($dasta);
            if(!$mingxi){
                 //失败回滚
                    $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'收入明细添加失败']);
            }
//            $brainresult = braintree($allmoney,$nonce);
//            $abd = substr($brainresult,0,7);
//            if( $abd != "success"){
//                //失败回滚
//                    $order->rollback();
//                    $this->ajaxReturn(['status'=>0,'msg'=>'支付失败']);
//            } else {
//                 Vendor('pushi.autoload');
//                $client = new \JPush\Client("a81b6096697fa2f544fc0157", "7064db033ad094f6a76cd8f3");
//                        $push_payload = $client->push() // 调用push方法（返回一个PushPayload实例） 
//                        ->setPlatform('all') // 设置平台 
//                        ->addAlias($shopid) 
////                       ->addAllAudience()
////                       ->setNotificationAlert('您有一条新订单，请及时处理！') // 设置推送通知内容 
////                        ->addAndroidNotification('您有一条新订单，请及时处理！',  '您有一条新订单，请及时处理！',1,array("orderid" => $orderid,"juli"=>$juli,"money"=>$money,"allprice"=>$allprices."","cometime"=>$cometime,"uid"=>$userid,"sex"=>$sex,"name"=>$name,"phone"=>$phone,"address"=>$address,"beizhu"=>$beizhu,"state"=>"1","todaynums"=>$ordernums."","addtime"=>date('Y-m-d H:i:s', time()),"goodsinfo"=>$goodsresult))
////                        ->addIosNotification('您有一条新订单，请及时处理！', 'default', '+1', true, 'iOS category', array("orderid" => $orderid,"juli"=>$juli,"money"=>$money,"allprice"=>$allprices."","cometime"=>$cometime,"uid"=>$userid,"sex"=>$sex,"name"=>$name,"phone"=>$phone,"address"=>$address,"beizhu"=>$beizhu,"state"=>"1","todaynums"=>$ordernums."","addtime"=>date('Y-m-d H:i:s', time()),"goodsinfo"=>$goodsresult));
//                        ->setNotificationAlert('您有一条新订单，请及时处理！') // 设置推送通知内容 
//                        ->addAndroidNotification('您有一条新订单，请及时处理！',  '您有一条新订单，请及时处理！',1,array("orderid" => $orderid,"juli"=>$juli,"money"=>$money,"allprice"=>$allprices."","cometime"=>$cometime,"uid"=>$userid,"sex"=>$sex,"name"=>$name,"phone"=>$phone,"address"=>$address,"beizhu"=>$beizhu,"state"=>"1","todaynums"=>$ordernums."","addtime"=>date('Y-m-d H:i:s', time()),"goodsinfo"=>$goodsresult))
//                        ->addIosNotification('您有一条新订单，请及时处理！', 'default', '+1', true, 'iOS category', array("orderid" => $orderid,"juli"=>$juli,"money"=>$money,"allprice"=>$allprices."","cometime"=>$cometime,"uid"=>$userid,"sex"=>$sex,"name"=>$name,"phone"=>$phone,"address"=>$address,"beizhu"=>$beizhu,"state"=>"1","todaynums"=>$ordernums."","addtime"=>date('Y-m-d H:i:s', time()),"goodsinfo"=>$goodsresult))
//                        ->options(array(
//                            "apns_production" => true  //true表示发送到生产环境(默认值)，false为开发环境
//                        ));
//                        try { 
//                            $response = $push_payload->send(); // 执行推送 
//                        }catch (\JPush\Exceptions\APIConnectionException $e) { // 请求异常 // 
//                           $this->ajaxReturn(['status'=>66,"msg"=>$e]);
//                            } 
//                            catch (\JPush\Exceptions\APIRequestException $e) { // 回复异常 // 
//                            $this->ajaxReturn(['status'=>66,"msg"=>$e]);
//                            }
                            $order->commit();
                        $this->ajaxReturn(['status'=>1,"msg"=>""]);
//            }
        }
    }
    
    /**
     * 返回签名
     */
    public function sign(){
        $post = I('post.');
//            $nonce = "fake-valid-nonce";
            $messages = $post['messages'];
            $nonce = $post['nonce'];
            $shopid = $post['shopid'];
            $goodsid = $post['goods'];
            $allprices = $post['allprices'];
            $cometime = $post['cometime'];
            $name = $post['name'];
            $sex = $post['sex'];
            $phone = $post['phone'];
            $address = $post['address'];
            $beizhu = $post['beizhu'];
            $money = $post['money'];
            $userid = $post['userid'];
            $juli = $post['juli'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            $shopmesag = M('shopmessage')->where(['shopid'=>$shopid])->field('state,long')->find();
            if($shopmesag['state'] == 2){
                $this->ajaxReturn(['status'=>4,"msg"=>"商铺未营业。"]);
            }
            if($juli > $shopmesag['long']){
                $this->ajaxReturn(['status'=>5,"msg"=>"超出最大配送范围。"]);
            }
            $allprice = 0;
            foreach ($goodsid as $val){
                $price = M('shopgoods')->field('goodsprice')->where(['goodsid'=>$val[0]])->find();
                $allprice += $price['goodsprice'] * $val[1];
            }
            $goodsresult = "";
            foreach ($goodsid as $v){
                $goodsinfo = M('shopgoods')->where(['goodsid'=>$v[0]])->field('goodsid,goodsname,goodsprice,goodsphoto')->find();
                if($goodsinfo['goodsphoto'] == null){
                    $goodsinfo['goodsphoto'] = "";
                }else{
                    $goodsinfo['goodsphoto'] = $this->path.$goodsinfo['goodsphoto'];
                }
                $aaa = implode(',', $goodsinfo);
                $aaa = $aaa.",".$v[1];
                $goodsresult .=$aaa."|"; 
            }
            
            $allmoney = $allprice + $money;
            $allprices = $allprices + 0;
            if (bccomp($allmoney,$allprices,2) != 0){
                $this->ajaxReturn(['status'=>0,'msg'=>'商品价格有变动，请重新下单123']);
            }
            //开启事物
            $order = M('orders');
            $order->startTrans();
//            $mobile = M('user')->field('mobile')->where(['uid'=>2])->find();
            $orderid = $post['phone'].time();
            $lingchen =  strtotime(date('Y-m-d',time()));
            $lingchen = date("Y-m-d H:i:s",$lingchen);
            $now = time();
            $now = date("Y-m-d H:i:s",time());
            $maps['addtime']  = array('between',array($lingchen,$now));
            $ordernums =M('orders')->where($maps)->where(['shopid'=>$shopid])->count();
            $ordernums = $ordernums + 1;
            $lifetime = time() + 900;
            $lifetime = date("Y-m-d H:i:s",$lifetime);
            $data = array(
                'orderid'=>$orderid,
                'uid' => $userid,
                'shopid' => $shopid,
                'money'=>$money,
                'cometime'=>$cometime,
                'name'=>$name,
                'sex'=>$sex,
                'phone'=>$phone,
                'address'=>$address,
                'beizhu'=>$beizhu,
                'allprice'=>$allmoney,
                'juli'=>$juli,
                'pay' => 2,
                'goodsinfo' => $goodsresult,
                'state' => 1,
                'todaynums' => $ordernums,
                'lifetime' => $lifetime,
                'addtime'=>date('Y-m-d H:i:s', time()),
            );
            $addorder = $order->add($data);
            if(!$addorder){
                //失败回滚
                $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'订单添加失败']);
            }
            
            if(!empty($goodsid)){
                foreach($goodsid as $vv){
                $datas = array(
                    'orderid' => $orderid,
                    'goodsid' => $vv[0],
                    'num' => $vv[1],
                    'addtime' => date('Y-m-d H:i:s', time()),
                );
                $ordergoods = M('ordergoods')->add($datas);
                if(!$ordergoods){
                    //失败回滚
                    $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'订单商品信息添加失败']);
                }
            }
            }else{
                 $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'商品信息不能为空']);
            }
            
            
            $dasta = array(
                "orderid"=>$orderid,
                "shopid" => $shopid,
                "money" => $allmoney,
                "addtime" => date("Y-m-d H:i:s",time()),
            );
            $mingxi = M('mingxi')->add($dasta);
            if(!$mingxi){
                 //失败回滚
                    $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'收入明细添加失败']);
            }else{
                $order->commit();
                Vendor('paybao.signatures_url');
            }
           
        
    }
    /**
     * 回调地址
     */
    public function backurl(){
        Vendor('paybao.notify_url');
    }
    /*
    * 货到付款
    * 2017.6.23
    */
    public function haddorder(){
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $goodsid = $post['goods'];
            $allprices = $post['allprices'];
            $cometime = $post['cometime'];
            $name = $post['name'];
            $sex = $post['sex'];
            $phone = $post['phone'];
            $address = $post['address'];
            $beizhu = $post['beizhu'];
            $money = $post['money'];
            $userid = $post['userid'];
            $juli = $post['juli'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
            $shopmesag = M('shopmessage')->where(['shopid'=>$shopid])->field('long,state')->find();
            if($shopmesag['state'] == 2){
                $this->ajaxReturn(['status'=>4,"msg"=>"商铺未营业。"]);
            }
            if($juli > $shopmesag['long']){
                $this->ajaxReturn(['status'=>5,"msg"=>"超出最大配送范围。"]);
            }
            
            $allprice = 0;
            foreach ($goodsid as $val){
                $price = M('shopgoods')->field('goodsprice')->where(['goodsid'=>$val[0]])->find();
                $allprice += $price['goodsprice'] * $val[1];
            }
            $goodsresult = "";
            foreach ($goodsid as $v){
                $goodsinfo = M('shopgoods')->where(['goodsid'=>$v[0]])->field('goodsid,goodsname,goodsprice,goodsphoto')->find();
                if($goodsinfo['goodsphoto'] == null){
                    $goodsinfo['goodsphoto'] = "";
                }else{
                    $goodsinfo['goodsphoto'] = $this->path.$goodsinfo['goodsphoto'];
                }
                $aaa = implode(',', $goodsinfo);
                $aaa = $aaa.",".$v[1];
                $goodsresult .=$aaa."|"; 
            }
            $allmoney = $allprice + $money;
            $allprices = $allprices + 0;
            //$allmoney = (float)$allmoney;
            //$allprices = (float)$allprices;
            //$this->ajaxReturn(['status'=>0,'msg'=>[$allmoney,$allprices]]);
//            if ($allmoney != $allprices){
//                $this->ajaxReturn(['status'=>0,'msg'=>'商品价格有变动，请重新下单123']);
//            }
            if (bccomp($allmoney,$allprices,2) != 0){
                $this->ajaxReturn(['status'=>0,'msg'=>'商品价格有变动，请重新下单123']);
            }
            //开启事物
            $order = M('orders');
            $order->startTrans();
            $mobile = M('user')->field('mobile')->where(['uid'=>1])->find();
            $orderid = $mobile['mobile'].time();
            $lingchen =  strtotime(date('Y-m-d',time()));
            $lingchen = date("Y-m-d H:i:s",$lingchen);
            $now = time();
            $now = date("Y-m-d H:i:s",time());
            $maps['addtime']  = array('between',array($lingchen,$now));
            $ordernums = M('orders')->where($maps)->where(['shopid'=>$shopid])->count();
            $ordernums = $ordernums + 1;
            $lifetime = time() + 900;
            $lifetime = date("Y-m-d H:i:s",$lifetime);
            $data = array(
                'orderid'=>$orderid,
                'uid' => $userid,
                'shopid' => $shopid,
                'money'=>$money,
                'cometime'=>$cometime,
                'name'=>$name,
                'sex'=>$sex,
                'phone'=>$phone,
                'address'=>$address,
                'beizhu'=>$beizhu,
                'allprice'=>$allmoney,
                'juli'=>$juli,
                'pay' => 4,
                'state' => 1,
                'goodsinfo' => $goodsresult,
                'todaynums'=>$ordernums,
                 'lifetime' => $lifetime,
                'addtime'=>date('Y-m-d H:i:s', time()),
            );
            $addorder = $order->add($data);
            if(!$addorder){
                //失败回滚
                $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'订单添加失败']);
            }
            
            if(!empty($goodsid)){
                foreach($goodsid as $vv){
                $datas = array(
                    'orderid' => $orderid,
                    'goodsid' => $vv[0],
                    'num' => $vv[1],
                    'addtime' => date('Y-m-d H:i:s', time()),
                );
                $ordergoods = M('ordergoods')->add($datas);
                if(!$ordergoods){
                    //失败回滚
                    $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'订单商品信息添加失败']);
                }
            }
            }else{
                 $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'商品信息不能为空']);
            }
            
            
            $dasta = array(
                "orderid"=>$orderid,
                "shopid" => $shopid,
                "money" => $allmoney,
                "addtime" => date("Y-m-d H:i:s",time()),
            );
            $mingxi = M('mingxi')->add($dasta);
            if(!$mingxi){
                 //失败回滚
                    $order->rollback();
                $this->ajaxReturn(['status'=>0,'msg'=>'收入明细添加失败']);
            }else{
                 
//                Vendor('pushi.autoload');
//                $client = new \JPush\Client("9873490601703901a2e33f7a", "ff7897730ebb54c4fc313c30");
//                        $push_payload = $client->push() // 调用push方法（返回一个PushPayload实例） 
//                        ->setPlatform('all') // 设置平台 
//                        ->addAlias($shopid) 
//                        ->setNotificationAlert('您有一条新订单，请及时处理！') // 设置推送通知内容 
//                        ->addAndroidNotification('您有一条新订单，请及时处理！',  '您有一条新订单，请及时处理！',1,array("orderid" => $orderid,"money"=>$money,"allprice"=>$allprices."","cometime"=>$cometime,"uid"=>$userid,"sex"=>$sex,"name"=>$name,"phone"=>$phone,"address"=>$address,"beizhu"=>$beizhu,"state"=>"1","todaynums"=>$ordernums."","addtime"=>date('Y-m-d H:i:s', time()),"goodsinfo"=>$goodsresult))
//                        ->addIosNotification('您有一条新订单，请及时处理！', 'default', '+1', true, 'iOS category', array("orderid" => $orderid,"money"=>$money,"allprice"=>$allprices."","cometime"=>$cometime,"uid"=>$userid,"sex"=>$sex,"name"=>$name,"phone"=>$phone,"address"=>$address,"beizhu"=>$beizhu,"state"=>"1","todaynums"=>$ordernums."","addtime"=>date('Y-m-d H:i:s', time()),"goodsinfo"=>$goodsresult))
//                        ->options(array(
//                            "apns_production" => true  //true表示发送到生产环境(默认值)，false为开发环境
//                        ));
//                        try { 
//                            $response = $push_payload->send(); // 执行推送 
//                        }catch (\JPush\Exceptions\APIConnectionException $e) { // 请求异常 // 
//                           $this->ajaxReturn(['status'=>0,"msg"=>$e]);
//                            } 
//                            catch (\JPush\Exceptions\APIRequestException $e) { // 回复异常 // 
//                            $this->ajaxReturn(['status'=>0,"msg"=>$e]);
//                            
//                            }
                            $order->commit();
                        $this->ajaxReturn(['status'=>1,"msg"=>""]);
            }
           
              
            
            
        }
    }
    /*
    * 订单列表
    * 2017.6.23
    */
    public function orderlist(){
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $page = $post['page'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
//            $nowss = date("Y-m-d H:i:s",time());
//            $orderedit =M('orders')->where(['state'=>1])->select();
//            foreach($orderedit as $vaa){
//                if($vaa['lifetime'] < $nowss){
//                    if($vaa['statu'] == 2){
//                        $afda = array(
//                        'statu'=>1,
//                    );
//                    $resultor = M("orders")->where(['orderid'=>$vaa['orderid']])->save($afda);
//                    $mingxi = M('mingxi')->where(['orderid'=>$vaa['orderid']])->find();
//                    if($mingxi['flag'] == 1){
//                        $abdd = array(
//                        'flag'=>2,
//                    );
//                    $res = M("mingxi")->where(['orderid'=>$vaa['orderid']])->save($abdd);
//                    }
//                    
//                    }
//                    
//                }
//            }
            $info = M('orders') ->where(['uid'=>$userid])->page($page.",10")->order('addtime desc') -> select();
            $shopmessage = array();
            foreach($info as $key => $val){
                $shopm = M("shopmessage")->where(['shopid'=>$val['shopid']])->find();
                $shopm['shophead'] = $this->path.$shopm['shophead'];
                $shopm['shopphoto'] = $this->path.$shopm['shopphoto'];
                $ara = array_merge($shopm,$val);
                $shopmessage[] = $ara;
                $ordergoods = M('ordergoods') -> where(['orderid'=>$val['orderid']])->select();
                $erwei = array();
                foreach($ordergoods as $k => $v){
                    $goods = M('shopgoods') -> where(['goodsid'=>$v['goodsid']]) -> find();
                    $goods['num'] = $v['num']; 
                    $goods['goodsphoto'] = $this->path.$goods['goodsphoto'];
                    $erwei[]= $goods;
                }
                $shopmessage[$key]['goods']=$erwei;
                
            }
            if(empty($info)){
                 $this->ajaxReturn(['status'=>1,'msg'=>array()]);
            }else{
                $this->ajaxReturn(['status'=>1,'msg'=>$shopmessage]);
            }
            
        }
    }
    /*
    * 未完成订单列表
    * 2017.7.6
    */
    public function worderlist(){
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
//            $nowss = date("Y-m-d H:i:s",time());
//            $orderedit =M('orders')->where(['state'=>1])->select();
//            foreach($orderedit as $vaa){
//                if($vaa['lifetime'] < $nowss){
//                    if($vaa['statu'] == 2){
//                        $afda = array(
//                        'statu'=>1,
//                    );
//                    $resultor = M("orders")->where(['orderid'=>$vaa['orderid']])->save($afda);
//                    $mingxi = M('mingxi')->where(['orderid'=>$vaa['orderid']])->find();
//                    if($mingxi['flag'] == 1){
//                        $abdd = array(
//                        'flag'=>2,
//                    );
//                    $res = M("mingxi")->where(['orderid'=>$vaa['orderid']])->save($abdd);
//                    }
//                    
//                    }
//                    
//                }
//            }
            $info = M('orders') ->where(['uid'=>$userid,'statu'=>2])->where(array("state"=>array("in","1,2,3")))->order('addtime desc') -> select();
            $shopmessage = array();
            foreach($info as $key => $val){
                $shopm = M("shopmessage")->where(['shopid'=>$val['shopid']])->find();
                $shopm['shophead'] = $this->path.$shopm['shophead'];
                $shopm['shopphoto'] = $this->path.$shopm['shopphoto'];
                $ara = array_merge($shopm,$val);
                $shopmessage[] = $ara;
                $ordergoods = M('ordergoods') -> where(['orderid'=>$val['orderid']])->select();
                $erwei = array();
                foreach($ordergoods as $k => $v){
                    $goods = M('shopgoods') -> where(['goodsid'=>$v['goodsid']]) -> find();
                    $goods['num'] = $v['num']; 
                    $erwei[]= $goods;
                }
                $shopmessage[$key]['goods']=$erwei;
                
            }
            $this->ajaxReturn(['status'=>1,'msg'=>$shopmessage]);
        }
    }
   /**
    * 订单详情
    * 2017.6.23
    */
   public function orderdetails(){
       if (IS_POST) {
            $post = I('post.');
            $orderid = $post['orderid'];
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this -> ajaxReturn(['status' => 9,'msg' => []]);
            }
//            $nowss = date("Y-m-d H:i:s",time());
//            $nowss = date("Y-m-d H:i:s",time());
//            $orderedit =M('orders')->where(['state'=>1])->select();
//            foreach($orderedit as $vaa){
//                if($vaa['lifetime'] < $nowss){
//                    if($vaa['statu'] == 2){
//                        $afda = array(
//                        'statu'=>1,
//                    );
//                    $resultor = M("orders")->where(['orderid'=>$vaa['orderid']])->save($afda);
//                    $mingxi = M('mingxi')->where(['orderid'=>$vaa['orderid']])->find();
//                    if($mingxi['flag'] == 1){
//                        $abdd = array(
//                        'flag'=>2,
//                    );
//                    $res = M("mingxi")->where(['orderid'=>$vaa['orderid']])->save($abdd);
//                    }
//                    
//                    }
//                    
//                }
//            }
            $info = M('orders') ->where(['orderid'=>$orderid]) -> find();
            $orderinfo = M('ordergoods') ->where(['orderid'=>$orderid]) -> select();
            $shop = M('shopmessage') ->where(['shopid'=>$info['shopid']]) -> find();
            $array = array();
            $array['shopid'] = $shop['shopid'];
            $array['shopname'] = $shop['shopname'];
            $array['shophead'] = $this->path.$shop['shophead'];
            $array['shopphoto'] = $this->path.$shop['shopphoto'];
            $array['phone'] = $info['phone'];
            $array['goodsinfo'] = $info['goodsinfo'];
            $array['shopphone'] = $shop['mobile'];
            $times = time();
            $array['cometime'] = $info['cometime'];
            
            
            $array['statu'] = $info['statu'];
            $array['money'] = $info['money'];
            $array['juli'] = $info['juli'];
            $array['allprice'] = $info['allprice'];
            $array['orderid'] = $orderid;
            $array['state'] = $info['state'];
            $array['address'] = $info['address'];
            $array['beizhu'] = $info['beizhu'];
            if(($times - strtotime($info['addtime']))>86400){
                $array['addtime'] = date("Y-m-d",  strtotime($info['addtime']));
            }else{
                $array['addtime'] = $info['addtime'];
            }
//            $array['addtime'] = $info['addtime'];
            foreach ($orderinfo as $k => $v){
                $goods = M('shopgoods')->field('goodsname,goodsphoto,goodsprice') ->where(['goodsid'=>$v['goodsid']])->find();
                $goods['goodsid'] = $v['goodsid'];
                $goods['goodsphoto'] = $this->path . $goods['goodsphoto'];
                $goods['num'] = $v['num'];
                $array['goods'][] = $goods;
            }
            $this->ajaxReturn(['status'=>1,'msg'=>$array]);
        }
   }
   public function ss(){
       braintree();
   }
   /**
    * 确认收货
    */
   public function queren() {
        $post = I('post.');
        $orderid = $post['orderid'];
        $userid = $post['userid'];
        $token = $post['token'];
        if ($token != S("token" . $userid)) {
            $this->ajaxReturn(['status' => 9]);
        }
        $data = array(
            'state'=>4,
        );
        $result = M('orders')->where(['orderid'=>$orderid])->save($data);
        if($result){
            $this->ajaxReturn(['status'=>1,"msg"=>""]);
        }else{
             $this->ajaxReturn(['status'=>0,"msg"=>""]);
        }
    }
 
}