<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>商家后台登陆页面</title>
<script type="text/javascript" language="javascript">
	function check(){
		document.getElementById('check').src="";
	}
</script>
<link href="<?php echo CSS_URL; ?>/bootstrap.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/login.css" />
</head>
<body>
<div class="login">
	<!--输入部分-->
	<form id="login-form" class="form-signin" method="post" action="/assocer/handle/sign.html" onsubmit="return checkform()">
		<input id="username" class="inputText input-block-level" placeholder="会长登陆名" type="text" name="LoginForms[name]">
		<input id="password" class="inputText input-block-level" placeholder="密码"  type="password" name="LoginForms[password]">
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
				<input class="inputAuto" type="checkbox" value="1" name="LoginForms[rememberMe]">
				记住密码 
			</label>
			<button class="btn btn-large btn-primary" type="submit">会长登陆</button>
	
	</form>
	
</div>
	<!--尾部文字部分-->
	<div class="footer">
		<p>2013 &#169; 坛城文化 版权所有</p>
	</div>
	<script>
		function checkform(){
			var user = document.getElementById('username').value;
			var pawd = document.getElementById('password').value;
			if(user==''){
				alert('请输入用户名');
				document.getElementById('username').focus();
				return false;
			}
			if(pawd==''){
				alert('请输入密码');
				document.getElementById('password').focus();
				return false;
			}		
		}
	</script>
</body>
</html>