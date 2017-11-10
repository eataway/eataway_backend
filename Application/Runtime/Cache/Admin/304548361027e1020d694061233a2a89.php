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
        <link rel="stylesheet" href="/Public/admin/css/authenticated.css">
        <script type="text/javascript" src="/Public/admin/js/jquery-1.9.1.js"></script>
    </head>

    <body>
    
    <div class="right">
        <div class="right1">
            <div class="dao">
                <ul>
                    <li>用户管理</li>
                    <li>></li>
                    <li>用户</li>
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
            <div class="r3">
                <p><?php echo ($count); ?></p>
                <p>用户</p>
            </div>
        </div>

        <div class="right3">
            <div class="biao">
                <div class="top">
<!--                    <select name="" id="" class="top1">
                        <option value="">
                            排序方式
                        </option>
                    </select>-->
                     <div class="top2">
                    <input class="sousuo" type="button">
                    <input value="<?php echo ($name); ?>" class="sou" type="text" placeholder="Search">
                </div>
                </div>
                <div class="cen">
                    <table>
                        <tr class="ee">
<!--                            <td width="60">
                                <input type="checkbox" class="cen1">
                            </td>-->
                            <td width="80">
                                <div class="cen2">
                                    ID
                                </div>
                            </td>
                            <td width="240">
                                <div class="cen2">
                                    用户昵称
                                </div>
                            </td>
                            <td width="240">
                                <div class="cen2">
                                    联系方式
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen2">
                                    下单数
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen2">
                                    交易额
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen2">
                                    用户状态
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen2">
                                    操作
                                </div>
                            </td>
                        </tr>
                        <?php if(is_array($userinfo)): foreach($userinfo as $k=>$v): if($k%2 == 0): ?><tr class="ee1">
<!--                            <td width="60">
                                <input type="checkbox" class="cen1">
                            </td>-->
                            <td width="80">
                                <div class="cen2 id">
                                    <?php echo ($v["uid"]); ?>
                                </div>
                            </td>
                            <td width="240">
                                <div class="cen5">
                                    <?php echo ($v["username"]); ?>
                                </div>
                            </td>
                            <td width="240">
                                <div class="cen5">
                                    <?php echo ($v["mobile"]); ?>
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen5">
                                    <?php echo ($v["num"]); ?>
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen5">
                                   <?php echo ($v["money"]); ?>
                                </div>
                            </td>
                             <td>
                                <div class="cen4" width="150">
                                    <?php if($v["flag"] == 1): ?><div class="cen4" width="150">
                                    <input type="button" value="启用" class="start">
                                </div>
                            <?php elseif($v["flag"] == 0): ?>
                            <input type="button" value="停用" class="stop"><?php endif; ?>
                                </div>
                            </td>

                            <td>
                                <div class="cen4" width="150">
                                    <a href="/index.php/Admin/Shop/userdetail?uid=<?php echo ($v["uid"]); ?>">
                                        <input type="button" value="" class="right_t1">
                                    </a>
                                    <input type="button" value="" class="error_t1">
                                </div>
                            </td>
                        </tr>
                        <?php else: ?>
                        <tr class="ee">
<!--                            <td width="60">
                                <input type="checkbox" class="cen1">
                            </td>-->
                            <td width="80">
                                <div class="cen2 id">
                                    <?php echo ($v["uid"]); ?>
                                </div>
                            </td>
                            <td width="240">
                                <div class="cen5">
                                    <?php echo ($v["username"]); ?>
                                </div>
                            </td>
                            <td width="240">
                                <div class="cen5">
                                    <?php echo ($v["mobile"]); ?>
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen5">
                                   <?php echo ($v["num"]); ?>
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen5">
                                   <?php echo ($v["money"]); ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen4" width="150">
                                    <?php if($v["flag"] == 1): ?><div class="cen4" width="150">
                                    <input type="button" value="启用" class="start">
                                </div>
                            <?php elseif($v["flag"] == 0): ?>
                            <input type="button" value="停用" class="stop"><?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen4" width="150">
                                    <a href="/index.php/Admin/Shop/userdetail?uid=<?php echo ($v["uid"]); ?>">
                                        <input type="button" value="" class="right_t1">
                                    </a>
                                    <input type="button" value="" class="error_t1">
                                </div>
                            </td>
                        </tr><?php endif; endforeach; endif; ?>
                        </table>
                    </table>
                </div>
                <div class="ter">
                    <div class="ter1">
<!--                        <p>
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
</body>
<script>
//	$(".left").height($(window).height());
</script>
<script>
    $(".right").height($(window).height());
</script>
<script>
    $(document).ready(function() {
        $("#l1").click(function() {
            $("#pen").slideToggle("slow");
            $(".span").toggle(500);
            $("#l1").toggleClass("l1");
        })
    });
</script>
<script>
    $(document).ready(function() {
        $("#l2").click(function() {
            $("#pen1").slideToggle("slow");
            $(".span1").toggle(500);
            $("#l2").toggleClass("l1");
        })
    });
</script>
<script>
    $(document).ready(function() {
        $("#l3").click(function() {
            $("#pen2").slideToggle("slow");
            $(".span2").toggle(500);
            $("#l3").toggleClass("l1");
        })
    });
</script>
<script>
    $(document).ready(function() {
        $("#l4").click(function() {
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
    $(document).ready(function() {
        $(".dao2").click(function() {
            $(".dao3").slideToggle("slow");
        })
    });
</script>
<script>
    $(".ee").css({background: "#4D4D4D"});
    $(".ee1").css({background: "#9C9C9C"});
    $(".ee2").css({background: "#242424"});
    $(".ter").css({background: "#4D4D4D"});
</script>
<script>
	$(function() {
            $(".start").click(function(){
                var uid = $(this).parents("tr").find(".id").text();
                    $.ajax({
                    type: 'POST',
                    url: "<?php echo U('Shop/stops');?>",
                    data: {uid: uid},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("禁用成功。");
                            window.location.reload();
                        } else if (data.status == 0) {
                            alert("禁用失败");
                        }
                    }
                });
            })
            $(".stop").click(function(){
               var uid = $(this).parents("tr").find(".id").text();
                    $.ajax({
                    type: 'POST',
                    url: "<?php echo U('Shop/starts');?>",
                    data: {uid: uid},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("启用成功。");
                            window.location.reload();
                        } else if (data.status == 0) {
                            alert("启用失败");
                        }
                    }
                });
            })
           $('.error_t1').click(function(){
               var uid = $(this).parents('tr').find('.id').text();
               var a = confirm("确定要删除吗？");
               if(a == true){
                   $.ajax({
                    type: 'POST',
                    url: "<?php echo U('Shop/deleteuser');?>",
                    data: {uid: uid},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("删除成功。");
                            window.location.reload();
                        } else if (data.status == 0) {
                            alert(data.msg);
                        }
                    }
                });
               }
               
           })
           $('.sousuo').click(function(){
            var username = $('.sou').val();
            if(username !== null){
                window.location.href='/index.php/Admin/Shop/userlists?username='+username;
            }
        })
        $('.outs').click(function(){
                window.location.href="<?php echo U('Login/logout');?>";
        })
        })
</script>
</html>