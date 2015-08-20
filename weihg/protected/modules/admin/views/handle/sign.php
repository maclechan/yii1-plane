<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>系统后台登陆页面</title>
<script type="text/javascript" language="javascript">
	function check(){
		document.getElementById('check').src="";
	}
</script>

<link href="<?php echo CSS_URL; ?>/bootstrap.css" rel="stylesheet" media="screen">
<script src="<?php echo JS_URL; ?>/bootstrap.js"></script>
<script src="<?php echo JS_URL; ?>/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/login.css" />
</head>
<body>
<div class="login">
	<div class="pic"><img src="<?php echo Yii::app()->homeUrl;?>images/admin_img/loginpic.png" /></div>
	
	<form class="form-signin" id="login-form" method="post" action="/admin/sign.html">
		<input class="inputText input-block-level" placeholder="登陆名" type="text" name="LoginForm[username]">
		<input class="inputText input-block-level" placeholder="密码" type="password" name="LoginForm[password]">
		
		<input name="verifyCode" id="verifyCode" class="zc_txt2" type="text" placeholder="输入验证码"/>
		<?php 
				$this->widget('CCaptcha',array(
					'showRefreshButton'=>false,
					'clickableImage'=>true,
					'imageOptions'=>array(
						'title'=>'点击刷新图片',
						'height'=>30,
						'width'=>100,
					)
				)); 
			?><em id="em5" style="display:none">验证码错误</em>
			
			<label class="checkbox">
				<input class="inputAuto" type="checkbox" value="1"  name="LoginForm[rememberMe]">
				记住用户名
			</label>
			<button class="btn btn-large btn-primary" type="submit">登 陆</button>
			
	</form>

</div>
	<!--尾部文字部分-->
	<div class="footer">
		<p>2013 &#169; 坛城文化 版权所有</p>
	</div>
</body>
</html>