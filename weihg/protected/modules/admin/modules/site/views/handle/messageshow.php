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
     <div class="tabLeft">当前位置：
     <a href="javascript:void(0);" class="ccc_color">系统管理</a> > 
     <a href="javascript:void(0);" class="ccc_color">基础设置</a> > 
     <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">私信管理</a></div>
     </div>	
     <div class="search">
         <dl>
	         <form action="<?php echo $this->createUrl('/admin/site/handle/messageadminsearch'); ?>"  class="form-search" method="get" name="search" />
	       		<input id="keyword" class="insearch input-large" placeholder="标题搜索" type="text" value="<?php echo isset($keyword)?$keyword:'';?>" name="keyword" />
	       		<input id="keyword" class="b_search btn" class="b_search" type="submit" value="标题搜索" />
	         </form>
         </dl>
         <!-- 搜索框部分 -->
         <ul class="searchSub">
          	<li><a href="<?php echo $this->createUrl('/admin/site/handle/messageadd');?>" class="btn"><i class="icon-envelope"></i>发送私信</a></li>
        </ul>
        <div class="clear"></div>
     </div>
     <div class="clear"></div>
   <div class="linellae"></div>	
    <table class="same_t table table-bordered table-hover" >
        <thead>
        <tr>
        	<th width='4%'>选择</th>
            <th>私信标题</th>
            <th>FROM</th>
            <th>TO</th>
            <th>日期</th>
            <th>状态</th>
            <th><i class=" icon-wrench"> </i> 操作</th>
        </tr>
        </thead>
        <tbody>
		<?php 
			if($message){
				foreach($message as $val){
		?>
        <tr id="tr<?php echo $val->id?>">
        	<th style="width:12px;"><input type="checkbox" value="" name="checkbox[]"></th>
            <td><a href="/admin/site/handle/messagedetail/id/<?php echo $val->id?>"><?php echo $val->title;?></a></td>
            <td><?php echo $val->ms->user_name?></td>
            <td><?php echo $val->mr->user_name?></td>
            <td><?php $time=date("Y-m-d H:i:s",$val->send_time); echo $time;?></td>
            <td><?php $status=$val->read_status;if($status == '1'){echo "<a href='/admin/site/handle/messagedetail/id/$val->id'>已读</a>";}else{echo "<a href='/admin/site/handle/messagedetail/id/$val->id'><font color='red'>未读</font></a>";} ?></td>
            <td>
            <a href="<?php echo $this->createUrl('navadd',array('id'=>$val->id));?>"></a>
            <span class="b_blue"><a href="<?php echo '/admin/site/handle/messageadmindel/id/'.$val->id;?>" class="sel" onclick="return confirm('确定删除？')"><i class="icon-remove"></i> 删除</a></span>
        </td>
        </tr>
		<?php }}?>
		</tbody>
      </table>
    </div>
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
