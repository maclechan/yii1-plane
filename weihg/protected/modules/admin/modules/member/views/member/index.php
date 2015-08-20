<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>坛城文化后台管理系统</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/base_new.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/font.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/member.css"/>
<script  src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>
<script  src="<?php echo Yii::app()->homeUrl;?>js/jqeryOther.js"></script>
<script  src="<?php echo Yii::app()->homeUrl;?>js/thebase.js"></script>
</head>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：
     <a href="javascript:void(0);" class="ccc_color">系统设置</a> > 
     <a href="javascript:void(0);" class="ccc_color">菜单管理</a> > 
     <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">导航管理</a></div>
     </div>	
     <div class="search">
        <ul class="searchSub">
          <li><a href="<?php echo $this->createUrl('navadd');?>" class="red b_add">添加导航</a></li>
        </ul>
        <div class="clear"></div>
     </div>
     <div class="clear"></div>
     <table id="sample2" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <th width="10%"><span>模块ID</span></th>
            <th width="15%"><span>模块名称</span></th>
            <th width="15%"><span>模块英文</span></th>
            <th width="10%"><span>导航ID</span></th>
            <th width="15%"><span>导航名称</span></th>
            <th><span>操作</span></th>
        </tr>
		<?php 
			if($model){
				foreach($model as $val){
		?>
        <tr id="tr<?php echo $val->id?>">
            <td><?php echo $val->m_id?></td>
            <td><?php echo $val->md->menu_cn?></td>
            <td><?php echo $val->md->menu_en?></td>
            <td><?php echo $val->id?></td>
            <td><?php echo $val->nav_cn?></td>
            <td><a href="<?php echo $this->createUrl('navadd',array('id'=>$val->id));?>" class="Blue">编辑 </a>　<a href="javascript:void(0);" class="sel" onclick="navDel(<?php echo $val->id;?>)">删除</a>
        </td>
        </tr>
		<?php }}?>
      </table>
	<div class="pageBG">
        <div class="pageY fl">
		<?php $pages->itemCount = isset($itemCount) ? $itemCount : $pages->itemCount;?>
        <?php $this->widget("CLinkPager",array(
      			  'pages'=>$pages,
        		  'firstPageLabel'=>"首页",
      			  'prevPageLabel'=>'上一页',
                  'nextPageLabel'=>'下一页',
        		  'lastPageLabel'=>'末页',
	              'header'=>false,
        		  'cssFile'=>Yii::app()->homeUrl."css/newlink.css",
      ));?>
        </div>
		<?php if($pages->pageCount>1):?>
        <div class="pageBG_R fr">共<?php echo $pages->pageCount;?>页</div>
		<?php endif;?>
        <div class="clear"></div>
    </div>
</div>
</body>
</html>