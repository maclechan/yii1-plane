<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/person/pwork.css">
	<div class="g-load"></div>
	<div class="g-body">
		<p class="g-box bg01"><span id="pname" class="fs08 fc06 f-fl">By <?php echo $advi_anli->advi_name?></span><span id="likebtn" class="likebtn f-fr <?php if($fav_status){echo "redheart";}?>"></span><span id="sharebtn" class="f-fr"></span></p>
		<div class="g-main">
			<p class="m-title fs10 f-tac fc08"><?php echo $advi_anli->title?></p>
			<div class="m-body fs06 fc09 f-tac">
<!--				<p>以蓝色的丝带位主，衬托出大气与时尚，尤其是花艺师刘社强老师手工制作的那个孔雀，更是给整场的布局中，添加了一丝大气。新人对此次婚礼也是非常的重视，所以特别请了全国各地最优秀的团队，来为他们共同打造出这场盛大的婚礼视觉盛宴</p>
				<p>以蓝色的丝带位主，衬托出大气与时尚，尤其是花艺师刘社强老师手工制作的那个孔雀，更是给整场的布局中，添加了一丝大气。新人对此次婚礼也是非常的重视，所以特别请了全国各地最优秀的团队，来为他们共同打造出这场盛大的婚礼视觉盛宴</p>
				<p>以蓝色的丝带位主，衬托出大气与时尚，尤其是花艺师刘社强老师手工制作的那个孔雀，更是给整场的布局中，添加了一丝大气。新人对此次婚礼也是非常的重视，所以特别请了全国各地最优秀的团队，来为他们共同打造出这场盛大的婚礼视觉盛宴</p>
				<p>以蓝色的丝带位主，衬托出大气与时尚，尤其是花艺师刘社强老师手工制作的那个孔雀，更是给整场的布局中，添加了一丝大气。新人对此次婚礼也是非常的重视，所以特别请了全国各地最优秀的团队，来为他们共同打造出这场盛大的婚礼视觉盛宴</p>
				<P>
					<img src="/images/1.jpg"/>
				</p>
				<P>
					<img src="/images/1.jpg"/>
				</p>
				<P>
					<img src="/images/1.jpg"/>
				</p>
				<P>
					<img src="/images/1.jpg"/>
				</p>-->
				<?php echo $advi_anli->desc?>
			</div>
		</div>
		<!-- 联系顾问 -->
		
	</div>
	<div class="g-ctat bg06">
			<div class="fs10 fc09 f-tac"><a href="http://wpa.qq.com/msgrd?v=3&uin=1624808548&site=qq&menu=yes" id="t-qq" class="br01 fc09">QQ联系</a></div>
			<div class="fs10 fc09 f-tac"><a href="tel:01234567890" id="t-tel" class="br01 fc09">电话联系</a></div>
	</div>
	<!-- ====================================================================添加分享蒙版 -->
	<div class="share-mask"></div>
	<input type="hidden" id="an_id" name="an_id" value="<?php echo $advi_anli->id?>">
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/person/pwork.js"></script>
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
		title: '<?php echo $advi_anli->title?>-微婚购', // 分享标题
		link: 'http://weihungo.com/site/guwanlixq/id<?php echo $advi_anli->id?>/share_id/<?php echo Yii::app()->user->getState("openid")?>', // 分享链接
		imgUrl: 'http://weihungo.com<?php echo $advi_anli->cover?>', // 分享图标
		success: function () { 
			// 用户确认分享后执行的回调函数
			//alert("分享成功");
			$.ajax({
				type: "POST",
				url: "http://weihungo.com/site/guwanlishare",
				data: {'id':<?php echo $advi_anli->id?>},
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
		title: '<?php echo $advi_anli->title?>-微婚购', // 分享标题
		desc: '微婚购是专业的婚礼服务平台,欢迎到访。', // 分享描述
		link: 'http://weihungo.com/site/guwanlixq/id<?php echo $advi_anli->id?>/share_id/<?php echo Yii::app()->user->getState("openid")?>', // 分享链接
		imgUrl: 'http://weihungo.com<?php echo $advi_anli->cover?>', // 分享图标
		type: 'link', // 分享类型,music、video或link，不填默认为link
		dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
		success: function () { 
			// 用户确认分享后执行的回调函数
			//alert("发送成功");
			$.ajax({
				type: "POST",
				url: "http://weihungo.com/site/guwanlishare",
				data: {'id':<?php echo $advi_anli->id?>},
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