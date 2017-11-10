<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Upload;

class UserController extends Controller {

    //构造函数
    public function _initialize() {
        if (!session('username')) {
            $this->redirect('Login/loadlogin');
            exit(0);
        }
    }

    /**
     * 引入认证中
     * @2017.6.29
     */
    public function index() {
        $results = M('shopmessage')->where(['state' => 3])->select();
        $orderinfo = M('orders')->where(array("state" => array("in", "1,2")))->where(['states' => 1, 'statu' => 1])->select();
        $tuidan = count($orderinfo);
        $renzheng = count($results);
        $page = new \Think\Page($renzheng, 10);
        $page->setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;     //最后一页不显示为总页数
        $page->rollPage = 10;          //分页栏每页显示的页数

        $show = $page->show();
        $result = M('shopmessage')
                ->where(['state' => 3])
                ->limit($page->firstRow, $page->listRows)
                ->select();
        $resultaa = M('shopmessage')
                ->where(array("state" => array("in", "1,2")))
                ->select();
        foreach ($resultaa as $k => $val) {
            $orderinfo = M('orders')->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2])->select();
            $money = 0;
            foreach ($orderinfo as $va) {
                $money += $va['allprice'];
            }
            $resultaa[$k]['money'] = $money;
            if (empty($orderinfo)) {
                unset($resultaa[$k]);
            }
        }
        $countss = M('shopmessage')->where(array("state" => array("in", "1,2")))->count();
        $jiaoyi = count($resultaa);
        $session = session('username');
        $this->assign("result", $result);
        $this->assign("session", $session);
        $this->assign("renzheng", $renzheng);
        $this->assign("yirenzheng", $countss);
        $this->assign("renzheng", $renzheng);
        $this->assign("jiaoyi", $jiaoyi);
        $this->assign("tuidan", $tuidan);
        $this->assign('show', $show);
        $this->display();
    }

    /**
     * 首页模糊搜索
     */
    public function indexs() {
        if (IS_GET) {
            $get = I('get.shopname');
            $where['shopname'] = array('like', '%' . $get . '%');
            $result = M('shopmessage')
                    ->where(['state' => 3])
                    ->where($where)
                    ->select();
            $results = M('shopmessage')->where(['state' => 3])->select();
            $orderinfo = M('orders')->where(array("state" => array("in", "1,2")))->where(['states' => 1, 'statu' => 1])->select();
            $tuidan = count($orderinfo);
            $renzheng = count($results);
            $resultaa = M('shopmessage')
                    ->where(array("state" => array("in", "1,2")))
                    ->select();
            foreach ($resultaa as $k => $val) {
                $orderinfo = M('orders')->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2])->select();
                $money = 0;
                foreach ($orderinfo as $va) {
                    $money += $va['allprice'];
                }
                $resultaa[$k]['money'] = $money;
                if (empty($orderinfo)) {
                    unset($resultaa[$k]);
                }
            }
            $countss = M('shopmessage')->where(array("state" => array("in", "1,2")))->count();
            $jiaoyi = count($resultaa);
            $session = session('username');
            $this->assign("result", $result);
            $this->assign("session", $session);
            $this->assign("renzheng", $renzheng);
            $this->assign("jiaoyi", $jiaoyi);
            $this->assign("tuidan", $tuidan);
            $this->assign("yirenzheng", $countss);
            $this->assign('show', $show);
            $this->assign('shopname', $get);
            $this->display('index');
        }
    }

    /**
     * 引入退单申请
     */
    public function tuidan() {
        $resultsa = M("orders")->where(array('state' => array("in", "1,2")))->where(['states' => 1, 'statu' => 1])->select();
        $count = count($resultsa);
        $page = new \Think\Page($count, 10);
        $page->setConfig('header', '<span class="rows">共<b class="blue">%TOTAL_ROW%</b>条记录&nbsp;第<b class="blue">%NOW_PAGE%</b>页/共<b class="blue">%TOTAL_PAGE%</b>页</span>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;     //最后一页不显示为总页数
        $page->rollPage = 10;          //分页栏每页显示的页数

        $show = $page->show();
        $result = M('orders')
                ->where(array("state" => array("in", "1,2")))
                ->where(['states' => 1, 'statu' => 1])
                ->limit($page->firstRow, $page->listRows)
                ->select();
        foreach ($result as $k => $val) {
            $userinfo = M("user")->where(['uid' => $val['uid']])->field("username,mobile")->find();
            $result[$k]['username'] = $userinfo['username'];
            $result[$k]['userphone'] = $userinfo['mobile'];
            $shopinfo = M('shopmessage')->where(['shopid' => $val['shopid']])->field("shopname")->find();
            $result[$k]['shopname'] = $shopinfo['shopname'];
        }
        $countss = M('shopmessage')->where(array("state" => array("in", "1,2")))->count();
        $results = M('shopmessage')->where(['state' => 3])->select();
        $resultall = M('shopmessage')
                ->where(array("state" => array("in", "1,2")))
                ->select();
        foreach ($resultall as $k => $val) {
            $orderinfo = M('orders')->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2])->select();
            $money = 0;
            foreach ($orderinfo as $va) {
                $money += $va['allprice'];
            }
            $resultall[$k]['money'] = $money;
            if (empty($orderinfo)) {
                unset($resultall[$k]);
            }
        }
        $jiaoyi = count($resultall);
        $renzheng = count($results);
        $session = session('username');
        $this->assign("session", $session);
        $this->assign("renzheng", $renzheng);
        $this->assign("jiaoyi", $jiaoyi);
        $this->assign("tuidan", $count);
        $this->assign("result", $result);
        $this->assign("yirenzheng", $countss);
        $this->assign("show", $show);
        $this->display("untreated");
    }

    /**
     * 退单模糊搜索
     */
    public function tuidans() {
        if (IS_GET) {
            $get = I("get.shopname");
            $resultsa = M("orders")->where(array('state' => array("in", "1,2")))->where(['states' => 1, 'statu' => 1])->select();
            $count = count($resultsa);
            $where['shopname'] = array('like', '%' . $get . '%');
            $result = M('orders')
                    ->where(array("state" => array("in", "1,2")))
                    ->where(['states' => 1, 'statu' => 1])
                    ->select();
            foreach ($result as $k => $val) {
                $userinfo = M("user")->where(['uid' => $val['uid']])->field("username,mobile")->find();
                $result[$k]['username'] = $userinfo['username'];
                $result[$k]['userphone'] = $userinfo['mobile'];
                $shopinfo = M('shopmessage')->where($where)->where(['shopid' => $val['shopid']])->field("shopname")->find();
                if (empty($shopinfo)) {
                    unset($result[$k]);
                } else {
                    $result[$k]['shopname'] = $shopinfo['shopname'];
                }
            }
            $countss = M('shopmessage')->where(array("state" => array("in", "1,2")))->count();
            $results = M('shopmessage')->where(['state' => 3])->select();
            $resultall = M('shopmessage')
                    ->where(array("state" => array("in", "1,2")))
                    ->select();
            foreach ($resultall as $k => $val) {
                $orderinfo = M('orders')->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2])->select();
                $money = 0;
                foreach ($orderinfo as $va) {
                    $money += $va['allprice'];
                }
                $resultall[$k]['money'] = $money;
                if (empty($orderinfo)) {
                    unset($resultall[$k]);
                }
            }
            $jiaoyi = count($resultall);
            $renzheng = count($results);
            $session = session('username');
            $this->assign("session", $session);
            $this->assign("renzheng", $renzheng);
            $this->assign("jiaoyi", $jiaoyi);
            $this->assign("tuidan", $count);
            $this->assign("result", $result);
            $this->assign('shopname', $get);
            $this->assign("yirenzheng", $countss);
            $this->display("untreated");
        }
    }

    /**
     * 引入交易额模版
     * @2017.6.30
     */
    public function jiaoyi() {
        $listinfo = M("shopmessage")->where(array("state" => array("in", "1,2")))->select();
        foreach ($listinfo as $kk => $vav) {
            $orderlist = M('orders')->where(['shopid' => $vav['shopid'], 'states' => 1, 'statu' => 2])->where(array("state" => array("in", "3,4,5")))->select();
            if (empty($orderlist)) {
                unset($listinfo[$kk]);
            }
        }
        $count = count($listinfo);
        $page = new \Think\Page($count, 10);
        $page->setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;     //最后一页不显示为总页数
        $page->rollPage = 10;          //分页栏每页显示的页数

        $show = $page->show();
        $result = M('shopmessage')
                ->where(array("et_shopmessage.state" => array("in", "1,2")))
                ->field('et_shopmessage.shopid,et_shopmessage.shopname,et_shopmessage.mobile,et_shopmessage.addtime')
                ->distinct(true)
                ->join("et_orders ON et_shopmessage.shopid = et_orders.shopid")
                ->select();
        foreach ($result as $k => $val) {
            $orderinfo = M('orders')->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2])->select();
            $money = 0;
            foreach ($orderinfo as $va) {
                $money += $va['allprice'];
            }
            $result[$k]['money'] = $money;
            $weixin = M("orders")->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2, 'pay' => 1])->select();
            $weixinmoney = 0;
            foreach ($weixin as $tyyu) {
                $weixinmoney += $tyyu['allprice'];
            }
            $result[$k]['weixin'] = $weixinmoney;
            $zhifu = M("orders")->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2, 'pay' => 2])->select();
            $zhifumoney = 0;
            foreach ($zhifu as $rtr) {
                $zhifumoney += $rtr['allprice'];
            }
            $result[$k]['zhifumoney'] = $zhifumoney;
            $brain = M("orders")->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2, 'pay' => 3])->select();
            $brainmoney = 0;
            foreach ($brain as $rtrs) {
                $brainmoney += $rtrs['allprice'];
            }
            $result[$k]['brainmoney'] = $brainmoney;
            if (empty($orderinfo) && empty($weixin) && empty($zhifu) && empty($brain)) {
                unset($result[$k]);
            }
        }
        $resultss = M('shopmessage')
                ->where(array("state" => array("in", "1,2")))
                ->select();
        foreach ($resultss as $k => $val) {
            $orderinfo = M('orders')->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2])->select();
            $money = 0;
            foreach ($orderinfo as $va) {
                $money += $va['allprice'];
            }
            $resultss[$k]['money'] = $money;
            if (empty($orderinfo)) {
                unset($resultss[$k]);
            }
        }
        $countss = M('shopmessage')->where(array("state" => array("in", "1,2")))->count();
        $results = M('shopmessage')->where(['state' => 3])->select();
        $jiaoyi = count($resultss);
        $orderinfo = M('orders')->where(array("state" => array("in", "1,2")))->where(['states' => 1, 'statu' => 1])->select();
        $tuidan = count($orderinfo);
        $renzheng = count($results);
        $session = session('username');
        $this->assign("session", $session);
        $this->assign("renzheng", $renzheng);
        $this->assign("jiaoyi", $jiaoyi);
        $this->assign("tuidan", $tuidan);
        $this->assign("result", $result);
        $this->assign("time", date("Y-m-d H:i:s", time()));
        $this->assign("show", $show);
        $this->assign("yirenzheng", $countss);
        $this->display("tradingVolume");
    }

    /**
     * 交易额模糊搜索
     */
    public function jiaoyis() {
        if (IS_GET) {
            $get = I("get.shopname");
            $where['shopname'] = array('like', '%' . $get . '%');
            $result = M("shopmessage")->where($where)->where(array("state" => array("in", "1,2")))->select();
            foreach ($result as $kk => $vav) {
                $orderlist = M('orders')->where(['shopid' => $vav['shopid'], 'states' => 1, 'statu' => 2])->where(array("state" => array("in", "3,4,5")))->select();
                if (empty($orderlist)) {
                    unset($result[$kk]);
                }
            }
            $count = count($result);
            foreach ($result as $k => $val) {
                $orderinfo = M('orders')->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2])->select();
                $money = 0;
                foreach ($orderinfo as $va) {
                    $money += $va['allprice'];
                }
                $result[$k]['money'] = $money;
                $weixin = M("orders")->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2, 'pay' => 1])->select();
                $weixinmoney = 0;
                foreach ($weixin as $tyyu) {
                    $weixinmoney += $tyyu['allprice'];
                }
                $result[$k]['weixin'] = $weixinmoney;
                $zhifu = M("orders")->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2, 'pay' => 2])->select();
                $zhifumoney = 0;
                foreach ($zhifu as $rtr) {
                    $zhifumoney += $rtr['allprice'];
                }
                $result[$k]['zhifumoney'] = $zhifumoney;
                $brain = M("orders")->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2, 'pay' => 3])->select();
                $brainmoney = 0;
                foreach ($brain as $rtrs) {
                    $brainmoney += $rtrs['allprice'];
                }
                $result[$k]['brainmoney'] = $brainmoney;
                if (empty($orderinfo) && empty($weixin) && empty($zhifu) && empty($brain)) {
                    unset($result[$k]);
                }
            }
            $resultss = M('shopmessage')
                    ->where(array("state" => array("in", "1,2")))
                    ->select();
            foreach ($resultss as $k => $val) {
                $orderinfo = M('orders')->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2])->select();
                $money = 0;
                foreach ($orderinfo as $va) {
                    $money += $va['allprice'];
                }
                $resultss[$k]['money'] = $money;
                if (empty($orderinfo)) {
                    unset($resultss[$k]);
                }
            }
            $countss = M('shopmessage')->where(array("state" => array("in", "1,2")))->count();
            $results = M('shopmessage')->where(['state' => 3])->select();
            $jiaoyi = count($resultss);
            $orderinfo = M('orders')->where(array("state" => array("in", "1,2")))->where(['states' => 1, 'statu' => 1])->select();
            $tuidan = count($orderinfo);
            $renzheng = count($results);
            $session = session('username');
            $this->assign("session", $session);
            $this->assign("renzheng", $renzheng);
            $this->assign("jiaoyi", $jiaoyi);
            $this->assign("tuidan", $tuidan);
            $this->assign("result", $result);
            $this->assign("time", date("Y-m-d H:i:s", time()));
            $this->assign('shopname', $get);
            $this->assign("yirenzheng", $countss);
            $this->display("tradingVolume");
        }
    }

    /**
     * 已认证
     */
    public function ready() {
        $count = M('shopmessage')->where(array("state" => array("in", "1,2")))->count();
        $page = new \Org\Page\Page($count, 5);
        $page->setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;     //最后一页不显示为总页数
        $page->rollPage = 10;          //分页栏每页显示的页数
        $show = $page->show();
        $result = M('shopmessage')
                ->where(array("state" => array("in", "1,2")))
                ->order("addtime desc")
                ->limit($page->firstRow, $page->listRows)
                ->select();
        $resultss = M('shopmessage')
                ->where(array("state" => array("in", "1,2")))
                ->select();
        foreach ($resultss as $k => $val) {
            $orderinfo = M('orders')->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2])->select();
            $money = 0;
            foreach ($orderinfo as $va) {
                $money += $va['allprice'];
            }
            $resultss[$k]['money'] = $money;
            if (empty($orderinfo)) {
                unset($resultss[$k]);
            }
        }
        $resultsa = M("orders")->where(array('state' => array("in", "1,2")))->where(['states' => 1, 'statu' => 1])->select();
        $tuidan = count($resultsa);
        $renzheng = M('shopmessage')->where(['state' => 3])->count();
        $jiaoyi = count($resultss);
        $this->assign('renzheng', $renzheng);
        $this->assign('tuidan', $tuidan);
        $this->assign('jiaoyi', $jiaoyi);
        $this->assign('yirenzheng', $count);
        $this->assign('show', $show);
        $this->assign('result', $result);
        $session = session('username');
        $this->assign("session", $session);
        $this->display('authenticated');
    }

    /**
     * 已认证模糊搜索
     */
    public function readys() {
        if (IS_GET) {
            $get = I('get.shopname');
            $count = M('shopmessage')->where(array("state" => array("in", "1,2")))->count();
            $where['shopname'] = array('like', '%' . $get . '%');
            $result = M('shopmessage')
                    ->where($where)
                    ->where(array("state" => array("in", "1,2")))
                    ->order("addtime desc")
                    ->select();
            $resultss = M('shopmessage')
                    ->where(array("state" => array("in", "1,2")))
                    ->order("addtime desc")
                    ->select();
            foreach ($resultss as $k => $val) {
                $orderinfo = M('orders')->where(array("state" => array("in", "3,4,5")))->where(['states' => 1, "shopid" => $val['shopid'], 'statu' => 2])->select();
                $money = 0;
                foreach ($orderinfo as $va) {
                    $money += $va['allprice'];
                }
                $resultss[$k]['money'] = $money;
                if (empty($orderinfo)) {
                    unset($resultss[$k]);
                }
            }
            $resultsa = M("orders")->where(array('state' => array("in", "1,2")))->where(['states' => 1, 'statu' => 1])->select();
            $tuidan = count($resultsa);
            $renzheng = M('shopmessage')->where(['state' => 3])->count();
            $jiaoyi = count($resultss);
            $this->assign('renzheng', $renzheng);
            $this->assign('tuidan', $tuidan);
            $this->assign('jiaoyi', $jiaoyi);
            $this->assign('yirenzheng', $count);
            $this->assign('result', $result);
            $session = session('username');
            $this->assign("session", $session);
            $this->assign('shopname', $get);
            $this->display('authenticated');
        }
    }

    /**
     * 停用
     */
    public function stop() {
        if (IS_POST) {
            $post = I("post.");
            $array = array(
                'state' => 2,
            );
            $result = M('shopmessage')->where(['shopid' => $post['id']])->save($array);
            if ($result) {
                $this->ajaxReturn(['status' => 1]); //成功
            } else {
                $this->ajaxReturn(['status' => 0]); //失败
            }
        }
    }

    /**
     * 启用
     */
    public function start() {
        if (IS_POST) {
            $post = I("post.");
            $array = array(
                'state' => 1,
            );
            $result = M('shopmessage')->where(['shopid' => $post['id']])->save($array);
            if ($result) {
                $this->ajaxReturn(['status' => 1]); //成功
            } else {
                $this->ajaxReturn(['status' => 0]); //失败
            }
        }
    }

    /**
     * 商户信息
     */
    public function forms() {
        $get = I('get.');
        if ($get) {
            $result = M("shopmessage")->where(['shopid' => $get['shopid']])->find();
            $countorder = M('orders')->where(['shopid' => $result['shopid']])->where(['statu' => 2])->where(array("state" => array("in", "3,4,5")))->select();
            $money = 0;
            foreach ($countorder as $val) {
                $money += $val['allprice'];
            }
            $weixin = M('orders')->where(['shopid' => $result['shopid']])->where(['statu' => 2, 'pay' => 1])->where(array("state" => array("in", "3,4,5")))->select();
            $weixinmoney = 0;
            foreach ($weixin as $val) {
                $weixinmoney += $val['allprice'];
            }
            $zhifubao = M('orders')->where(['shopid' => $result['shopid']])->where(['statu' => 2, 'pay' => 2])->where(array("state" => array("in", "3,4,5")))->select();
            $zhifumoney = 0;
            foreach ($zhifubao as $val) {
                $zhifumoney += $val['allprice'];
            }
            $brain = M('orders')->where(['shopid' => $result['shopid']])->where(['statu' => 2, 'pay' => 3])->where(array("state" => array("in", "3,4,5")))->select();
            $brainmoney = 0;
            foreach ($brain as $val) {
                $brainmoney += $val['allprice'];
            }

            $count = M('orders')->where(['shopid' => $result['shopid']])->where(['statu' => 2])->where(array("state" => array("in", "3,4,5")))->count();
            $shopselse = M('shop')->where(['shopid' => $result['shopid']])->find();
            $this->assign('count', $count);
            $this->assign('money', $money);
            $this->assign('weixinmoney', $weixinmoney);
            $this->assign('zhifumoney', $zhifumoney);
            $this->assign('brainmoney', $brainmoney);
            $this->assign('result', $result);
            $this->username = $shopselse['phone'];
            $session = session('username');
            $this->assign("session", $session);
            $this->display('particulars');
        }
    }

    /**
     * 删除商铺信息
     */
    public function deleteuser() {
        if (IS_POST) {
            $post = I("post.");
            $result = M('shopmessage')->delete($post['shopid']);
            if ($result) {
                S("token" . $post, null);
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /**
     * 首推
     */
    public function shoutui() {
        if (IS_POST) {
            $post = I("post.");
            $data = array(
                'states' => 2,
            );
            $result = M('shopmessage')->where(['shopid' => $post['shopid']])->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1]); //成功
            } else {
                $this->ajaxReturn(['status' => 0]); //失败
            }
        }
    }

    /**
     * 撤销首推
     */
    public function backshoutui() {
        if (IS_POST) {
            $post = I("post.");
            $data = array(
                'states' => 1,
            );
            $result = M('shopmessage')->where(['shopid' => $post['shopid']])->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1]); //成功
            } else {
                $this->ajaxReturn(['status' => 0]); //失败
            }
        }
    }

    /**
     * 商铺订单信息
     */
    public function orderlist() {
        $get = I('get.');
        if ($get) {
            $result = M("shopmessage")->where(['shopid' => $get['shopid']])->find();
            $countorder = M('orders')->where(['shopid' => $get['shopid']])->where(['statu' => 2])->select();
            $money = 0;
            foreach ($countorder as $val) {
                $money += $val['allprice'];
            }
            $count = count($countorder);
            $page = new \Think\Page($count, 10);
            $page->setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('last', '末页');
            $page->setConfig('first', '首页');
            $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page->show();
            $orderinfos = M('orders')
                    ->where(['shopid' => $get['shopid']])->where(['statu' => 2])
                    ->order("addtime desc")
                    ->limit($page->firstRow, $page->listRows)
                    ->select();
            foreach ($orderinfos as $kd => $vals) {
                $goods = M("ordergoods")->where(['orderid' => $vals['orderid']])->select();
                foreach ($goods as $v) {
                    $goodsinfo = M("shopgoods")->where(['goodsid' => $v['goodsid']])->field('goodsname')->find();
                    $orderinfos[$kd]['goodsname'] .=$goodsinfo['goodsname'] . "&nbsp";
                }
            }
            $this->assign('show', $show);
            $this->assign('count', $count);
            $this->assign('money', $money);
            $this->assign('result', $result);
            $this->assign('orders', $orderinfos);
            $session = session('username');
            $this->assign("session", $session);
            $this->display('particulars1');
        }
    }

    /**
     * 删除订单
     */
    public function deleteorder() {
        if (IS_POST) {
            $post = I('post.orderid');
            $post = $post * 1;
            $result = M('orders')->where(['orderid' => $post])->find();
            if ($result['states'] == 1) {
                $this->ajaxReturn(['status' => 2]);
            }
            $delete = M('orders')->where(['orderid' => $post])->delete();
            if ($delete) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /**
     * 删除订单
     */
    public function deletecategory() {
        if (IS_POST) {
            $post = I('post.cid');
            $cid = trim($post);
            $goodinfo = M('shopgoods')->where(array("cid" => $cid))->select();
            if (!empty($goodinfo)) {
                $this->ajaxReturn(['status' => 2, 'msg' => ""]);
            }
            $self = M('category')->where(['cid' => $cid])->find();
            if ($self['up'] == "-1") {
                if ($self['end'] !== "0") {
                    M('category')->startTrans();
                    $editnextend = M('category')->where(['cid' => $self['end']])->save(['up' => -1]);
                    if ($editnextend) {
                        $info = M("category")->delete($cid);
                        if ($info) {
                            M('category')->commit();
                            $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                        } else {
                            M('category')->rollback();
                            $this->ajaxReturn(['status' => 0, "msg" => "删除失败"]);
                        }
                    } else {
                        M('category')->rollback();
                        $this->ajaxReturn(['status' => 0, "msg" => "修改上下级关系失败"]);
                    }
                } else {
                    $info = M('category')->delete($cid);
                    if ($info) {
                        $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                    } else {
                        $this->ajaxReturn(['status' => 0, "msg" => "删除失败"]);
                    }
                }
            } else {
                if ($self['end'] !== "0") {
                    M('category')->startTrans();
                    $editup = M('category')->where(['cid' => $self['up']])->save(['end' => $self['end']]);
                    if ($editup) {
                        $editend = M('category')->where(['cid' => $self['end']])->save(['up' => $self['up']]);
                        if ($editend) {
                            $info = M('category')->delete($cid);
                            if ($info) {
                                M("category")->commit();
                                $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                            } else {
                                M("category")->rollback();
                                $this->ajaxReturn(['status' => 0, "msg" => "删除失败"]);
                            }
                        } else {
                            M("category")->rollback();
                            $this->ajaxReturn(['status' => 0, "msg" => "修改下条信息的上标记失败。"]);
                        }
                    } else {
                        M("category")->rollback();
                        $this->ajaxReturn(['status' => 0, "msg" => "修改上条信息的下标记失败。"]);
                    }
                } else {
                    M('category')->startTrans();
                    $editups = M('category')->where(['cid' => $self['up']])->save(['end' => 0]);
                    if ($editups) {
                        $info = M('category')->delete($cid);
                        if ($info) {
                            M("category")->commit();
                            $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                        } else {
                            M("category")->rollback();
                            $this->ajaxReturn(['status' => 0, "msg" => "删除失败。"]);
                        }
                    } else {
                        M("category")->rollback();
                        $this->ajaxReturn(['status' => 0, "msg" => "修改上条信息的下标记失败。"]);
                    }
                }
            }
        }
    }

    /**
     * 删除菜品
     */
    public function deletegoods() {
        if (IS_POST) {
            $post = I('post.goodsid');
            $post = $post * 1;
            $delete = M('shopgoods')->where(['goodsid' => $post])->delete();
            if ($delete) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /**
     * 删除评价
     */
    public function deletepingjia() {
        if (IS_POST) {
            $post = I('post.eid');
            $post = $post * 1;
            $delete = M('evaluate')->where(['eid' => $post])->delete();
            if ($delete) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /**
     * 商户菜单分类
     */
    public function category() {
        $get = I('get.');
        $result = M("shopmessage")->where(['shopid' => $get['shopid']])->find();
//        $category = M('category')->where(['shopid' => $get['shopid']])->select();
        $first = M('category')->where(['shopid' => $get['shopid'], 'up' => -1])->find();
        $category = $this->diguicategory($first['end']);
        array_unshift($category, $first);
        $orderinfo = M("orders")->where(['shopid' => $get['shopid'], 'statu' => 2])->where(array('states' => array("in", "3,4,5")))->select();
        foreach ($category as $k => $v) {
            $goods = M('shopgoods')->where(['cid' => $v['cid'], 'shopid' => $get['shopid']])->select();
            $category[$k]['goodsnum'] = count($goods);
            $orders = M('orders')->where(['shopid' => $v['shopid']])->where(array("state" => array("in", "3,4,5")))->select();
            foreach ($goods as $vs) {
                foreach ($orders as $vss) {
                    $vss['goodsinfo'] = rtrim($vss['goodsinfo'], "|");
                    $forst = explode("|", $vss['goodsinfo']);
                    foreach ($forst as $vvv) {
                        $tows = explode(",", $vvv);
                        if ($vs['goodsid'] == $tows[0]) {
                            $category[$k]['num'] +=$tows[4];
                        }
                    }
                }
            }
        }
        $goodsnums = 0;
        foreach ($category as $ksd => $trs) {
            $category[$ksd]['goodsnum'] = M("shopgoods")->where(['cid' => $trs['cid']])->count();
            $goodsnums += $category[$ksd]['goodsnum'];
        }
        $countcategory = count($category);
        $this->assign('countcategory', $countcategory);
        $this->assign('goodsnums', $goodsnums);
        $this->assign('result', $result);
        $session = session('username');
        $this->assign("session", $session);
        $this->assign("category", $category);
        $this->display('particulars2');
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
     * 添加菜单
     * @2017.6.22
     */
    public function addcategory() {
        if (IS_POST) {
            $post = I('post.');
            $shopid = $post['shopid'];
            $cname = $post['cname'];
            $first = M('category')->where(['shopid' => $shopid, 'up' => -1])->find();
            $categorys = $this->diguicategory($first['end']);
            array_unshift($categorys, $first);
            $result = end($categorys);
            if (empty($result)) {
                $data = array(
                    "cname" => $cname,
                    "up" => -1,
                    "end" => 0,
                    "shopid" => $shopid,
                    "addtime" => date("Y-m-d H:i:s", time()),
                );
                $info = M('category')->add($data);
                if ($info) {
                    $this->ajaxReturn(['status' => 1, 'msg' => ""]);
                } else {
                    $this->ajaxReturn(['status' => 0, 'msg' => '']);
                }
            } else {
                $data = array(
                    "cname" => $cname,
                    "up" => $result['cid'],
                    "end" => 0,
                    "shopid" => $shopid,
                    "addtime" => date("Y-m-d H:i:s", time()),
                );
                M('category')->startTrans();
                $info = M('category')->add($data);
                if ($info) {
                    $editup = M('category')->where(['cid' => $result['cid']])->save(['end' => $info]);
                    if ($editup) {
                        M("category")->commit();
                        $this->ajaxReturn(['status' => 1]);
                    } else {
                        M("category")->rollback();
                        $this->ajaxReturn(['status' => 0]);
                    }
                } else {
                    M("category")->rollback();
                    $this->ajaxReturn(['status' => 0, "msg" => "添加信息失败"]);
                }
            }
        }
    }

    /**
     * 商品列表
     */
    public function goodform() {
        $get = I("get.");
        if ($get) {
            $result = M("shopmessage")->where(['shopid' => $get['shopid']])->find();
            $count = M("shopgoods")->where(['cid' => $get['id']])->count();
            $page = new \Think\Page($count, 10);
            $page->setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('last', '末页');
            $page->setConfig('first', '首页');
            $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page->show();
            $goodsinfos = M('shopgoods')
                    ->where(['cid' => $get['id']])
                    ->order("addtime desc")
                    ->limit($page->firstRow, $page->listRows)
                    ->select();
            $orders = M('orders')->where(['shopid' => $get['shopid']])->where(array("state" => array("in", "3,4,5")))->select();
            foreach ($goodsinfos as $k => $v) {
                foreach ($orders as $vs) {
                    $vs['goodsinfo'] = rtrim($vs['goodsinfo'], "|");
                    $dat = explode("|", $vs['goodsinfo']);
                    foreach ($dat as $vv) {
                        $aa = explode(",", $vv);
                        if ($aa[0] == $v['goodsid']) {
                            $goodsinfos[$k]['num'] +=$aa[4];
                        }
                    }
                }
            }
            foreach ($goodsinfos as $k => $v) {
                if ($v['num'] == null) {
                    $goodsinfos[$k]['num'] = 0;
                }
            }
            $self = M('category')->where(['cid' => $get['id']])->find();
            $caidan = M("category")->where(['shopid' => $get['shopid']])->count();
            $this->caidan = $caidan;
            $this->self = $self;
            $session = session('username');
            $this->assign("session", $session);
            $this->assign('goodsinfos', $goodsinfos);
            $this->assign('result', $result);
            $this->assign('count', $count);
            $this->assign('show', $show);
            $this->display('particulars3');
        }
    }

    /**
     * 评价列表
     */
    public function pingjia() {
        $get = I('get.shopid');
        if ($get) {
            $result = M("shopmessage")->where(['shopid' => $get])->find();
            $count = M("evaluate")->where(['shopid' => $get])->count();
            $page = new \Think\Page($count, 10);
            $page->setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
            $page->setConfig('prev', '上一页');
            $page->setConfig('next', '下一页');
            $page->setConfig('last', '末页');
            $page->setConfig('first', '首页');
            $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
            $page->lastSuffix = false;     //最后一页不显示为总页数
            $page->rollPage = 10;          //分页栏每页显示的页数
            $show = $page->show();
            $pingjia = M('evaluate')
                    ->where(['shopid' => $get])
                    ->order("addtime desc")
                    ->limit($page->firstRow, $page->listRows)
                    ->select();
            foreach ($pingjia as $key => $val) {
                $username = M("user")->where(['userid' => $val['uid']])->field("username")->find();
                $pingjia[$key]['username'] = $username['username'];
            }
            $session = session('username');
            $this->assign("session", $session);
            $this->assign('count', $count);
            $this->assign('result', $result);
            $this->assign('show', $show);
            $this->assign('pingjia', $pingjia);
            $this->display('particulars4');
        }
    }

    /**
     * 评论详情
     */
    public function evaluateform() {
        $get = I('get.');
        if ($get) {
            $result = M("shopmessage")->where(['shopid' => $get['shopid']])->find();
            $evaluate = M("evaluate")->where(['eid' => $get['eid']])->find();
            $user = M('user')->where(['uid' => $evaluate['uid']])->find();
            $this->assign("username", $user['username']);
            $this->assign('result', $result);
            $this->assign('evaluate', $evaluate);
            $this->display('particulars5');
        }
    }

    /**
     * 配送费
     */
    public function peisong() {
        $get = I('get.');
        if ($get) {
            $result = M("shopmessage")->where(['shopid' => $get['shopid']])->find();
            $this->assign('result', $result);
            $session = session('username');
            $this->assign("session", $session);
            $this->display('particulars6');
        }
    }

    /**
     * 修改添加配送规则
     */
    public function addpeisong() {
        if (IS_PSOT) {
            $post = I('post.');
            $data = array(
                'lkmoney' => $post['lkmoney'],
                'maxprice' => $post['maxprice'],
                'maxlong' => $post['maxlong'],
                'maxmoney' => $post['maxmoney'],
                'lmoney' => $post['lmoney'],
                'long' => $post['long'],
            );
            $result = M('shopmessage')->where(['shopid' => $post['shopid']])->save($data);
            if ($result == 1) {
                $this->ajaxReturn(['status' => 1, "msg" => "成功。"]);
            } else if ($result == 0) {
                $this->ajaxReturn(['status' => 0, "msg" => "修改信息无变化。"]);
            } else if ($result == false) {
                $this->ajaxReturn(['status' => 2, "msg" => "失败。"]);
            }
        }
    }

    /**
     * 通过结算
     */
    public function passok() {
        $post = I("post.");
        $result = M('orders')->where(['shopid' => $post['id'], 'statu' => 2, 'states' => 1])->where(array("state" => array("in", "3,4,5")))
                        ->where("updatetime < '{$post['time']}'")->save(['states' => 2]);
        if ($result) {
            $this->ajaxReturn(['status' => 1]);
        } else {
            $this->ajaxReturn(['status' => 0]);
        }
    }

    /**
     * 修改账号
     */
    public function edituser() {
        $post = I('post.');
        $result = M('shop')->where(['shopid' => $post['shopid']])->save(['phone' => $post['username']]);
        if ($result) {
            $this->ajaxReturn(['status' => 1]);
        } else {
            $this->ajaxReturn(['status' => 0]);
        }
    }

    /**
     * 菜单拖动程序定位
     */
    public function movecategory() {
        $post = I("post.");
//        $this->ajaxReturn(['msg'=>$post]);
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
                                    } else {
                                        M("category")->rollback();
                                        $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的下标记为移动后的下条信息id失败3"]);
                                    }
                                } else {
                                    //修改自身移动后的下标记为0
                                    $editselfend = M('category')->where(['cid' => $self['cid']])->save(['end' => 0]);
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
                                    } else {
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
                            $editselfup = M('category')->where(['cid' => $self['cid']])->save(['up' => -1]);
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
                                    } else {
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
                $editbeforupup = M('category')->where(['cid' => $self['up']])->save(['end' => 0]);
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
                                } else {
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
                        $editselfup = M('category')->where(['cid' => $self['cid']])->save(['up' => -1]);
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
                                } else {
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
                $editbeforupend = M('category')->where(['cid' => $self['end']])->save(['up' => -1]);
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
                                } else {
                                    M("category")->rollback();
                                    $this->ajaxReturn(['status' => 0, "msg" => "修改自身移动后的下标记为移动后的下条信息id失败12"]);
                                }
                            } else {
                                //修改自身移动后的下标记为0
                                $editselfend = M('category')->where(['cid' => $self['cid']])->save(['end' => 0]);
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
                                } else {
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

    /**
     * 添加商品模板
     */
    public function addgoods() {
        $shopid = I("get.shopid");
        $cid = I("get.cid");
        $result = M('category')->where(['shopid' => $shopid])->select();
        $this->result = $result;
        $this->shopid = $shopid;
        $username = session("username");
        $this->assign("session", $username);
        $this->cid = $cid;
        $this->display('addMenu');
    }

    /**
     * 添加商品时返回图片和商品主要信息
     */
    public function addalls() {
        $post = I('post.');
        //图片信息接收上传
        $files = array();
        if ($_FILES) {
            foreach ($_FILES as $k => $fileInfo) {
                $files[$k] = $this->uploadFile($fileInfo);
            }
        } else {
            $files['img'] = "";
        }
        $post['img'] = $files['img'];
        $this->ajaxReturn($post);
    }

    /**
     * 添加商品
     */
    public function addalls1() {
        $post = I('post.');
        M('shopgoods')->startTrans();
        $shopgoods = array(
            'goodsname' => $post['cc']['goodsname'],
            'goodsphoto' => $post['cc']['img'],
            'goodsprice' => $post['cc']['dishprice'],
            'goodscontent' => $post['cc']['dishname'],
            'cid' => $post['cc']['belongmenu'],
            'zhekou' => $post['cc']['dishdiscount'],
            'shopid' => $post['cc']['shopid'],
            'addtime' => date("Y-m-d H:i:s", time()),
        );
        $goods = M('shopgoods')->add($shopgoods);
        if ($goods == true) {
            if (!empty($post['aa']) && !empty($post['bb'])) {
                foreach ($post['aa'] as $k => $v) {
                    $post['aa'][$k]['goodsid'] = $goods;
                    $post['aa'][$k]['addtime'] = date("Y-m-d H:i:s",time());
                }
                $guige = M('guige')->addall($post['aa']);
                if ($guige) {
                    foreach ($post['bb'] as $k => $v) {
                        $post['bb'][$k]['goodsid'] = $goods;
                        $post['bb'][$k]['addtime'] = date("Y-m-d H:i:s",time());
                    }
                    $peicai = M('pcaidan')->addall($post['bb']);
                    if ($peicai) {
                        M('shopgoods')->commit();
                        $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                    } else {
                        M('shopgoods')->rollback();
                        $this->ajaxReturn(['status' => 0, "msg" => "配菜添加失败"]);
                    }
                } else {
                    M('shopgoods')->rollback();
                    $this->ajaxReturn(['status' => 0, "msg" => "商品规格添加错误"]);
                }
            } else if (!empty($post['aa']) && empty($post['bb'])) {
                foreach ($post['aa'] as $k => $v) {
                    $post['aa'][$k]['goodsid'] = $goods;
                    $post['aa'][$k]['addtime'] = date("Y-m-d H:i:s",time());
                }
                $guige = M('guige')->addall($post['aa']);
                if ($guige) {
                    M('shopgoods')->commit();
                    $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                } else {
                    M('shopgoods')->rollback();
                    $this->ajaxReturn(['status' => 0, "msg" => "商品规格添加错误"]);
                }
            } else if (empty($post['aa']) && !empty($post['bb'])) {
                foreach ($post['bb'] as $k => $v) {
                    $post['bb'][$k]['goodsid'] = $goods;
                    $post['bb'][$k]['addtime'] = date("Y-m-d H:i:s",time());
                }
                $peicai = M('pcaidan')->addall($post['bb']);
                if ($peicai) {
                    M('shopgoods')->commit();
                    $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
                } else {
                    M('shopgoods')->rollback();
                    $this->ajaxReturn(['status' => 0, "msg" => "配菜添加失败"]);
                }
            } else if (empty($post['aa']) && empty($post['bb'])) {
                M('shopgoods')->commit();
                $this->ajaxReturn(['status' => 1, "msg" => "成功"]);
            }
        } else {
            M('shopgoods')->rollback();
            $this->ajaxReturn(['status' => 0, "msg" => "商品基本信息添加失败，请重新添加"]);
        }
    }

    /**
     * 商品详情
     */
    public function checkgoods() {
        $goodsid = I("get.goodsid");
        $goods = M("shopgoods")->where(["goodsid"=>$goodsid])->find();
        $guige = M('guige')->where(["goodsid"=>$goodsid])->select();
        $caidan = M('pcaidan')->where(["goodsid"=>$goodsid])->select();
        $result = M('category')->where(['shopid' => $goods['shopid']])->select();
        $this->result = $result;
        $session = session('username');
        $this->assign("session", $session);
        $this->goods = $goods;
        $this->guige = $guige;
        $this->caidan = $caidan;
        $this->display('addmegoods');
    }
    /**
     * 修改商品图片
     */
    public function editphoto(){
        if ($_FILES) {
            foreach ($_FILES as $k => $fileInfo) {
                $files[$k] = $this->uploadFile($fileInfo);
            }
        }
        $post = I('post.');
        $data = array('goodsphoto'=>$files['img']);
        $result = M('shopgoods')->where(['goodsid'=>$post['goodsid']])->save($data);
        if($result == true){
           $this->ajaxReturn(['status'=>1]);
        }else if($result == 0){
            $this->ajaxReturn(['status'=>2]);
        }else if($result == false){
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 修改商品自身信息
     */
    public function editself(){
        $post = I('post.');
        $data = array(
            'goodsname'=>$post['goodsname'],
            'goodsprice'=>$post['dishprice'],
            'cid'=>$post['belongmenu'],
            'zhekou'=>$post['dishdiscount'],
            'goodscontent'=>$post['dishname'],
        );
        $result = M('shopgoods')->where(['goodsid'=>$post['goodsid']])->save($data);
        if($result = true){
            $this->ajaxReturn(['status'=>1]);
        }else if($result == 0){
            $this->ajaxReturn(['status'=>2]);
        }else if($result == false){
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 修改页面添加规格
     */
    public function addguiges(){
        $post = I("post.");
        $data =array(
            'goodsid'=>$post['goodsid'],
            'guige'=>$post['guige'],
            'primoney'=>$post['primoney'],
            'addtiem'=>date("Y-m-d H:i:s",time())
        );
        $result = M('guige')->add($data);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 删除规格
     */
    public function deleteguiges(){
        $post = I('post.gid');
        $result = M('guige')->delete($post);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 修改规格
     */
    public function editguiges(){
        $post = I('post.');
        $data = array(
            'guige'=>$post['editguige'],
            'primoney'=>$post['editprice']
        );
        $reuslt = M('guige')->where(['gid'=>$post['gid']])->save($data);
        if($reuslt == true){
            $this->ajaxReturn(['status'=>1]);
        }else if($reuslt == 0){
            $this->ajaxReturn(['status'=>2]);
        }else if($reuslt == false){
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 添加配菜菜单
     */
    public function addpeicais(){
        $post = I('post.');
        $data = array(
            'goodsid'=>$post['goodsid'],
            'pcaidan'=>$post['peicai'],
            'addtime'=>date("Y-m-d H:i:s",time())
        );
        $result = M('pcaidan')->add($data);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 删除配菜菜单
     */
    public function deletepcaidan(){
        $post = I("post.pid");
        $result = M('pcaidan')->delete($post);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 修改配菜菜单
     */
    public function editpcaidan(){
        $post = I('post.');
        $data = array(
          'pcaidan'=>$post['caidan'],
        );
        $result = M('pcaidan')->where(['pid'=>$post['pid']])->save($data);
        if($result == true){
            $this->ajaxReturn(['status'=>1]);
        }else if($result == 0){
            $this->ajaxReturn(['status'=>2]);
        }else if($result == false){
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 查看配菜菜品
     */
    public function checkpgood(){
        $get = I("get.");
        $fid = trim($get['id']);
        $count = M('pcgoods')->where(['fid'=>$fid])->count();
        $page = new \Org\Page\Page($count, 5);
        $page->setConfig('header', '<span class="rows" style="color:#7d7d7d;">共<i class="blue">%TOTAL_ROW%</i>条记录&nbsp;第<i class="blue">%NOW_PAGE%</i>页/共<i class="blue">%TOTAL_PAGE%</i>页</span>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;     //最后一页不显示为总页数
        $page->rollPage = 10;          //分页栏每页显示的页数
        $show = $page->show();
        $result = M('pcgoods')
                ->where(['fid'=>$fid])
                ->order("addtime desc")
                ->limit($page->firstRow, $page->listRows)
                ->select();
        $peicai = M('pcaidan')->where(['goodsid'=>$get['goodsid']])->select();
        $this->peicai = $peicai;
        $this->count = $count;
        $this->result = $result;
        $this->show = $show;
        $this->id = $fid;
        $session = session('username');
        $this->assign("session", $session);
        $this->display('system7');
    }
    /**
     * 添加配菜
     */
    public function addpeicaid(){
        $post = I('post.');
        $post['addtime'] = date("Y-m-d H:i:s",time());
        $result = M('pcgoods')->add($post);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 修改配菜
     */
    public function editpcpeicai(){
        $post = I('post.');
        $data = array(
            'pcname'=>$post['name'],
            'pcprice'=>$post['price']
        );
        $result = M('pcgoods')->where(['pcid'=>$post['fid']])->save($data);
        if($result == true){
            $this->ajaxReturn(['status'=>1]);
        }else if($result == 0){
            $this->ajaxReturn(['status'=>2]);
        }else if($result == false){
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 删除配菜菜品
     */
    public function deletepeicai(){
        $post = I('post.id');
        $result = M('pcgoods')->delete($post);
        if($result){
            $this->ajaxReturn(['status'=>1]);
        }else{
            $this->ajaxReturn(['status'=>0]);
        }
    }
    /**
     * 修改营业时间
     */
    public function edityingye(){
        $get = I('get.');
        $result = M("shopmessage")->where(['shopid' => $get['shopid']])->find();
        if(strpos($result['monday'],",")){
            $array = explode(",", $result['monday']);
            $up = explode("-", $array[0]);
            $end= explode("-", $array[1]);
            $result['upf'] = $up[0];
            $result['ups'] = $up[1];
            $result['endf'] = $end[0];
            $result['ends'] = $end[1];
        }else{
            $array = explode("-",$result['monday']);
            $result['upf'] = $array[0];
            $result['ups'] = $array[1];
            $result['endf'] = "";
            $result['ends'] = "";
        }
        $this->result = $result;
        $session = session('username');
        $this->assign("session", $session);
        $this->display("particulars10");
    }
}
