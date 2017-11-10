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
    <link rel="stylesheet" href="/Public/admin/css/right.css">
    <link rel="stylesheet" href="/Public/admin/css/page.css"/>
    <script type="text/javascript" src="/Public/admin/js/jquery-1.9.1.js"></script>
    <style>
        .right_one{
            width:98%;
            margin:0px auto;
            border-bottom: 1px solid #ccc;
            border-top:1px solid #ccc;
        }
        .cl:after{
            content:"";
            display: block;
            clear:both;
        }
        ul{
            list-style: none;
        }
        .right_one li{
            width:50%;
            float: left;
            text-align: center;
            font-weight: bold;
            margin: 1em 0 1.5em;
        }
        .right_one li div{
            font-size: 4em;
        }
        .right_one li p{
            font-size: 1em;
            margin-top:0.5em;
        }
        .right_one li p img{
            width: 1.2em;
            height: 1.2em;
            vertical-align: middle;
            cursor: pointer;
        }
        .right_two{
            width:98%;
            margin:0 auto;
        }
        .right_two div{
            padding-left: 35px;
            margin-top: 22px;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: -9px;
            border-left:8px solid #ccc;
        }
        .top_btn{
            padding:16px 10px;
            text-align: right;
        }
        .top_btn span{
            background: #3F51B5;
            padding:6px 40px;
            border-radius: 5px;
            font-size: 15px;
            color:#fff;
            cursor: pointer;
        }
        .operate{
            text-align: center;
        }
        .btn_disabled{
            padding: 5px 25px;
            background: #E51C23;
            color: #fff;
            outline: none;
            border: none;
            border-radius: 5PX;
            margin-right: 20px;
            cursor: pointer;
        }
        .btn_disabled_all{
            padding: 9px 40px;
            background: #E51C23;
            color: #fff;
            border-radius: 5PX;
            margin-right: 20px;
            cursor: pointer;
        }
       .btn_abled{
           padding: 5px 25px;
           background: #259B24;
           color: #fff;
           outline: none;
           border: none;
           border-radius: 5PX;
           margin-right: 20px;
           cursor: pointer;
       }
        .btn_edit{
            width:25px;
            height:25px;
            vertical-align: middle;
            margin-top: -4px;
            cursor: pointer;
        }
        .page{
            width:100%;
            background: #E8E8E8;
        }
        .page ul{
            padding-left:40px;
        }
        .page li{
            float: left;
            padding:20px 20px;
        }
        /*遮罩层*/
        .shadow,
        .shadow_box {
            width: 100%;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: none;
        }
        .shadow {
            z-index: 50;
            background: #000;
            opacity: 0.6;
        }
        .btn_edit{
            margin-left: 10px;
        }
        .shadow_content {
            box-sizing: border-box;
            position: absolute;
            z-index: 52;
            top: 50%;
            left: 50%;
            margin-top: -160px;
            margin-left: -135px;
            width: 350px;
            height: 270px;
            border-radius: 5px;
            background: #fff;
            padding: 40px 30px;
            font-size: 16px;
        }
        #edit1,#edit2{
            display: none;
        }
        .shadow_content > p {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        #edit1 ul,#edit2 ul{
            width: 100%;
        }
        #edit1 div,#edit2 div{
            width: 28%;
            float: left;
            height: 2.5em;
            line-height: 2.5em;
            clear: both;
            margin-bottom: 15px;
        }
        #edit1 input[type="text"],#edit2 input[type="text"]{
            width: 70%;
            height: 2.5em;
            float: left;
        }
        .form_btn{
            padding: 10px 48px;
            background: #3F51B5;
            color: #fff;
            outline: none;
            border: none;
            border-radius: 5PX;
            margin-right: 20px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 16px;
        }
        span.form_btn,.form_btn1{
            float: left !important;
            clear: both;
        }
        .form_btn1{
            background:#e51c23;
        }
        input.form_btn{
            margin-right: 0px;
            float: right;
        }
        .dao{
            width: 500px;
        }
        .right_one li {
            width: 100%;
            text-align: center;
            font-weight: bold;
            margin: 1em 0 1.5em;
        }
        .right_one{
            border:none;
        }
        .select_add{
            width: 140px;
            height: 30px;
            border-radius: 3px;
            float: left;
        }
        .hiddenid{
            display:none;
        }
        #edit2 div.close{
            position: absolute;
            top: 0px;
            right: 0px;
            width: 50px;
            height: 25px;
            background: #1c1c1c;
            color: #fff;
            font-size: 14px;
            text-align: center;
            line-height: 25px;
            cursor: pointer;
            border-top-right-radius:5px;
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
                    <li>菜单</li>
                    <li>></li>
                    <li>菜品</li>
                    <li>></li>
                    <li>菜品信息</li>
                    <li>></li>
                    <li>配菜管理</li>
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
        <div class="right_one">
            <ul class="cl">
                <li>
                    <div><?php echo ($count); ?></div>
                    <p>配菜数量</p>
                </li>
            </ul>
        </div>
        <div class="right3">
            <div class="biao">
                <div class="top">
                   
                    <div class="top_btn">
                     <select name="fid" class="select_add fid">
                         <?php if(is_array($peicai)): foreach($peicai as $k=>$v): ?><option <?php if($v["pid"] == $id): ?>selected<?php endif; ?>  value="<?php echo ($v["pid"]); ?>"><?php echo ($v["pcaidan"]); ?></option><?php endforeach; endif; ?>
                    </select>
                        <span class="youhui_edit">新增配菜</span>
                    </div>
                </div>
                <div class="cen">
                    <table>
                        <tr class="ee">
                            <td>
                                <div class="cen2">
                                    ID
                                </div>
                            </td>
                            <td>
                                <div class="cen2">
                                    配菜名称
                                </div>
                            </td>
                            <td>
                                <div class="cen2">
                                    配菜价格
                                </div>
                            </td>         
                            <td>
                                <div class="cen2">
                                    操作
                                </div>
                            </td>
                        </tr>
                        <?php if(is_array($result)): foreach($result as $k=>$v): if($k%2 == 0): ?><tr class="ee1">
                            <td class="ii">
                                <div class="cen2 li"><?php echo ($v["pcid"]); ?></div>
                            </td>
                            <td>
                                <div class="cen5"><?php echo ($v["pcname"]); ?></div>
                            </td>
                            <td>
                                <div class="cen5">$<?php echo ($v["pcprice"]); ?></div>
                            </td>
                            <td>
                                <div class="operate">
                                    <img class="btn_edit update_edit" src="/Public/admin/img/icon_modify_white.png" alt=""/>
                                    <img class="btn_edit deletecai" src="/Public/admin/img/icon_delete.png" alt=""/>
                                </div>
                            </td>
                        </tr>
                        <?php else: ?>
                        <tr class="ee">
                            <td>
                                <div class="cen2 li"><?php echo ($v["pcid"]); ?></div>
                            </td>
                            <td>
                                <div class="cen5"><?php echo ($v["pcname"]); ?></div>
                            </td>
                            <td>
                                <div class="cen5">$<?php echo ($v["pcprice"]); ?></div>
                            </td>
                            <td>
                                <div class="operate">
                                    <img class="btn_edit update_edit" src="/Public/admin/img/icon_modify_white.png" alt=""/>
                                    <img class="btn_edit deletecai" src="/Public/admin/img/icon_delete.png" alt=""/>
                                </div>
                            </td>
                        </tr><?php endif; endforeach; endif; ?>
                    </table>
                </div>
                <div class="page">
                    <tr>
                                <?php echo ($show); ?>

                            </tr>
                </div>
            </div>
        </div>
    </div>
    <!-- 弹框 -->
    <div class="shadow_box">
        <div class="shadow"></div>
        <div id="edit1" class="shadow_content">
            <p>添加配菜</p>
                <ul>
                    <li><div>配菜名称</div><input type="text" class="pcname" placeholder="请输入配菜名称"/></li>
                    <li><div>配菜价格</div><input type="text" class="pcprice" placeholder="请输入配菜价格"/></li>
                    <li class="cl"><span class="cancel form_btn">取消</span><input class="form_btn addnews" type="button" value="保存"/></li>
                </ul>
        </div>
        <div id="edit2" class="shadow_content">
            <p>修改配菜</p>
                <ul>
                    <li class='hiddenid'><input class="fids" type='text'/></li>
                    <li><div>配菜名称</div><input class="name" type="text" /></li>
                    <li><div>配菜价格</div><input class="price" type="text"/></li>
                    <li class="cl"><span class="cancel form_btn">取消</span><input class="form_btn editpei" type="button" value="保存"/></li>
                </ul>
        </div>
    </div>
