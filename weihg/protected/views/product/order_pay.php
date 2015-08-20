	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/pro/proorder.css">
	<div class="g-load"></div>
	<div class="g-body">
		<div class="g-info f-cb">
			<div class="m-left f-fl"><img src="<?php echo $order_pay['goodsimg']?>"></div>
			<div class="m-right f-fl">
				<p class="prottl fs07 fc09 f-tf"><?php echo $order_pay['goodsname']?></p>
				<p class="procost fc06 fs07">订单总额：<span id="allcost" class="fc03 fs08">￥<?php echo $order_pay['price']*$order_pay['rows']?></span></p>
			</div>
		</div>
		<div class="g-side bg06"></div>

		<!-- 提交支付 -->
		<button id="sub-btn" type="button"  onclick="callpay()" class="fc01 fs08 bg07 br01 f-tac">确认支付</button>
	</div>
	<script type="text/javascript">
	window.onload=function(){
	$(".g-load").hide();
	$(".g-body").show();
	}
	
	function callpay()
	{
		WeixinJSBridge.invoke('getBrandWCPayRequest',<?php echo $biz_package;?>,function(res){
			WeixinJSBridge.log(res.err_msg);
			if(res.err_msg == 'get_brand_wcpay_request:cancel'){
				alert('支付取消');
			}else if(res.err_msg == 'get_brand_wcpay_request:ok'){
				window.location.href="/users/usersorder/type/1.html";
			}else if(res.err_msg == 'get_brand_wcpay_request:fail'){
				alert('支付失败');
			} 
		//	alert(res.err_msg);
		});
	}	
	</script>