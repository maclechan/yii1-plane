
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/tminus/ustrategy.css">
	<div class="g-load"></div>
	<?php if($model){ ?>
	<div class="g-body">
		<p class="ttl fs13 f-tac fc08"><?php echo $model->title; ?></p>
		<p class="fc06 fs09"><span class="f-fl">作者：坛城文化官网</span><span class="f-fr">浏览 <?php echo $model -> browse;?></span></p>
		<div class="f-cb"></div>
		<div class="m-detail">
			<p><?php echo $model->desc; ?></p>
		</div>
	</div>
<?php } ?>
<script type="text/javascript">
	window.onload=function(){
		$(".g-load").hide();
		$(".g-body").show();
	}
</script>