<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/wcard/xtshow.css">

	<div id="body1" class="g-body">
		<div class="playbtn play"></div>
		<div class="sec">
			<section id="sec1" class="show" data-src="/images/front_img/wcard/bg1.jpg">
				<div class="iarrow"></div>
			</section>
			<section id="sec2" class="hide" data-src="/images/front_img/wcard/bg2.jpg">
				<div class="m-cir m-cir1">
					<div class="m-cir m-cir2"></div>
				</div>
				<div class="m-info">
					<p class="f-tal fs08 fc13">
						<span>新郎:<label class="m_name"></label></span>
						<span>新娘:<label class="w_name"></label></span>
					</p>
					<p id="time" class="f-tal fs08 fc13 f-tf"></p>
					<p id="addr" class="f-tal fs08 fc13 f-tf"></p>
				</div>
				<div class="iarrow"></div>
			</section>
			<section id="sec3" class="hide" data-src="/images/front_img/wcard/bg2.jpg">
				<div class="m-view f-tac fs07 fc03"></div>
				<ul>
					
				</ul>
				<div class="m-boom fadeOut"></div>
				<div class="larrow"></div>
				<div class="rarrow"></div>
				<p class="m-dot f-tac"></p>
				<div class="iarrow"></div>
			</section>
			<section id="sec4" class="hide" data-src="/images/front_img/wcard/bg3.jpg">
				<div class="m-info  fs09 fc13">
					<p class="f-tac">
						<span>新郎:<label class="m_name"></label></span>
						<span>新娘:<label class="w_name"></label></span>
					</p>
					<p id="time1" class="f-tac fs08 fc13"></p>
					<p id="addr1" class="f-tac fs08 fc13"></p>
				</div>
				<div class="m-txt"></div>
				<div class="m-tel">
					<a class="f-tac f-fl" href="tel:01234567890"><span class="fc13 fs08">新郎电话</span></a>
					<a class="f-tac f-fl" href="tel:01234567890"><span class="fc13 fs08">新娘电话</span></a>
					<div class="f-cb"></div>
				</div>
				<div class="m-reply">
					<!-- 如果第一次进入或者没有提交任何数据 -->
					<div class="cover">
						<div class="replybtn hide"></div>
					</div>
					<!-- 如果已经提交数据的 -->
					<div class="cover1 fc01 fs08">
						<p><span>姓名：<label id="gname"></label></span><span>手机：<label id="gtel"></label></span></p>
						<p>是否出席：<span id="gbool"></p>
						<p>出席人数：<span id="pnum"></p>
						<p>馈赠礼金：<span id="pcount"></span></p>
						<p class="m-wish">祝福语：<span id="wish"></span></p>
						<div class="m-editbtn bg05 fc01 fs08 f-tac">修改</div>
					</div>
				</div>
				<div class="sendTxt" data-href="wishwall.html"></div>
			</section>
		</div>
		<div class="m-replycover hide">
			<div class="m-replyinfo fs08 fc08">
				<p>姓名：<input id="replyname" class="m-input fs08" type="text" name=""/></p>
				<p>手机：<input id="replytel" class="m-input fs08" type="text" name=""/></p>
				<p class="isreply">是否出席：<span id="prst" class="js-selected" data-val="1">是</span><span id="abst"  data-val="0">否</span></p>
				<p>出席人数：<button id="cut" class="fc03 fs08 f-tac">-</button><button id="replynum" class="fc03 fs08 f-tac">1</button><button id="add" class="fc03 fs08 f-tac">+</button></p>
				<p>馈赠礼金：<input id="replycount" class="m-input fs08" type="text" name=""/><button id="weipay" class="fc08 fs08 f-tac">微信支付</button></p>
				<p><textarea id="wishtxt" class="fc08 fs08 f-tal" placeholder="写下你对新人的祝福"></textarea></p>
				<p class="opt"><button id="exit" class="fs08">退出</button><button id="sbm" class="fs08">提交</button></p>
			</div>
		</div>
	</div>

<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/wcard/xtshow.js"></script>