<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/person/phome.css">
	<div class="g-load"></div>
	<div class="g-body">
		<div class="m-intr">
			<p style="width:100%;height:100%;text-align:center;"><img id="pimg" src="<?php echo $advi_data->icon?>"></p>
			<div class="m-info">
				<p class="pname fs12 fc01"><?php echo $advi_data->name?></p>
				<p class="pttl fs08 fc01">知名婚礼顾问<a href="<?php echo $this->createUrl('guwhomeintro',array("id"=>$advi_data->id))?>"><span style="padding-left:30px;" class="fs08 fc01">更多>></span></a></p>
				<p id="pbtn" class="pbtn fs08"><a id="itel" href="tel:0123456789">电话</a><a id="icat" href="http://wpa.qq.com/msgrd?v=3&uin=1624808548&site=qq&menu=yes">聊天</a><a id="igo" href="<?php echo $this->createUrl('/product/protjlist',array("id"=>$advi_data->id))?>">新人go</a></p>
			</div>
		</div>

		<div id="img-ctn" class="m-img">
			<ul id="imgul">
				<?php 
					if($advi_data->anli){
						$ii = 1;
						foreach($advi_data->anli as $aval){
							if($ii == 1){
								echo '<li class="cur"><a href="'.$this->createUrl('guwanlixq',array("id"=>$aval->id)).'"><img src="'.$aval->cover.'"></a></li>';
							}elseif($ii == 2){
								echo '<li class="right"><a href="'.$this->createUrl('guwanlixq',array("id"=>$aval->id)).'"><img src="'.$aval->cover.'"></a></li>';
							}elseif($ii == 3){
								echo '<li class="right2"><a href="'.$this->createUrl('guwanlixq',array("id"=>$aval->id)).'"><img src="'.$aval->cover.'"></a></li>';
							}elseif($ii == 4){
								echo '<li class="left"><a href="'.$this->createUrl('guwanlixq',array("id"=>$aval->id)).'"><img src="'.$aval->cover.'"></a></li>';
							}elseif($ii == 5){
								echo '<li class="left2"><a href="'.$this->createUrl('guwanlixq',array("id"=>$aval->id)).'"><img src="'.$aval->cover.'"></a></li>';
							}else{
								echo '<li><a href="'.$this->createUrl('guwanlixq',array("id"=>$aval->id)).'"><img src="'.$aval->cover.'"></a></li>';
							}
							$ii++;
						}
					}
				?>
			</ul>
		</div>

	</div>
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/person/phome.js"></script>