</div>
</body>
<script>
    $(".youhui_edit").on("click",function(){
        $(".shadow_box").show();
        $(".shadow").show();
        $("#edit1").show();
        $("#edit1 input[type='text']").val("");
    });
    $(".cancel").on("click",function(){
        $(".shadow_box").hide();
        $(".shadow").hide();
        $(".shadow_content").hide();
    })
    $(".deletecai").on("click",function(){
        var id = $(this).parents("tr").find(".li").text();
        $.ajax({
            type: "POST",
            url:"<?php echo U('User/deletepeicai');?>",
            data:{id:id},
            dataType:"json",
            success: function(data) {
                if(data.status == 1){
                    alert("删除成功。");
                    window.location.reload();
                }else if(data.status == 0){
                    alert("配菜删除失败");
                }
            },
            error:function(data){
                alert("失败");
            }
        });
    })
    $(".editpei").on("click",function(){
        var name = $(".name").val();
        var price =$(".price").val();
        var fid = $(".fids").val();
        $.ajax({
            type: "POST",
            url:"<?php echo U('User/editpcpeicai');?>",
            data:{name:name,price:price,fid:fid},
            dataType:"json",
            success: function(data) {
                if(data.status == 1){
                    window.location.reload();
                }else if(data.status == 2){
                    alert("修改无变化");
                }else if(data.status == 0){
                    alert("配菜修改失败");
                }
            },
            error:function(data){
                alert("失败");
            }
        });
    })
    $(".addnews").on("click",function(){
        var pcname = $('.pcname').val();
        var pcprice = $(".pcprice").val();
        var fid = $('.fid').val();
        if(pcname == ""){
            alert("请填写菜品名。");exit();
        }
        if(pcprice == ""){
            alert("请填写价格。");exit();
        }
        $.ajax({
            type: "POST",
            url:"<?php echo U('User/addpeicaid');?>",
            data:{pcname:pcname,pcprice:pcprice,fid:fid},
            dataType:"json",
            success: function(data) {
                if(data.status == 1){
                    window.location.reload();
                }else if(data.status == 0){
                    alert("配菜添加失败");
                }
            },
            error:function(data){
                alert("失败");
            }
        });
    })
</script>
<script>
    $(".update_edit").on("click",function(){
        $(".shadow_box").show();
        $(".shadow").show();
        $("#edit2").show();
        var id=$(this).parents("tr").find("td:nth-child(1) div").text();
        var na=$(this).parents("tr").find("td:nth-child(2) div").text();
        var pri=$(this).parents("tr").find("td:nth-child(3) div").text();
        console.log(id);
        console.log(na);
        console.log(pri);
        $("#edit2 .hiddenid input").val(id);
        $("#edit2 .name").val(na);
        $("#edit2 .price").val(pri);
    });
    $(".cancel").on("click",function(){
        $(".shadow_box").hide();
        $(".shadow").hide();
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
</html>