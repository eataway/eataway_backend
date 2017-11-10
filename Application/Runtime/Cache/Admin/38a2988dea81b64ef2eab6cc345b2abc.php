<?php if (!defined('THINK_PATH')) exit();?>
<div class="warp">
    <div class="left">
        <div class="left1">
            <p>
                <!-- <img src="/Public/admin/img/1_3_nor.png" alt=""> -->
                EatAway
            </p>
        </div>
        <!--    		<div class="left2">
                                <input type="text">
                                <input type="button">
                        </div>-->
        <div class="left3">
            <ul>
                <li>
                    <div id="l1">
                        <p>
                            <img src="/Public/admin/img/01_nor.png" alt="">
                        </p>
                        <p>
                            首页
                        </p>
                        <span class="span">
                            ﹀
                        </span>
                    </div>
                    <div id="pen">
                        <ul>
                            <a href="<?php echo U('Index/index');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/1_1_nor.png" alt="">
                                    </p>
                                    <p>
                                        新认证商家
                                    </p>
                                </li>
                            </a>
                            <a href="<?php echo U('Index/jiaoyi');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/1_1_nor.png" alt="">
                                    </p>
                                    <p>
                                        商家交易额
                                    </p>
                                </li>
                            </a>
                            <a href="<?php echo U('Index/tuidan');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/1_1_nor.png" alt="">
                                    </p>
                                    <p>
                                        未处理退单申请
                                    </p>
                                </li>
                            </a>
                        </ul>
                    </div>
                </li>


                <li>
                    <div id="l2">
                        <p>
                            <img src="/Public/admin/img/03_nor.png" alt="">
                        </p>
                        <p>
                            商户管理
                        </p>
                        <span class="span1">
                            ﹀
                        </span>
                    </div>
                    <div id="pen1">
                        <ul>
                            <a href="<?php echo U('User/ready');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/1_1_nor.png" alt="">
                                    </p>
                                    <p>
                                        已认证
                                    </p>
                                </li>
                            </a>
                            <a href="<?php echo U('User/index');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/1_1_nor.png" alt="">
                                    </p>
                                    <p>
                                        认证中
                                    </p>
                                </li>
                            </a>
                            <a href="<?php echo U('User/tuidan');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/1_1_nor.png" alt="">
                                    </p>
                                    <p>
                                        商户申请
                                    </p>
                                </li>
                            </a>
                            <a href="<?php echo U('User/jiaoyi');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/1_1_nor.png" alt="">
                                    </p>
                                    <p>
                                        商户交易额
                                    </p>
                                </li>
                            </a>
                        </ul>
                    </div>
                </li>


                <li>
                    <div id="l3">
                        <p>
                            <img src="/Public/admin/img/1_1_nor.png" alt="">
                        </p>
                        <p>
                            用户管理
                        </p>
                        <span class="span2">
                            ﹀
                        </span>
                    </div>
                    <div id="pen2">
                        <ul>
                            <a href="<?php echo U('Shop/userlist');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/1_1_nor.png" alt="">
                                    </p>
                                    <p>
                                        用户
                                    </p>
                                </li>
                            </a>

                        </ul>
                    </div>
                </li>


                <li>
                    <div id="l4">
                        <p>
                            <img src="/Public/admin/img/04_nor.png" alt="">
                        </p>
                        <p>
                            系统
                        </p>
                        <span class="span3">
                            ﹀
                        </span>
                    </div>
                    <div id="pen3">
                        <ul>
                            <a href="<?php echo U('Shop/tuilist');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/4_3_nor.png" alt="">
                                    </p>
                                    <p>
                                        客户端推荐
                                    </p>
                                </li>
                            </a>
<!--                            <a href="<?php echo U('Index/kefu');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/4_2_nor.png" alt="">
                                    </p>
                                    <p>
                                        客服
                                    </p>
                                </li>
                            </a>-->
                            <a href="<?php echo U('Shop/backlist');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/4_2_nor.png" alt="">
                                    </p>
                                    <p>
                                        意见反馈
                                    </p>
                                </li>
                            </a>
                            <a href="<?php echo U('Shop/outthis');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/4_2_nor.png" alt="">
                                    </p>
                                    <p>
                                        退出申请
                                    </p>
                                </li>
                            </a>
                        </ul>
                    </div>
                </li>
                
                <?php if($_SESSION['state'] == 2): ?><li>
                    <div id="l5">
                        <p>
                            <img src="/Public/admin/img/0.png" alt="">
                        </p>
                        <p>
                            管理员设置
                            
                        </p>
                        <span class="span4">
                            ﹀
                        </span>
                    </div>
                    <div id="pen4">
                        <ul>
                            <a href="<?php echo U('Root/roots');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/1_1_nor.png" alt="">
                                    </p>
                                    <p>
                                        管理员列表
                                    </p>
                                </li>
                            </a>
                        </ul>
                    </div>
                </li><?php endif; ?>
                
            </ul>
        </div>
    </div>

    <!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>EatAway</title>
