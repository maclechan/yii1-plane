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
<script  src="<?php echo Yii::app()->homeUrl;?>js/thebase.js">
</script>
</head>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">我的首页</a> > <a href="javascript:void(0);" class="ccc_color">我的管理</a> > <a href="javascript:void(0);" class="ccc_color">公告信息</a></div>
     </div>
     <div class="search">
         <dl>
	         <form action="<?php echo $this->createUrl('/admin/handle/noticesearch'); ?>"  class="form-search" method="get" name="search" />
	       		<input id="keyword" class="insearch input-large" type="text" value="<?php echo isset($keyword)?$keyword:'';?>" placeholder="标题搜索" name="keyword" />
       			<input id="keyword" class="b_search btn" type="submit" class="b_search" value="标题搜索" />
	         </form>
         </dl>
        <div class="clear"></div>
     </div>
     <div class="clear"></div>
     <div class="linellae"></div>	
    <table class="same_t table table-bordered table-hover" >
        <thead>
	        <tr>
	        	<th width='4%'>选择</th>
	        	<th>公告标题</th>
	        	<th>发布人</th>
	        	<th width='15%'>日期</th>
	        </tr>
	    </thead>
	    <tbody>
		<?php 
			if($notice){
				foreach($notice as $val){
		?>
        <tr id="tr<?php echo $val->id?>">
        	<th style="width:12px;"><input type="checkbox" value="" name="checkbox[]"></th>
            <td><a href="<?php echo '/admin/handle/noticedetail/id/'.$val->id;?>"><?php echo $val->title?></a></td>
            <td><?php echo $val->na->user_name;?></td>
            <td><?php $time=date("Y-m-d H:i:s",$val->time); echo $time;?></td>
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
