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
                            <a href="<?php echo U('Index/ordermingxi');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/1_1_nor.png" alt="">
                                    </p>
                                    <p>
                                        订单明细
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
                            <a href="<?php echo U('Root/youhuilist');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/4_3_nor.png" alt="">
                                    </p>
                                    <p>
                                        优惠码管理
                                    </p>
                                </li>
                            </a>
                            <a href="<?php echo U('Index/kefu');?>">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/4_2_nor.png" alt="">
                                    </p>
                                    <p>
                                        客服
                                    </p>
                                </li>
                            </a>
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
<link rel="stylesheet" href="/Public/admin/css/right.css">
<script type="text/javascript" src="/Public/admin/js/jquery-1.9.1.js"></script>
<link rel="stylesheet" href="/Public/admin/css/part.css">
<style>
    .yoa{
	width:15%;
	float: left;
	margin:10px 0px 10px 20px;
/*	border:1px solid black;*/
}
.yoa p:nth-child(1){
	display: block;
	width:100%;
	font-size: 1.8em;
	text-align: center;
	padding:5px 0px 5px 0px;
}
.yoa p:nth-child(2){
	display: block;
	width:100%;
	font-size: 1em;
	text-align: center;
	padding:2px 0px 2px 0px;
}
.shade{
    opacity:0.3;
    background:#000;
    position:fixed;
    top:0;
    bottom:0;
    left:0;
    right:0;
    z-index:9;
}
.lay{
    width:400px;
    height:250px;
    background: #fff;
    z-index:10;
    position:absolute;
    left:35%;
    top:20%;
    border-radius: 2px;
}
.lay ul li{
    list-style: none;
    width:90%;
    margin:2% auto;
}
.content_lay{
    height:2em;
    width:70%;
    margin-top:5%;
}
.exit_lay1,.submit_lay{
    width:100px;
    height:2.2em;
    background: #175d97;
    border:none;
    color:#fff;
    margin-top:8%;
}
.submit_lay{
    float:right;
}
.title_lay{
    text-align: center;
    font-size:20px;
    font-weight: bold;
    margin-top:35px !important;
}
.you-1{
    height:65px;
}
</style>
</head>

<body>
   
    	<div class="right">
    		<div class="right1">
    			<div class="dao">
    				<ul>
    					<li>商户详情</li>
    					<li>></li>
    					<li>商户信息</li>
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
                            <?php echo ($result["shopname"]); ?>
                        </div>
                        <div class="zuo2">
                            <div class="zuo-1">
                            <img src="/<?php echo ($result["shophead"]); ?>" alt="">
                            </div>
                            <div class="zuo-2">
                                <input type="hidden" value="<?php echo ($result["shopid"]); ?>">
                                <input class="dle" type="submit" value="删除该用户">
                            </div>
                        </div>
                        <div class="zuo3">
                            <ul>
                                <a href="/index.php/Admin/User/forms?shopid=<?php echo ($result["shopid"]); ?>">
                                    <li>
                                    商户信息
                                </li>
                                </a>
                                <a href="/index.php/Admin/User/orderlist?shopid=<?php echo ($result["shopid"]); ?>">
                                    <li>
                                    订单
                                </li>
                                </a>
                                <a href="/index.php/Admin/User/category?shopid=<?php echo ($result["shopid"]); ?>">
                                    <li>
                                    菜单
                                </li>
                                </a>
                                <a href="/index.php/Admin/User/pingjia?shopid=<?php echo ($result["shopid"]); ?>">
                                    <li>
                                    商户评论
                                </li>
                                </a>
                               <a href="/index.php/Admin/User/peisong?shopid=<?php echo ($result["shopid"]); ?>">
                                    <li>
                                    配送费
                                </li>
                                </a>
                               <a href="/index.php/Admin/User/edityingye?shopid=<?php echo ($result["shopid"]); ?>">
                                    <li>
                                    营业时间
                                </li>
                                </a>
                            </ul>
                        </div>
                    </div>


                    <div class="you">
                        <div class="you-1">
                            <div class="you-2">
                                <p>
                                    <img src="/Public/admin/img/icon_location.png" alt="">
                                </p>
                                <p><?php echo ($result["detailed_address"]); ?></p>
                            </div>
                             <div class="you-2">
                                <p>
                                    <img src="/Public/admin/img/icon_phone.png" alt="">
                                </p>
                                <p><?php echo ($result["mobile"]); ?></p>
                            </div>
                           
                            <div class="you-3">
                                <?php if($result["states"] == 2): ?><input class="backs" type="button" value="撤回推荐">
                                <?php elseif($result["states"] == 1): ?>
                                    <input class="pass" type="button" value="推荐"><?php endif; ?>
                            </div>
                             <div class="you-3" style="width:100px;">
                                <input type="button" value="修改账号" id="update_num">
                            </div>
                        </div>

                        <div class="you1">
                            <div class="yoa">
                                <p>
                                    <?php echo ($count); ?>
                                </p>
                                <p>
                                    订单数
                                </p>
                            </div>
                            <div class="yoa">
                                <p>
                                    $<?php echo ($weixinmoney); ?>
                                </p>
                                <p>
                                    微信成交额
                                </p>
                            </div>
                            <div class="yoa">
                                <p>
                                    $<?php echo ($zhifumoney); ?>
                                </p>
                                <p>
                                    支付宝成交额
                                </p>
                            </div>
                            <div class="yoa">
                                <p>
                                    $<?php echo ($brainmoney); ?>
                                </p>
                                <p>
                                    Braintree成交额
                                </p>
                            </div>
                            <div class="yoa">
                                <p>
                                    $<?php echo ($money); ?>
                                </p>
                                <p>
                                    总成交额
                                </p>
                            </div>
                        </div>

                        <div class="you-z">
                            <p>User Pictures</p>
                            <div class="you-z1">
                                <img src="/<?php echo ($result["shopphoto"]); ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    		</div>
    	</div>
    </div>
    <div class="shade" style="display:none;"></div>
    <div class="lay" style="display:none;">
        <form>
            <ul>
                <li class="title_lay">修改账号</li>
                <li>商户账号： <input type="text" id="username" class="content_lay" value="<?php echo ($username); ?>"> </li>
                <li>
                    <input type="button" value="取消" class="exit_lay1">
                    <input type="button" value="提交" class="submit_lay">
                </li>
            </ul>
        </form>
    </div>
