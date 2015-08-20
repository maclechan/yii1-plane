<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> 易舱网后台管理平台 </title>
<link href="<?php echo CSS_URL; ?>/bootstrap.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/base_new.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/font.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/table.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/member.css"/>
<script  src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>
<script  src="<?php echo Yii::app()->homeUrl;?>js/role.js"></script>
</head>
<body>
<div class="main">
     <div class="tab">
     <div class="tabLeft fl">当前位置：
     <a href="javascript:void(0);" class="ccc_color">系统管理</a> > 
     <a href="javascript:void(0);" class="ccc_color">权限管理</a> > 
     <a href="<?php echo $this->createUrl("role")?>" class="ccc_color">角色管理</a> >
     <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">角色内成员</a>
     </div>
     </div>
     <div class="pageBG"></div>
	</div>
     <div class="shops_add" style="min-height:100px;">
     <div class="btn_con m3">　&nbsp;角色名称：<span class="red_color"><?php echo $role->role_name;?></span></div>
	 <input type="hidden" id="rid" value="<?php echo $role->role_id;?>">
	 <input type="hidden" id="rname" value="<?php echo $role->role_name;?>">
     <div class="show2">
        <div class="juese fl">
          <p>角色内人员</p>
          <div class="juese_con">
              <ul id="role">
			  <?php foreach($model as $val){?>
			  <li><label class="checkbox"><input name="roll[]" type="checkbox" value="<?php echo $val->user_id?>"/><?php echo $val->user_name;?></label></li>
			  <?php }?>
              </ul>
          </div>
          <div class="juese_down m5">
         		<div class="btn-group" data-toggle="buttons-checkbox">
               	 	<input type="button" name="checkall" id="checkall" class="btn btn-primary" value="全选">
                	<input type="button" name="remove"  id="remove" class="btn btn-primary" value="删除">
                	<input type="button" name="removeall" id="removeall" class="btn btn-primary" value="全部删除">
                	<input type="button" class="btn btn-primary" onclick="javascript:history.go(-1);" value="返回">
                </div>
          </div>
        </div>
        <div class="clear"></div>
     </div>
	</div>
     <div class="pageBG m10"> </div>
</div>
</body>
</html>
