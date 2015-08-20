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
	.g-main p.m-loc{
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
		display: block;cursor:pointer;
		margin: 20px 20px 20px 0;
		height: 40px;
		line-height: 40px;
		padding: 0 20px;
	}
	.g-main .m-nav li.cur{
		background-color: #ff444c;
		color: #fff;
	}
	.m-txtinfo{
		width: 100%;
		padding-bottom: 40px;
		border-bottom: 1px solid #333;
	}
	.m-txtinfo p.ttl{
		font-size: 36px;
		line-height: 60px;
		color: #4e4c4d;
		font-weight: bold;
	}
	.m-meet,.m-news,.m-huiyuan,.m-jiyu{
		width: 100%;
		padding-bottom: 40px;
		border-bottom: 1px solid #222;

	}
	.m-meet p.ttl,.m-news p.ttl,.m-huiyuan,.m-jiyu p.ttl{
		line-height: 80px;
	}
	.m-meet li{
		position: relative;
		width: 48%;
		margin-right: 2%;
		height: 124px;
		margin-bottom: 20px;
	}
	.m-meet li img{
		float: left;
		width: 188px;
		height: 100%;
	}
	.m-meet li div.txt{
		height: 100%;
		padding-left: 5%;
		overflow:hidden;
		background-color: #efefef;
	}
	.m-meet li .txt p{
		line-height: 26px;
	}
	.m-meet li .txt a{
		display: block;
		margin-top: 10px;
		height: 24px;
		width: 60px;
		text-align: center;
		color: #606060;
		border: 2px solid #606060;
		cursor: pointer;
	}
	.m-meet li img.timepic{
		position: absolute;
		right: 0;
		bottom: 0;
		width: 60px;
		height: 50px;
	}
	.m-huiyuan li{
		display: block;
		width: 230px;
		height: 110px;
		margin:20px 20px;
	}
	.m-huiyuan li img{
		width: 230px;
		height: 110px;
		cursor: pointer;
		border: 1px solid #ccc;
	}
	.more-btn{
		display: block;
		width: 100px;
		height: 40px;
		line-height: 40px;
		text-align: center;
		background-color: #ff444c;
		color: #fff;
		margin: 0 auto;
	}
	.hideo{display: none;}
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
		<p class="m-loc fs20">所在位置：首页>婚礼支持人><span class="fc-red"><?php echo $model->assoc_name ?></span></p>
		<div class="m-info">
			<img class="f-fl" src="<?php echo '/'.$model->icon;?>">
			<div class="m-txt f-fl">
				<p class="fs36"><?php echo $model->assoc_name ?></p>
				<p class="fs26">海之声（中国）婚礼顾问</p>
				<p class="fs26">联系电话：<?php echo $model->mobile ?></p>
				<p class="fs26">QQ：<?php echo $model->qq ?></p>
				<p class="fs26">E-mail：<?php echo $model->mail ?></p>
				<img style="height:43px;width:402px;" src="/images/sh/dslogo/renzheng.jpg">
			</div>
			<div class="f-cb"></div>
		</div>
		<div class="m-content">
			<div class="m-nav" id="mine">
				<ul>
					<li class="f-fl fs26 fc-gray cur">协会简介</li>
					<li class="f-fl fs26 fc-gray">会长寄语</li>
					<div class="f-cb"></div>
				</ul>
			</div>
			<div class="wrap_c">
				<div class="m-txtinfo">
					<p class="fs20 fcdg" style="color:#4e4c4d;line-htight:36px;"><?php echo $model->assoc_desc ?></p>	
				</div>	
				<div class="m-txtinfo hideo">
					<p class="fs20 fcdg" style="color:#4e4c4d;line-htight:36px;"><?php echo $model->assocer_jy ?></p>
				</div>	
			</div>
			<div class="m-meet">
				<p class="ttl fs28 fc-gr">协会热门活动</p>
				<ul>
					<?php 
						if(isset($hdong)){
							foreach ($hdong as $_k => $_v) {
					 ?>
					<li class="f-fl">
						<img src="/images/sh/dslogo/images/hzshow_01.jpg">
						<div class="txt">
							<p class="ttl fs16"><?php echo $_v->title ?></p>
							<p class="ttl fs14 fc-lg"><?php echo date("Y年m月d日",$_v->add_time); ?></p>
							<p class="ttl fs16">内容</p>
							<a class="read-more" target="_blank" href="<?php echo $this->createUrl('/shqq/default/hpdetail',array("id"=>$_v->id));?>">+阅读</a>
						</div>
						<div class="f-cb"></div>
						<img class="timepic" src="/images/sh/dslogo/images/time.jpg">
					</li>
					<?php }} ?>
					<div class="f-cb"></div>				
				</ul>
			</div>
			<div class="m-news">
				<p class="ttl fs28 fc-gr">会展风采</p>
					<?php 
						if(isset($fcai)){
							foreach ($fcai as $_k => $_v) {
					 ?>
				<p style="font-size:18px;line-height:30px;"><a target="_blank" href="<?php echo $this->createUrl('/shqq/default/hpdetail',array("id"=>$_v->id));?>"><span class="f-fl fc-lg"><?php echo $_v->title ?></span><span class="f-fr fc-lg"><?php echo date("Y年m月d日",$_v->add_time); ?></span><div class="f-cb"></div></a></p>
				<?php }} ?>
				<a target="_blank" class="more-btn" style="margin-top:20px;" href="">More...</a>
				<div class="f-cb"></div>
			</div>

			<div class="m-huiyuan">
				<p class="ttl fs28 fc-gr">协会会员</p>
				<ul>
					<?php 
						if(isset($member)){
							foreach ($member as $_k => $_v) {
					 ?>
					<li class="f-fl">
						<img src="<?php echo $_v->cy_logo ?>">						
					</li>	
					<?php }} ?>
					<div class="f-cb"></div>				
				</ul>
				<a target="_blank" class="more-btn" style="margin-top:20px;" href="">More...</a>
			</div>


		</div>
	</div>
</body>

<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/sh/jquery-1.11.2.js"></script>
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
</html> 