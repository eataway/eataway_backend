<?php

namespace Home\Controller;

use Think\Controller;
use Think\Upload;
date_default_timezone_set('Australia/South');
class UserController extends Controller {
    public $path="http://wm.sawfree.com/";
    /**
     * 用户注册,直接登录
     * @2017.6.12
     */
    public function register() {
        if (IS_POST) {
            $post = I('post.');
            $mobile = $post['mobile'];
            $pwd = $post['password'];
            //检查手机号是否已经注册
            $vmobi = M('user')->field("uid")->where(['mobile' => $mobile])->find();
            if (!empty($vmobi)) {
                //手机号已经注册
                $this->ajaxReturn(['status' => 2, 'userid' => '', 'token' => '']);
            }
            $userid = M('user')->add(['username' => 'EA_' . $mobile, 'mobile' => $mobile, 'password' => $pwd, 'flag' => '1']);
            if ($userid) {
                    $token = md5('EA_' . $mobile . time());
                    $this->ajaxReturn(['status' => 1, 'userid' => $userid, 'token' => $token]);
            } else {
                $this->ajaxReturn(['status' => 0, 'userid' => '', 'token' => '']);
            }
        }
    }

    /**
     * 验证手机号是否注册
     * @2017.6.12
     */
    public function veri_mobile() {
        if (IS_POST) {
            $post = I('post.');
            $mobile = $post['mobile'];
            if (empty($mobile)) {
                //手机号为空
                $this->ajaxReturn(['status' => 4]);
            }
            if (!is_numeric($mobile)) {
                $this->ajaxReturn(['status' => 5]);
            }
            //检查手机号是否已经注册
            $vmobi = M('user')->field("uid")->where(['mobile' => $mobile])->find();
            if (!empty($vmobi)) {
                //手机号已经注册
                $this->ajaxReturn(['status' => 2]);
            } else {
                //手机号可以注册
                $this->ajaxReturn(['status' => 3]);
            }
        }
    }
    /**
     * 换帮手机号
     */
    public function editmobile() {
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $mobile = $post['mobile'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            //修改手机号
            $data = array(
                'mobile'=>$mobile,
            );
            $result = M('user')->where(['uid' => $userid])->save($data);
            if ($result) {
                //成功
                $this->ajaxReturn(['status' => 1,"msg"=>""]);
            } else {
                //失败
                $this->ajaxReturn(['status' => 0,"msg"=>""]);
            }
        }
    }

    /**
     * 用户登录
     * @2017.6.12
     */
    public function login() {
        if (IS_POST) {
            $post = I('post.');
            $mobile = $post['mobile'];
            $pwd = $post['password'];
            if (empty($mobile)) {
                //手机号为空
                $this->ajaxReturn(['status' => 4]);
            }
            if (!is_numeric($mobile)) {
                $this->ajaxReturn(['status' => 5]);
            }
            $info = M('user')->field("uid,username")->where(['mobile' => $mobile, 'password' => $pwd])->find();
            if (empty($info)) {
                //输入有误
                $this->ajaxReturn(['status' => 0, 'userid' => '', 'token' => '']);
            } else {
                //登录成功
                $token = md5($username . time());
                S("token" . $info['uid'], $token);
                $this->ajaxReturn(['status' => 1, 'userid' => $info['uid'], 'token' => $token]);
            }
        }
    }

    /**
     * 用户第三方登录
     * @2017.6.12
     */
    public function third_login() {
        if (IS_POST) {
            $post = I('post.');
            $type = $post['type'];
            $username = $post['username'];
            $openid = $post['openid'];
            switch ($type) {
                //微信登录
                case 'wechat':
                    $info = M('user')->field("uid,username")->where(['wechat_openid' => $openid])->find();
                    if (empty($info)) {
                        //该微信号未注册
                        $userid = M('user')->add(['username' => $username, 'wechat_openid' => $openid, 'flag' => '1']);
                        if ($userid) {
                            //注册成功,直接登录
                            $token = md5($username . time());
                            S("token" . $userid, $token);
                            $this->ajaxReturn(['status' => 1, 'userid' => $userid, 'token' => $token]);
                        } else {
                            $this->ajaxReturn(['status' => 0, 'userid' => '', 'token' => '']);
                        }
                    } else {
                        //登录成功
                        $token = md5($username . time());
                        S("token" . $info['uid'], $token);
                        $this->ajaxReturn(['status' => 1, 'userid' => $info['uid'], 'token' => $token]);
                    }
                    break;
                //facebook登录
                case 'facebook':
                    $info = M('user')->field('uid,username')->where(['facebook_opendid'=> $openid])->find();
                    if (empty($info)) {
                        //该facebook号未注册
                        $userid = M('user')->add(['username' => $username, 'facebook_opendid' => $openid, 'flag' => '1']);
                        if ($userid) {
                            //注册成功,直接登录
                            $token = md5($username . time());
                            S("token" . $userid, $token);
                            $this->ajaxReturn(['status' => 1, 'userid' => $userid, 'token' => $token]);
                        } else {
                            $this->ajaxReturn(['status' => 0, 'userid' => '', 'token' => '']);
                        }
                    } else {
                        //登录成功
                        $token = md5($username . time());
                        S("token" . $info['uid'], $token);
                        $this->ajaxReturn(['status' => 1, 'userid' => $info['uid'], 'token' => $token]);
                    }
                    break;

            }
        }
    }

