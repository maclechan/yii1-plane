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
<script  src="<?php echo Yii::app()->homeUrl;?>js/impower.js"></script>
</head>
<body>
<div class="main">
    <div class="tab">
		<div class="tabLeft fl">当前位置：<a href="javascript:void(0);" class="ccc_color">系统管理</a> > <a href="javascript:void(0);" class="ccc_color">权限管理</a> > <a href="<?php echo $this->createUrl("roleauth")?>" class="ccc_color">授权管理</a></div>
    </div>
    <div class="btn_con m3">　&nbsp;角色名称：<span class="red_color"><?php echo $role->role_name;?></span></div>
	<?php
		$marr = explode(',',$role->role_menu);
		$navarr = explode(',',$role->role_nav);
		$acarr = explode(',',$role->role_action);
	?>
    <div class="show2">
	<?php if($model){?>
	<?php foreach($model as $list){?>
        <div class="juese fl">
			<div class="juese_top"><label class="checkbox"><input onclick="checkAll(this);" name="m[]" type="checkbox" value="<?php echo $list->id;?>" <?php echo in_array($list->id,$marr)?'checked':'';?>/><?php echo $list->menu_cn;?></label></div>
			<div class="juese_con">
				<ul>
				<?php if($list->nav){?>
				<?php foreach($list->nav as $nav){?>
				<li><label class="checkbox"><input name="nav[]" type="checkbox" value="<?php echo $nav->id;?>" onclick="checkNav(this);" <?php echo in_array($nav->id,$navarr)?'checked':'';?>/><?php echo $nav->nav_cn;?></label>
				<?php if($nav->ac){?>
					<ul>
				<?php foreach($nav->ac as $ac){
						$acbeli = $ac->action_belonging?','.$ac->action_belonging:'';
				?>
                        <li><label class="checkbox"><input name="ac[]" type="checkbox" value="<?php echo $ac->action_en.$acbeli;?>" onclick="checkAc(this);" <?php echo in_array($ac->action_en,$acarr)?'checked':'';?>/><?php echo $ac->action_cn;?></label></li>
				<?php }?>
					</ul>
				</li>
				<?php 
						}
					}
				}
				?>
				</ul>
          </div>
        </div>
	<?php 
		}
	}
	?>
        <div class="clear"></div>
    </div>
	<input type="hidden" id="rid" value="<?php echo $role->role_id;?>">
    <div class="pageBG m10">
        <div class="pt_8">　
        <a><button class="btn btn-small" type="button" id="cancel"><i class="icon-remove-sign"></i> 取消所有权限</button></a>
        <a><button class="btn btn-small" type="button" id="funcsub"><i class="icon-ok-sign"></i> 确定</button></a>
        <a><button class="btn btn-small" type="button" onclick="javascript:history.go(-1);"><i class="icon-share-alt"></i> 返回</button></a>
        </div>
    </div>
</div>
</body>
</html>
