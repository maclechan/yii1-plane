	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/person/uploadcmt.css">
	<div class="g-load"></div>
	<div class="g-body">
	<form action="/users/userscommentssave" method="post" enctype="multipart/form-data">
		<div class="g-head bg05">
			<span class="g-back f-fl"></span>
			<span class="ttl f-fl fc01 fs13">评论</span>
		</div>
		<div class="m-box">
			<p class="fs08 fc12">评价我的宝贝</p>
			<div class="m-inf">
				<img class="f-fl" src="<?php echo $order->goods_img?>">
				<p class="ttl f-fl fc09 fs06"><?php echo $order->goods_name?></p>
				<div class="f-fr fc08 fs06">
					<p class="f-tar">¥<?php echo $order->price?></p>
					<p class="fc10 f-tar">×<?php echo $order->rows?></p>
				</div>
				<p class="pnum fs07 fc10">应该付款：<label class="fs07 fc08">¥<?php echo $order->price*$order->rows?></label></p>
			</div>
			<textarea id="proCmt" class="fs07 fc10 br01" placeholder="写评价，拿红包，对，就是辣么任性..."></textarea>
			<p class="nobd fs06 fc03">结婚就是要秀出来，上传美图才是硬道理！</p>
			<p class="nobd">
				<span class="imgb f-fl"><input type="file"	id="file1" name="CommentsImg[p_path][]" /></span>
				<span class="imgb f-fl"><input type="file"  id="file2" name="CommentsImg[p_path][]" /></span>
				<span class="imgb f-fl"><input type="file"  id="file3" name="CommentsImg[p_path][]" /></span>
				<span class="imgb f-fl"><input type="file"  id="file4" name="CommentsImg[p_path][]" /></span>
				<span class="imgb f-fl"><input type="file"  id="file5" name="CommentsImg[p_path][]" /></span>
			</p>
			<div class="f-cb"></div>
		</div>
		<div class="g-side bg06"></div>
		<div class="m-box m-box1">
			<p class="fs08 fc12">评价我的顾问</p>
			<div class="m-list">
				<img class="f-fl" src="<?php echo $order->odadvi->icon?>">
				<div class="m-info f-fl">
					<p class="m-intr"><span class="pname fs08 fc05"><?php echo $order->odadvi->name?></span><span class="pttl  f-tac fs07 fc06">高级婚礼顾问</span></p>
					<p class="m-intr fs07 fc06"><span class="pname">作品:<span><?php echo $order->odadvi->anlis?></span></span><span class="pttl f-tac">粉丝:<span><?php echo $order->odadvi->zans?></span></span></p>
				</div>
			</div>
			<textarea id="perCmt" class="fs07 fc10 br01" placeholder="顾问给不给力，你说了算"></textarea>
			<div class="m-score fc08 fs09">
				<p class="m-left f-fl">服务态度</p>
				<div class="m-right f-fl">
					<p class="m-star" id="ser">
						<span id="ser1" score="1"></span>
						<span id="ser2" score="2"></span>
						<span id="ser3" score="3"></span>
						<span id="ser4" score="4"></span>
						<span id="ser5" score="5"></span>
					</p>					
				</div>
				<p class="m-left f-fl">专业能力</p>
				<div class="m-right f-fl">
					<p class="m-star" id="skill">
						<span id="skill1" score="1"></span>
						<span id="skill2" score="2"></span>
						<span id="skill3" score="3"></span>
						<span id="skill4" score="4"></span>
						<span id="skill5" score="5"></span>
					</p>
				</div>
				<p class="m-left f-fl">导向性</p>
				<div class="m-right f-fl">
					<p class="m-star" id="guide">
						<span id="guide1" score="1"></span>
						<span id="guide2" score="2"></span>
						<span id="guide3" score="3"></span>
						<span id="guide4" score="4"></span>
						<span id="guide5" score="5"></span>
					</p>
				</div>
			</div>
			<div class="f-cb"></div>
		</div>
		<div class="g-tail bg06">
			<!--<button id="ccl" class="fs08 fc03 bg09 f-tac f-fl br01">取消</button>-->
			<input type="hidden" name="goods_id" value="<?php echo $order->goods_id?>"/>
			<input type="hidden" name="adviser_id" value="<?php echo $order->advi_id?>"/>
			<input type="hidden" name="order_id" value="<?php echo $order->id?>"/>
			<input type="hidden" name="goods_c" id="procomment" value=""/>
			<input type="hidden" name="adviser_c" id="percomment" value=""/>
			<input type="hidden" name="service" id="serScore" value=""/>
			<input type="hidden" name="skill" id="skScore" value=""/>
			<input type="hidden" name="guide" id="guScore" value=""/>			
			<button id="sbm" type="submit" class="fs08 fc01 bg05 f-tac f-fl br01">提交</button>
		</div>
	</form>
	</div>
	<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/person/uploadcmt.js"></script>