    /*
     * 用户第三方注册
     * @2017.6.12
     */
    /* public function third_register(){
      if (IS_POST) {
      $post = I('post.');
      $type = $post['type'];
      $username = $post['username'];
      $openid = $post['openid'];
      $user = M('user');
      switch ($type) {
      case 'wechat':
      //验证微信是否已经注册
      $veri = $user -> field("uid") -> where(['wechat_openid' => $openid]) -> find();
      if (!empty($veri)) {
      //已经注册
      $this -> ajaxReturn(['status' => 2,'userid' => '','token' => '']);
      }
      $userid = $user -> add(['username' => $username,'wechat_openid' => $openid,'flag' => '1']);
      if ($userid) {
      //注册成功,直接登录
      $token = md5($username . time());
      S("token" . $userid,$token);
      $this -> ajaxReturn(['status' => 1,'userid' => $userid,'token' => $token]);
      } else {
      $this -> ajaxReturn(['status' => 0,'userid' => '','token' => '']);
      }
      break;

      case 'facebook':
      //验证facebook是否已经注册
      $veri = $user -> field("uid") -> where(['facebook_openid' => $openid]) -> find();
      if (!empty($veri)) {
      //已经注册
      $this -> ajaxReturn(['status' => 2,'userid' => '','token' => '']);
      }
      $userid = $user -> add(['username' => $username,'facebook_openid' => $openid,'flag' => '1']);
      if ($userid) {
      //注册成功,直接登录
      $token = md5($username . time());
      S("token" . $userid,$token);
      $this -> ajaxReturn(['status' => 1,'userid' => $userid,'token' => $token]);
      } else {
      $this -> ajaxReturn(['status' => 0,'userid' => '','token' => '']);
      }
      break;

      default:
      # code...
      break;
      }
      }
      } */
    /*
     * 找回密码
     * 2017.6.14
     */

