	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/pro/lplist.css">
	<div class="g-load"></div>
	<div class="g-body">
		<div class="g-head">
			<span class="sgg f-fl fs08 fc09 f-tac js-selected">推荐产品</span>
			<span class="cho f-fl fs08 fc09 f-tac">作品精选</span>
		</div>
		
		<div class="g-list1">
		<?php foreach($fav_goods as $val){?>
			<div class="m-box f-fl">
				<div class="m-pro">
					<p>
						<a href="<?php echo $this->createUrl('/site/guwhome',array("id"=>$val->advi_id));?>"><img class="f-fl" src="<?php echo $val->advi->icon?>">
						<span class="f-fl fs09 fc08"><?php echo $val->advi->name?></span>
						<span class="f-fl fs08 fc02">高级</span></a>
					</p>
					<a class="m-img" href="<?php echo $this->createUrl('/product/protjdetail',array("id"=>$val->recom_id))?>"><img src="<?php echo $val->gds->goods_img?>"></a>
					<p class="m-inf">
						<span class="f-fl fs07 fc06"><?php echo $val->gds->shop_price?></span>
						<span class="islike f-fr bg06 fc03 fs06 br01" msgval="<?php echo $val->recom_id?>"><?php echo $val->gds->zans?></span>
					</p>
				</div>
			</div>
		<?php }?>
		</div>
		<!-- 作品精选 -->
		<div class="g-list2">
			<div class="m-box f-fl">
				<?php foreach($anli_arr as $k=>$v){?>
				<div class="m-pro">				
					<p>
						<a href="<?php echo $this->createUrl('/site/guwhome',array("id"=>$k));?>"><img class="f-fl" src="<?php echo $v['icon'];?>">
						<span class="f-fl fs09 fc08"><?php echo $v['adviname'];?></span>
						<span class="f-fl fs08 fc02">高级</span></a>
					</p>
					<?php 
					foreach($v as $kk=>$vv){					
					if(is_array($vv)){
					?>
					<a class="m-img" href="/site/guwanlixq/id/<?php echo $vv['id']?>">
						<img src="<?php echo $vv['img']?>">
						<p class="fc01"><span class="ttl f-fl fs09 f-tf"><?php echo $vv['title']?></span><span class="islike_anli f-fr fs06" msganli="<?php echo $vv['id']?>"><?php echo $vv['zans']?></span><span class="cmt f-fr fs06">99</span></p>
					</a>
					<?php }}?>
				</div>
				<?php }?>
			</div>
		</div>
		<div class="g-pmt">
			<input type="hidden" id="tjid">
			<p class="fs09 fc01 f-tac f-wb">提醒：确定取消对她的喜欢吗？</p>
			<div class="cfm m-btn f-fl fs12 fc01 f-tac">是</div>
			<div class="ccl m-btn f-fl fs12 fc01 f-tac">否</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/pro/lplist.js"></script>