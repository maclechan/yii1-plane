<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>坛城文化后台管理系统</title>
<link href="<?php echo CSS_URL; ?>/bootstrap.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/base_new.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/font.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/table.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/member.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>javascript/YiCangDialog4/"/>
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
    $("#allmem").click(function(){
        if($("#allmem").attr("checked")==true){
            $("#toMail").val("").attr("disabled",true);
        }else if($("#allmem").attr("checked")==false){
            $("#toMail").val("").attr("disabled",false);
        }
    });
});
</script>
</head>
<body> 
<div class="main">
    <div class="tab">
        <div class="tabLeft">当前位置：
        <a href="javascript:void(0);" class="ccc_color">系统管理</a> > 
        <a href="javascript:void(0);" class="ccc_color">私信管理</a> > 
        <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">私信发送</a></div>
    </div>
    <!-- 表单部分 -->
    <form action="<?php echo $this->createUrl('/admin/site/handle/messageadd'); ?>" method="post" name="mailForm" id="msgForm">     
        <div class="show2">
            <ul class="mod_add2">
                <li><span>收件人</span>
                    <input type="text" value="<?php echo isset($msg->user_name)?$msg->user_name:'';?>" class="lab_250" id="toMail" name="toMsg">
                    <label class="checkbox inline"><input type="checkbox" value="allmem"  id="allmem" name="allmem">所有会员</input>
                </li>
                
                <li><span>信息主题</span><input type="text" value="" class="lab_250" id="mailSubject" name="title"></li>
            </ul>
            <div class="zixun2"  id="contentTemplateType2"><em>信息内容</em><textarea id="content" name="content" class="lab_250" rows="12"></textarea></div>
            <div class="clear"></div>
            <ul class="mod_add2">
                <li><span></span>
                    <input type="submit" class="btn btn-primary" id="send" value="发送" name="send">&#12288;
            		<input type="reset" class="btn btn-primary"  value="取消" name="">
                </li>
            </ul>
        </div>
        <div class="pageBG"></div>
    </form>
</div>
<script type="text/javascript">
	$('#send').click(function(){
		if(!$('#toMail').val()&&$('#toMail').attr("disabled")!=true){
			//$.dialog.alert('请填写收件人邮箱');
           
            alert("请填写收件人");
			return false;
		}else if(!$("#mailSubject").val()){
            alert("请填写主题");
            return false;
        }else if(!$("#content").val()){
            alert("请填写内容");
            return false;
        }
	});
</script>
</body>
</html>