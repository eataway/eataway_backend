<?php

namespace Server\Controller;

use Think\Controller;
use Think\Upload;
date_default_timezone_set('Australia/South');
class ShopController extends Controller {

    public $path = "http://wm.sawfree.com/";

    /**
     * 菜单列表
     * @2017.6.27
     */
//    public function categorylist() {
//        if (IS_POST) {
//            $post = I('post.');
//            $shopid = $post['shopid'];
//            $token = $post['token'];
//            if ($token != S("token" . $shopid)) {
//                $this->ajaxReturn(['status' => 9, 'msg' => []]);
//            }
//            $info = M('category')->where(array("shopid" => $shopid))->field("cid,cname")->select();
//            foreach ($info as $k => $v) {
//                $result = M('shopgoods')->where(['shopid' => $shopid, 'cid' => $v['cid']])->select();
//                $info[$k]['num'] = count($result);
//            }
//            if ($info) {
//                $this->ajaxReturn(['status' => 1, 'msg' => $info]);
//            } else {
//                $this->ajaxReturn(['status' => 1, 'msg' => array()]);
//            }
//        }
//    }
      /**
     * 菜单列表
     * @2017.6.27
     */
    public function categorylists() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
//            $token = $post['token'];
//            if ($token != S("token" . $shopid)) {
//                $this->ajaxReturn(['status' => 9, 'msg' => []]);
//            }
            $info = M('category')->where(array("shopid" => $shopid))->field("cid,cname")->select();
            foreach ($info as $k => $v) {
                $result = M('shopgoods')->where(['shopid' => $shopid, 'cid' => $v['cid']])->select();
                $info[$k]['num'] = count($result);
            }
            if ($info) {
                $this->ajaxReturn(['status' => 1, 'msg' => $info]);
            } else {
                $this->ajaxReturn(['status' => 1, 'msg' => array()]);
            }
        }
    }
     /**
     * 商户菜单分类
     */
    public function categorylist() {
        if (IS_POST) {
             $post = I('post.');
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
        $result = M("shopmessage")->where(['shopid' => $post['shopid']])->find();
//        $category = M('category')->where(['shopid' => $get['shopid']])->select();
        $first = M('category')->where(['shopid' => $post['shopid'], 'up' => -1])->find();
        $category = $this->diguicategory($first['end']);
        array_unshift($category, $first);
        if($category){
            foreach ($category as $k => $v){
            $goods = M('shopgoods')->where(['cid'=>$v['cid'],'shopid'=>$post['shopid']])->select();
            $category[$k]['num'] = count($goods);
        }
        $this->ajaxReturn(['status'=>1,"msg"=>$category]);
        }else{
            $this->ajaxReturn(['status'=>1,"msg"=>array()]);
        }
        }
    }

    /**
     * 添加菜单
     * @2017.6.22
     */
    public function addcategory() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $cname = $post['cname'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $first = M('category')->where(['shopid' => $shopid, 'up' => -1])->find();
        $categorys = $this->diguicategory($first['end']);
        array_unshift($categorys, $first);
        $result = end($categorys);
            if(empty($result)){
                $data = array(
                "cname" => $cname,
                "up"=>-1,
                "end"=>0,
                "shopid" => $shopid,
                "addtime" => date("Y-m-d H:i:s", time()),
            );
                $info = M('category')->add($data);
                if ($info) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => '']);
            }
            }else{
                    $data = array(
                    "cname" => $cname,
                    "up"=>$result['cid'],
                    "end"=>0,
                    "shopid" => $shopid,
                    "addtime" => date("Y-m-d H:i:s", time()),
                );
                    M('category')->startTrans();
                    $info = M('category')->add($data);
                    if($info){
                        $editup = M('category')->where(['cid'=>$result['cid']])->save(['end'=>$info]);
                        if($editup){
                            M("category")->commit();
                            $this->ajaxReturn(['status'=>1]);
                        }else{
                            M("category")->rollback();
                            $this->ajaxReturn(['status'=>0]);
                        }
                    }else{
                        M("category")->rollback();
                        $this->ajaxReturn(['status'=>0,"msg"=>"添加信息失败"]);
                    }
            }
        }
    }
 /**
     * 递归查询菜单
     */
    public function diguicategory($firstss, &$arrs = array()) {
        $result = M('category')->where(['cid' => $firstss])->find();
        if ($result) {
            $arrs[] = $result;
            $this->diguicategory($result['end'], $arrs);
        }
        return $arrs;
    }
    /**
     * 修改商铺菜单
     * @2017.6.27
     */
    public function editcategory() {
        if (IS_POST) {
            $post = I('post.');
            $cid = $post['cid'];
            $shopid = $post['shopid'];
            $cname = $post['cname'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                "cname" => $cname,
            );
            $info = M('category')->where(array('cid' => $cid))->field("cname")->save($data);
            if ($info) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => '']);
            }
        }
    }

    /**
     * 批量删除菜单
     * @2017.6.27
     */
    public function deletecategory() {
        if (IS_POST) {
            $post = I('post.');
            $cid = $post['cid'];
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $goodinfo = M('shopgoods')->where(array("cid" => $cid))->select();
            if (!empty($goodinfo)) {
                $this->ajaxReturn(['status' => 2, 'msg' => ""]);
            }
            $self = M('category')->where(['cid'=>$cid])->find();
            if($self['up'] == "-1"){
                if($self['end'] !== "0"){
                    M('category')->startTrans();
                    $editnextend = M('category')->where(['cid'=>$self['end']])->save(['up'=>-1]);
                    if($editnextend){
                        $info = M("category")->delete($cid);
                        if($info){
                            M('category')->commit();
                            $this->ajaxReturn(['status'=>1,"msg"=>"成功"]);
                        }else{
                            M('category')->rollback();
                        $this->ajaxReturn(['status'=>0,"msg"=>"删除失败"]);
                        }
                    }else{
                        M('category')->rollback();
                        $this->ajaxReturn(['status'=>0,"msg"=>"修改上下级关系失败"]);
                    }
                }else{
                    $info = M('category')->delete($cid);
                    if($info){
                        $this->ajaxReturn(['status'=>1,"msg"=>"成功"]);
                    }else{
                        $this->ajaxReturn(['status'=>0,"msg"=>"删除失败"]);
                    }
                }
            }else{
                if($self['end'] !== "0"){
                    M('category')->startTrans();
                    $editup = M('category')->where(['cid'=>$self['up']])->save(['end'=>$self['end']]);
                    if($editup){
                        $editend = M('category')->where(['cid'=>$self['end']])->save(['up'=>$self['up']]);
                        if($editend){
                            $info = M('category')->delete($cid);
                            if($info){
                                M("category")->commit();
                                $this->ajaxReturn(['status'=>1,"msg"=>"成功"]);
                            }else{
                                M("category")->rollback();
                                $this->ajaxReturn(['status'=>0,"msg"=>"删除失败"]);
                            }
                        }else{
                            M("category")->rollback();
                        $this->ajaxReturn(['status'=>0,"msg"=>"修改下条信息的上标记失败。"]);
                        }
                    }else{
                        M("category")->rollback();
                        $this->ajaxReturn(['status'=>0,"msg"=>"修改上条信息的下标记失败。"]);
                    }
                }else{
                    M('category')->startTrans();
                    $editups = M('category')->where(['cid'=>$self['up']])->save(['end'=>0]);
                    if($editups){
                        $info = M('category')->delete($cid);
                        if($info){
                            M("category")->commit();
                            $this->ajaxReturn(['status'=>1,"msg"=>"成功"]);
                        }else{
                            M("category")->rollback();
                        $this->ajaxReturn(['status'=>0,"msg"=>"删除失败。"]);
                        }
                    }else{
                        M("category")->rollback();
                        $this->ajaxReturn(['status'=>0,"msg"=>"修改上条信息的下标记失败。"]);
                    }
                }
            }
        }
    }

    /*
     * 添加分类商品信息
     * 2017.6.27
     */
    public function addgoods() {
        if (IS_POST) {
            $post = I('post.');
            $cid = $post['cid'];
            $shopid = $post['shopid'];
            $goodsname = $post['goodsname'];
            $goodscontent = $post['goodscontent'];
            $goodsprice = $post['goodsprice'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //图片信息接收上传
            if ($_FILES) {
                foreach ($_FILES as $k => $fileInfo) {
                    $files[$k] = $this->uploadFile($fileInfo);
                }
            }else{
                $sop = M('shopmessage')->where(['shopid'=>$shopid])->find();
                if($sop['shopphoto'] !==null){
                    $files = array();
                    $files['myFile'] = $sop['shophead'];
                }
            }
            $data = array(
                "cid" => $cid,
                "shopid" => $shopid,
                "goodsname" => $goodsname,
                "goodsprice" => $goodsprice,
                "goodscontent" => $goodscontent,
                "goodsphoto" => $files['myFile'],
                "addtime" => date("Y-m-d H:i:s", time()),
            );
            $info = M('shopgoods')->add($data);
            if ($info) {
                $this->ajaxReturn(['status' => 1, "msg" => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, "msg" => ""]);
            }
        }
    }

    /*
     * 删除菜品
     * 2017.6.27
     */

    public function deletegoods() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $goodsid = $post['goodsid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //原图封装进变量，删除成功后删图
            $goods = M('shopgoods')->where(array("goodsid" => array("in", $goodsid)))->select();
            $delete = M('shopgoods')->delete($goodsid);
            if ($delete) {
                //删除商品图
                foreach ($goods as $val) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . "/" . $val['goodsphoto']);
                }
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => '']);
            }
        }
    }

    /**
     * 商户菜单类别内商品
     * @2017.6.27
     */
    public function menugoods() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $cid = $post['cid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $info = M('shopgoods')->where(array("shopid" => $shopid, 'cid' => $cid))->select();
            foreach ($info as $k => $va) {
                if ($va['goodsphoto'] == null) {
                    $info[$k]['goodsphoto'] = "";
                } else {
                    $info[$k]['goodsphoto'] = $this->path . $va['goodsphoto'];
                }
            }
            if ($info) {
                $this->ajaxReturn(['status' => 1, 'msg' => $info]);
            } else {
                $this->ajaxReturn(['status' => 1, 'msg' => array()]);
            }
        }
    }

    /*
     * 菜品详情
     * @2017.6.27
     */

    public function menudetail() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $goodsid = $post['goodsid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //有关当前商品订单
            $goodsinfo = M('ordergoods')->where(["goodsid" => $goodsid])->select();
            //当前商品信息
            $goodsresult = M('shopgoods')->where(['goodsid' => $goodsid])->field("goodsname,goodsphoto,cid,goodsprice,flag,goodscontent")->find();
            //当前商品类别
            $reujs = M('category')->where(['cid' => $goodsresult['cid']])->find();
            $num = 0;
            foreach ($goodsinfo as $val) {
                $num += $val['num'];
            }
            $goodsresult['num'] = $num;
            $goodsresult['fenlei'] = $reujs['cname'];
            if ($goodsresult['goodsphoto'] == null) {
                $goodsresult['goodsphoto'] = "";
            } else {
                $goodsresult['goodsphoto'] = $this->path . $goodsresult['goodsphoto'];
            }
            if ($goodsresult) {
                $this->ajaxReturn(['status' => 1, 'msg' => $goodsresult]);
            } else {
                $this->ajaxReturn(['status' => 1, 'msg' => array()]);
            }
        }
    }

    /**
     * 商铺分类列表
     * @2017.6.27
     */
    public function fenleilist() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $info = M('category')->where(array("shopid" => $shopid))->field("cid,cname")->select();

            if ($info) {
                $this->ajaxReturn(['status' => 1, 'msg' => $info]);
            } else {
                $this->ajaxReturn(['status' => 1, 'msg' => array()]);
            }
        }
    }

    /**
     * 商铺修改商品
     * @2017.6.27
     */
    public function editgoods() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $goodsid = $post['goodsid'];
            $goodsname = $post['goodsname'];
            $cid = $post['cid'];
            $goodsprice = $post['goodsprice'];
            $goodscontent = $post['goodscontent'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //旧图片封装到变量
            $picture = M('shopgoods')->where(['goodsid' => $goodsid])->find();
            //图片信息接收上传
            if ($_FILES) {
                foreach ($_FILES as $k => $fileInfo) {
                    $files[$k] = $this->uploadFile($fileInfo);
                }
            }
            if (!empty($files)) {
                $data = array(
                    "goodsname" => $goodsname,
                    "goodsprice" => $goodsprice,
                    "cid" => $cid,
                    "goodscontent" => $goodscontent,
                    "goodsphoto" => $files['myFile'],
                );
                $info = M('shopgoods')->where(array("goodsid" => $goodsid))->save($data);
                if ($info) {
                    //删除旧图片
                    unlink($_SERVER['DOCUMENT_ROOT'] . "/" . $picture['goodsphoto']);
                    $this->ajaxReturn(['status' => 1, 'msg' => ""]);
                } else {
                    $this->ajaxReturn(['status' => 0, 'msg' => '']);
                }
            } else {
                $data = array(
                    "goodsname" => $goodsname,
                    "goodsprice" => $goodsprice,
                    "cid" => $cid,
                    "goodscontent" => $goodscontent,
                    "goodsphoto" => $picture['goodsphoto'],
                );
                $info = M("shopgoods")->where(['goodsid'=>$goodsid])->save($data);
                if ($info == true){
                    $this->ajaxReturn(['status' => 1, 'msg' => ""]);
                }else if($info == 0) {
                    $this->ajaxReturn(['status' => 1, 'msg' => '']);
                }else if($info == false){
                    $this->ajaxReturn(['status' => 0, 'msg' => ""]);
                }
            }
        }
    }

    /**
     * 修改商铺地址
     */
    public function editaddress() {
        if (IS_POST) {
            $post = I("post.");
            $shopid = $post['shopid'];
            $detailed_address = $post['detailed_address'];
            $coordinate = $post['coordinate'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'detailed_address' => $detailed_address,
                'coordinate' => $coordinate,
            );
            $result = M("shopmessage")->where(['shopid' => $shopid])->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /**
     * 修改手机号
     */
    public function editmobile() {
        if (IS_POST) {
            $post = I("post.");
            $shopid = $post['shopid'];
            $mobile = $post['mobile'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'mobile' => $mobile,
            );
            $result = M("shopmessage")->where(['shopid' => $shopid])->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /**
     * 修改商品出售状态
     */
    public function editflaga() {
        if (IS_POST) {
            $post = I("post.");
            $shopid = $post['shopid'];
            $goodsid = $post['goodsid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $today = date("Y-m-d", time());
            $today = strtotime($today);
            $today = date("Y-m-d H:i:s", $today);
            $now = date("Y-m-d H:i:s", time());
            $map['addtime'] = array('between', array($today, $now));
            $orderinfo = M('orders')->where($map)->where(['shopid' => $shopid])->where(array("state" => array("in", "3,4,5")))->select();
            $b = 0;
            foreach ($orderinfo as $k => $v) {
                $ordergoods = M("ordergoods")->where(['orderid' => $v['orderid']])->select();
                $a = 0;
                foreach ($ordergoods as $val) {
                    if ($val['goodsid'] == $goodsid) {
                        $a += $val['num'];
                    }
                }
                $b += $a;
            }
            $data = array(
                'flag' => 1,
            );
            $result = M("shopgoods")->where(['goodsid' => $goodsid])->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ['num' => $b]]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /**
     * 修改商品出售状态
     */
    public function editflagb() {
        if (IS_POST) {
            $post = I("post.");
            $shopid = $post['shopid'];
            $goodsid = $post['goodsid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'flag' => 2,
            );
            $today = date("Y-m-d", time());
            $today = strtotime($today);
            $today = date("Y-m-d H:i:s", $today);
            $now = date("Y-m-d H:i:s", time());
            $map['addtime'] = array('between', array($today, $now));
            $orderinfo = M('orders')->where($map)->where(['shopid' => $shopid])->where(array("state" => array("in", "3,4,5")))->select();
            $b = 0;
            foreach ($orderinfo as $k => $v) {
                $ordergoods = M("ordergoods")->where(['orderid' => $v['orderid']])->select();
                $a = 0;
                foreach ($ordergoods as $val) {
                    if ($val['goodsid'] == $goodsid) {
                        $a += $val['num'];
                    }
                }
                $b += $a;
            }
            $result = M("shopgoods")->where(['goodsid' => $goodsid])->save($data);

            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ['num' => $b]]);
            } else {
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
        }
    }

    /**
     * 恢复免费配送金额
     */
    public function backprice() {
        if (IS_POST) {
            $post = I("post.");
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'maxprice' => "-1",
            );
            $result = M("shopmessage")->where(['shopid' => $shopid])->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /**
     * 恢复免费配送距离
     */
    public function backlong() {
        if (IS_POST) {
            $post = I("post.");
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'maxlong' => "-1",
                'maxmoney'=>"0",
            );
            $result = M("shopmessage")->where(['shopid' => $shopid])->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }
    /**
     * 修改最低起送金额
     */
    public function editlmoney(){
        if(IS_POST){
            $post = I("post.");
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $data = array(
                'lmoney'=>$post['lmoney'],
            );
            $result = M('shopmessage')->where(['shopid'=>$shopid])->save($data);
            if($result){
                $this->ajaxReturn(['status'=>1,"msg"=>"成功。"]);
            }else if($result == 0){
                $this->ajaxReturn(['status'=>1,"msg"=>"修改数据无变化。"]);
            }else if($result == false){
                $this->ajaxReturn(['status'=>0,"msg"=>"修改失败。"]);
            }
        }
    }
        /**
     * 菜单拖动程序定位
     */
    public function movecategory() {
        if(IS_POST){
        $post = I("post.");
        $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
        //移动的本身详情信息
        $self = M('category')->where(['cid' => $post['self']])->find();
        //移动前上条信息存不存在
        if ($self['up'] !== "-1") {
            M('category')->startTrans();
            //移动前下条存不存在
            if ($self['end'] !== "0") {
                //修改移动前下条信息的上标记，修改为移动前上条信息的id
                $editbeforupend = M('category')->where(['cid' => $self['end']])->save(['up' => $self['up']]);
                if ($editbeforupend) {
                    //修改移动前上条信息的下标记，修改为移动前下条信息的id
                    $editbeforupup = M('category')->where(['cid' => $self['up']])->save(['end' => $self['end']]);
                    if ($editbeforupup) {
                        if ($post['up'] !== "-1") {
                            //修改自身移动后的上标记为移动后的上条信息id
                            $editselfup = M('category')->where(['cid' => $self['cid']])->save(['up' => $post['up']]);
                            if ($editselfup) {
                                if ($post['end'] !== "0") {
                                    //修改自身移动后的下标记为移动后的下条信息id
                                    $editselfend = M('category')->where(['cid' => $self['cid']])->save(['end' => $post['end']]);
                                    if ($editselfend) {
                                        //修改移动后下条信息的上标记为自身id
                                        $editafternext = M('category')->where(['cid' => $post['end']])->save(['up' => $post['self']]);
                                        if ($editafternext) {
                                            //修改移动后上条信息的下标记为自身id
                                            $editafterups = M('category')->where(['cid' => $post['up']])->save(['end' => $post['self']]);
                                            if ($editafterups) {
                                                M("category")->commit();
                                                $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                                            } else {
                                                M("category")->rollback();
                                                $this->ajaxReturn(['status' => 0, "msg" => "修改移动后上条信息的下标记为自身id失败1"]);
                                            }
                                        } else {
                                            M("category")->rollback();
                                            $this->ajaxReturn(['status' => 0, "msg" => "修改移动后下条信息的上标记为自身id失败2"]);
                                        }
                                    }else {
                                        M("category")->rollback();
                                        $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的下标记为移动后的下条信息id失败3"]);
                                    }
                                } else {
                                     //修改自身移动后的下标记为0
                                    $editselfend = M('category')->where(['cid' => $self['cid']])->save(['end' =>0]);
                                    if ($editselfend) {
                                            //修改移动后上条信息的下标记为自身id
                                            $editafterups = M('category')->where(['cid' => $post['up']])->save(['end' => $post['self']]);
                                            if ($editafterups) {
                                                M("category")->commit();
                                                $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                                            } else {
                                                M("category")->rollback();
                                                $this->ajaxReturn(['status' => 0, "msg" => "修改移动后上条信息的下标记为自身id失败4"]);
                                            }
                                    }else {
                                        M("category")->rollback();
                                        $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的下标记为移动后的下条信息id失败5"]);
                                    }
                                    
                                }
                            } else {
                                M("category")->rollback();
                                $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的上标记为移动后的上条信息id失败6"]);
                            }
                        } else {
                            //修改自身移动后的上标记为-1
                            $editselfup = M('category')->where(['cid' => $self['cid']])->save(['up' =>-1]);
                            if ($editselfup) {
                                if ($post['end'] !== 0) {
                                    //修改自身移动后的下标记为移动后的下条信息id
                                    $editselfend = M('category')->where(['cid' => $self['cid']])->save(['end' => $post['end']]);
                                    if ($editselfend) {
                                        //修改移动后下条信息的上标记为自身id
                                        $editafternext = M('category')->where(['cid' => $post['end']])->save(['up' => $post['self']]);
                                        if ($editafternext) {
                                                M("category")->commit();
                                                $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                                        } else {
                                            M("category")->rollback();
                                            $this->ajaxReturn(['status' => 0, "msg" => "修改移动后下条信息的上标记为自身id失败7"]);
                                        }
                                    }else {
                                        M("category")->rollback();
                                        $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的下标记为移动后的下条信息id失败8"]);
                                    }
                                }
                            } else {
                                M("category")->rollback();
                                $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的上标记为移动后的上条信息id失败9"]);
                            }
                        }
                    } else {
                        M("category")->rollback();
                        $this->ajaxReturn(['status' => 0, "msg" => "修改移动前上条信息的下标记，修改为移动前下条信息的id失败0"]);
                    }
                } else {
                    M("category")->rollback();
                    $this->ajaxReturn(['status' => 0, "msg" => "修改移动前下条信息的上标记，修改为移动前上条信息的id失败11"]);
                }
            } else {
                    //修改移动前上条信息的下标记，修改为0
                    $editbeforupup = M('category')->where(['cid' => $self['up']])->save(['end' =>0]);
                    if ($editbeforupup) {
                        if ($post['up'] !== "-1") {
                            //修改自身移动后的上标记为移动后的上条信息id
                            $editselfup = M('category')->where(['cid' => $self['cid']])->save(['up' => $post['up']]);
                            if ($editselfup) {
                                if ($post['end'] !== "0") {
                                    //修改自身移动后的下标记为移动后的下条信息id
                                    $editselfend = M('category')->where(['cid' => $self['cid']])->save(['end' => $post['end']]);
                                    if ($editselfend) {
                                        //修改移动后下条信息的上标记为自身id
                                        $editafternext = M('category')->where(['cid' => $post['end']])->save(['up' => $post['self']]);
                                        if ($editafternext) {
                                            //修改移动后上条信息的下标记为自身id
                                            $editafterups = M('category')->where(['cid' => $post['up']])->save(['end' => $post['self']]);
                                            if ($editafterups) {
                                                M("category")->commit();
                                                $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                                            } else {
                                                M("category")->rollback();
                                                $this->ajaxReturn(['status' => 0, "msg" => "修改移动后上条信息的下标记为自身id失败22"]);
                                            }
                                        } else {
                                            M("category")->rollback();
                                            $this->ajaxReturn(['status' => 0, "msg" => "修改移动后下条信息的上标记为自身id失败"]);
                                        }
                                    }else {
                                        M("category")->rollback();
                                        $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的下标记为移动后的下条信息id失败33"]);
                                    }
                                }
                            } else {
                                M("category")->rollback();
                                $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的上标记为移动后的上条信息id失败44"]);
                            }
                        } else {
                            //修改自身移动后的上标记为-1
                            $editselfup = M('category')->where(['cid' => $self['cid']])->save(['up' =>-1]);
                            if ($editselfup) {
                                if ($post['end'] !== "0") {
                                    //修改自身移动后的下标记为移动后的下条信息id
                                    $editselfend = M('category')->where(['cid' => $self['cid']])->save(['end' => $post['end']]);
                                    if ($editselfend) {
                                        //修改移动后下条信息的上标记为自身id
                                        $editafternext = M('category')->where(['cid' => $post['end']])->save(['up' => $post['self']]);
                                        if ($editafternext) {
                                                M("category")->commit();
                                                $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                                        } else {
                                            M("category")->rollback();
                                            $this->ajaxReturn(['status' => 0, "msg" => "修改移动后下条信息的上标记为自身id失败55"]);
                                        }
                                    }else {
                                        M("category")->rollback();
                                        $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的下标记为移动后的下条信息id失败66"]);
                                    }
                                }
                            } else {
                                M("category")->rollback();
                                $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的上标记为移动后的上条信息id失败77"]);
                            }
                        }
                    } else {
                        M("category")->rollback();
                        $this->ajaxReturn(['status' => 0, "msg" => "修改移动前上条信息的下标记，修改为移动前下条信息的id失败88"]);
                    }
            }
        } else {
            M('category')->startTrans();
            //移动前下条存不存在
            if ($self['end'] !== "0") {
                //修改移动前下条信息的上标记-1
                $editbeforupend = M('category')->where(['cid' => $self['end']])->save(['up' =>-1]);
                if ($editbeforupend) {
                        if ($post['up'] !== "-1") {
                            //修改自身移动后的上标记为移动后的上条信息id
                            $editselfup = M('category')->where(['cid' => $self['cid']])->save(['up' => $post['up']]);
                            if ($editselfup) {
                                if ($post['end'] !== "0") {
                                    //修改自身移动后的下标记为移动后的下条信息id
                                    $editselfend = M('category')->where(['cid' => $self['cid']])->save(['end' => $post['end']]);
                                    if ($editselfend) {
                                        //修改移动后下条信息的上标记为自身id
                                        $editafternext = M('category')->where(['cid' => $post['end']])->save(['up' => $post['self']]);
                                        if ($editafternext) {
                                            //修改移动后上条信息的下标记为自身id
                                            $editafterups = M('category')->where(['cid' => $post['up']])->save(['end' => $post['self']]);
                                            if ($editafterups) {
                                                M("category")->commit();
                                                $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                                            } else {
                                                M("category")->rollback();
                                                $this->ajaxReturn(['status' => 0, "msg" => "修改移动后上条信息的下标记为自身id失败99"]);
                                            }
                                        } else {
                                            M("category")->rollback();
                                            $this->ajaxReturn(['status' => 0, "msg" => "修改移动后下条信息的上标记为自身id失败00"]);
                                        }
                                    }else {
                                        M("category")->rollback();
                                        $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的下标记为移动后的下条信息id失败12"]);
                                    }
                                } else {
                                     //修改自身移动后的下标记为0
                                    $editselfend = M('category')->where(['cid' => $self['cid']])->save(['end' =>0]);
                                    if ($editselfend) {
                                            //修改移动后上条信息的下标记为自身id
                                            $editafterups = M('category')->where(['cid' => $post['up']])->save(['end' => $post['self']]);
                                            if ($editafterups) {
                                                M("category")->commit();
                                                $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                                            } else {
                                                M("category")->rollback();
                                                $this->ajaxReturn(['status' => 0, "msg" => "修改移动后上条信息的下标记为自身id失败13"]);
                                            }
                                    }else {
                                        M("category")->rollback();
                                        $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的下标记为移动后的下条信息id失败14"]);
                                    }
                                    
                                }
                            } else {
                                M("category")->rollback();
                                $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的上标记为移动后的上条信息id失败15"]);
                            }
                        }
                    } else {
                        M("category")->rollback();
                        $this->ajaxReturn(['status' => 0, "msg" => "修改移动前上条信息的下标记，修改为移动前下条信息的id失败16"]);
                    }
            }
        }
    }
    }
    /**
     * 七天营业时间查看
     */
    public function lookyingye(){
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $shopid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
         $result = M('shopmessage')->where(['shopid'=>$shopid])->find();
         if($result){
             $this->ajaxReturn(['status'=>1,"msg"=>$result]);
         }else{
             $this->ajaxReturn(['status'=>0,"msg"=>array()]);
         }
        }
    }

}
