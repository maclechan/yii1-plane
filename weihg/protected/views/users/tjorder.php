	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/pro/proorder.css">
	<div class="g-load"></div>
	<div class="g-body">
		<div class="g-info f-cb">
			<div class="m-left f-fl"><img src="<?php echo $order['goodsimg']?>"></div>
			<div class="m-right f-fl">
				<p class="prottl fs07 fc09 f-tf"><?php echo $order['goodsname']?></p>
				<p class="procost fc06 fs07">订单总额：<span id="allcost" class="fc03 fs08">¥<?php echo $order['price']*$order['rows']?></span></p>
			</div>
		</div>
		<div class="g-side bg06"></div>
		<div class="g-form fs08">
			<div class="m-box">
				<div class="m-left f-fl fc06 f-tal">联系人</div>
				<div class="m-right f-fl fc10 f-tar">
					<input id="name" type="text" />
				</div>
			</div>
			<!-- =========== -->
			<div class="m-box">
				<div class="m-left f-fl fc06 f-tal">手机号</div>
				<div class="m-right f-fl fc10 f-tar">
					<input id="tel" type="text" />
				</div>
			</div>
			<div class="m-box">
				<div class="m-left f-fl fc06 f-tal">地址</div>
				<div class="m-right f-fl fc10 f-tar">
					<input id="addr" type="text" />
				</div>
			</div>
			<div class="m-box last">
				<div class="m-left f-fl fc06 f-tal">备注</div>
				<div class="m-right f-fl fc10 f-tar">
					<input id="msgg" type="text"  />
				</div>
			</div>
		</div>
		<div class="g-side bg06"></div>
		<div class="paymode fs08">
			<div class="f-fl fc06 f-tal">支付方式</div>
			<div id="pay-btn" class="f-fl fc06 f-tar">微信支付</div>
		</div>
		<div class="g-side bg06"></div>
		<!-- 提交订单 -->
		<form action="<?php echo $this->createUrl('/product/protjorderqr')?>" method="POST">
			<!--  -->
			<input id="ordername" class="hide" type="hidden" name="ordername" />
			<input id="orderaddr" class="hide" type="hidden" name="orderaddr" />
			<input id="ordertel" class="hide" type="hidden" name="ordertel" />
			<input id="ordermsgg" class="hide" type="hidden" name="ordermsgg" />
			<input id="t_id" type="hidden" name="t_id" value="<?php echo $order['t_id']?>" />
			<input id="a_id" type="hidden" name="a_id" value="<?php echo $order['a_id']?>" />
			<input id="g_id" type="hidden" name="g_id" value="<?php echo $order['g_id']?>" />
			<input id="goodsname" type="hidden" name="goodsname" value="<?php echo $order['goodsname']?>" />
			<input id="goodsimg" type="hidden" name="goodsimg" value="<?php echo $order['goodsimg']?>" />
			<input id="adviname" type="hidden" name="adviname" value="<?php echo $order['adviname']?>" />
			<input id="price" type="hidden" name="price" value="<?php echo $order['price']?>" />
			<input id="goodsnum" type="hidden" name="rows" value="<?php echo $order['rows']?>" />			
			<button id="sub-btn" type="submit" class="fc01 fs08 bg07 br01 f-tac">提交订单</button>
		</form>
	</div>
	<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/pro/proorder.js"></script>