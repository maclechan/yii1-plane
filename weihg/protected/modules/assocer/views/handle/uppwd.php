<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="pragma" content="no-cache">  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">  
<meta http-equiv="expires" content="0">  
<title>顾问后台管理系统</title>
	<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/jquery-1.11.1.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/whg-manage-common.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/html5shiv.js"></script>
    <![endif]-->
<script type="text/javascript">
$(function(){
	$('#pwdsub').click(function(){
		var old = $('#oldPwd').val();
		var pwd1 = $('#newPwd').val();
		var pwd2 = $('#newPwd2').val();
		if(old=='' || pwd1=='' || pwd2=='')
		{
			alert('请完整输入');
			return false;
		}
		if(old == pwd1)
		{
			alert('新密码不能于原密码相同!');
			return false;
		}
		if(pwd1.length<6)
		{
			alert('密码长度不能小于6位');
			return false;
		}
		if(pwd1!=pwd2)
		{
			alert('新密码输入不一致,请重新输入!');
			return false;
		}
	});
});
</script>
</head>
<body>
<!--bread-->
<div class="breadcrumbs breadcrumbs-fixed">
    <ul class="breadcrumb">
        <li><i class="glyphicon glyphicon-home"></i><a href='#'> 首页 > </a></li> 
        <li><a href='#'> 修改密码 </a></li>
    </ul>
</div>
<!--bread-->

<div class="whg-admin-wrap">
    <div class="mange-panel">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><span aria-hidden="true" class="glyphicon glyphicon-eye-close"></span> 更改密码</h3>
          </div>
          <div class="panel-body">  
          <form action="<?php Yii::app()->createUrl('uppwd');?>" method="post">
          	<dl class="dl-horizontal">
			  <dt>当前密码</dt><dd><input class="form-control" name="old_pass" type="password" id="oldPwd"/></dd><br />
			  <dt>新密码</dt><dd><input class="form-control" name="new_pass" type="password" id="newPwd"/></dd><br />
			  <dt>确认新密码</dt><dd><input class="form-control" name="new_pass2" type="password" id="newPwd2"/></dd><br />
			  <dt></dt>
			  <dd>
			  <input name="" type="submit"  id="pwdsub" value="确认修改"  class="btn btn-primary Save" />　
			  <input name="" type="reset" class="btn btn-primary" value="取消" /></dd>
			</dl> 
			</form>
          </div>
        </div>
    </div>
</div>
</body>
</html>