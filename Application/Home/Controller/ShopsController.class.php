<?php

namespace Home\Controller;

use Think\Controller;
use Think\Upload;
date_default_timezone_set('Australia/South');
class ShopsController extends Controller {

    public $path = "http://wm.sawfree.com/";
    public $rows = 15;

    /**
     * 商户列表展示（默认列表）
     * @2017.6.22
     */
    public function shoplist() {
        if (IS_POST) {
            $post = I('post.');
            $page = $post['page'];
            $rownum = $post['row'];
            $coor = $post['coor'];
            $num = $post['num']; //0默认排序 1商家推荐 2距离 3销量
            if ($num == "0") {
                //查询所有商户
                $result = M('shopmessage')->where(array("state" => array("in", "1,2")))->page($page, $this->rows)->order('shopid desc')->select();
                foreach ($result as $k => $val) {
                    $shopzuobiao = explode(",", $val['coordinate']);
                    $coordinate = explode(",", $coor);
                    $result[$k]['juli'] = $this->getDistance($coordinate[0], $coordinate[1], $shopzuobiao[0], $shopzuobiao[1]);
                    $result[$k]['shophead'] = $this->path . $val['shophead'];
                    $result[$k]['shopphoto'] = $this->path . $val['shopphoto'];
                    $result[$k]['category'] = M('category')->where(['shopid' => $val['shopid']])->field('cid,cname')->order('num desc')->limit(3)->select();
                }
                $shopinfo = M('shopmessage')->where(array("state" => array("in", "1,2")))->where(['states' => 2])->field("shopid,shopphoto")->limit(4)->select();
                foreach ($shopinfo as $k => $vv) {
                    $shopinfo[$k]['shopphoto'] = $this->path . $vv['shopphoto'];
                }
                $sort = array(
                    'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
                    'field' => 'state', //排序字段  
                );
                $arrSort = array();
                foreach ($result AS $uniqid => $row) {
                    foreach ($row AS $key => $value) {
                        $arrSort[$key][$uniqid] = $value;
                    }
                }
                if ($sort['direction']) {
                    array_multisort($arrSort[$sort['field']], constant($sort['direction']), $result);
                }
                if ($result || $shopinfo) {
                    $data = array(
                        "status" => 1,
                        "msg" => $result,
                        "msg1" =>$shopinfo,
                    );
                    $this->ajaxReturn($data);
                } else {
                    $data = array(
                        "status" => 1,
                        "msg" => array(),
                        "msg1" => array(),
                    );
                    $this->ajaxReturn($data);
                }
            } else if ($num == "1") {
                //查询所有推荐商户
                $result = M('shopmessage')->where(array("state" => array("in", "1,2")))->where(['states' => 2])->page($page, $this->rows)->order('shopid desc')->select();
                foreach ($result as $k => $val) {
                    $shopzuobiao = explode(",", $val['coordinate']);
                    $coordinate = explode(",", $coor);
                    $result[$k]['juli'] = $this->getDistance($coordinate[0], $coordinate[1], $shopzuobiao[0], $shopzuobiao[1]);
                    $result[$k]['shophead'] = $this->path . $val['shophead'];
                    $result[$k]['shopphoto'] = $this->path . $val['shopphoto'];
                    $result[$k]['category'] = M('category')->where(['shopid' => $val['shopid']])->field('cid,cname')->order('num desc')->limit(3)->select();
                }
                $shopinfo = M('shopmessage')->where(array("state" => array("in", "1,2")))->where(['states' => 2])->field("shopid,shopphoto")->limit(4)->select();
                foreach ($shopinfo as $k => $vv) {
                    $shopinfo[$k]['shopphoto'] = $this->path . $vv['shopphoto'];
                }
                $sort = array(
                    'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
                    'field' => 'state', //排序字段  
                );
                $arrSort = array();
                foreach ($result AS $uniqid => $row) {
                    foreach ($row AS $key => $value) {
                        $arrSort[$key][$uniqid] = $value;
                    }
                }
                if ($sort['direction']) {
                    array_multisort($arrSort[$sort['field']], constant($sort['direction']), $result);
                }
                if ($result || $shopinfo) {
                    $data = array(
                        "status" => 1,
                        "msg" => $result,
                        "msg1" =>$shopinfo,
                    );
                    $this->ajaxReturn($data);
                } else {
                    $data = array(
                        "status" => 1,
                        "msg" => array(),
                        "msg1" => array(),
                    );
                    $this->ajaxReturn($data);
                }
            } else if ($num == "2") {
                //查询所有商户
                $result = M('shopmessage')->where(array("state" => array("in", "1,2")))->order('shopid desc')->select();
                foreach ($result as $k => $val) {
                    $shopzuobiao = explode(",", $val['coordinate']);
                    $coordinate = explode(",", $coor);
                    $result[$k]['juli'] = $this->getDistance($coordinate[0], $coordinate[1], $shopzuobiao[0], $shopzuobiao[1]);
                    $result[$k]['shophead'] = $this->path . $val['shophead'];
                    $result[$k]['shopphoto'] = $this->path . $val['shopphoto'];
                    $result[$k]['category'] = M('category')->where(['shopid' => $val['shopid']])->field('cid,cname')->order('num desc')->limit(3)->select();
                }
                
                $sort = array(
                    'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
                    'field' => 'juli', //排序字段  
                );
                $arrSort = array();
                foreach ($result AS $uniqid => $row) {
                    foreach ($row AS $key => $value) {
                        $arrSort[$key][$uniqid] = $value;
                    }
                }
                if ($sort['direction']) {
                    array_multisort($arrSort[$sort['field']], constant($sort['direction']), $result);
                }
                $result = array_slice($result,$rownum,15);
                $shopinfo = M('shopmessage')->where(array("state" => array("in", "1,2")))->where(['states' => 2])->field("shopid,shopphoto")->limit(4)->select();
                foreach ($shopinfo as $k => $vv) {
                    $shopinfo[$k]['shopphoto'] = $this->path . $vv['shopphoto'];
                }
                if ($result || $shopinfo) {
                    $data = array(
                        "status" => 1,
                        "msg" => $result,
                        "msg1" =>$shopinfo,
                    );
                    $this->ajaxReturn($data);
                } else {
                    $data = array(
                        "status" => 1,
                        "msg" => array(),
                        "msg1" => array(),
                    );
                    $this->ajaxReturn($data);
                }
            }else if($num == "3"){
                //查询所有商铺
                $result = M('shopmessage')->where(array("state" => array("in", "1,2")))->order('shopid desc')->select();
                foreach ($result as $k => $val) {
                    $shopzuobiao = explode(",", $val['coordinate']);
                    $coordinate = explode(",", $coor);
                    $result[$k]['juli'] = $this->getDistance($coordinate[0], $coordinate[1], $shopzuobiao[0], $shopzuobiao[1]);
                    $result[$k]['count'] = M("orders")->where(['shopid'=>$val['shopid']])->count();
                    $result[$k]['shophead'] = $this->path . $val['shophead'];
                    $result[$k]['shopphoto'] = $this->path . $val['shopphoto'];
                    $result[$k]['category'] = M('category')->where(['shopid' => $val['shopid']])->field('cid,cname')->order('num desc')->limit(3)->select();
                }
                 $sort = array(
                    'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
                    'field' => 'count', //排序字段  
                );
                $arrSort = array();
                foreach ($result AS $uniqid => $row) {
                    foreach ($row AS $key => $value) {
                        $arrSort[$key][$uniqid] = $value;
                    }
                }
                if ($sort['direction']) {
                    array_multisort($arrSort[$sort['field']], constant($sort['direction']), $result);
                }
                $result = array_slice($result,$rownum,15);
                $shopinfo = M('shopmessage')->where(array("state" => array("in", "1,2")))->where(['states' => 2])->field("shopid,shopphoto")->limit(4)->select();
                foreach ($shopinfo as $k => $vv) {
                    $shopinfo[$k]['shopphoto'] = $this->path . $vv['shopphoto'];
                }
               if ($result || $shopinfo) {
                    $data = array(
                        "status" => 1,
                        "msg" => $result,
                        "msg1" =>$shopinfo,
                    );
                    $this->ajaxReturn($data);
                } else {
                    $data = array(
                        "status" => 1,
                        "msg" => array(),
                        "msg1" => array(),
                    );
                    $this->ajaxReturn($data);
                }
            }
        }
    }
    /**
     * 计算当前商铺与客户的距离
     */
    public function jisuan(){
        if(IS_POST){
            $post = I('post.');
            $shopinfo = M("shopmessage")->where(['shopid'=>$post['shopid']])->field("lmoney,coordinate,maxprice,maxlong,maxmoney,lkmoney,long")->find();
            $shopcoor = explode(",",$shopinfo['coordinate']);
            $usercoor = explode(",", $post['coordinate']);
            $result = $this->getDistance($usercoor[0], $usercoor[1], $shopcoor[0], $shopcoor[1]);
            $shopinfo['juli'] = $result;
            if($result !== false){
                $this->ajaxReturn(['status'=>1,"msg"=>$shopinfo]);
            }else{
                $this->ajaxReturn(['status'=>0,"msg"=>""]);
            }
        }
    }

