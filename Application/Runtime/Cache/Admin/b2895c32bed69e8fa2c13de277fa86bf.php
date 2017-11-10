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
<link rel="stylesheet" href="/Public/admin/css/css.css">
<link rel="stylesheet" href="/Public/admin/css/part1.css">
<script type="text/javascript" src="/Public/admin/js/jquery-1.9.1.js"></script>
</head>

<body>
  
    	<div class="right">
    		<div class="right1">
    			<div class="dao">
    				<ul>
    					<li>系统</li>
    					<li>></li>
    					<li>意见反馈</li>
                        <li>></li>
                        <li>反馈详情</li>
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
                		<p class='outs'>
                    退出
                </p>
                	</div>

                </div>
    		</div>

            <div class="right2">
                <div class="zhong">
                    <div class="zuo">
                        <div class="zuo1">
                            <?php echo ($user["username"]); ?>
                        </div>
                        <div class="zuo2">
                            <div class="zuo-1">
                                <?php if($user["head_photo"] == null): ?><img src="/Public/admin/img/raw.jpeg" alt="没有头像">
                            <?php else: ?>
                            <img src="/<?php echo ($user["head_photo"]); ?>" alt="没有头像"><?php endif; ?>
                            </div>
                            <div class="zuo-2">
                                <input type="hidden" value="<?php echo ($user["uid"]); ?>"/>
                                <input type="submit" value="删除该用户">
                            </div>
                        </div>
                        <div class="zuo3">
<!--                            <ul>
                                <a href="party1.html">
                                    <li>
                                    用户信息
                                </li>
                                </a>
                                <a href="party2.html">
                                    <li>
                                    用户订单
                                </li>
                                </a>
                                <a href="party3.html">
                                    <li>
                                    用户评论
                                </li>
                                </a>
                            </ul>-->
                        </div>
                    </div>


                    <div class="you">
                        <div class="you-1">
                           
                             <div class="you-2">
                                <p>
                                    <img src="/Public/admin/img/icon_phone.png" alt="">
                                </p>
                                <p><?php echo ($user["mobile"]); ?></p>
                            </div>
<!--                            <div class="you-31">
                                <input type="button" value="Send Message">
                            </div>-->
                        </div>


                        <div class="you-z">
                            <div class="infor1">
                                <div class="infor">
                                    <p>
                                        反馈用户
                                    </p>
                                    <p>
                                        <?php echo ($user["username"]); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="infor2">
                                <div class="infor4">
                                    <ul>
                                        <li>
                                            <p class="for">
                                                反馈内容
                                            </p>
                                            <!-- <p class="for1">
                                                <img src="/Public/admin/img/icon_delete_02.png" alt="">
                                            </p> -->
                                            <!--<input type="button" class="for1">-->
                                        </li>
                                        <li>
                                             <div class="for2">
                                                <textarea name="" id="" cols="30" rows="10"><?php echo ($back["content"]); ?></textarea>
                                            </div>
                                        </li>
<!--                                        <li>
                                            <div class="for3">
                                                <p></p><p></p><p></p><p></p><p></p>
                                                <span>打分</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="for4">
                                                2017-09-28
                                            </div>
                                        </li>-->
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    		</div>
    	</div>
    </div>
</body>
<script>
//	$(".left").height($(window).height());
</script>
<script>
	// $(".right").height($(window).height());
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
</script>
<script>
    $(function(){
        $('input[type=submit]').click(function(){
            var uid = $('input[type=hidden]').val();
            var a = confirm("确认要删除吗？");
            if(a == true){
                $.ajax({
                type:"POST",
                url:"<?php echo U('Shop/deleteuser');?>",
                data:{uid:uid},
                dataType:"json",
                success:function(data){
                    if(data.status == 1){
                        alert("删除成功。");
                        window.location.reload();
                    }else{
                        alert("删除失败。");
                    }
                }
                   
            });
            }
            
        })
        $('.outs').click(function(){
                window.location.href="<?php echo U('Login/logout');?>";
        })
    })
</script>
</html>