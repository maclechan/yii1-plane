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
<script  src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>
<script  src="<?php echo Yii::app()->homeUrl;?>js/jqeryOther.js"></script>
<script  src="<?php echo Yii::app()->homeUrl;?>js/role.js"></script>
</head>
<body>
<div class="main">
     <div class="tab">
     <div class="tabLeft fl">当前位置：
     	<a href="javascript:void(0);" class="ccc_color">系统管理</a> >
      	<a href="javascript:void(0);" class="ccc_color">权限管理</a> > 
 		<a href="<?php echo $this->createUrl("role")?>" class="ccc_color">角色管理</a> > 
     	<a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">角色修改</a></div>
     </div>
     <div class="shops_add" style="min-height:100px;">
	    <table class="same_t table table-hover">
	    <input type="hidden" id="rid" value="<?php echo $model->role_id;?>">
	    	<thead style="background-color:#FFF">
	      		<tr>
		      		<td style="text-align:right"><label>修改角色</label></td>
		      		<td style="text-align:left">
			      		<input type="text" name="role" id="role"  value="<?php echo $model->role_name;?>" />
		            </td>
	            </tr>
	            <tr>
		      		<td style="text-align:right"><label>角色描述</label></td>
		      		<td style="text-align:left"><textarea id="intro" rows="3" name="intro"><?php echo $model->intro;?></textarea></td>
	            </tr>
	            <tr>
		      		<td style="text-align:right"><label>状态</label></td>
		      		<td style="text-align:left">
			      		<label class="radio"><input type="radio" name="status" value="1" id="dsdy1" <?php echo $model->status==1?'checked="true"':'';?>/>启用</label>
						<label class="radio"><input type="radio" class="txt" name="status" value="0" id="dsdy2" <?php echo $model->status==0?'checked="true"':'';?>/>禁用	</label>
		            </td>
	            </tr>
	            <tr>
		      		<td style="text-align:right"><label></label></td>
		      		<td style="text-align:left">
						<input id="roleedit" class="btn btn-primary" name="" type="button" value="确定修改" />  
            			<input class="btn btn-primary" onclick="window.location='<?php echo $this->createUrl("role")?>'" type="button" value="返回" />
		            </td>
	            </tr>
	        </thead>
	    </table>
    </div> 
     <div class="pageBG"> </div>
</div>
</body>
</html>
