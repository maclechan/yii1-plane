	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/person/uorder.css">
	<div class="g-load"></div>
	<div class="g-body">
		<div class="g-head fc09 fs08 bg01">
			<a href="<?php echo $this->createUrl('/users/usersorder');?>"><span class="f-fl fc09 f-tac <?php echo $type=='all' ? 'js-selected' : '';?>">全部</span></a>
			<a href="<?php echo $this->createUrl('/users/usersorder',array("type"=>0));?>"><span class="f-fl fc09 f-tac <?php echo $type=='0' ? 'js-selected' : '';?>">待付款</span></a>
			<a href="<?php echo $this->createUrl('/users/usersorder',array("type"=>1));?>"><span class="f-fl fc09 f-tac <?php echo $type=='1' ? 'js-selected' : '';?>">待发货</span></a>
			<a href="<?php echo $this->createUrl('/users/usersorder',array("type"=>2));?>"><span class="f-fl fc09 f-tac <?php echo $type=='2' ? 'js-selected' : '';?>">待收货</span></a>
			<a href="<?php echo $this->createUrl('/users/usersorder',array("type"=>3));?>"><span class="f-fl fc09 f-tac <?php echo $type=='3' ? 'js-selected' : '';?>">待评价</span></a>
		<!--	<span class="f-fl f-tac">退/换货</span>-->
		</div>
		<div class="g-list">
			<?php 
			$ii = 1;
			foreach($order_data as $order_val){
			if($order_val->status == '0'){
			?>		
			<!-- 待付款 -->
			<div class="m-box unpaid">
				<p class="m-head fc09 fs06">
					<span class="f-fl ">订单号：<label><?php echo $order_val->order_id?></label></span>
					<span class="f-fl "><label><?php echo $order_val->advi_name?></label></span>
					<a class="ctat f-fl f-tac" href="http://wpa.qq.com/msgrd?v=3&uin=1624808548&site=qq&menu=yes"></a>
					<span class="f-fr fc03">待付款</span>
				</p>
				<a class="m-inf">
					<img class="f-fl" src="<?php echo $order_val->goods_img?>">
					<p class="ttl f-fl fc09 fs06"><?php echo $order_val->goods_name?></p>
					<div class="f-fr fc08 fs06">
						<p class="f-tar">¥<?php echo $order_val->price?></p>
						<p class="fc10 f-tar">×<?php echo $order_val->rows?></p>
					</div>
					<p class="pnum fs07 fc10">应该付款：<label class="fs07 fc08">¥<?php echo $order_val->price*$order_val->rows?></label></p>
				</a>
				<div class="m-opt f-cb">
					<form name="payform<?php echo $ii;?>" action="<?php echo $this->createUrl('/product/usersorderpay');?>" method="post">
					<input type="hidden" name="oid" value="<?php echo $order_val->id?>">
					<!-- ========================================2/13 -->
					<button class="m-btn f-fr fc09 fs08 bg01" type="submit" name="paysubmit<?php echo $ii;?>" >立即支付</button>
					</form>
					<span class="m-btn cclorder f-fr fc09 fs08" msgval="<?php echo $order_val->id?>">取消订单</span>
				</div>
			</div>
			<div class="g-side bg06 f-cb"></div>
			<?php }elseif($order_val->status == 1){?>
			<!-- 待发货 -->
			<div class="m-box unpost">
				<p class="m-head fc09 fs06">
					<span class="f-fl ">订单号：<label><?php echo $order_val->order_id?></label></span>
					<span class="f-fl "><label><?php echo $order_val->advi_name?></label></span>
					<a class="ctat f-fl f-tac" href="http://wpa.qq.com/msgrd?v=3&uin=1624808548&site=qq&menu=yes"></a>
					<span class="f-fr fc03">待发货</span>
				</p>
				<a class="m-inf">
					<img class="f-fl" src="<?php echo $order_val->goods_img?>">
					<p class="ttl f-fl fc09 fs06"><?php echo $order_val->goods_name?></p>
					<div class="f-fr fc08 fs06">
						<p class="f-tar">¥<?php echo $order_val->price?></p>
						<p class="fc10 f-tar">×<?php echo $order_val->rows?></p>
					</div>
					<p class="pnum fs07 fc10">实际付款：<label class="fs07 fc08">¥<?php echo $order_val->price*$order_val->rows?></label></p>
				</a>
				<div class="m-opt f-cb">
					<span class="m-btn f-fr fc09 fs08">提醒发货</span>
				</div>
			</div><div class="g-side bg06 f-cb"></div>
			<?php }elseif($order_val->status == 2){?>
			<!-- 待收货 -->
			<div class="m-box alpost">
				<p class="m-head fc09 fs06">
					<span class="f-fl ">订单号：<label><?php echo $order_val->order_id?></label></span>
					<span class="f-fl "><label><?php echo $order_val->advi_name?></label></span>
					<a class="ctat f-fl f-tac" href="http://wpa.qq.com/msgrd?v=3&uin=1624808548&site=qq&menu=yes"></a>
					<span class="f-fr fc03">已发货</span>
				</p>
				<a class="m-inf">
					<img class="f-fl" src="<?php echo $order_val->goods_img?>">
					<p class="ttl f-fl fc09 fs06"><?php echo $order_val->goods_name?></p>
					<div class="f-fr fc08 fs06">
						<p class="f-tar">¥<?php echo $order_val->price?></p>
						<p class="fc10 f-tar">×<?php echo $order_val->rows?></p>
					</div>
					<p class="pnum fs07 fc10">实际付款：<label class="fs07 fc08">¥<?php echo $order_val->price*$order_val->rows?></label></p>
				</a>
				<div class="m-opt f-cb">
					<span class="m-btn f-fr fc09 fs08 cfmget" msgval="<?php echo $order_val->id?>">确认收货</span>
				</div>
			</div><div class="g-side bg06 f-cb"></div>
			<?php }elseif($order_val->status == 3){?>
			<!-- 待评价 -->
			<div class="m-box uncmt">
				<p class="m-head fc09 fs06">
					<span class="f-fl ">订单号：<label><?php echo $order_val->order_id?></label></span>
					<span class="f-fl "><label><?php echo $order_val->advi_name?></label></span>
					<a class="ctat f-fl f-tac" href="http://wpa.qq.com/msgrd?v=3&uin=1624808548&site=qq&menu=yes"></a>
					<span class="f-fr fc03">待评价</span>
				</p>
				<a class="m-inf">
					<img class="f-fl" src="<?php echo $order_val->goods_img?>">
					<p class="ttl f-fl fc09 fs06"><?php echo $order_val->goods_name?></p>
					<div class="f-fr fc08 fs06">
						<p class="f-tar">¥<?php echo $order_val->price?></p>
						<p class="fc10 f-tar">×<?php echo $order_val->rows?></p>
					</div>
					<p class="pnum fs07 fc10">实际付款：<label class="fs07 fc08">¥<?php echo $order_val->price*$order_val->rows?></label></p>
				</a>
				<div class="m-opt f-cb">
					<a href="/users/usersordercomments/id/<?php echo $order_val->id?>.html"><span class="m-btn f-fr fc09 fs08">立即评价</span></a>
				</div>
			</div>
			<?php }elseif($order_val->status == 4){?>
			<!-- 退款受理中 -->
			<div class="m-box uncmt">
				<p class="m-head fc09 fs06">
					<span class="f-fl ">订单号：<label><?php echo $order_val->order_id?></label></span>
					<span class="f-fl "><label><?php echo $order_val->advi_name?></label></span>
					<a class="ctat f-fl f-tac" href="http://wpa.qq.com/msgrd?v=3&uin=1624808548&site=qq&menu=yes"></a>
					<span class="f-fr fc03">受理中</span>
				</p>
				<a class="m-inf">
					<img class="f-fl" src="<?php echo $order_val->goods_img?>">
					<p class="ttl f-fl fc09 fs06"><?php echo $order_val->goods_name?></p>
					<div class="f-fr fc08 fs06">
						<p class="f-tar">¥<?php echo $order_val->price?></p>
						<p class="fc10 f-tar">×<?php echo $order_val->rows?></p>
					</div>
					<p class="pnum fs07 fc10">实际付款：<label class="fs07 fc08">¥<?php echo $order_val->price*$order_val->rows?></label></p>
				</a>
			</div>	
			<?php }elseif($order_val->status == 5){?>
			<!-- 已取消 -->
			<div class="m-box uncmt">
				<p class="m-head fc09 fs06">
					<span class="f-fl ">订单号：<label><?php echo $order_val->order_id?></label></span>
					<span class="f-fl "><label><?php echo $order_val->advi_name?></label></span>
					<a class="ctat f-fl f-tac" href="http://wpa.qq.com/msgrd?v=3&uin=1624808548&site=qq&menu=yes"></a>
					<span class="f-fr fc03">已取消</span>
				</p>
				<a class="m-inf">
					<img class="f-fl" src="<?php echo $order_val->goods_img?>">
					<p class="ttl f-fl fc09 fs06"><?php echo $order_val->goods_name?></p>
					<div class="f-fr fc08 fs06">
						<p class="f-tar">¥<?php echo $order_val->price?></p>
						<p class="fc10 f-tar">×<?php echo $order_val->rows?></p>
					</div>
					<p class="pnum fs07 fc10">实际付款：<label class="fs07 fc08">¥<?php echo $order_val->price*$order_val->rows?></label></p>
				</a>
				<div class="m-opt f-cb">
					<a href="/product/protjdetail/id/<?php echo $order_val->recom_id?>.html"><span class="m-btn f-fr fc09 fs08">再次购买</span></a>
				</div>
			</div>			
			<?php }elseif($order_val->status == 6){?>
			<!-- 已完成 -->
			<div class="m-box uncmt">
				<p class="m-head fc09 fs06">
					<span class="f-fl ">订单号：<label><?php echo $order_val->order_id?></label></span>
					<span class="f-fl "><label><?php echo $order_val->advi_name?></label></span>
					<a class="ctat f-fl f-tac" href="http://wpa.qq.com/msgrd?v=3&uin=1624808548&site=qq&menu=yes"></a>
					<span class="f-fr fc03">已完成</span>
				</p>
				<a class="m-inf">
					<img class="f-fl" src="<?php echo $order_val->goods_img?>">
					<p class="ttl f-fl fc09 fs06"><?php echo $order_val->goods_name?></p>
					<div class="f-fr fc08 fs06">
						<p class="f-tar">¥<?php echo $order_val->price?></p>
						<p class="fc10 f-tar">×<?php echo $order_val->rows?></p>
					</div>
					<p class="pnum fs07 fc10">实际付款：<label class="fs07 fc08">¥<?php echo $order_val->price*$order_val->rows?></label></p>
				</a>
			</div>			
			<?php }
			$ii++;}?>
		</div>
		<!-- 确认弹出框 -->
		<div class="g-pmt" id="cancle">
			<input type="hidden" id="qxid">
			<p class="fs09 fc01 f-tac f-wb">提醒：确定取消此订单吗？</p>
			<div class="cfm m-btn f-fl fs12 fc01 f-tac">是</div>
			<div class="ccl m-btn f-fl fs12 fc01 f-tac">否</div>
		</div>
		<div class="g-pmt" id="rcvd">
			<p class="fs09 fc01 f-tac f-wb">提醒：确认已经收到货了吗？</p>
			<div class="cfm m-btn f-fl fs12 fc01 f-tac">是</div>
			<div class="ccl m-btn f-fl fs12 fc01 f-tac">否</div>
		</div>

	</div>
	<div class="g-mask"></div>
	<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/person/uorder.js"></script>