<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/pro/prolist.css">
	<div class="g-load"></div>
	<div class="g-body">
		<div class="m-pro">
			<ul>
				<?php 
				if($tjlist){
				foreach($tjlist as $tjval){
				?>
				<li><a href="<?php echo $this->createUrl('/product/protjdetail',array("id"=>$tjval->id))?>"><img src="<?php echo $tjval->gds->goods_img?>"></a>
					<p class="m-inf">
						<span class="procost fs08 fc06 f-fl"><?php echo $tjval->gds->shop_price?></span><span class="islike fs06 fc03 bg06 br00 f-fr <?php if($tjval->fav){echo 'redheart';}?>" msgval="<?php echo $tjval->id?>"><?php echo $tjval->gds->zans?></span>
					</p>
				</li>
				<?php }}?>
			</ul>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/pro/prolist.js"></script>