    public function replay_password() {
        if (IS_POST) {
            $post = I('post.');
            $mobile = $post['mobile'];
            $pwd = $post['password'];
            $user = M('user');
            $veri = $user->field("uid")->where(['mobile' => $mobile])->find();
            if (empty($veri)) {
                //该手机号未注册
                $this->ajaxReturn(['status' => 2]);
            }
            $rst = $user->where(['mobile' => $mobile])->setField('password', $pwd);
            if ($rst !== false) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /*
     * 个人中心
     * 2017.6.14
     */

    public function personal_center() {
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $info = M('user')->field("username,mobile,head_photo")->find($userid);
            if (!empty($info['head_photo'])) {
                $info['head_photo'] = $this->path . $info['head_photo'];
            } else {
                $info['head_photo'] = "";
            }
            if($info){
                $this->ajaxReturn(['status' => 1, 'msg' => $info]);
            }else{
                $this->ajaxReturn(['status' => 0, 'msg' => array()]);
            }
            
        }
    }

    /*
     * 用户修改头像
     * 2017.6.15
     */

    public function edit_headpic() {
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9]);
            }
            $user = M('user');
            //差不就头像,保存到变量中
            $user_pic = $user->field("head_photo")->find($userid);
            //实例化上传类
            $cfg = [
                'rootPath' => WORKING_PATH . UPLOAD_PATH . '/Headpic/',
                'subName' => array('date', 'Y-m')
            ];
            $upload = new Upload($cfg);
            $info = $upload->uploadOne($_FILES['photo']);
            //修改头像
            if ($info) {
                $head_pic = UPLOAD_PATH . '/Headpic/' . $info['savepath'] . $info['savename'];
                $rst = $user->where(['uid' => $userid])->setField('head_photo', $head_pic);
                if ($rst !== false) {
                    //删除旧头像
                    unlink(WORKING_PATH . $user_pic['head_photo']);
                    $this->ajaxReturn(['status' => 1]);
                } else {
                    $this->ajaxReturn(['status' => 0]);
                }
            } else {
                //没有检测到图片
                $this->ajaxReturn(['status' => 2]);
            }
        }
    }

    /*
     * 修改用户名
     * @date 2017.6.15
     */

    public function edit_username() {
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $token = $post['token'];
            $username = $post['username'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9]);
            }
            $rst = M('user')->where(['uid' => $userid])->setField('username', $username);
            if ($rst !== false) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /*
     * 用户退出登录
     * @date 2017.6.15
     */

    public function logout() {
        $userid = I('post.userid');
        S("token" . $userid, null);
    }

    /*
     * 获取收货地址
     * @date 2017.6.15
     */

    public function get_address() {
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9, 'msg' => []]);
            }
            $info = M('ShippingAddress')
                    ->field("addid,userid,real_name,gender,mobile,location_address,coordinate,detailed_address,flag")
                    ->where(['userid' => $userid])
                    ->order("addid desc")
                    ->select();
            if (empty($info)) {
                $this->ajaxReturn(['status' => 1, 'msg' => []]);
            }
            foreach ($info as $key => $value) {
                if ($value['add_sex'] == '1') {
                    $info[$key]['add_sex'] = "先生";
                } else {
                    $info[$key]['add_sex'] = "女士";
                }
            }
            $this->ajaxReturn(['status' => 1, 'msg' => $info]);
        }
    }

    /*
     * 新增收货地址
     * @date 2017.6.15
     */

    public function add_address() {
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9]);
            }
            $real_name = $post['real_name'];
            $gender = $post['gender'];  //1先生,2女士
            $mobile = $post['mobile'];
            $location_address = $post['location_address'];
            $detailed_address = $post['detailed_address'];
            $coordinate = $post['coordinate'];
            //将默认地址取消
            $addre = M('ShippingAddress');
            $addre->where(['userid' => $userid, 'flag' => '1'])->setField('flag', '0');
            $data = [
                'userid' => $userid,
                'real_name' => $real_name,
                'gender' => $gender,
                'mobile' => $mobile,
                'location_address' => $location_address,
                'detailed_address' => $detailed_address,
                'coordinate' => $coordinate,
                'flag' => '1'
            ];
            $addid = $addre->add($data);
            if ($addid) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /*
     * 批量删除收货地址
     * @date 2017.6.15
     */

    public function alldel_address() {
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9]);
            }
            $str_addid = $post['str_addid'];   //地址id(2,3,4,5);
            $rst = M('ShippingAddress')->delete($str_addid);
            if ($rst !== false) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /*
     * 编辑收货地址
     * @date 2017.6.15
     */

    public function edit_address() {
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9]);
            }
            $addid = $post['addid'];
            $real_name = $post['real_name'];
            $gender = $post['gender'];  //1先生,2女士
            $mobile = $post['mobile'];
            $location_address = $post['location_address'];
            $coordinate = $post['coordinate'];
            $detailed_address = $post['detailed_address'];
            $data = [
                'userid' => $userid,
                'real_name' => $real_name,
                'gender' => $gender,
                'mobile' => $mobile,
                'coordinate' => $coordinate,
                'location_address' => $location_address,
                'detailed_address' => $detailed_address,
            ];
            $rst = M('ShippingAddress')->where(['addid' => $addid])->save($data);
            if ($rst !== false) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /*
     * 用户设置默认地址
     * @date 2017.6.15
     */

    public function set_address() {
        if (IS_POST) {
            $post = I('post.');
            $userid = $post['userid'];
            $token = $post['token'];
            if ($token != S("token" . $userid)) {
                $this->ajaxReturn(['status' => 9]);
            }
            $addid = $post['addid'];  //地址id
            //将默认地址取消
            $addre = M('ShippingAddress');
            $addre->where(['userid' => $userid, 'flag' => '1'])->setField('flag', '0');
            $rst = $addre->where(['addid' => $addid])->setField('flag', '1');
            if ($rst !== false) {
                $this->ajaxReturn(['status' => 1]);
            } else {
                $this->ajaxReturn(['status' => 0]);
            }
        }
    }

    /*
     * 用户添加/修改头像
     * @date 2017.6.22
     */

    public function set_photo() {
        $post = I('post.');
        $userid = $post['userid'];
        $token = $post['token'];
        if ($token != S("token" . $userid)) {
            $this->ajaxReturn(['status' => 9]);
        }
        //图片信息接收上传
            if ($_FILES) {
                foreach ($_FILES as $k => $fileInfo) {
                    $files[$k] = $this->uploadFile($fileInfo);
                }
            }
        $data = array(
                "head_photo" => $files['photo'],
            );
            $result = M("user")->where(['uid' => $userid])->field("head_photo")->save($data);
            if ($result) {
                $this->ajaxReturn(['status' => 1, 'msg' => ""]);
            }else{
                $this->ajaxReturn(['status' => 0, 'msg' => ""]);
            }
    }

  

  

}
