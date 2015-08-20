<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/sh/reset.css" rel="stylesheet">
	<style type="text/css">
	body{
		background-color: #fff;
	}
	.g-head{
		width: 1100px;
		height: 90px;
		margin:0 auto;
		background: url(/images/sh/dslogo/logo.jpg) left center no-repeat;
	}
	.g-head input{
		margin: 26px 0;
		width: 280px;
		height: 38px;
		border: 1px solid #e2e2e2;
		padding-left: 1em;
		background: url(/images/sh/dslogo/icon.jpg) 94% center no-repeat;

	}
	.g-nav{
		width: 100%;
		height: 60px;
		background-color: #ff444c;
		color: #fff;
		overflow: hidden;
	}
	.g-nav ul{
		width: 1100px;
		height: 60px;
		margin: 0 auto;
	}
	.g-nav li{
		display: block;
		height:60px;
		line-height: 60px;
		width: 200px;
	}
	.g-main{
		width: 1100px;
		margin:0 auto;
	}
	.g-main p{
		width: 100%;
		color: #3b3a3a;
		line-height: 50px;
	}
	.g-main .m-info{
		width: 100%;
		height: 280px;
		border-bottom:2px solid #3b3a3a;
	}
	.g-main .m-info img{
		width: 246px;
		height: 246px;
	}
	.g-main .m-info .m-txt{
		padding-left: 40px;
		width: 460px;
		height: 246px;
		color: #0d0101;
	}
	.g-main .m-txt p{		
		line-height: 36px;
	}
	.g-main .m-txt p:first-child{
		line-height: 60px;
	}
	.g-main .m-content .m-nav{
		width: 100%;
		height: 80px;
		line-height: 80px;
	}
	.g-main .m-nav li{
		display: block;
		margin: 20px 20px 20px 0;
		height: 40px;
		line-height: 40px;
		padding: 0 20px;
		cursor:pointer
	}
	.g-main .m-nav li.cur{
		background-color: #ff444c;
		color: #fff;
	}
	.g-main .m-imgtxt{
		width: 100%;
	}
	.g-main .m-imgtxt ul{
		width: 100%;
	}
	.g-main .m-imgtxt li{
		display: block;
		height: 510px;
		width: 260px;
		margin:0 6px 40px;
		overflow: hidden;
		border-bottom: 2px solid #e2e2e2;
	}
	.g-main .m-imgtxt li img{
		width: 100%;
		height: 378px;
	}
	.g-main .m-imgtxt li p.ttl{
		line-height: 40px;
	}
	.g-main .m-imgtxt li p.del{
		line-height: 30px;
	}
	.g-main .m-imgtxt li p.content{
		line-height: 30px;
	}
	.g-main .m-imgtxt li a{
		margin-top: 30px;
		display: block;
		width: 100%;
		height: 30px;
		line-height: 30px;
	}
	.g-main .m-imgtxt2 li{
		width: 100%;
		height: 200px;
	}
	.g-main .m-imgtxt2 li img{
		width: 50%;
		height: 100%;
		float: left;
	}
	.g-main .m-imgtxt2 li p,.g-main .m-imgtxt2 li a{
		display: block;
		width: 48%;
		padding-left: 2%;
	}
	.more-btn{
		display: block;
		width: 100px;
		height: 40px;
		line-height: 40px;
		text-align: center;
		background-color: #ff444c;
		color: #fff;
		margin: 0 auto 40px;
	}
	.content2{display: none}
	</style>