</body>
<script>
//	$(".left").height($(window).height());
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
</script>
<script>
	$(function() {
            $(".dle").click(function(){
                var shopid = $("input[type=hidden]").val();
                var a = confirm("删除后不可恢复，你确认要删除吗？");
                if(a == true){
                    $.ajax({
                    type: 'POST',
                    url: "<?php echo U('User/deleteuser');?>",
                    data: {shopid: shopid},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("删除成功。");
                            window.location.href="/index.php/Admin/User/ready";
                        } else if (data.status == 2) {
                            alert("删除商铺信息出错");
                        } else if (data.status == 3) {
                            alert("删除商铺基本信息出错");
                        }
                    }
                });
                }
            })
            $(".pass").click(function(){
                var shopid = $("input[type=hidden]").val();
                    $.ajax({
                    type: 'POST',
                    url: "<?php echo U('User/shoutui');?>",
                    data: {shopid: shopid},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("首推成功。");
                            window.location.reload();
                        } else if (data.status == 0) {
                            alert("首推失败");
                        }
                    }
                });
            })
            $(".backs").click(function(){
                var shopid = $("input[type=hidden]").val();
                    $.ajax({
                    type: 'POST',
                    url: "<?php echo U('User/backshoutui');?>",
                    data: {shopid: shopid},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("撤销首推成功。");
                            window.location.reload();
                        } else if (data.status == 0) {
                            alert("撤销首推失败");
                        }
                    }
                });
            })
            $('.outs').click(function(){
                window.location.href="<?php echo U('Login/logout');?>";
        })    
           

        })
</script>
<script>
    $(function(){
        $('#update_num').click(function(){
            $('.shade').css('display','block');
            $('.lay').css('display','block');
        })
        $('.exit_lay1').click(function(){
            $('.shade').css('display','none');
            $('.lay').css('display','none');
        })
        var shopid = $("input[type=hidden]").val();
        $('.submit_lay').click(function(){
            var username = $("#username").val();
            $.ajax({
                    type: 'POST',
                    url: "<?php echo U('User/edituser');?>",
                    data: {shopid: shopid,username:username},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("修改成功。");
                            window.location.reload();
                        } else if (data.status == 0) {
                            alert("失败");
                        }
                    }
                });
        })
    })
</script>
</html>