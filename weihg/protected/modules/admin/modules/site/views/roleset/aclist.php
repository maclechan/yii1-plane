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
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">系统设置</a> > <a href="javascript:void(0);" class="ccc_color">菜单管理</a> > <a href="<?php echo $this->createUrl('index')?>>" class="ccc_color">动作管理</a></div>
     </div>
     
     <div class="search">
	 	<form method='post' class="form-search" action="<?php echo $this->createUrl('acsearch');?>">
        <ul class="searchSub " style="float:left">
			<li>
			  <select name="menu_id" class="span2">
	            <option value='0'>请选择</option>
				<?php foreach($menu as $mval){?>
	            <option value="<?php echo $mval->id;?>"/><?php echo $mval->menu_cn;?></option>
				<?php }?>
	          </select>
			</li>
			<input name="submit" type="submit" value="搜索" class="b_search btn" />					
        </ul>
         <ul class="searchSub" style="float:left">
          <li><a href="<?php echo $this->createUrl('acadd');?>" class="btn"><i class="icon-plus-sign"></i>添加动作</a></li>	
        </ul>
		</form>		
        <div class="clear"></div>
     </div>
     <div class="clear"></div>
     <div class="linellae"></div>	
     <table class="same_t table table-bordered table-hover" >
     	<thead>
        <tr>
            <th>模块ID</th>
            <th>模块名称</th>
            <th>模块英文</th>
            <th>导航ID</th>
            <th>导航名称</th>
            <th>动作ID</th>
            <th>动作名称</th>
            <th>动作英文</th>
            <th><i class=" icon-wrench"> </i> 操作</th>
        </tr>
        </thead>
        <tbody>
		<?php if($model){?>
		<?php foreach($model as $list){?>
        <tr id="<?php echo 'tr'.$list->id;?>">
            <td><?php echo $list->m_id;?></td>
            <td><?php echo $list->md->menu_cn;?></td>
            <td><?php echo $list->md->menu_en;?></td>
            <td><?php echo $list->nav_id;?></td>
            <td><?php echo $list->nav->nav_cn;?></td>
            <td><?php echo $list->id;?></td>
            <td><?php echo $list->action_cn;?></td>
            <td><?php echo $list->action_en;?></td>
            <td>
            <span class="b_blue"><a href="<?php echo $this->createUrl('acadd',array('id'=>$list->id));?>"><i class="icon-pencil"></i>编辑 </a></span>&nbsp;&nbsp;
            <span class="b_blue"><a href="javascript:void(0);" class="sel" onclick="acDel(<?php echo $list->id;?>)"><i class="icon-remove"></i>删除</a></span>
        </td>
         </tr>
		 <?php }
		 }
		 ?>
		 </tbody>
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