<link rel="stylesheet" href="/Public/admin/css/authenticated.css">
<link rel="stylesheet" href="/Public/admin/css/css.css">
<link rel="stylesheet" href="/Public/admin/css/right.css">
<link rel="stylesheet" href="/Public/admin/css/install.css">
<script type="text/javascript" src="/Public/admin/js/jquery-1.9.1.js"></script>
</head>

<body>
  
        <div class="right">
            <div class="right1">
                <div class="dao">
                    <ul>
                        <li>管理员设置</li>
                        <li>></li>
                        <li>管理员列表</li>
                        <li>></li>
                        <li>新增账户</li>
                    </ul>
                </div>
                <div class="dao1">
                    <div class="dao2">
                        <div class="pian">
                            <img src="/Public/admin/img/icon_01.png" alt="">
                        </div>
                        <div class="pian1">
                            <p>
                                <?php echo ($session); ?>
                            </p>
                            <p>
                                ﹀
                            </p>
                        </div>
                    </div>
                    <div class="dao3">
                        <p class="outs">
                            退出
                        </p>
                    </div>

                </div>
            </div>


            <div class="rig-c">
               <div class="rig-c1">
                   新增账户信息
               </div>
               <div class="rig-c2">
                   <ul>
                       <li>
                           <label for="">用户名：</label>
                           <input name="username" value="<?php echo ($result["username"]); ?>" type="text" class="rig-c3 name">
                       </li>
                       <li>
                           <label for="">输入密码：</label>
                           <input name="password" type="password" class="rig-c3 pwd">
                       </li>
                       <li>
                           <label for="">再次确认密码：</label>
                           <input name="newpassword" type="password" class="rig-c3 news">
                           <input name="uid" type="hidden" value="<?php echo ($uid); ?>" >
                       </li>
                       <li>
                           <input type="button" class="rig-c4 oks" value="提交">
                           <input type="button" class="rig-c5 deletess" value="取消">
                       </li>
                   </ul>
               </div>
            </div>
        </div>
    </div>
</body>
<script>
//  $(".left").height($(window).height());
</script>
<script>
    $(".right").height($(window).height());
</script>
<script>
    $(document).ready(function(){
        $("#l1").click(function(){
            $("#pen").slideToggle("slow");
             $(".span").toggle(500);
               $("#l1").toggleClass("l1");
        })
    });
</script>
<script>
    $(document).ready(function(){
        $("#l2").click(function(){
            $("#pen1").slideToggle("slow");
             $(".span1").toggle(500);
               $("#l2").toggleClass("l1");
        })
    });
</script>
<script>
    $(document).ready(function(){
        $("#l3").click(function(){
            $("#pen2").slideToggle("slow");
             $(".span2").toggle(500);
               $("#l3").toggleClass("l1");
        })
    });
</script>
<script>
    $(document).ready(function(){
        $("#l4").click(function(){
            $("#pen3").slideToggle("slow");
             $(".span3").toggle(500);
               $("#l4").toggleClass("l1");
        })
    });
</script>
<script>
    $(document).ready(function(){
        $("#l5").click(function(){
            $("#pen4").slideToggle("slow");
             $(".span4").toggle(500);
               $("#l5").toggleClass("l1");
        })
    });
</script>
<script>
    $(document).ready(function(){
        $(".dao2").click(function(){
            $(".dao3").slideToggle("slow");
        })
    });
</script>
<script>
    $(".ee").css({ background: "#4D4D4D" });
    $(".ee1").css({ background: "#9C9C9C" });
     $(".ee2").css({ background: "#242424" });
     $(".ter").css({ background: "#4D4D4D" });
</script>
<script>
    $(function(){
        $('.oks').click(function(){
            var news = $('.news').val();
            var pwd = $('.pwd').val();
            var name= $('.name').val();
            if(news == ""){
                alert('确认密码不能为空。');
                die;
            }else if(pwd == ""){
                alert('新密码不能为空。');
                die;
            }else if(name == ""){
                alert('用户名不能为空。');
                die;
            }else if(pwd !== news){
                alert('两次新密码输入不一致');
                die;
            }
            $.ajax({
                type:"POST",
                url:"<?php echo U('Root/addrootin');?>",
                data:{name:name,news:news,pwd:pwd},
                dataType:"json",
                success:function(data){
                    if(data.status == 1){
                        alert(data.msg);
                        window.location.href="<?php echo U('Root/roots');?>";
                    }else if(data.status == 0){
                        alert(data.msg);
                    }
                }
            });
            
        })
        $('.deletess').click(function(){
            window.history.back(-1);
        })
        $('.outs').click(function(){
                window.location.href="<?php echo U('Login/logout');?>";
        })
    })
</script>
</html>