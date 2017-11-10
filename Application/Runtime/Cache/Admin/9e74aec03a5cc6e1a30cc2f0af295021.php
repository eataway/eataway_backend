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
<title>删除优惠码</title>
<link rel="stylesheet" href="/Public/admin/css/authenticated.css">
<link rel="stylesheet" href="/Public/admin/css/css.css">
<link rel="stylesheet" href="/Public/admin/css/right.css">
<link rel="stylesheet" href="/Public/admin/css/install.css">
<script type="text/javascript" src="/Public/admin/js/jquery-1.9.1.js"></script>
<style type="text/css">
    .rig-cc{
        width: 6%;
        /*float: left;*/
    }
    .rig-c2 ul li {
        margin: 10px 0px 20px 0px;
    }
    
    .rig-c4,.rig-c5{       
        padding: 3px 0px 5px 0px;
    }
    .deleteCode{
        width: 120px;
        height: 32px;
        line-height: 32px;
        background: #E51C23;
        color: #fff;
        float: right;
        font-size: 16px !important;
        font-weight: normal;
        text-align: center;
        margin-right: 7%;
        border-radius: 4px;
        cursor: pointer;
    }
    .shadeCode{
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: #000;
        opacity: 0.3;
        z-index: 9;
    }
    .layCode{
        background: #fff;
        z-index: 10;
        border:1px solid #ccc;
        border-radius: 3px;
        width: 400px;
        height: 300px;
        position: absolute;
        left: 35%;
        top: 20%;
    }
    .contentCode{
        margin: 90px 0;
        color: #767575;
        font-size: 18px;
        text-align: center;
    }
    .btnCode{       
        text-align: center;;
        line-height: 30px;
        color: #fff;
        width: 70%;
        margin: 0 auto;
    }
    .btnCode input:nth-child(2){
        background: #32ba4a;
        color: #fff;
        float: right;
        width: 110px;
        height: 30px;
        border:none;
        border-radius: 3px;
    }
    .btnCode input:nth-child(1){
        background: #ccc;
        float: left;
        width: 110px;
        height: 30px;        
        border:none;
        border-radius: 3px;
    }

</style>
</head>

        <div class="right">
            <div class="right1">
                <div class="dao">
                    <ul>
                        <li>管理员设置</li>
                        <li>></li>
                        <li>优惠码</li>
                        <li>></li>
                        <li>修改优惠码</li>
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
            <div class="rig-c">
               <div class="rig-c1" style="font-weight: bold;font-size: 1.3em;margin-top:30px;">
                   修改优惠码
                   <span class="deleteCode">删除优惠码</span>
               </div>
               <div class="rig-c2">
                   <ul>
                       <li>
                           <label for="">优惠码：</label>
                           <input type="text" class="rig-c3 ma" value="<?php echo ($result["codema"]); ?>"/>
                           <input type="hidden" class="yid" name="yid" value="<?php echo ($result["yid"]); ?>"/>
                       </li>
                       <li>
                           <label for="">优惠方式：</label>
                       <?php if($result["state"] == 1): ?><input type="radio" class="rig-cc" checked="checked" name="percent" value="1">百分比
                           <input type="radio" class="rig-cc" name="percent" value="2">抵扣金额
                           <?php elseif($result["state"] == 2): ?>
                           <input type="radio" class="rig-cc" name="percent" value="1">百分比
                           <input type="radio" class="rig-cc" checked="checked" name="percent" value="2">抵扣金额<?php endif; ?>
                           
                           
                       </li>
                       <li>
                           <label for="">优惠额度：</label>
                           <input type="text" class="rig-c3 money" value="<?php echo ($result["money"]); ?>">
                       </li>                      
                       <li>
                           <input type="button" class="rig-c4 tijiao" value="提交">
                           <input type="button" class="rig-c5" value="取消">
                       </li>
                       <li style="margin:14% 0; color:#8A8A8A;">
                           注：“百分比”代表优惠的百分比额度，“抵扣金额”代表实际抵扣金额
                       </li>
                   </ul>
               </div>
            </div>
        </div>
    </div>
    <div class="shadeCode" style="display:none"></div>
    <div class="layCode" style="display:none">
        <div class="contentCode">
            确定要删除吗？
        </div>
        <div class="btnCode">
            <input type="button" value="取消" class="exitCode">
            <input type="button" class="ok" value="确定">
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
<!-- 删除优惠码 -->
<script type="text/javascript">
    $(function(){
        $('.deleteCode').click(function(event) {          
            /* Act on the event */
            $('.shadeCode').css('display',"block");
            $('.layCode').css('display',"block");
        });
        $('.exitCode').click(function(event) {
            /* Act on the event */
            $('.shadeCode').css('display',"none");
            $('.layCode').css('display',"none");
        });
        
    })
</script>
<script>
    $(function(){
        $(".tijiao").click(function(){
            var codema = $(".ma").val();
            var asd = $("input[type = 'radio']:checked").val();
            if(asd == null){
                alert("单选不能为空。");
            }
            var money = $(".money").val();
            var yid = $(".yid").val();
            $.ajax({
                type:"POST",
                url:"<?php echo U('Root/editma');?>",
                data:{yid:yid,codema:codema,asd:asd,money:money},
                dataType:"json",
                success:function(data){
                    if(data.status == 1){
                        alert("修改成功。");
                        window.location.reload();
                    }else if(data.status == 2){
                        alert("修改无变化。");
                    }else if(data.status == 3){
                        alert("失败。");
                    }
                }
            })
            
        })
        $(".ok").click(function(){
            var yid = $(".yid").val();
            $.ajax({
                type:"POST",
                url:"<?php echo U('Root/deletema');?>",
                data:{yid:yid},
                dataType:"json",
                success:function(data){
                    if(data.status == 1){
                        alert("删除成功。");
                        window.location.href="/index.php/Admin/Root/youhuilist.html";
                    }else if(data.status == 2){
                        alert("失败。");
                    }
                }
            })
            
        })
    })
</script>
</html>