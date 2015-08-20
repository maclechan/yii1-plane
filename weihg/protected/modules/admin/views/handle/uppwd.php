<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>坛城文化后台管理系统</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/base_new.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/font.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/table.css"/>
<script  src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>
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
<form action="<?php Yii::app()->createUrl('uppwd');?>" method="post">
<div class="main">
    <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">我的首页</a> > <a href="javascript:void(0);" class="ccc_color">修改密码</a></div>
    </div>
    <div class="show2">
        <ul class="mod_add2">
            <li><span>当前密码</span><input name="old_pass" type="password" id="oldPwd"/></li>
            <li><span>新密码</span><input name="new_pass" type="password" id="newPwd"/></li>
            <li><span>确认新密码</span><input name="new_pass2" type="password" id="newPwd2"/></li>
        </ul>

        <div class="clear"></div>
    </div>

    <div class="pageBG">
        <div class="pt_8">　<input name="" type="submit"  id="pwdsub" value="确认修改" class="Save"/>　<input name="" type="reset" value="取消" /></div>
    </div>
</div>
</form>
</body>
</html>