	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/system/rcmad.css">
	<script type="text/javascript">
		window.onload=function(){
			$(".g-load").hide();
			$(".g-body").show();
		}
	</script>	
	<div class="g-load"></div>
	<div class="g-body">
		<p class="m-ttl f-tac"><span class="fs12 fc02 bd02 br01">推荐的顾问</span></p>
		<div class="m-pbox  fs04">
				<?php 
				$i = 1;
				foreach($advi_data as $val){
					if($i%2 == 0){
						$classplay = 'm-per f-tar fc01';
						$classplay2 = 'm-ptxt f-fr bgr';
						$classplay3 = 'm-pimg f-fr';
					}else{
						$classplay = 'm-per f-tal fc01';
						$classplay2 = 'm-ptxt f-fl bgl';
						$classplay3 = 'm-pimg f-fl';
					}
				?>
				<a id="m-per<?php echo $i?>" class="<?php echo $classplay;?>" href="<?php echo $this->createUrl('guwhome',array("id"=>$val->id));?>">
					<img class="<?php echo $classplay3;?>" src="<?php echo $val->icon?>" draggable="false"></img><span class="<?php echo $classplay2;?>"><?php echo $val->name?></span><span class="m-cirbr f-fl"></span>
				</a>
				<?php $i++;}?>
		</div>
		<p class="m-btn f-tac"><a class="bd02 br01 bg03 fs12 fc01" href="<?php echo $this->createUrl('guwlist');?>">查看更多</a></p>
	</div>