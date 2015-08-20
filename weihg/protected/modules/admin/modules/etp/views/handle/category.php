<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>坛城文化后台管理系统</title>
<link href="<?php echo CSS_URL; ?>/bootstrap.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/base_new.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/font.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/member.css"/>
<script src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>
</head>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">商家管理</a> > 
     <a href="javascript:void(0);" class="ccc_color">商家中心</a> > 
     <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">类型管理</a>
     </div>
     </div>	
     <div class="search">
         <dl>
         <form action="<?php echo $this->createUrl('c_categorysearch');?>" method="get" class="form-search" name="search" />
       		<input id="keyword" class="insearch input-large" placeholder="类别搜索" type="text" value="<?php echo isset($keyword)?$keyword:'';?>" name="keyword" />
       		<input id="keyword" class="b_search btn" type="submit" value="类别搜索" />
         </form>
         </dl>
         <!-- 搜索框部分 -->
         <ul class="searchSub">
          <li><a href="<?php echo $this->createUrl('/admin/shangjia/handle/c_categoryadd');?>" class="btn"><i class="icon-plus-sign"></i> 新增类别</a></li>
        </ul>
        <div class="clear"></div>
     </div>
     <div class="clear"></div>
     <div class="linellae"></div>	
    <table class="same_t table table-bordered table-hover" >
        <thead>
        <tr>
            <th>ID</th>
            <th>类别名称</th>
            <th>添加人</th>
            <th>添加时间</th>
            <th>类别状态</th>
            <th><i class=" icon-wrench"> </i>操作</th>
        </tr>
        </thead>
        <tbody>
		<?php 
			if($customercategory){
				foreach($customercategory as $val){
		?>
       		<tr id="tr<?php echo $val->c_id?>">
            <td><?php echo $val->c_id;?></td>
            <td><?php echo $val->c_name;?></td>
            <td><?php echo $val->add_man;?></td>
            <td><?php echo date("Y-m-d H:i:s",$val->add_time);?></td>
            <td><?php if($val->status==1){echo "<font style='color:blue;'>已启用</font>";}else{echo "<font style='color:red;'>已禁用</font>";} ?></td>
            <td>
            <span class="b_blue">
            	<a href="/admin/etp/handle/etptaglist/c_id/<?php echo $val->c_id;?>"><i class="icon-th-list"> </i> 标签列表</a>
            </span>&nbsp;&nbsp;|&nbsp;&nbsp;
            <span class="b_blue">
            	<a href="<?php echo $this->createUrl('/admin/shangjia/handle/c_categoryupdate/id/'.$val->c_id);?>"><?php if($val->status==1){echo "<i class=\"icon-ban-circle\"> </i> 禁用";}elseif($val->status==0){echo "<i class=\"icon-ok-circle\"> </i> 启用";} ?></a>
          	</span>
        </td>
        </tr>
		<?php }}?>
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
