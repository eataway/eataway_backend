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
        .top_btn a{
            background: #3F51B5;
            padding:6px 40px;
            border-radius: 5px;
            font-size: 15px;
            color:#fff;
            text-decoration: none;
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
        .page li:last-child{
            float: right;
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
        #edit1{
            display: none;
        }
        .shadow_content > p {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        #edit1 ul{
            width: 100%;
        }
        #edit1 input[type="text"]{
            width: 100%;
            height: 3em;
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
        }
        span.form_btn{
            float: left;
        }
        input.form_btn{
            margin-right: 0px;
            float: right;
        }
        #edit1 li:last-child{
            margin-top: 40px;
        }
        
        .page a,span{
            float:left;
        }
        .page span.rows{
            margin-top: 7px;
        }
        .btn_disabled_all{
            position:absolute;
            top:13px;
            right:0px;
        }
        .page{
            box-sizing: border-box;
        }
        .page1{
            position:relative;
        }
    </style>
</head>

    <div class="right">
        <div class="right1">
            <div class="dao">
                <ul>
                    <li>系统</li>
                    <li>></li>
                    <li>优惠码</li>
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
                    <p>优惠码</p>
                </li>
                <li>
                    <div><?php echo ($shangxian); ?></div>
                    <p>优惠码个人使用上限 <img class="youhui_edit" src="/Public/admin/img/icon_modify.png" alt=""/></p>
                </li>
            </ul>
        </div>
        <div class="right_two">
            <div>优惠码</div>
        </div>
        <div class="right3">
            <div class="biao">
                <div class="top">
                    <div class="top_btn">
                        <a href="/index.php/Admin/Root/addyouhui.html">新增优惠码</a>
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
                                    优惠码
                                </div>
                            </td>
                            <td>
                                <div class="cen2">
                                    添加日期
                                </div>
                            </td>
                            <td>
                                <div class="cen2">
                                    优惠
                                </div>
                            </td>
                            <td>
                                <div class="cen2">
                                    使用次数
                                </div>
                            </td>
                            <td>
                                <div class="cen2">
                                    优惠类型
                                </div>
                            </td>
                            <td>
                                <div class="cen2">
                                    状态
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
                                <div class="cen2 id">
                                    <?php echo ($v["yid"]); ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                   <?php echo ($v["codema"]); ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                    <?php echo ($v["addtime"]); ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                    <?php if($v["state"] == 1): echo ($v["money"]); ?>% off
                                        <?php elseif($v["state"] == 2): ?>
                                        $<?php echo ($v["money"]); endif; ?>
                                    
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                    <?php echo ($v["num"]); ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                    <?php if($v["state"] == 1): ?>百分比
                                        <?php elseif($v["state"] == 2): ?>
                                       折扣金额<?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                    <?php if($v["flag"] == 1): ?>启用状态
                                        <?php elseif($v["flag"] == 2): ?>
                                       停用状态<?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="operate">
                                    <?php if($v["flag"] == 2): ?><input type="button" value="启用"  class="btn_abled tingyong">
                                    <img class="btn_edit edits" src="/Public/admin/img/icon_modify_white.png" alt=""/>
                                        <?php elseif($v["flag"] == 1): ?>
                                       <input type="button" value="停用" class="btn_disabled qiyong">
                                    <img class="btn_edit edits" src="/Public/admin/img/icon_modify_white.png" alt=""/><?php endif; ?>
                                </div>
                            </td>
                        </tr>
                            <?php else: ?>
                        <tr class="ee">
                            <td>
                                <div class="cen2 id">
                                    <?php echo ($v["yid"]); ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                   <?php echo ($v["codema"]); ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                    <?php echo ($v["addtime"]); ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                    <?php if($v["state"] == 1): echo ($v["money"]); ?>% off
                                        <?php elseif($v["state"] == 2): ?>
                                        $<?php echo ($v["money"]); endif; ?>
                                    
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                    <?php echo ($v["num"]); ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                    <?php if($v["state"] == 1): ?>百分比
                                        <?php elseif($v["state"] == 2): ?>
                                       折扣金额<?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="cen5">
                                    <?php if($v["flag"] == 1): ?>启用状态
                                        <?php elseif($v["flag"] == 2): ?>
                                       停用状态<?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="operate">
                                    <?php if($v["flag"] == 2): ?><input type="button" value="启用"  class="btn_abled tingyong">
                                    <img class="btn_edit edits" src="/Public/admin/img/icon_modify_white.png" alt=""/>
                                        <?php elseif($v["flag"] == 1): ?>
                                       <input type="button" value="停用" class="btn_disabled qiyong">
                                    <img class="btn_edit edits" src="/Public/admin/img/icon_modify_white.png" alt=""/><?php endif; ?>
                                </div>
                            </td>
                        </tr><?php endif; endforeach; endif; ?>
                    </table>
                    <div class="page1">
                    <?php echo ($show); ?><span class="btn_disabled_all alltingyong">全部停用</span>
                </div>
                </div>
