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
    <link rel="stylesheet" href="/Public/admin/css/css.css">
    <link rel="stylesheet" href="/Public/admin/css/part.css">
    <script type="text/javascript" src="/Public/admin/js/jquery-1.9.1.js"></script>
    <style>
        .right2_top{
            margin: 35px 30px 20px;
        }
        .right2_top select{
            width:150px;
            height:35px;
            border:1px solid #bbb;
            border-radius:5px;
            text-indent: 5px;
        }
        #updateAll{
            float: right;
            width: 150px;
            height:35px;
            line-height: 35px;
            text-align: center;
            border-radius:5px;
            background:#1d79c5;
            color:#fff;
            border:none;
            outline: none ;
            cursor: pointer;
            font-size: 14px;
        }
        ul{
            list-style: none;
        }
        .right2_content{
            width:400px;
            margin: 0px auto 20px;
        }
        .right2_content li{
            width:100%;
            height: 3em;
            line-height: 3em;
        }
        .input1{
            text-align: center;
        }
        .input1 input{
            width:34%;
            height:2em;
            line-height: 2em;
        }
        .input1 span{
            display: inline-block;
            width:15%;
            height:2em;
            line-height: 2em;
            text-align: center;
        }
        .form_btn{
            margin-top:60px;
        }
        .btn{
            width: 30%;
            height: 35px;
            color:#fff;
            text-align: center;
            line-height: 35px;
            border:none;
            outline: none;
            cursor: pointer;
            font-size: 14px;
        }
        .form_btn span{
            background: green;
            float: left;
        }
        .form_btn input{
            background: red;
            float: right;
        }
        /*弹框*/
        .shadow,.shadow_box{
            width:100%;
            height: 100%;
            position: fixed;
            z-index: 100;
            display: none;
        }
        .shadow{
            background: #000;
            opacity:0.7 ;
            z-index: 100;
        }
        .shadow_box{
            z-index: 101;
        }
        .shadow_content{
            display: none;
            width:450px;
            height:330px;
            position: absolute;
            top:50%;
            left:50%;
            margin-top:-200px;
            margin-left:-165px;
            background: #fff;
            border:1px solid #bbb;
            border-radius: 10px;
        }
        .shadow_content ul{
            width:90%;
            margin:0 auto;
        }
        .shadow_content li{
            width:100%;
            height: 4em;
            line-height: 4em;
        }
        .title{
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            line-height: 2em;
        }
        .input2 span{
            display: inline-block;
            width: 3em;
            text-align: center;
        }
        .input2 input{
            width: 34%;
            height:2em;
        }
        input.btn2{
            float: right;
        }
        span.btn2{
            float: left;
            display: inline-block;
        }
        .btn2 {
            width:45%;
            height: 2em;
            line-height: 2em;
            text-align: center;
            border-radius:5px;
            background:#1d79c5;
            color:#fff;
            border:none;
            outline: none ;
            cursor: pointer;
            font-size: 14px;
            margin-top:3em;
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
                    <li>营业时间</li>
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

        <div class="right2">
            <div class="zhong">
                <div class="zuo">
                    <div class="zuo1">
                       <?php echo ($result["shopname"]); ?>
                    </div>
                    <div class="zuo2">
                        <div class="zuo-1">
                            <<img src="/<?php echo ($result["shophead"]); ?>" alt="">
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
                        <div style="width:135px;" class="you-3">
                            <input type="button" value="Send Message">
                        </div>
                    </div>
                    <div class="right_2">
                        <form action="">
                            <p class="right2_top">
                                <select name="week" id="week">
                                    <option value="1">星期一</option>
                                    <option value="2">星期二</option>
                                    <option value="3">星期三</option>
                                    <option value="4">星期四</option>
                                    <option value="5">星期五</option>
                                    <option value="6">星期六</option>
                                    <option value="7">星期日</option>
                                </select>
                                <span id="updateAll">统一修改营业时间</span>
                            </p>
                            <ul class="right2_content">
                                <li>必填</li>
                                <li class="input1"><input type="text" class="upstart" placeholder="请输入开店时间" name="" value ="<?php echo ($result["upf"]); ?>"/><span>~</span><input type="text" class="upclose" placeholder="请输入闭店时间" name="" value ="<?php echo ($result["ups"]); ?>"/></li>
                                <li>选填</li>
                                <li class="input1"><input type="text" class="endstart" placeholder="请输入开店时间" name=""value ="<?php echo ($result["endf"]); ?>"/><span>~</span><input type="text" class="endclose" placeholder="请输入闭店时间" name=""value ="<?php echo ($result["ends"]); ?>"/></li>
                                <li class="form_btn">
                                    <span class="btn">取消</span>
                                    <input class="btn editss" type="button" value="保存"/>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--弹框-->
    <div class="shadow"></div>
    <div class="shadow_box">
        <div class="shadow_content">
            <ul>
                <li class="title"><p>统一设定营业时间</p></li>
                <li class="input2">
                    <span>必填：</span>
                    <input type="text" name=""/>
                    <span>~</span>
                    <input type="text" name=""/>
                </li>
                <li class="input2">
                    <span>选填：</span>
                    <input type="text" name=""/>
                    <span>~</span>
                    <input type="text" name=""/>
                </li>
                <li>
                    <span class="btn2 cancel">取消</span>
                    <input class="btn2" type="button" value="保存"/>
                </li>
            </ul>
        </div>
    </div>
</div>
</body>
<script>
    $("#updateAll").click(function(){
        $(".shadow").show();
        $(".shadow_box").show();
        $(".shadow_content").show();
        $(".shadow_content input[type='text']").val("");
    });
    $(".cancel").click(function(){
        $(".shadow").hide();
        $(".shadow_box").hide();
        $(".shadow_content").hide();
    })
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
            $(".editss").click(function(){
                var week = $("#week").val();
                var upstart = $(".upstart").val();
                var upclose = $(".upclose").val();
                var endstart = $(".endstart").val();
                var endclose = $(".endclose").val();
                $.ajax({
                    type: 'POST',
                    url: "<?php echo U('User/edityingyetime');?>",
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
            });
        });
</script>
</html>