    /**
     * 计算两点地理坐标之间的距离
     * @param  Decimal $longitude1 起点经度
     * @param  Decimal $latitude1  起点纬度
     * @param  Decimal $longitude2 终点经度 
     * @param  Decimal $latitude2  终点纬度
     * @param  Int     $unit       单位 1:米 2:公里
     * @param  Int     $decimal    精度 保留小数位数
     * @return Decimal
     */
    function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit = 2, $decimal = 2) {

        $EARTH_RADIUS = 6370.996; // 地球半径系数
        $PI = 3.1415926;

        $radLat1 = $latitude1 * $PI / 180.0;
        $radLat2 = $latitude2 * $PI / 180.0;

        $radLng1 = $longitude1 * $PI / 180.0;
        $radLng2 = $longitude2 * $PI / 180.0;

        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;

        $distance = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $distance = $distance * $EARTH_RADIUS * 1000;

        if ($unit == 2) {
            $distance = $distance / 1000;
        }

        return round($distance, $decimal);
    }

    /**
     * 商户菜单类别列表
     * @2017.6.22
     */
    public function menulist() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $coor = $post['coor'];
            $info = M('category')->where(array("shopid" => $shopid))->select();
            foreach ($info as $k => $val) {
                $goodsinfo = M('shopgoods')->where(array("shopid" => $shopid, 'cid' => $val['cid']))->select();
                foreach ($goodsinfo as $kv =>$vald){
                    $goodsinfo[$kv]['goodsphoto'] = $this->path.$vald['goodsphoto'];
                    if($vald['goodscontent'] == null){
                        $goodsinfo[$kv]['goodscontent'] = "";
                    }
                }
                $info[$k]['goods'] = $goodsinfo;
            }
            $infos = M('shopmessage')->field('maxmoney,shopname,shopphoto,mobile,lmoney,content,shophead,state,detailed_address,coordinate,gotime,long,maxprice,maxlong,lkmoney')->where(['shopid' => $shopid])->find();
            $infos['shophead'] = $this->path . $infos['shophead'];
            $infos['shopphoto'] = $this->path . $infos['shopphoto'];
            $coor = explode(",", $coor);
            $coorend = explode(",", $infos['coordinate']);
            $infos['juli'] = $this->getDistance($coor[0], $coor[1], $coorend[0], $coorend[1]);
            $pingjia = M('evaluate')->where(['shopid' => $shopid])->page('1,'.$this->path)->select();
            if(!empty($pingjia)){
                foreach ($pingjia as $val) {
                $userinfo = M('user')->field('username,head_photo')->where(['uid' => $val['uid']])->find();
                if($userinfo['head_photo'] == null){
                    $userinfo['head_photo'] = "";
                }else{
                    $userinfo['head_photo'] = $this->path . $userinfo['head_photo'];
                }
                $userinfo['eid'] = $val['eid'];
                $userinfo['pingjia'] = $val['pingjia'];
                $userinfo['content'] = $val['content'];
                if($val['photo1'] == null){
                    $userinfo['photo1'] = "";
                }else{
                    $userinfo['photo1'] = $this->path. $val['photo1'];
                }
                if($val['photo2'] == null){
                    $userinfo['photo2'] = "";
                }else{
                    $userinfo['photo2'] =$this->path. $val['photo2'];
                }
                $userinfo['state'] = $val['state'];
                $userinfo['addtime'] = $val['addtime'];
                $backpingjia = M('backevaluate')->field('backpingjia')->where(['shopid' => $shopid, 'uid' => $val['uid'], "eid" => $val['eid']])->find();
                if(empty($backpingjia)){
                    $userinfo['backpingjia'] = "";
                }else{
                     $userinfo['backpingjia'] = $backpingjia['backpingjia'];
                }
               
                $infos['userspingjia'][] = $userinfo;
            }
            }else{
                 $infos['userspingjia']= array();
            }
            
            $infos['shopmessage'] = $info;
            if ($infos) {
                $this->ajaxReturn(['status' => 1, 'msg' => $infos]);
            } else {
                $this->ajaxReturn(['status' => 1, 'msg' => array()]);
            }
        }
    }

    /*
     * 商铺信息
     * 2017.6.24
     */
    public function shopmessage() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $info = M('shopmessage')->where(['shopid' => $shopid])->find();
            if ($info) {
                $this->ajaxReturn(['status' => 1, "msg" => $info]);
            }
        }
    }

    /*
     * 商铺模糊搜索
     * 2017.6.27
     */

    public function sercheshop() {
        if (IS_POST) {
            $post = I('post.');
            $shopname = $post['shopname'];
            $coor = $post['coor'];
            $data['shopname'] = array('like', "%$shopname%");
            $info = M('shopmessage')->where($data)->order('shopid desc')->select();
            foreach ($info as $k => $val) {
                $shopzuobiao = explode(",", $val['coordinate']);
                    $coordinate = explode(",", $coor);
                    $info[$k]['juli'] = $this->getDistance($coordinate[0], $coordinate[1], $shopzuobiao[0], $shopzuobiao[1]);
                $info[$k]['shophead'] = $this->path . $val['shophead'];
                $info[$k]['shopphoto'] = $this->path . $val['shopphoto'];
                $info[$k]['category'] = M('category')->where(['shopid' => $val['shopid']])->field('cid,cname')->order('num desc')->limit(3)->select();
            }
            if ($info) {
                $data = array(
                    "status" => 1,
                    "msg" => $info,
                );
                $this->ajaxReturn($data);
            } else {
                $data = array(
                    "status" => 3,
                    "msg" => "",
                );
                $this->ajaxReturn($data);
            }
        }
    }

}
