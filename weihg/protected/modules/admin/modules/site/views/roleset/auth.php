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
     <div class="tabLeft fl">当前位置：<a href="javascript:void(0);" class="ccc_color">系统管理</a> > <a href="javascript:void(0);" class="ccc_color">权限管理</a> > <a href="<?php echo $this->createUrl("roleauth")?>" class="ccc_color">授权管理</a></div>
     </div>
     <div class="pageBG">
		<div class="pt_8">	
	        <a href="<?php echo $this->createUrl('roleadd');?>"><button class="btn btn-small" type="button" id="addShops"><i class="icon-user"></i> 添加角色</button></a>
	    </div>
	</div>
      <table class="same_t table table-bordered table-hover" style="width:60%">
        <thead>
        <tr>
            <th width="50%">角色名称</th>
            <th><i class=" icon-wrench"> </i> 操作</th>
        </tr>
        </thead>
        <tbody>
		<?php if($model){?>
		<?php foreach($model as $list):?>
        <tr id="<?php echo 'tr'.$list->role_id;?>">
            <td><?php echo $list->role_name;?></td>
            <td><span class="b_blue"><a href="<?php echo $this->createUrl('authadd',array('id'=>$list->role_id));?>"><i class="icon-user"></i> 功能授权</a></span></td>
        </tr>
		<?php endforeach;?>
		<?php }?>
		</tbody>
      </table>
      <div class="pageBG"></div>
    </div>
</body>
</html>