</head>
<body>
	<div class="g-head">
		<input class="f-fr fs16" type="text" name="k_word" placeholder="请输入关键字搜索">
		<div class="f-cb"></div>
	</div>
	<div class="g-nav">
		<ul>
			<li class="fs28 f-fl">目的地婚礼</li>
			<li class="fs28 f-fl">本地结婚圈</li>
			<li class="fs28 f-fl">婚礼顾问</li>
			<li class="fs28 f-fl">婚礼日记</li>
			<li class="fs28 f-fl">结婚商城</li>
			<div class="f-cb"></div>
		</ul>
		<div class="f-cb"></div>
	</div>
	<div class="g-main">
		<p class="m-loc fs20">所在位置：首页>婚礼主持人><span class="fc-red"><?php echo $model->name ?></span></p>
		<div class="m-info">
			<img class="f-fl" src="<?php echo $model->icon;?>">
			<div class="m-txt f-fl">
				<p class="fs36"><?php echo $model->name ?></p>
				<p class="fs26">海之声（中国）婚礼<?php echo $model->job==1?"司仪":"策划"  ?></p>
				<p class="fs26">联系电话：<?php echo $model->mobile ?></p>
				<p class="fs26">QQ：<?php echo $model->qq ?></p>
				<img style="height:43px;width:402px;" src="/images/sh/dslogo/renzheng.jpg">
			</div>
			<div id="code" style="width:287px;height:249px;" class="f-fl"><input type="hidden" class="input" id="mytxt" value="<?php echo $model->weixin ?>"> </div>
			<div class="f-cb"></div>
		</div>
		<div class="m-content">
			<div class="m-nav" id="mine">
				<ul>
					<li class="f-fl fs26 fc-gray cur">我的案例</li>
					<li class="f-fl fs26 fc-gray">我的简介</li>
					<div class="f-cb"></div>
				</ul>
			</div>
			<div class="wrap_c">
				<div class="m-imgtxt content">
					<ul>
					<?php 
						if(isset($anli)){
							foreach ($anli as $_k => $_v) {
					 ?>
						<li class="f-fl">
							<img src="<?php echo $_v->cover ?>">
							<p class="ttl f-tac fs20"><?php echo $_v->title; ?></p>
							<a target="_blank" class="f-tac" href="<?php echo $this->createUrl('/shqq/default/pdetail',array("id"=>$_v->id));?>">READ MORE</a>
						</li>
						<?php }} ?>
						<div class="f-cb"></div>
					</ul>
					<div class="f-cb"></div>
				</div>
				<div class="m-imgtxt content2">
					<ul>
							<p class="ttl f-tac fs20">个人简介</p>
							<p class="content fs18"><?php echo $model->intro ?></p>
						
						<div class="f-cb"></div>
					</ul>
					<div class="f-cb"></div>
				</div>
			</div>
			<a target="_blank" class="more-btn" href="">More...</a>
		</div>
	</div>
</body>

<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/sh/jquery-1.11.2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/sh/jquery.qrcode.min.js"></script>
<script type="text/javascript">
$(function(){
        var $cOne=$("#mine ul li");
        $cOne.click(function(){
                $(this).addClass("cur").siblings().removeClass("cur");
                //获取当前单击的li无素在全部<li>元素中的索引
                var index = $cOne.index(this);
                $("div.wrap_c > div").eq(index).show().siblings().hide();//取子节点
                //$("div.content2 > div").eq(index).show().siblings().hide();
            })
   
    })  
//文本回复和图文回复
</script>
<script type="text/javascript">
			$(function(){
				//str 为默认生成二维码 
				//var str = "http://www.sina.com";
				//$('#code').qrcode(str);
				
				/*$("#sub_btn").click(function(){
					$("#ercode").toggle(
				      function(){
				        $("this").hide();},
				      function(){
				        $("this").show();
				    });*/
					//$("#code").empty();
					//获得要生成的二维码值
					var str = toUtf8($("#mytxt").val());
					
					$("#code").qrcode({
						render: "canvas",
						width: 200,
						height:200,
						text: str
					});
				//});
			})
			function toUtf8(str) {   
			    var out, i, len, c;   
			    out = "";   
			    len = str.length;   
			    for(i = 0; i < len; i++) {   
			    	c = str.charCodeAt(i);   
			    	if ((c >= 0x0001) && (c <= 0x007F)) {   
			        	out += str.charAt(i);   
			    	} else if (c > 0x07FF) {   
			        	out += String.fromCharCode(0xE0 | ((c >> 12) & 0x0F));   
			        	out += String.fromCharCode(0x80 | ((c >>  6) & 0x3F));   
			        	out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));   
			    	} else {   
			        	out += String.fromCharCode(0xC0 | ((c >>  6) & 0x1F));   
			        	out += String.fromCharCode(0x80 | ((c >>  0) & 0x3F));   
			    	}   
			    }   
			    return out;   
			}  
			</script>
</html> 