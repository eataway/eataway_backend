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
    <script type="text/javascript" src="/Public/admin/js/jquery-1.9.1.js"></script>
    <style>
        .cl:after{
            content:"";
            display: block;
            clear:both;
        }
        ul{
            list-style: none;
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
            z-index: 51;
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
        .shadow_content{
            display: none;
        }
        .shadow_content > p {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .shadow_content ul{
            width: 100%;
        }
        .shadow_content div{
            width: 28%;
            float: left;
            height: 2.5em;
            line-height: 2.5em;
            clear: both;
            margin-bottom: 15px;
        }
        .shadow_content input[type="text"]{
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
        /*左 */
        .right_zuo{
            margin: 0px 0px 0px 30px;
            width:150px;
            float: left;
        }
        .img_box img{
            width:100%;
            height: 100px;
        }
        .change_img{
            position: relative;
            margin:15px 0px;
            height: 30px;

        }
        input[type="file"] {
            color: transparent;
        }
        .change_img input{
            width: 100%;
            height: 30px;
            position: absolute;
            left:0px;
            top:0px;
            z-index:11;
            opacity: 0;
        }
        .change_img div{
            width: 100%;
            height: 30px;
            position: absolute;
            left:0px;
            top:0px;
            z-index:10;
            text-align: center;
            line-height: 30px;
            background: #E51C23;
            color:#fff;
            font-size: 14px;
        }
        .right_zuo textarea{
            padding:3px;
            width: 100%;
            box-sizing: border-box;
            height: 350px;
            resize: none;
        }
        .right_zhong{
            width: 400px;
            padding-left:30px;
            float: left;
            border-right:1px solid #E7E7E7;
        }
        .right_zhong li{
            width: 80%;
        }
        .right_zhong li span{
            font-size:15px ;
        }
        .list1{
            padding:12px 0px;
            border-bottom:1px solid #EFEFEF;
        }
        .list1 input{
            text-indent: 10px;
            border:none;
            font-size: 14px;
            width:230px;
        }
        .list1 select{
            border:none;
            width:230px;
        }
        .list2{
            margin-top:25px;
            margin-bottom:13px;
        }
        .add_menu1,.add_menu2{
            width: 16px;
            height: 16px;
            float: right;
            cursor: pointer;
        }
        .edit_menu1,.edit_menu2,.add3{
            width:20px;
            height: 20px;
            cursor: pointer;
        }
        .add3{
            margin-left:15px;
        }
        
        .list3{
            height: 300px;
            overflow-y: auto;
        }
        .right_you .list3{
            height: 500px;
        }
        .tbl{
            width: 100%;
        }
        .tbl tr{
            background: #E8E8E8;
            height: 3em;
        }
        .tbl td{
            text-align: center;
            border-bottom: 3px solid #fff;
            font-size: 14px;
        }
        .right_you{
            width: 400px;
            padding-left:30px;
            float: left;
        }
        .right_you li span{
            font-size:15px ;
        }
        .right_you .list2{
            margin-top:3px;
            margin-bottom:20px;
        }
        .sub{
            margin-top:30px;
        }
        .sub button{
            padding:10px 40px;
            background: blue;
            border-radius: 5px;
            border:none;
            outline: none;
            color:#fff;
            float: right;
        }
    </style>
</head>
<body>

    <div class="right">
        <div class="right1 cl">
            <div class="dao">
                <ul>
                    <li>商户详情</li>
                    <li>></li>
                    <li>菜单</li>
                    <li>></li>
                    <li>菜品</li>
                    <li>></li>
                    <li>新增菜品</li>
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
        <form action="" id="form1">
            <ul class="right_zuo">
                <li class="img_box"><img src="/Public/admin/img/Logo_01.png" alt=""/></li>
                <li class="change_img"><input type="file" name="img" value=""/><div>点击替换</div></li>
                <li><textarea name="dishname" placeholder="请输入菜品描述（选填）"></textarea>
                <input type='hidden' class="shopids" name='shopid' value="<?php echo ($shopid); ?>"/>
                <input type='hidden' class="cids" name='cid' value="<?php echo ($cid); ?>"/>
                </li>
            </ul>
            <ul class="right_zhong">
                <li class="list1"><span>菜品名称：</span><input type="text" name="goodsname" placeholder="请填写菜品名称"/></li>
                <li class="list1"><span>菜品价格：</span><input type="text" name="dishprice" placeholder="请填写菜品价格"/></li>
                <li class="list1"><span>菜品折扣：</span><input  type="text" name="dishdiscount" placeholder="折扣为减去商品原价百分比"/>%</li>
                <li class="list1">
                    <span>所属菜单：</span>
                    <select name="belongmenu">
                        <?php if(is_array($result)): foreach($result as $k=>$v): ?><option  value="<?php echo ($v["cid"]); ?>" <?php if($v["cid"] == $cid): ?>selected<?php endif; ?>><?php echo ($v["cname"]); ?></option><?php endforeach; endif; ?>
                    </select>
                </li>
                <li class="list2">
                    <span>菜品规格：</span><img src="/Public/admin/img/add1.png" class="add_menu1" alt=""/>
                </li>
                <li class="list3">
                    <table class="tbl" cellpadding="0" cellspacing="0">
                    </table>
                </li>
            </ul>
        </form>
        <ul class="right_you">
            <li class="list2">
                <span>菜品配菜：</span><img src="/Public/admin/img/add1.png" class="add_menu2" alt=""/>
            </li>
            <li class="list3">
                <table class="tbl" cellpadding="0" cellspacing="0"></table>
            </li>
            <li class="sub cl">
                <button id="submit1">提交</button>
            </li>
        </ul>
    </div>
    <!-- 弹框 -->
    <div class="shadow_box">
        <div class="shadow"></div>
        <div id="add1" class="shadow_content">
            <p>添加规格</p>
            <form action="">
                <ul>
                    <li><div>规格名称</div><input class="name" type="text" placeholder=""/></li>
                    <li><div>规格价格</div><input class="price" type="text" placeholder=""/></li>
                    <li class="cl"><span class="cancel form_btn">取消</span><input class="form_btn save" type="button" value="保存"/></li>
                </ul>
            </form>
        </div>
        <div id="edit1" class="shadow_content">
            <p>修改规格</p>
            <form action="">
                <ul>
                    <li><div>规格名称</div><input class="name" type="text" placeholder=""/></li>
                    <li><div>规格价格</div><input class="price" type="text" placeholder=""/></li>
                    <li class="cl"><input type="button" class="del form_btn  form_btn1" value="删除"><input class="form_btn save" type="button" value="保存"/></li>
                </ul>
            </form>
        </div>
        <div id="add2" class="shadow_content">
            <p>添加配菜菜单名</p>
            <form action="">
                <ul>
                    <li><div>菜单名称</div><input class="name" type="text" placeholder=""/></li>
                    <li class="cl"><span class="cancel form_btn">取消</span><input class="form_btn save" type="button" value="保存"/></li>
                </ul>
            </form>
        </div>
        <div id="edit2" class="shadow_content">
            <p>修改配菜菜单名</p>
            <form action="">
                <ul>
                    <li><div>菜单名称</div><input class="name" type="text" placeholder=""/></li>
                    <li class="cl"><input type="button" class="del form_btn  form_btn1" value="删除"><input class="form_btn save" type="button" value="保存"/></li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
<script>
//    禁止用enter键

	document.onkeydown=function(evt){
		if(evt.keyCode ==13){
		     return false ;
		}
	}
 
    
    
//    点击加号
    $(".right_you .tbl").on("click",".add3",function(){
        alert(1);
    })
    /*点击选择图片*/
    function getObjectURL(file) {
        var url = null;
        if(window.createObjectURL != undefined) { // basic
            url = window.createObjectURL(file);
        } else if(window.URL != undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file);
        } else if(window.webkitURL != undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file);
        }
        return url;
    }
    $(".change_img input").change(function(){
        var objUrl = getObjectURL(this.files[0]);
        if(objUrl) {
            $(".img_box img").attr("src", objUrl);
        }
    });
    /*点击弹出弹框*/
    //添加菜品规格
    $(".add_menu1").click(function(){
        $(".shadow_box").show();
        $(".shadow").show();
        $("#add1").show();
        $("#add1 input[type='text']").val("");
    });
    $("#add1 .save").on("click",function(){
        var na=$("#add1 .name").val();
        var pri=$("#add1 .price").val();
        var html1=`<tr>
                    <td>${na}</td>
                    <td>${pri}</td>
                    <td><img onclick='edit1(this)' class='edit_menu1' src='/Public/admin/img/icon_modify.png'/></td>
                </tr>`;
        $(".right_zhong .tbl").append(html1);
        close();
    });
    //编辑菜品规格
    function edit1(el){
        $(".shadow_box").show();
        $(".shadow").show();
        $("#edit1").show();
        var na=$(el).parents("tr").find("td:nth-child(1)").text();
        var pri=$(el).parents("tr").find("td:nth-child(2)").text();
        $("#edit1 .name").val(na);
        $("#edit1 .price").val(pri);
        $(el).parents("tr").attr("id","cur");
    }
    //编辑菜品规格中的删除 和 保存
    $("#edit1 .del").on("click",function(){
        $("#cur").remove();
        close();
    });
    $("#edit1 .save").on("click",function(){
        var na=$("#edit1 .name").val();
        var pri=$("#edit1 .price").val();
        $("#cur").find("td:nth-child(1)").text(na);
        $("#cur").find("td:nth-child(2)").text(pri);
        $("#cur").attr("id","");
        close();
    });
    //添加菜品配菜
    $(".add_menu2").click(function(){
        $(".shadow_box").show();
        $(".shadow").show();
        $("#add2").show();
        $("#add2 input[type='text']").val("");
    });
    $("#add2 .save").on("click",function(){
        var na=$("#add2 .name").val();
        var html1=` <tr>
                        <td>${na}</td>
                        <td><img onclick='edit2(this)' class='edit_menu2' src='/Public/admin/img/icon_modify.png' alt=""/>
                    </tr>`;
        $(".right_you .tbl").append(html1);
        close();
    });
    //编辑菜品配菜
    function edit2(el){
        $(".shadow_box").show();
        $(".shadow").show();
        $("#edit2").show();
        var na=$(el).parents("tr").find("td:nth-child(1)").text();
        $("#edit2 .name").val(na);
        $(el).parents("tr").attr("id","cur");
    }
    //编辑菜品规格中的删除 和 保存
    $("#edit2 .del").on("click",function(){
        $("#cur").remove();
        close();
    });
    $("#edit2 .save").on("click",function(){
        var na=$("#edit2 .name").val();
        $("#cur").find("td:nth-child(1)").text(na);
        $("#cur").attr("id","");
        close();
    });
    /*点击关闭弹框*/
    function close(){
        $(".shadow_box").hide();
        $(".shadow").hide();
        $(".shadow_content").hide();
    }
    $(".cancel").on("click",function(){
        close();
    });
  /*保存提交数据*/
    $("#submit1").click(function(){
        var form = new FormData(document.getElementById("form1"));
        var arr1 = new Array();
        $(".right_zhong .tbl tr").each(function(){
            var na=$(this).find("td:nth-child(1)").text();
            var pri=$(this).find("td:nth-child(2)").text();
            var addtime = new Date();
            var item={guige:na,primoney:pri,addtime:addtime};
            arr1.push(item);
        });
        var arr2 = new Array();
        $(".right_you .tbl tr").each(function(){
            var na=$(this).find("td:nth-child(1)").text();
            var addtime = new Date();
            var item={pcaidan:na,addtime:addtime};
            arr2.push(item);
        });
        var cid = $(".cids").val();
        var shopid = $(".shopids").val();
        $.ajax({
            type: "POST",
            url:"<?php echo U('User/addalls');?>",
            data:form,
            dataType:"json",
            processData:false,
            contentType:false,
            success: function(data) {
                $.ajax({
                    type: "POST",
                    url:"<?php echo U('User/addalls1');?>",
                    data:{aa:arr1,bb:arr2,cc:data},
                    dataType:"json",
                    success: function(datas) {
                        if(datas.status == 1){
                            alert(datas.msg);
                            window.location.href="/index.php/Admin/User/goodform?id="+cid+"&shopid="+shopid;
                        }else{
                            alert(datas.msg);
                        }
                    },
                    error:function(datas){
                        alert("error2");
                    }
                });
            },
            error:function(data){
                alert("error1");
            }
        });
    });

</script>
<script>
    $(".update_edit").on("click",function(){
        $(".shadow_box").show();
        $(".shadow").show();
        $("#edit2").show();
        $("#edit2 input[type='text']").val("");
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