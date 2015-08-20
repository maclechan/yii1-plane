	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/person/ucart.css">
	<div class="g-load"></div>
	<div class="g-body">		
		<div class="g-list">
			<?php 
			foreach($cart_data as $val){
			$cart = CJSON::decode($val->cart_desc);
			?>
			<div class="m-box">
				<a class="m-inf" href="<?php echo $this->createUrl('/product/protjdetail',array("id"=>$val->recom_id))?>">
					<img class="f-fl" src="<?php echo $cart['goodsimg'];?>">
					<p class="ttl f-fl fc09 fs06"><?php echo $cart['goodsname'];?></p>
					<div class="f-fr fc08 fs06">
						<p class="f-tar">¥<?php echo $cart['price'];?></p>
						<p class="fc10 f-tar">×<?php echo $cart['rows'];?></p>
					</div>
					<p class="pnum fs07 fc10">应该付款：<label class="fs07 fc08">¥<?php echo $cart['price']*$cart['rows'];?></label></p>
				</a>
				<div class="m-opt f-cb">
					<a class="bg01 m-btn f-fr fc09 fs08" href="<?php echo $this->createUrl('/users/userscartsub',array("cartid"=>$val->id))?>">提交订单</a>
				</div>
			</div>
			<div class="g-side bg06 f-cb"></div>
			<?php }?>
		</div>
	</div>
<script type="text/javascript">
	window.onload=function(){
		$(".g-load").hide();
		$(".g-body").show();
	}
</script>