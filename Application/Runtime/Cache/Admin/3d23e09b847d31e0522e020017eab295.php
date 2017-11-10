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
<title>澳洲外卖</title>
<link rel="stylesheet" href="/Public/admin/css/authenticated.css">
<link rel="stylesheet" href="/Public/admin/css/css.css">
<link rel="stylesheet" href="/Public/admin/css/right.css">
<link rel="stylesheet" href="/Public/admin/css/page.css"/>
<script type="text/javascript" src="/Public/admin/js/jquery-1.9.1.js"></script>
<style type="text/css">
    .addNew{        
        width: 280px;
        float: left;
        padding: 0px 0px 0px 10px;
        margin: 13px 0px 0px 20px;
        color: #fff;
        text-align: right;
    }
    .top1{
        width:140px;
        border-radius: 10px;
    }
    .cen2{     
        margin: 14px 8px 14px 8px;
        color: #fff;
    }
    .ee div,.ee1 div{
        color: #fff;
    }
    .left{
        position: absolute;
    }
    .right{
        float: right;
        position: absolute;
        right: 0;        
        overflow-y: hidden;
    }
    .refresh{
        background: none;
    }
    .Ordersearch{
        float: left;
        width: 50px;
        height: 30px;
        line-height: 30px;
        background: #2BAF2B;
        text-align: center;
        border-radius: 5px;
        margin: 10px 0px 0px 20px;
        cursor: pointer;
        color:#fff;
    }
    .right{
        overflow-y: auto;
    }
</style>
</head>

        <div class="right">
            <div class="right1">
                <div class="dao">
                    <ul>
                        <li>首页</li>
                        <li>></li>
                        <li>订单统计</li>
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
                        <p>
                            切换账号
                        </p>
                        <p>
                            退出
                        </p>
                    </div>

                </div>
            </div>

            <div class="right4">
                <ul>
                    <li>
                    <div class="r2">
                        <a href="<?php echo U('Index/index');?>">
                            <p><?php echo ($renzheng); ?></p>
                            <p>新认证商家</p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="r2">
                        <a href="<?php echo U('Index/jiaoyi');?>">
                            <p><?php echo ($jiaoyi); ?></p>
                            <p>商家交易额</p>
                        </a>
                    </div>
                </li>
                <li>
                    <div class="r2">
                        <a href="<?php echo U('Index/tuidan');?>">
                            <p><?php echo ($tuidan); ?></p>
                            <p>未处理退单申请</p>
                        </a>
                    </div>
                </li>
                     <li>
                        <div class="r1">
                            <p><?php echo ($allorders); ?></p>
                            <p>订单统计</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="right3">
                <div class="biao">
                    <div class="top">
                        <select name="states" id="states" class="top1">
                            <option value="1"<?php if($getstates == 1): ?>selected<?php endif; ?>>未接单</option>
                            <option value="2"<?php if($getstates == 2): ?>selected<?php endif; ?>>已接单</option>
                            <option value="3"<?php if($getstates == 3): ?>selected<?php endif; ?>>已完成</option>
                        </select>
                        <select name="times" id="times" class="top1">
                            <option value="1"<?php if($gettimes == 1): ?>selected<?php endif; ?>>5分钟内</option>
                            <option value="2"<?php if($gettimes == 2): ?>selected<?php endif; ?>>15分钟内</option>
                            <option value="3"<?php if($gettimes == 3): ?>selected<?php endif; ?>>1小时内</option>
                            <option value="4"<?php if($gettimes == 4): ?>selected<?php endif; ?>>1天内</option>
                            <option value="5"<?php if($gettimes == 5): ?>selected<?php endif; ?>>全部</option>
                        </select>
                        <div class="Ordersearch">筛选</div>
                        <div class="addNew">订单数：&nbsp;&nbsp;
                        <span><?php echo ($count); ?></span></div>
<!--                        <div class="top2">
                            <input type="button">
                            <input type="text" placeholder="Search">
                        </div>-->
                    </div>
                    <div class="cen">
                        <table>
                            <tr class="ee">                                
                                <td>
                                    <div class="cen2">
                                        订单号
                                    </div>
                                </td>
                                <td>
                                    <div class="cen2">
                                        商户名称
                                    </div>
                                </td>
                                <td>
                                    <div class="cen2">
                                        商铺电话
                                    </div>
                                </td>
                                <td>
                                    <div class="cen2">
                                        商铺地址
                                    </div>
                                </td>
                                <td>
                                    <div class="cen2">
                                        订单价格
                                    </div>
                                </td>
                                <td>
                                    <div class="cen2">
                                        订单日期
                                    </div>
                                </td>
                                <td>
                                    <div class="cen2">
                                        操作
                                    </div>
                                </td>
                            </tr>
                            <?php if(is_array($result)): foreach($result as $k=>$v): if($k%2 == 0): ?><tr class="ee1">                                
                                <td>
                                    <div class="ben3">
                                        <?php echo ($v["orderid"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen5">
                                        <?php echo ($v["shopname"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen5">
                                       <?php echo ($v["mobile"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen5">
                                       <?php echo ($v["detailed_address"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen5">
                                       $<?php echo ($v["allprice"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen5">
                                       <?php echo ($v["addtime"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen4">
                                    <a href="particulars.html" class="refresh">
                                        <!-- <input type="button" value="" class="refresh"> -->
                                        <img src="/Public/admin/img/icon_eye.png" alt="">
                                    </a>
                                    </div>
                                </td>
                            </tr>
                            <?php else: ?>
                            <tr class="ee">                                
                                <td>
                                    <div class="ben3">
                                        <?php echo ($v["orderid"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen5">
                                        <?php echo ($v["shopname"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen5">
                                       <?php echo ($v["mobile"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen5">
                                       <?php echo ($v["detailed_address"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen5">
                                       $<?php echo ($v["allprice"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen5">
                                       <?php echo ($v["addtime"]); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="cen4">
                                    <a href="particulars.html" class="refresh">
                                        <!-- <input type="button" value="" class="refresh"> -->
                                        <img src="/Public/admin/img/icon_eye.png" alt="">
                                    </a>
                                    </div>
                                </td>
                            </tr><?php endif; endforeach; endif; ?>
                        </table>
                         <tr>
                                <?php echo ($show); ?>
                            </tr>
                    </div>
<!--                    <div class="ter">
                        <div class="ter2">
                            <table>
                               
                            </table>
                        </div>
                    </div>-->
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
        $('.Ordersearch').click(function(){
            var states = $("#states").val();
            var times = $("#times").val();
            window.location.href="/index.php/Admin/Index/ordermingxi?states="+states+"&times="+times;
        })
    })
    
    
</script>
</html>