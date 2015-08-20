<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>坛城文化后台管理系统</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/base_new.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/font.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/table.css"/>
<script  src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>
<script  src="<?php echo Yii::app()->homeUrl;?>js/jqeryOther.js"></script>
<script  src="<?php echo Yii::app()->homeUrl;?>js/thebase.js">
</script>
</head>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">系统管理</a> > <a href="javascript:void(0);" class="ccc_color">私信管理</a> > <a href="javascript:void(0);" class="ccc_color">私信发送列表</a></div>
     </div>	
     <div class="search">
        <!-- <ul class="searchSub">
          <li><a href="<?php echo $this->createUrl('navadd');?>" class="red b_add">添加导航</a></li>
        </ul>
         -->
         <!-- 收件箱  发件箱 -->
         <ul class="searchSub">
          <li><a style="background:#cccccc;" href="<?php echo $this->createUrl('/admin/site/handle/messagelist');?>" class="red b_add">收件箱</a></li>
        	<li><a href="<?php echo $this->createUrl('/admin/site/handle/messagesendlist');?>" class="red b_add">发件箱</a></li>
        </ul>
         
         
         
         <!-- 搜索框部分 -->
         <ul class="searchSub">
          <li><a href="<?php echo $this->createUrl('/admin/site/handle/messageadd');?>" class="red b_add">发送私信</a></li>
        </ul>
         <form action="<?php echo $this->createUrl('/admin/site/handle/messagesendsearch'); ?>" method="get" name="search" />
       		<input id="keyword" type="text" value="<?php echo isset($keyword)?$keyword:'';?>" name="keyword" />
       		<input id="keyword" type="submit" value="标 题 搜 索" />
         </form>
        <div class="clear"></div>
     </div>
     <div class="clear"></div>
     <table id="sample2" width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
        	<th style="width:12px;"><input type="checkbox" value="" name="checkbox[]"></th>
            <th width="10%"><span>私信标题</span></th>
            <th width="15%"><span>FROM</span></th>
            <th width="15%"><span>TO</span></th>
            <th width="10%"><span>日期</span></th>
            <!--  <th width="15%"><span></span>状态</span></th>-->
            <th><span>操作</span></th>
        </tr>
		<?php 
			if($message){
				foreach($message as $val){
		?>
        <tr id="tr<?php echo $val->id?>">
        	<th style="width:12px;"><input type="checkbox" value="" name="checkbox[]"></th>
            <td><a href="/admin/site/handle/messagesenddetail/id/<?php echo $val->id?>"><?php echo $val->title;?></a></td>
            <td><?php echo $val->ms->user_name?></td>
            <td><?php echo $val->mr->user_name?></td>
            <td><?php $time=date("Y-m-d H:i:s",$val->send_time); echo $time;?></td>
           <!-- <td><?php //$status=$val->read_status;if($status == '1'){echo "<a href='/admin/site/handle/messagedetail/id/$val->id'>已读</a>";}else{echo "<a href='/admin/site/handle/messagedetail/id/$val->id'><font color='red'>未读</font></a>";} ?></td>  --> 
            <td><a href="<?php echo $this->createUrl('navadd',array('id'=>$val->id));?>" class="Blue"></a><a href="<?php echo '/admin/site/handle/messagesenddel/id/'.$val->id;?>" class="sel" onclick="return confirm('确定删除？')">删除</a>
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
