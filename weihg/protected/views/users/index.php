	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/person/uhome.css">
	<div class="g-load"></div>
	<div class="g-body">
		<div class="m-box1">
			<div class="u-name">
				<p class="f-tac"><img src="<?php echo $info['icon']?$info['icon']:'/images/front_img/default.png';?>"></p>
				<p class="name f-tac fs13 fc01"><?php echo $info['uname']?$info['uname']:'微婚购';?></p>
				<p class="cart f-tal"><a href="/users/userscart"><span class="cnum fc03 fs04 bg01 f-tac"><?php echo $gwrows;?></span></a></p>
			</div>
		</div>
		<div class="g-side bg06 f-cb"></div>
		<div class="g-list">
			<ul class="ul1 fc08">
				<a class="ttl" href="/users/usersfav" ><label class="fc08 fs11">我喜欢的</label><span class="f-fr fc10 fs07 f-tar">查看全部</span></a>
				<li class="fs08 f-cb fc09">
					<a class="f-fl" href="/users/usersfav/set/1"><label class="fc09">产品推荐</label></a>
					<a class="f-fl" href="/users/usersfav/set/2"><label class="fc09">作品精选</label></a>
				</li>
			</ul>
		</div>
		<div class="g-side bg06 f-cb"></div>
		<div class="g-list">
			<ul class="ul2">
				<a class="ttl fs11" href="<?php echo $this->createUrl('/users/usersorder');?>"><label class="fc08">我的订单</label><span class="f-fr fc10 fs07 f-tar">查看全部已购买订单</span></a>
				<li class="fs08 f-cb fc09">
					<a class="unpaid f-fl" href="<?php echo $this->createUrl('/users/usersorder',array("type"=>0));?>"><label class="fc09">待付款</label></a>
					<a class="unsend f-fl" href="<?php echo $this->createUrl('/users/usersorder',array("type"=>1));?>"><label class="fc09">待发货</label></a>
					<a class="unget f-fl" href="<?php echo $this->createUrl('/users/usersorder',array("type"=>2));?>"><label class="fc09">待收货</label></a>
					<a class="uncmt f-fl" href="<?php echo $this->createUrl('/users/usersorder',array("type"=>3));?>"><label class="fc09">待评价</label></a>
					<!--<a class="afsale f-fl" href="http://www.baidu.com"><label class="fc09">售后中</label></a>-->
				</li>
			</ul>
		</div>
		<div class="g-side bg06 f-cb"></div>
		<div class="g-list">
			<ul class="ul3">
				<a class="ttl fs11"><label class="fc08">微社区管理</label></a>
				<li>
					<a class="fs08" href="http://demo.tanchengwh.com/forum.php?mod=forumdisplay&fid=46"><label class="fc08">我参与的活动</label><span class="f-fr fc10 fs07 f-tar">查看参加的活动</span></a>
				</li>
				<li>
					<a class="fs08" href="http://demo.tanchengwh.com/forum.php?mod=forumdisplay&fid=46"><label class="fc08">我参与的话题</label><span class="f-fr fc10 fs07 f-tar">查看参加过的话题</span></a>
				</li>
				<li>
					<a class="fs08" href="http://demo.tanchengwh.com/forum.php?mod=forumdisplay&fid=46"><label class="fc08">我的通知</label><span class="f-fr fc10 fs07 f-tar"><label id="msgnum"></label>查看通知</span></a>
				</li>
			</ul>
		</div>
		<div class="g-side bg06 f-cb"></div>
	<!--	<div class="g-list">
			<ul class="ul4">
				<a class="ttl fs11"><label class="fc08">顾问管理</label></a>
				<li>
					<a class="fs08" href="http://www.baidu.com"><label class="fc08">最近联系人<label><span class="f-fr fc10 fs07 f-tar">查看最近联系过的顾问</span></a>
				</li>
			</ul>
		</div>
		<div class="g-side bg06 f-cb"></div>-->
	</div>
	<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/person/uhome.js"></script>