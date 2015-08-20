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
<script  src="<?php echo Yii::app()->homeUrl;?>js/thebase.js"></script>
</head>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">基础信息</a> > <a href="aclist.html" class="ccc_color">动作管理</a> > <a href="acadd.html" class="ccc_color">添加动作</a></div>
     </div>
    <div class="shops_add">
    <table class="same_t table table-hover">
    	<input type="hidden" id="ac" value="<?php echo isset($ac)?$ac->id:'';?>"/>
      	<thead style="background-color:#FFF">
      		<tr>
	      		<td style="text-align:right"><label>模块名称</label></td>
	      		<td style="text-align:left">
		      		<select name="mid" id="mid">
						<?php foreach($menu as $val):?>
							<option value="<?php echo $val->id;?>" <?php if(isset($ac)){echo ($val->id==$ac->md->id)?'selected':'';}?>/><?php echo $val->menu_cn;?>==><?php echo $val->menu_en;?></option>
						<?php endforeach;?>
		            </select>
	            </td>
            </tr>
            <tr>
	            <td style="text-align:right"><label>导航名称</label></td>
	      		<td style="text-align:left">
		            <select name="nav" id='nav'>
						<?php if($nav){?>
						<?php foreach($nav as $nval):?>
						<option value="<?php echo $nval->id;?>" <?php if(isset($ac)){echo ($ac->nav->id==$nval->id)?'selected':'';}?>/><?php echo $nval->nav_cn;?></option>
						<?php endforeach;?>
					<?php }?>
	            </select>		      		
	            </td>
            </tr>
            <tr>
	            <td style="text-align:right"><label>默认控制器</label></td>
	      		<td style="text-align:left">
		      		<input type="text" name="" id="ctl"  value="<?php echo isset($ac)?$ac->default_ctl:'';?>" />
	            </td>
            </tr>
            <tr>
	            <td style="text-align:right"><label>动作名称</label></td>
	      		<td style="text-align:left">
		      		<input type="text" name="" id="accn"  value="<?php echo isset($ac)?$ac->action_cn:'';?>" />
	            </td>
            </tr>
            <tr>
	            <td style="text-align:right"><label>动作英文</label></td>
	      		<td style="text-align:left">
		      		<input type="text" name="" id="acen"  value="<?php echo isset($ac)?$ac->action_en:'';?>" />
	            </td>
            </tr>
            <tr>
	            <td style="text-align:right"><label>附属动作</label></td>
	      		<td style="text-align:left">
		      		<input type="text" name="" id="acbeling" style="width:300px;"  value="<?php echo isset($ac)?$ac->action_belonging:'';?>" />
	            </td>
            </tr>
            <tr>
	            <td style="text-align:right"><label>排序</label></td>
	      		<td style="text-align:left">
		      		<input type="text" name="" id="sort" class='span1' value="<?php echo isset($ac)?$ac->sort:5;?>" />
	            </td>
            </tr>
            <tr>
            <td style="text-align:right"></td>
      		<td style="text-align:left">
	      		<input id="acadd" class="btn btn-primary" type="submit" value="确定添加" />　
        		<input id="acreset" class="btn btn-primary" type="button" value="取消" />　
       			<input id="acback" class="btn btn-primary" type="button" value="返回" />
            </td>
            </tr>
      	</thead>
      </table>
	</div>
	
    <div class="pageBG"> </div>
</div>
</body>
</html>