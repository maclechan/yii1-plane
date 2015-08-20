
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/tminus/utimer.css">
	<div class="g-load"></div>
	<div class="g-body">
	<?php 
		foreach ($model as $k => $v) {
			

		?>
		<div class="m-mud">
			<p class="fs11 fc08"><?php echo $v->cname;?></p>
			<p><span class="fs09 fc10 f-fl f-tf"><?php echo $v->cword;?></span><span class="fs06 f-fr fc03"><?php echo $v->tminus;?></span></p>
			<!-- 默认第一条文章 -->
			<?php if($v->tm){ ?>
			<a href="<?php echo $this->createUrl('tminusatc',array("id"=>$v->tm->id));?>" class="m-demo">
				<img class="f-fl" src="<?php echo $v->tm->cover ?>">
				<div class="m-right f-fl">
					<div class="m-box">
						<p><span class="f-fl fs08 fc09 f-tf"><?php echo $v->tm->title;?></span><span class="num f-fr fs06 fc10">浏览<?php echo $v->tm->browse;?></span></p>
						<p class="m-cmt fc10 fs07"><?php echo $v->tm->intro;?></p>
					</div>
				</div>
				<div class="f-cb"></div>
			</a> 
			<?php } ?>
			<div class="m-container">
				<div class="loadmore"></div>
				<!--ajax追加倒计时文章-->
			</div>
			<div data-id="<?php echo $v->id; ?>" class="m-btn fc09 fs08 f-tac">查看更多</div>
			<div class="g-side bg06"></div>

		</div>
		</div>

		<?php }?>	
		
	</div>

<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/person/utimer.js"></script>
