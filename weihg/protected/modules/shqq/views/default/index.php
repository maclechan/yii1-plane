<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/sh/reset.css" rel="stylesheet">
	<style type="text/css">
	.m-box{
		width: 1000px;
		margin: 0 auto;
	}
	.m-box .m-ttl{
		width: 100%;
		line-height: 60px;
		border-bottom:2px solid #ff2a51;
	}
	.m-box ul.option{
		width: 100%;
		margin: 10px 0;
	}
	ul.option li{
		margin-right: 20px;
		padding: 0 4px;
		border-radius: 5px;
		cursor: pointer;
	}
	.cur_option{
		background-color: #fd50c6;
	}
	.m-box .content{
		width: 100%;
	}
	/*person*/
	.m-box .p-intro{
		position: relative;
		width: 206px;
		height: 260px;
		margin: 0 16px 20px ;
		overflow: hidden;
	}
	.p-intro img{
		width: 206px;
		height: 216px;
		overflow: hidden;
	}
	.p-intro p{
		line-height: 40px;
	}
	/*shangjia*/
	.m-box .s-intro{
		position: relative;
		width: 262px;
		height: 160px;
		margin: 20px 6px 20px ;
		overflow: hidden;
	}
	.s-intro img{
		width: 262px;
		height: 122px;
		overflow: hidden;
	}
	.s-intro p{
		line-height: 40px;
	}
	.content2{display: none}
	.content3{display: none}
	</style>
</head>
<body>

	<div class="m-box guwen">
		<p class="m-ttl fs28 f-tal fcdg">明星婚礼顾问</p>
		<ul class="option" id="minxing">
			<li class="f-fl fs18 fclg cur_option">会长风采</li>
			<li class="f-fl fs18 fclg">婚礼主持人</li>
			<li class="f-fl fs18 fclg">婚礼策划师</li>
			<div class="f-cb"></div>
		</ul>
		<div class="wrap_c">
			<div class="content">
				<?php
                    if($huiz){
                        foreach ($huiz as $v) {
                  ?>
				<div class="p-intro f-fl">
					<a target="_blank" href="<?php echo $this->createUrl('hperson',array("id"=> $v->id));?>">
					<img src="<?php echo $v->icon;?>">
					<p class="f-tac fs18 fclg"><?php echo $v->assoc_name;?></p>
					</a>			
				</div>
				<?php }}?>
				<div class="f-cb"></div>
			</div>
			<div class="content2">
				<?php
                    if($zhuci){
                        foreach ($zhuci as $v) {
                  ?>
				<div class="p-intro f-fl">
					<a target="_blank"  href="<?php echo $this->createUrl('person',array("id"=> $v->id));?>">
					<img src="<?php echo $v->icon;?>">
					<p class="f-tac fs18 fclg"><?php echo $v->name;?></p>
					</a>			
				</div>
				<?php }}?>
				<div class="f-cb"></div>
			</div>
			<div class="content3">
				<?php
                    if($cehua){
                        foreach ($cehua as $v) {
                  ?>
				<div class="p-intro f-fl">
					<a target="_blank"  href="<?php echo $this->createUrl('person',array("id"=> $v->id));?>">
					<img src="<?php echo $v->icon;?>">
					<p class="f-tac fs18 fclg"><?php echo $v->name;?></p>
					</a>			
				</div>
				<?php }}?>
				<div class="f-cb"></div>
			</div>
		</div>
	</div>

	<!-- 这个地方直接用iframe 嵌套  明星婚礼顾问
	<div class="m-box shangjia">
		<p class="m-ttl fs28 f-tal fcdg">本地商家精选</p>
		<ul class="option">
			<li class="f-fl fs18 fclg cur_option">婚纱</li>
			<li class="f-fl fs18 fclg">婚纱摄影</li>
			<li class="f-fl fs18 fclg">婚宴</li>
			<li class="f-fl fs18 fclg">珠宝</li>
			<li class="f-fl fs18 fclg">婚庆</li>
			<li class="f-fl fs18 fclg">婚礼服务</li>
			<div class="f-cb"></div>
		</ul>
		<div class="content">
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj1.jpg">
				<p class="f-tac fs18 fclg">莎依比卡</p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj2.jpg">
				<p class="f-tac fs18 fclg">盛纵文化</p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj3.jpg">
				<p class="f-tac fs18 fclg">广州萝亚婚礼</p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj4.jpg">
				<p class="f-tac fs18 fclg">广州百年好合高端婚礼定制</p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj5.jpg">
				<p class="f-tac fs18 fclg">缘梦纪</p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj6.jpg">
				<p class="f-tac fs18 fclg">花海阁</p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj7.jpg">
				<p class="f-tac fs18 fclg">广州蔓茉莉婚礼策划</p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj8.jpg">
				<p class="f-tac fs18 fclg">情缘婚礼主题会馆</p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj9.jpg">
				<p class="f-tac fs18 fclg"></p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj10.jpg">
				<p class="f-tac fs18 fclg"></p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj11.jpg">
				<p class="f-tac fs18 fclg"></p>
				</a>			
			</div>
			<div class="s-intro f-fl">
				<a href="###">
				<img src="img/sj12.jpg">
				<p class="f-tac fs18 fclg"></p>
				</a>			
			</div>
			<div class="f-cb"></div>
		</div>
	</div> -->
</body>

<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/sh/jquery-1.11.2.js"></script>
<script type="text/javascript">
$(function(){
        var $cOne=$("#minxing li");
        $cOne.click(function(){
                $(this).addClass("cur_option").siblings().removeClass("cur_option");
                //获取当前单击的li无素在全部<li>元素中的索引
                var index = $cOne.index(this);
                $("div.wrap_c > div").eq(index).show().siblings().hide();//取子节点
                //$("div.content2 > div").eq(index).show().siblings().hide();
            })
   
    })  
//文本回复和图文回复
</script>
</html>