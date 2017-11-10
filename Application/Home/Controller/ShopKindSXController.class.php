<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2017/8/15
 * Time: 15:02
 */
namespace Home\Controller;


use Think\Controller;
// 通过一级分类进入筛选页面
class ShopKindSXController extends Controller
{
    public $path = 'http://jyg.sawfree.com/';
    public $shopnum = 1;  //首页返回默认商铺的数量
    public $sudu = 15; // 15公里每小时
    /***
     * 首页点击一级店铺分类后进入筛选页面
     * 参数：分类的ID
     * 输出：该一级分类下所有的二级分类，一级默认全部店铺信息
     */
        public function index(){
            if(IS_POST){
                $post = I('post.');
                $shopkindid = $post['shopkindid'];
                $city = $post['city'];
                $lat1 = $post['lat1'];
                $lng1 = $post['lng1'];
                $page = $post['page'];
                /*测试数据*/
//                $shopkindid = 1;
//                $city = '石家庄市';
//                $lat1 = 39;
//                $lng1 = 116;
//                $page = 1;
                /*测试数据*/
                if(!$shopkindid||!$city||!$lat1||!$lng1){
                    // 参数没有传递完全
                    $this->ajaxReturn(['status'=>0]);
                }
                if($page<2) {
                    //获取二级分类
                    $firstKindid = M('shopkind')->where(['shopkindid' => $shopkindid])->field('shopkindid')->find();
                    $secondKinds = M('shopkind')->where(['fatherid' => $firstKindid['shopkindid']])->field('shopkindid,kindname')->select();
                   if($secondKinds) {
                       $seid = 0;
                       foreach ($secondKinds as $k) {
                           $data['secondKinds'][$seid]["shopkindid"] = $k['shopkindid'];
                           $data['secondKinds'][$seid]["kindname"] = $k['kindname'];
                           $seid++;
                       }
                   }else{
                       $data['secondKinds'] =array();
                   }
                }
                $shops = new ParamController();
                // shops  // 获取一级分类中所有的数据
                $data["shops"] = $shops->getShopByFirstKind($shopkindid,$city,$lng1,$lat1);
                if($data['shops']==2){
                    // 参数错误
                    $this->ajaxReturn(['status'=>3]);
                }
                if(!$data['shops']){
                    $data["shops"] = array();
                }else{
                    // 不为空将数据分页
                    $page2 = new SuanFaController();
                    $data['shops'] = $page2->goPage($page,$this->shopnum,$data['shops']);
                }
                if($page<2){
                    // 默认显示
                    $data['status'] = 1;
                }else{
                    $data['status'] = 2;
                }
              $this->ajaxReturn($data);
            }
        }
    /**
     *  通过条件筛选符合的店铺
     *  需要的参数：城市，坐标，条件（距离【几百米】，城区【不考虑】，二级分类ID【】，智能排序【评价，人均，距离】，筛选条件【堂食，外卖，价格】）
     *  返回的参数：符合条件的店铺的信息
     */
    public function SXShops(){
        if(IS_POST){
            $post = I('post.');
            $city = $post['city'];  //城市
            $lat1 = $post['lat1'];  //纬度
            $lng1 = $post['lng1'];  //经度
            $juli = $post['juli'];    // 距离
         //   $place = $post['place']; // 县区
            $secondid = $post['secondid']; // 二级分类ID
            $zhineng = $post['zhineng']; // 智能
            $last = $post['last']; // 筛选条件
            $price = $post['price']; // 价格
            $page = $post['page'];  //页
            // 测试条件
//            $city = '石家庄市';
//            $lat1 = '39';
//            $lng1 = '116';
//            $juli = 100000000000;
//            $secondid = '10';
//            $zhineng = '5';
//            $last = '3';
//            $price = '7-0';
//            $page = 1;
            // 测试条件结束
            // 判断坐标是否获取成功，坐标获取失败返回0
            if(!$city||!$lat1||!$lng1){
                $this->ajaxReturn(['status'=>0]);
            }
            if($juli&&$city&&$lat1&&$lng1){
                $obj = new ParamController();
                $result =  $obj->sXByJuLi($city,$lng1,$lat1,$juli);
            }
            //判断美食种类是否有限制
            if($secondid&&$city&&$lat1&&$lng1){
                // 判断是否有第一个条件
                if(empty($result)){
                    $result = array();
                }
                $secon = new ParamController();
                $result = $secon->sXByShopSecondKindId($result,$secondid,$city,$lng1,$lat1);
            }
            // 判断是否要智能排序
            if($zhineng&&$city&&$lat1&&$lng1){
                // 判断result是否为空
                if(empty($result)){
                    $result=array();
                }
                $sx = new ParamController();
                $result = $sx->sXByZhiNengId($result,$zhineng,$city,$lng1,$lat1);
                if($result == 2){
                    $this->ajaxReturn(['status'=>3]);
                }
            }
            // 判断是否有堂食，外卖，价格的要求
            if($last&&$city&&$lat1&&$lng1){
                // 判断result是否为空
                if(empty($result)){
                    $result = array();
                }
                $sx = new ParamController();
                $result = $sx->sXByLastId($result,$last,$city,$lng1,$lat1);
                if($result == 2){
                    $this->ajaxReturn(['status'=>3]);
                }
            }
            // 判断是否有价格的要求  10.6
            if($price&&$city&&$lat1&&$lng1){
                // 对价格进行筛选
                if(empty($result)){
                    $result = array();
                }
                $sx = new ParamController();
                $result = $sx->getShopsDetailsByPrice($result,$price);
            }
            if(empty($result)){
                $this->ajaxReturn(['status'=>2]);
            }else{
                if($result){
                    // 对数组分页处理
                    $page2 = new SuanFaController();
                    $result['city'] = $page2->goPage($page,$this->shopnum,$result);
                    if($result['city']){
                        $this->ajaxReturn(['status'=>1,'shops'=>$result['city']]);
                    }else{
                        $this->ajaxReturn(['status'=>2]);
                    }

                }else{
                    $this->ajaxReturn(['status'=>2]);
                }
            }
        }
    }
}