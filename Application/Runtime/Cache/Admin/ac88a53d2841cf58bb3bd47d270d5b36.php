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
<script type="text/javascript" src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"
          rel="stylesheet" />
<style>
    .btn_addmenu{
        float:right;
        background: #2186D9;
        color:#fff;
        font-sze:15px;
        padding:6px 40px;
        text-decoration: none;
        vertical-align: middle;
        margin:8px 12px 8px 0px;
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
            list-style: none;
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
                                <input type="hidden" class ="shopid" value="<?php echo ($result["shopid"]); ?>">
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
                        </div>

                        <div class="you1">
                            <div class="you2">
                                <p>
                                    <?php echo ($countcategory); ?>
                                </p>
                                <p>
                                    菜单数
                                </p>
                            </div>
                            <div class="you3">
                                <p>
                                    <?php echo ($goodsnums); ?>
                                </p>
                                <p>
                                    菜品数
                                </p>
                            </div>
                        </div>

                        <div class="you-z">
                            <div class="you-z1">
                                <p>
                                    Order
                                </p>
                            </div>
                            <div class="you-z2">
                                <div class="you-z3">
                                    <div class="biao">
                    <div class="top">
                        <a class="btn_addmenu">添加菜单</a>
                    </div>
                    <div class="cen">
                       <table id="sortable">
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
                                        菜单名称
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="cen2">
                                        菜单销量
                                    </div>
                                </td>
                                <td width="320">
                                    <div class="cen2">
                                        菜品数量
                                    </div>
                                </td>
                                <td width:"200">
                                    <div class="cen2">
                                        操作
                                    </div>
                                </td>
                            </tr>
                            <?php if(is_array($category)): foreach($category as $k=>$v): if($k%2 == 0): ?><tr id="<?php echo ($v["cid"]); ?>" class="sort_item ee1">
<!--                                <td width="60">
                                    <input type="checkbox" class="cen1">
                                </td>-->
                                <td width="80">
                                    <div class="cen2 id">
                                        <?php echo ($v["cid"]); ?>
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="ben3">
                                        <?php echo ($v["cname"]); ?>
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="cen5">
                                        <?php echo ($v["num"]); ?>
                                    </div>
                                </td>
                                <td width="320">
                                    <div class="cen5">
                                        <?php echo ($v["goodsnum"]); ?>
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
                            <tr id="<?php echo ($v["cid"]); ?>" class="sort_item ee">
<!--                                <td width="60">
                                    <input type="checkbox" class="cen1">
                                </td>-->
                                <td width="80">
                                    <div class="cen2 id">
                                        <?php echo ($v["cid"]); ?>
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="ben3">
                                        <?php echo ($v["cname"]); ?>
                                    </div>
                                </td>
                                <td width="220">
                                    <div class="cen5">
                                        <?php echo ($v["num"]); ?>
                                    </div>
                                </td>
                                <td width="320">
                                    <div class="cen5">
                                        <?php echo ($v["goodsnum"]); ?>
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
<!--                                <tr>
                                    <td>First</td>
                                    <td>Previous</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td class="ee2">3</td>
                                    <td>4</td>
                                    <td>...</td>
                                    <td>...</td>
                                    <td>Next</td>
                                    <td>Last</td>
                                </tr>-->
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
    <!-- 弹框 -->
    <div class="shadow_box">
        <div class="shadow"></div>
        <div id="edit1" class="shadow_content">
            <p>添加菜单</p>
            <form>
                <ul>
                    <li><input type="text" class="cate" placeholder="请输入菜单名"/></li>
                    <li class="cl"><span class="cancel form_btn">取消</span><input class="form_btn tijiao" type="button" value="保存"/></li>
                </ul>
            </form>
        </div>
    </div>
</body>
<script>
$(function() {
        $( "#sortable" ).sortable({
            cursor: "pointer",
            items :".sort_item",                        //只是li可以拖动
            opacity: 0.6,                       //拖动时，透明度为0.6
            revert: true,                       //释放时，增加动画
            update : function(event, ui){     //更新排序之后
                var self=ui.item[0].id;
                if($(ui.item[0]).prev("tr").attr("id")){
                    var up=$(ui.item[0]).prev("tr").attr("id")
                }else{
                    var up=-1;
                }
                if($(ui.item[0]).next("tr").attr("id")){
                    var end=$(ui.item[0]).next("tr").attr("id")
                }else{
                    var end= 0;
                }

                    $.ajax({
                        type: 'POST',
                        url: "<?php echo U('User/movecategory');?>",
                        data: {up:up,self:self,end:end},
                        dataType: "json",
                        success: function(data) {
//                            console.log(data);
                            if (data.status == 1) {
//                                alert(data.msg);
                                window.location.reload();
                            } else if (data.status == 0) {
                                alert(data.msg);
                            } 
                        }
                    });
            }
        });
    });
</script>
<script>
       $(".btn_addmenu").click(function(){
           $(".shadow_box").show();
            $(".shadow").show();
            $("#edit1").show();
            $("#edit1 input[type='text']").val("");
       })
       $(".cancel").on("click",function(){
        $(".shadow_box").hide();
        $(".shadow").hide();
        $(".shadow_content").hide();
    })
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
            $(".refresh").click(function(){
                var id = $(this).parents("tr").find(".id").text();
                var shopid = $("input[type=hidden]").val();
                var cid = id * 1;
                window.location.href='/index.php/Admin/User/goodform?id='+cid+'&shopid='+shopid;
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
            $(".delete").click(function(){
                var a=confirm("确认要删除吗？删除后不可恢复。");
               var cid = $(this).parents("tr").find(".id").text();
                if(a == true){
                    $.ajax({
                    type: 'POST',
                    url: "<?php echo U('User/deletecategory');?>",
                    data: {cid: cid},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("删除菜单成功。");
                            window.location.reload();
                        } else if (data.status == 0) {
                            alert("删除失败");
                        }else if(data.status == 2){
                            alert("请先删除该类别下菜品");
                        }
                    }
                });
                }
//                    
            })
            $('.outs').click(function(){
                window.location.href="<?php echo U('Login/logout');?>";
        })    
         $(".tijiao").click(function(){
             var cname = $(".cate").val();
             var shopid = $(".shopid").val();
             $.ajax({
                    type: 'POST',
                    url: "<?php echo U('User/addcategory');?>",
                    data: {cname: cname,shopid:shopid},
                    dataType: "json",
                    success: function(data) {
                        if (data.status == 1) {
                            alert("添加成功。");
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