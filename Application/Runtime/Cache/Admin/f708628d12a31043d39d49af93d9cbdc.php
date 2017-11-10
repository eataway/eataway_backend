<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>澳洲外卖</title>
        <link rel="stylesheet" href="/Public/admin/css/style.css">
        <script type="text/javascript" src="/Public/admin/js/jquery-3.1.1.min.js"></script>
    </head>
    <body>
        <div class="worp">
            <div class="worp1">
                <div class="tu">
                    <div class="tu1">
                        <img src="/Public/admin/img/Logo_01.png" alt="">
                    </div>
                </div>
                <form>
                    <div class="inner">
                        <div class="inner1">
                            <input type="text" id="name" name="username" placeholder="Enter Your Login Name">
                            <p>
                                <img src="/Public/admin/img/03.png" alt="">
                            </p>
                        </div>
                        <div class="inner2">
                            <input type="password" id="pwd" name="password" placeholder="Enter Your Password">
                            <p>
                                <img src="/Public/admin/img/icon_02.png" alt="">
                            </p>
                        </div>
                        <div class="inner3">
                            <input id='sub' type="button" onclick="check()"  value="Login">
                        </div>
<!--                        <div class="inner4">
                            <a href="register.html">
                                Lost Your Password?
                            </a>
                        </div>-->
                    </div>
                </form>
                <div class="footer">
<!--                    <p>
                        <a href="register.html">
                            Register
                        </a>
                    </p>
                    <p>
                        <img src="/Public/admin/img/arrow.png" alt="">
                    </p>-->
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function check() {
                var username = $("#name").val();
                var pwd = $("#pwd").val();
                $.ajax({
                        type: 'POST',
                        url: "<?php echo U('Login/login');?>",
                        data: {username:username,password:pwd},
                        dataType:"json",
                        success : function(data) {
                            if(data.status == 3){
                               alert("账号密码不能为空。");
                            }else if(data.status == 2){
                                alert("用户不存在。");
                            }else if(data.status == 4){
                                alert("密码错误。");
                            }else if(data.status == 1){
                                window.location.href="<?php echo U('Index/index');?>";
                            }
                        }
                });
//                 
            }
        </script>
    </body>
</html>