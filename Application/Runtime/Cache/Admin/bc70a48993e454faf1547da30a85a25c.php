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
                            <a href="http://wm.sawfree.com/server">
                                <li>
                                    <p>
                                        <img src="/Public/admin/img/4_2_nor.png" alt="">
                                    </p>
                                    <p>
                                        客服
                                    </p>
                                </li>
                            </a>
                            <a href="<?php echo U('Index/kefu');?>">
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
        <link rel="stylesheet" href="/Public/admin/css/authenticated.css">
        <link rel="stylesheet" href="/Public/admin/css/part.css">
        <link rel="stylesheet" href="/Public/admin/css/part1.css">
    </head>

    <body>
    
    <div class="right">
        <div class="right1">
            <div class="dao">
                <ul>
                    <li>商户管理</li>
                    <li>></li>
                    <li>商家交易额</li>
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

        <div class="right4">
            <ul>
                    <li>
                        <div class="r2">
                            <a href="<?php echo U('User/ready');?>">
                            <p><?php echo ($yirenzheng); ?></p>
                            <p>已认证</p>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="r2">
                            <a href="<?php echo U('User/index');?>">
                            <p><?php echo ($renzheng); ?></p>
                            <p>认证中</p>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="r2">
                            <a href="<?php echo U('User/tuidan');?>">
                            <p><?php echo ($tuidan); ?></p>
                            <p>商户申请</p>
                            </a>
                        </div>
                    </li>
                     <li>
                        <div class="r1">
                            <a href="<?php echo U('User/jiaoyi');?>">
                            <p><?php echo ($jiaoyi); ?></p>
                            <p>商户交易额</p>
                            </a>
                        </div>
                    </li>
                </ul>
        </div>

        <div class="right3">
            <div class="biao">
                <div class="top">
                    <!--                        <select name="" id="" class="top1">
                                                <option value="">
                                                    排序方式
                                                </option>
                                            </select>-->
                    <div class="top2">
                        <input class="sousuo" type="button">
                        <input value="<?php echo ($shopname); ?>" class="sou" type="text" placeholder="Search">
                    </div>
                </div>
                <div class="cen">
                    <table>
                        <tr class="ee">
                            <!--                                <td width="60">
                                                                <input type="checkbox" class="cen1">
                                                            </td>-->
                            <td width="120">
                                <div class="cen2">
                                    ID
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen2">
                                    商户名称
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen2">
                                    联系方式
                                </div>
                            </td>
                            <td width="300">
                                <div class="cen2">
                                    上次结算至今总交易额
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen2">
                                    状态
                                </div>
                            </td>
                            <td width="150">
                                <div class="cen2">
                                    操作
                                </div>
                            </td>
                        </tr>
                        <?php if(is_array($result)): foreach($result as $k=>$v): if($k%2 == 0): ?><tr class="ee1">
                                    <!--                                <td width="60">
                                                                        <input type="checkbox" class="cen1">
                                                                    </td>-->
                                    <td width="80">
                                        <div class="cen2 id">
                                            <?php echo ($v["shopid"]); ?>
                                        </div>
                                    </td>
                                    <td width="120">
                                        <div class="cen5">
                                            <?php echo ($v["shopname"]); ?>
                                        </div>
                                    </td>
                                    <td width="150">
                                        <div class="cen5">
                                            <?php echo ($v["mobile"]); ?>
                                        </div>
                                    </td>
                                    <td width="300">
                                        <div class="cen5">
                                            <?php echo ($v["money"]); ?>
                                        </div>
                                    </td>
                                    <td width="150">
                                        <div class="cen5">
                                            未结算
                                        </div>
                                    </td>
                                    <td width="150">
                                        <div class="cen4">
                                            <input type="button" value="" class="right_t">
                                            <input type="hidden" value="<?php echo ($time); ?>" class="time">
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
                                            <?php echo ($v["shopid"]); ?>
                                        </div>
                                    </td>
                                    <td width="120">
                                        <div class="cen5">
                                            <?php echo ($v["shopname"]); ?>
                                        </div>
                                    </td>
                                    <td width="150">
                                        <div class="cen5">
                                            <?php echo ($v["mobile"]); ?>
                                        </div>
                                    </td>
                                    <td width="300">
                                        <div class="cen5">
                                            <?php echo ($v["money"]); ?>
                                        </div>
                                    </td>
                                    <td width="150">
                                        <div class="cen5">
                                            未结算
                                        </div>
                                    </td>
                                    <td width="150">
                                        <div class="cen18">
                                            <input type="button" value="" class="right_t">
                                            <input type="hidden" value="<?php echo ($time); ?>" class="time">
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
</body>
<script>
//  $(".left").height($(window).height());
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
</script>
<script>
    $(function() {
        $('.right_t').click(function() {
            var a = confirm("结算后不可恢复，你确认要结算吗？");
            var id = $(this).parents("tr").find(".id").text();
            var time = $(".time").val();
            if (a == true) {
                $.ajax({
                    type: 'POST',
                    url: "/index.php/Admin/User/passok",
                    data: {id: id, time: time},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("结算成功");
                            window.location.reload();
                        } else if (data.status == 2) {
                            alert("出错了！");
                        }
                    }
                });
            }

        })
        $('.sousuo').click(function() {
            var shopname = $('.sou').val();
            if (shopname !== null) {
                window.location.href = '/index.php/Admin/User/jiaoyis?shopname=' + shopname;
            }
        })
        $('.outs').click(function() {
            window.location.href = "<?php echo U('Login/logout');?>";
        })
    })

</script>
</html>