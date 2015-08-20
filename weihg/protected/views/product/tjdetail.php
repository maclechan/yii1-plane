<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/pro/prodetail.css">
	<div class="g-load"></div>
	<div class="g-body">
		<div class="m-img">
			<img src="<?php echo $tjdetail->gds->goods_img?>">
		</div>
		<div class="m-inf">
			<p class="prottl f-wb fs07 fc09"><?php echo $tjdetail->gds->goods_name?></p>
			<p class="procost"><span id="ncost" class="new fc03 fs06">¥<?php echo $tjdetail->gds->shop_price?></span><span id="ocost" class="ever fc10 fs05">¥<?php echo $tjdetail->gds->price?></span></p>
			<p class="proopt fc10 fs06">
				<span id="like" class="opt f-tac">
					<span id="ltxt" class="opttxt <?php if($fav_status){echo 'redheart';}?>" msgval="<?php echo $tjdetail->id;?>">喜欢(<label id="lnum"><?php echo $tjdetail->gds->zans?></label>)</span>
				</span>
				<span id="share" class="opt f-tac">
					<span id="stxt" class="opttxt">分享(<label id="snum"><?php echo $tjdetail->gds->shares?></label>)</span>
				</span>
			</p>
		</div>
		<div class="g-side bg06"></div>
		<div class="m-sgg">
			<p class="fc05 fs07">顾问推荐理由：</p>
			<p id="sggT" class="fc11 fs06"><?php echo $tjdetail->recommend_reason?></p>
		</div>
		<?php if($tjdetail->gds->bs_name &&  $tjdetail->gds->bs_location){?>
		<div class="g-side bg06"></div>
		<div class="m-sgg">
			<p href="proshop.html" class="fc05 fs07" id="toshop">产品线下体验店：<div id="sname" class="fc11 fs06 f-tf"><?php echo $tjdetail->gds->bs_name?></div></p>
			<!-- 以后多个线下店可循环以下div-->
			<div class="s-info f-cb">
				<p class="fc11 fs07"><?php echo $tjdetail->gds->bs_name?></p>
				<p class="fc11 fs07">地址：<?php echo $tjdetail->gds->bs_location?></p>
				<div class="m-map fc11 fs04">查看地图</div>
			</div>
		</div>
		<?php }?>
		<div class="g-side bg06"></div>
		<div class="m-detail">
			<div class="m-header">
				<p class="proopt fc09 fs07">
					<span id="detail" class="opt f-tac">
						<span id="h-dtl" class="opttxt">商品细节</span>
					</span>
					<span id="cmt" class="opt f-tac">
						<span id="h-cmt" class="opttxt">用户评价(<label class="cmtnum"><?php echo count($commentsdata)?></label>)</span>
					</span>
				<!--	<span id="other" class="opt f-tac">
						<span id="h-sug" class="opttxt">同品推荐</span>
					</span>-->
				</p>
			</div>
			<!-- 图文详情 -->
			<div class="d-imgtxt">
				<!-- 定宽  后台获取数据填充 -->
				<?php echo $tjdetail->gds->goods_desc?>
			</div>
			<div class="g-side bg06"></div>
			<!-- 评论 !!! -->
			<div class="d-cmt">
				<p id="cttl" class="fc09 fs07">用户评价(<span class="cmtnum"><?php echo count($commentsdata)?></span>)</p>
				<!-- 评论内容 -->
				<div class="d-cmtbox f-cb">
					<?php 
					if($commentsdata){
					foreach($commentsdata as $val){?>
					<div class="d-left"><img src="/images/front_img/default.png"></div>
					<div class="d-right">
						<div class="d-inf">
							<span class="d-cname fc03 fs06"><?php echo $val->mem->uname?$val->mem->uname:'微婚购网友';?></span>
							<span class="d-ctime fc11 fs06"><?php echo date('Y-m-d',$val->add_time);?></span>
						</div>
						<p class="d-content fs07 fc05"><?php echo $val->goods_c;?></p>
						<!-- 有图片 -->
						<div class="d-img">
							<?php foreach($val->cimg as $img_val){?>
							<img src="/<?php echo $img_val->img_path;?>">
							<?php }?>
						</div>
					</div>
					<?php }}else{echo '暂无评论';}?>
					<div class="f-cb"></div>
				</div>
				<!-- End 评论内容 -->
				<!-- 查看更多评价 -->
				<div class="cmt-btn f-tac fc06 fs07">查看更多评价</div>
			</div>
			<div class="g-side bg06"></div>
			<div id="end"></div>
			<div class="f-cb"></div>
		</div>
		<!-- 加入购物车、购买 -->
		<div class="g-btm fs08 bg06">
			<span id="addCart" class="bg09 fc03 ">加入购物车</span>
			<span id="buy" class="bg05 fc01 ">立即购买</span>
			<a href="/users/userscart"><span id="cart" class=""></span></a>
		</div>
	</div>
	<!-- 立即购买弹出层 -->
	<div class="mask">
		<div class="acinfo bg01">
			<div class="acleft f-fl"><img src="<?php echo $tjdetail->gds->goods_img?>"></div>
			<div class="acright f-fl">
				<p class="prottl fs07 fc09 f-tf"><?php echo $tjdetail->gds->goods_name?></p>
				<p class="procost fc03 fs06">¥<?php echo $tjdetail->gds->shop_price?></p>
			</div>
		</div>
		<div class="acside bg06"></div>
		<div class="acnum">
			<p class="fs08">数量</p>
			<button type="button" class="cut fs10 fc09 bg01 f-fl">-</button>
			<input id="numval" class="fs10 f-fl f-tac"  value="1" />
			<button type="button" class=" plus fs10 fc09 bg01 f-fl">+</button>
		</div>
		<div class="f-cb"></div>
		<!-- 表单 -->
		<form action="<?php echo $this->createUrl('/product/protjorder')?>" method="post">
			<input id="t_id" type="hidden" name="t_id" value="<?php echo $tjdetail->id?>" />
			<input id="a_id" type="hidden" name="a_id" value="<?php echo $tjdetail->advi_id?>" />
			<input id="g_id" type="hidden" name="g_id" value="<?php echo $tjdetail->goods_id?>" />
			<input id="goodsname" type="hidden" name="goodsname" value="<?php echo $tjdetail->gds->goods_name?>" />
			<input id="goodsimg" type="hidden" name="goodsimg" value="<?php echo $tjdetail->gds->goods_img?>" />
			<input id="adviname" type="hidden" name="adviname" value="<?php echo $tjdetail->advi_name?>" />
			<input id="price" type="hidden" name="price" value="<?php echo $tjdetail->gds->shop_price?>" />
			<input id="goodsnum" type="hidden" name="rows" />
			<button type="submit" class="done-btn f-tac fs08 fc01 bg05">确定</button>
			<button type="button" class="ccl-btn f-tac fs08 fc01 bg05">取消</button>
		</form>
		
	</div>
	<div class="bigImg">
		<p class="f-tac fs10 fc05">1/6</p>
	</div>
	<div class="share-mask"></div>
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/pro/prodetail.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
  wx.config({
    debug: false,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',
    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage'] // 所有要调用的 API 都要加到这个列表中
  });
  wx.ready(function (){
    // 在这里调用 API
	//----分享到朋友圈
	wx.onMenuShareTimeline({
		title: '<?php echo $tjdetail->gds->goods_name?>-微婚购', // 分享标题
		link: 'http://weihungo.com/product/protjdetail/id<?php echo $tjdetail->id?>/share_id/<?php echo Yii::app()->user->getState("openid")?>', // 分享链接
		imgUrl: 'http://weihungo.com<?php echo $tjdetail->gds->goods_img?>', // 分享图标
		success: function () { 
			// 用户确认分享后执行的回调函数
			//alert("分享成功");
			$.ajax({
				type: "POST",
				url: "http://weihungo.com/product/protjshare",
				data: {'id':<?php echo $tjdetail->id?>},
				success:function(a){
				}
			});				
		},
		cancel: function () { 
			// 用户取消分享后执行的回调函数
			//alert("分享取消");
		}
	});	
	//----发送给朋友
	wx.onMenuShareAppMessage({
		title: '<?php echo $tjdetail->gds->goods_name?>-微婚购', // 分享标题
		desc: '微婚购是专业的婚礼服务平台,欢迎到访。', // 分享描述
		link: 'http://weihungo.com/product/protjdetail/id<?php echo $tjdetail->id?>/share_id/<?php echo Yii::app()->user->getState("openid")?>', // 分享链接
		imgUrl: 'http://weihungo.com<?php echo $tjdetail->gds->goods_img?>', // 分享图标
		type: 'link', // 分享类型,music、video或link，不填默认为link
		dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		success: function () { 
			// 用户确认分享后执行的回调函数
			//alert("发送成功");
			$.ajax({
				type: "POST",
				url: "http://weihungo.com/product/protjshare",
				data: {'id':<?php echo $tjdetail->id?>},
				success:function(a){
				}
			});			
		},
		cancel: function () { 
			// 用户取消分享后执行的回调函数
			//alert("发送取消");
		}
	});	
  });
  wx.error(function(res){
	//alert(res);
  });
</script>