<!--                <div class="page">
                    <ul class="cl">
                        <li>1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                        <li>5</li>
                        <li><span>下一页</span></li>
                        <li>共<span>13</span>条数据</li>
                        <li>第<span>1</span>页/共<span>2</span>页</li>
                        <li><span class="btn_disabled_all">全部停用</span></li>
                    </ul>
                </div>-->
            </div>
        </div>
    </div>
    <!-- 弹框 -->
    <div class="shadow_box">
        <div class="shadow"></div>
        <div id="edit1" class="shadow_content">
            <p>修改平台优惠码个人使用上限</p>
            <form>
                <ul>
                    <li><input type="text" class="shangxian" placeholder="输入0时代表个人可使用无限次"/></li>
                    <li class="cl"><span class="cancel form_btn">取消</span><input class="form_btn baocun" type="submit" value="保存"/></li>
                </ul>
            </form>
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
    $(function(){
        $(".qiyong").click(function(){
            var yid = $(this).parents('tr').find('.id').text();
            $.ajax({
                type:"POST",
                url:"<?php echo U('Root/jinyong');?>",
                data:{yid:yid},
                dataType:"json",
                success:function(data){
                    if(data.status == 1){
                        alert("停用成功。");
                        window.location.reload();
                    }else if(data.status == 2){
                        alert("失败。");
                    }
                }
            })
        })
        $(".tingyong").click(function(){
            var yid = $(this).parents('tr').find('.id').text();
            $.ajax({
                type:"POST",
                url:"<?php echo U('Root/qiyong');?>",
                data:{yid:yid},
                dataType:"json",
                success:function(data){
                    if(data.status == 1){
                        alert("启用成功。");
                        window.location.reload();
                    }else if(data.status == 2){
                        alert("失败。");
                    }
                }
            })
        })
        $(".alltingyong").click(function(){
            $.ajax({
                type:"POST",
                url:"<?php echo U('Root/alltingyong');?>",
                data:{},
                dataType:"json",
                success:function(data){
                    if(data.status == 1){
                        alert("全部停用成功。");
                        window.location.reload();
                    }else if(data.status == 2){
                        alert("已经全部停用。");
                    }else if(data.status == 3){
                        alert("失败。");
                    }
                }
            })
        })
        $(".baocun").click(function(){
            var shangxian = $(".shangxian").val();
            if(shangxian == 0){
                alert("不能为空。");
            }else{
                $.ajax({
                type:"POST",
                url:"<?php echo U('Root/editshangxian');?>",
                data:{shangxian:shangxian},
                dataType:"json",
                success:function(data){
                    if(data.status == 1){
                        alert("修改成功。");
                        window.location.reload();
                    }else if(data.status == 2){
                        alert("失败。");
                    }
                }
            })
            }
            
        })
         $(".edits").click(function(){
             var yid = $(this).parents('tr').find('.id').text();
           window.location.href="/index.php/Admin/Root/edityouhui?yid="+yid;
        })
    })


</script>
</html>