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
</head>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">产品交易</a> > <a href="javascript:void(0);" class="ccc_color">订单管理</a> > <a href="javascript:void(0);" class="ccc_color">交易信息</a></div>
     </div>	
     <div class="search">
	 	<form class="form-search" method='get' action="<?php echo $this->createUrl('omstradesearch');?>">
        <ul class="searchSub ">
			<input class="insearch input-large" name="search"  type="text" placeholder="请输入订单号">
          	<input type="submit" name="submit" value="交易搜索" class="b_search btn" />		
			<?php if(isset($goodname)){?>&nbsp; 您搜索的关键词为<font color="red">"<?php echo $orderid;?>"</font><?php }?>
        </ul>
		</form>		
        <div class="clear"></div>
     </div>
     <div class="clear"></div>
      <div class="linellae"></div>	
     <table class="same_t table table-bordered table-hover" >
     	<thead>
        <tr>
            <th>Id</th>
            <th>订单号</th>
            <th>支付单号</th>
            <th>付款银行</th>
			<th>交易金额</th>
            <th>交易时间</th>
			<th>交易微信标示</th>
        </tr>
        </thead>
        <tbody>
		<?php 
			if($tradelist){
				foreach($tradelist as $val){
		?>
        <tr id="tr<?php echo $val->id?>">
			<td><?php echo $val->id?></td>
            <td><?php echo $val->order_id?></td>
            <td><?php echo $val->trans_id?></td>
            <td><?php echo $val->bank_type;?></td>
            <td><?php echo $val->total_fee?></td>
			<td><?php echo date('Y-m-d H:i',$val->time_end)?></td>
            <td><?php echo $val->open_id?></td>
        </tr>
		<?php }}else{?>
		<tr class=""><td align="center" colspan="8"><span style="color:red;">sorry，没有找到有关信息哦！</span></td></tr>
		<?php }?>
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
        <div class="pageBG_R fr">共<?php echo $pages->pageCount;?>页 / 共<?php echo $pages->itemCount ?>条记录</div>
		<?php endif;?>
        <div class="clear"></div>
    </div>
</div>
</body>
</html>