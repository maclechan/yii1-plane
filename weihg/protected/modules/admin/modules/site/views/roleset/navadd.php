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
<style type="text/css">
label {
  display: inline;line-height:26px;
  margin-bottom: 0;
}
</style>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：
     <a href="javascript:void(0);" class="ccc_color">系统设置</a> > 
     <a href="javascript:void(0);" class="ccc_color">菜单管理</a> > 
     <a href="<?php echo $this->createUrl('index')?>>" class="ccc_color">导航管理</a> > 
     <a href="<?php echo $this->createUrl('navadd');?>" class="ccc_color">添加导航</a></div>
     </div>
      <div class="shops_add" style="min-height:200px;">
       <table class="same_t table table-hover">
	   <input type="hidden" id="nid" value="<?php echo isset($nav)?$nav->id:'';?>"/>
      	<thead style="background-color:#FFF">
      		<tr>
	      		<td style="text-align:right"><label>模块名称</label></td>
	      		<td style="text-align:left">
		      		<select name="m_id">
						<?php foreach($model as $list){?>
						<option value="<?php echo $list->id;?>" <?php if(isset($nav)){echo ($list->id==$nav->m_id)?'selected':'';}?>/><?php echo $list->menu_cn;?>==><?php echo $list->menu_en?></option>
						<?php }?>
		            </select>
	            </td>
            </tr>
            <tr>
	            <td style="text-align:right"><label>导航名称</label></td>
	      		<td style="text-align:left">
		      		<input type="text" name="name" id="name"  value="<?php echo isset($nav)?$nav->nav_cn:'';?>" />
	            </td>
            </tr>
            <tr>
	            <td style="text-align:right"><label>排序</label></td>
	      		<td style="text-align:left">
		      		<input type="text" name="sort" id="sort"  value="<?php echo isset($nav)?$nav->sort:5;?>" />
	            </td>
            </tr>
            <tr>
            <td style="text-align:right"></td>
      		<td style="text-align:left">
	      		<input id="navadd" class="btn btn-primary" name="navadd" type="submit" value="确定添加" />　
        		<input id="navreset" class="btn btn-primary" name="reset" type="button" value="取消" />　
       			<input id="navback" class="btn btn-primary" name="navback" type="button" value="返回" />
            </td>
            </tr>
      	</thead>
      </table>
    </div>

    <div class="pageBG"> </div>
</div>
</body>
</html>
