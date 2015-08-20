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
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js?skin=default"></script>
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
        <a href="javascript:void(0);" class="ccc_color">公告管理</a> > 
        <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">公告修改</a></div>
    </div>
    <!-- 表单部分 -->
    <form action="<?php echo $this->createUrl('/admin/site/handle/noticeaddupdate'); ?>" method="post" name="mailForm" id="msgForm">     
        <div class="show2">
            <ul class="mod_add2">
                <li><span>发布类型</span>
                <select name="type" id='toMail'>
                	<option value="1" <?php if($notice->type==1){echo "selected = 'selected'";}?>>后台公告</option>
                	<option value="2" <?php if($notice->type==2){echo "selected = 'selected'";}?>>前台公告</option>
                </select>
                </li>               
                <!-- 隐藏域   接受传过来的公告id -->
                <input type="hidden" name="notice_id" value="<?php echo $notice->id ?>" />
                <li><span>公告标题</span><input type="text" value="<?php echo $notice->title;?>" class="lab_250" id="mailSubject" name="title"></li>
            </ul>
            <div class="zixun2"  id="contentTemplateType2"><em>公告内容</em><textarea id="content" name="content" rows="12" class="lab_250"><?php echo $notice->content;?></textarea> </div>
            <div class="clear"></div>
            <ul class="mod_add2">
                <li><span></span>
                    <input type="submit" class="btn btn-primary" id="send" value="修改" name="send">
            		<input type="reset" class="btn btn-primary"  value="取消" name="">
                </li>
            </ul>
        </div>
        </form>
        <div class="pageBG"></div>
</div>
<script type="text/javascript">
	$('#send').click(function(){
		if(!$('#toMail').val()&&$('#toMail').attr("disabled")!=true){
			//$.dialog.alert('请填写收件人邮箱');
           
            alert("请选择");
			return false;
		}else if(!$("#mailSubject").val()){
            alert("请填写标题");
            return false;
        }else if(!$("#content").val()){
            alert("请填写内容");
            return false;
        }else{
            if($("#allmem").attr("checked")==false){        
                $.ajax({
                    type:"POST",
                    url:"/admin/site/handle/noticeadd",
                    data:{"user":$('#toMail').val()},
                    async:false,
                    error:function(e){
                        alert(e.responseText);
                        return false;
                    },
                    success:function(data){
                        if(!data){
                            alert("发送失败");
                            return false;
                        }else{
                            //alert("发送成功");
                            $("#msgForm").submit();
                        }
                    }   
                });
            }else{
               // alert("发送成功");
                 $("#msgForm").submit();
            }
        }
	});
</script>
</body>
</html>