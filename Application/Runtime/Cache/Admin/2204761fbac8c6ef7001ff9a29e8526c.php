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
<link rel="stylesheet" href="/Public/admin/css/part1.css">
<script type="text/javascript" src="/Public/admin/js/jquery-1.9.1.js"></script>
</head>

<body>
       
    	<div class="right">
    		<div class="right1">
    			<div class="dao">
    				<ul>
    					<li>商户详情</li>
    					<li>></li>
    					<li>菜单</li>
                        <li>></li>
                        <li>菜品</li>
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
                                <input type="submit" value="删除该用户">
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
                        </div>

                        <div class="you1">
                            <div class="you2">
                                <p>
                                    <?php echo ($caidan); ?>
                                </p>
                                <p>
                                    菜单数
                                </p>
                            </div>
                            <div class="you3">
                                <p>
                                    <?php echo ($count); ?>
                                </p>
                                <p>
                                    菜品数
                                </p>
                            </div>
                        </div>

                        <div class="you-z">
                            <div class="you-z1">
                                <p>
                                    当前所在菜单：<?php echo ($self["cname"]); ?>
                                </p>
                            </div>
                            <div class="you-z2">
                                <div class="you-z3">
                                    <div class="biao">
                    <div class="top">
                        <a class="btn_addmenu" href="/index.php/Admin/User/addgoods?cid=<?php echo ($self["cid"]); ?>&shopid=<?php echo ($result["shopid"]); ?>">添加菜品</a>
                    </div>
                    <div class="cen">
                       <table>
                            <tr class="ee">
<!--                                <td width="60">
                                    <input type="checkbox" class="cen1">
                                </td>-->
                                <td width="80">
                                    <div class="cen2">
                                        ID
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="cen2">
                                        菜品名称
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="cen2">
                                        菜品销量（/日）
                                    </div>
                                </td>
                                <td width:"200">
                                    <div class="cen2">
                                        操作
                                    </div>
                                </td>
                            </tr>
                            <?php if(is_array($goodsinfos)): foreach($goodsinfos as $k=>$v): if($k%2 == 0): ?><tr class="ee1">
<!--                                <td width="60">
                                    <input type="checkbox" class="cen1">
                                </td>-->
                                <td width="80">
                                    <div class="cen2 id">
                                        <?php echo ($v["goodsid"]); ?>
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="cen5">
                                        <?php echo ($v["goodsname"]); ?>
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="cen5">
                                        <?php echo ($v["num"]); ?>
                                    </div>
                                </td>
                                <td width="200">
                                    <div class="cen4">
                                        <input type="button" value="" class="refresh">
                                     <input type="button" value="" class="delete">
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                            <tr class="ee">
<!--                                <td width="60">
                                    <input type="checkbox" class="cen1">
                                </td>-->
                                <td width="80">
                                    <div class="cen2 id">
                                        <?php echo ($v["goodsid"]); ?>
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="cen5">
                                         <?php echo ($v["goodsname"]); ?>
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="cen5">
                                       <?php echo ($v["num"]); ?>
                                    </div>
                                </td>
                                <td width="200">
                                    <div class="cen4">
                                        <input type="button" value="" class="refresh">
                                     <input type="button" value="" class="delete">
                                    </div>
                                </td>
                            </tr><?php endif; endforeach; endif; ?>
                           
                        </table>
                    </div>
                    <div class="ter">
                        <div class="ter1">
<!--                            <p>
                                Show
                            </p>
                            <select name="" id="">
                                <option value=""></option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                            <p>
                                entries
                            </p>-->
                        </div>
                        <div class="ter2">
                            <table>
                                <tr>
                                    <?php echo ($show); ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
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
	$(function() {
            $("input[type=submit]").click(function(){
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
                            window.location.reload();
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
            $(".refresh").click(function(){
                var goodsid = $(this).parents("tr").find(".id").text();
                window.location.href="/index.php/Admin/User/checkgoods?goodsid="+goodsid;
                   
            })
            $(".delete").click(function(){
                var a=confirm("确认要删除吗？删除后不可恢复。");
               var goodsid = $(this).parents("tr").find(".id").text();
                if(a == true){
                    $.ajax({
                    type: 'POST',
                    url: "<?php echo U('User/deletegoods');?>",
                    data: {goodsid: goodsid},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("删除菜品成功。");
                            window.location.reload();
                        } else if (data.status == 0) {
                            alert("删除失败");
                        }
                    }
                });
                }
//                    
            })
            $('.outs').click(function(){
                window.location.href="<?php echo U('Login/logout');?>";
        })    
           

        })
</script>
</html>