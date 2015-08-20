<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=640,target-densitydpi=320,user-scalable=no">
	<meta name="format-detection" content="telephone=no" />
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="description" content="微婚购">
	<meta name="keywords" content="微婚购">
	<title>微婚购</title>
	<!-- @STYLE -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/front/base.css">
	<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/front/lib/jquery-1.11.2.js"></script>
</head>
<body>
<?php echo $content;?>
	<!-- 弹出菜单start -->
	<div class="g-whgbtn"></div>
	<div class="g-whgmenu">
		<ul>
			<li id="btn1" class="f-fl"><a href="/"></a></li>
			<li id="btn2" class="f-fl"><a href="/site/guwlist.html"></a></li>
			<li id="btn3" class="f-fl"><a href="http://demo.tanchengwh.com/forum.php?mod=forumdisplay&fid=46"></a></li>
			<li id="btn4" class="f-fl"><a href="/users/usersindex.html"></a></li>
			<li id="btn5" class="f-fl"><a href="/users/usersorder.html"></a></li>
			<li id="btn6" class="f-fl"><a href="/users/usersfav.html"></a></li>
			<li id="btn7" class="f-fl"><a href="/tminus/tminuslist.html"></a></li>
		</ul>
		<div class="g-whgclose"></div>
	</div>
	<script type="text/javascript">
		$(".g-whgbtn").click(function(){
			$(".g-whgmenu").css({"position":"fixed","display":"block"});
			document.addEventListener("touchmove",popup,false);
		});
		$(".g-whgclose").click(function(){
			$(this).parent().css("display","none");
			document.removeEventListener("touchmove",popup,false);
		});
		//固定锁屏	
		var popup = function(e){
			e.preventDefault();
			e.stopPropagation();
		};
		// ================================================================2/14
		$(".g-whgbtn").bind("touchmove",function(e){
			e.preventDefault();
			var posX=e.originalEvent.changedTouches[0].clientX;
			var posY=e.originalEvent.changedTouches[0].clientY;
			$(this).css({"left":posX-50,"top":posY-50});
		});
	</script>		
	<!-- 弹出菜单end -->
</body>
</html>