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
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">产品交易</a> > <a href="javascript:void(0);" class="ccc_color">订单管理</a> > <a href="javascript:void(0);" class="ccc_color">订单信息</a></div>
     </div>	
     <div class="search">
	 	<form class="form-search" method='get' action="<?php echo $this->createUrl('omsordersearch');?>">
        <ul class="searchSub ">
			<li><select name="types" class="span2">
					<option value="">所有订单</option>
					<option value="0">待付款</option>
					<option value="1">待发货</option>
					<option value="2">待收货</option>
					<option value="3">待评价</option>
					<option value="5">已取消</option>
			</select>
			</li>
			<input class="insearch input-large" name="search"  type="text" placeholder="请输入订单号">
          	<input type="submit" name="submit" value="订单搜索" class="b_search btn" />		
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
            <th>产品名称</th>
            <th>产品价格</th>
			<th>推荐人</th>
            <th>收货人</th>
			<th>收货人电话</th>
			<th>收货地址</th>
			<th>下单时间</th>
            <th><i class=" icon-wrench"> </i> 操作</th>
        </tr>
        </thead>
        <tbody>
		<?php 
			if($orderlist){
				foreach($orderlist as $val){
		?>
        <tr id="tr<?php echo $val->id?>">
			<td><?php echo $val->id?></td>
            <td><?php echo $val->order_id?></td>
            <td><?php echo $val->goods_name?></td>
            <td><?php echo $val->price.'*'.$val->rows;?></td>
            <td><?php echo $val->advi_name?></td>
            <td><?php echo $val->re_name?></td>
			<td><?php echo $val->re_mobile?></td>
			<td><?php echo $val->re_location?></td>
			<td><?php echo date('Y-m-d H:i',$val->add_time)?></td>
            <td>
　			<?php if($val->status == 1){?>			
			<span class="b_blue" id="fahuo"><a href="javascript:void(0);" onclick="fahuo(<?php echo $val->id;?>)"><i class="icon-chevron-up"></i> 点击发货 </a></span>
			<?php }?>
			<span class="b_blue">　<a href="javascript:void(0);" class="sel" onclick="del(<?php echo $val->id;?>)"><i class="icon-remove"></i> 删除&nbsp;</a></span>
			</td>
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
<script type="text/javascript">
	function del(id){
		var id = id;
		if(id && confirm('确认删除？')){
			$.ajax({
			type: "POST",
			url: "/admin/etp/oms/omsorderdel",
			data: {'id':id},
			success:function(a){
				if(a==1){
					$('#tr'+id).remove();
					alert('删除成功');
				}else if(a==2){
					alert('数据丢失');
				}else{
					alert('删除失败');
				}
			}
			});
		} 	
	}
	function fahuo(id){
		var id = id;
		if(id && confirm('确认发货？')){
			$.ajax({
			type: "POST",
			url: "/admin/etp/oms/omsordersend",
			data: {'id':id},
			success:function(a){
				if(a==1){
					$('#fahuo').hide();
					alert('操作成功');
				}else if(a==2){
					alert('数据丢失');
				}else{
					alert('操作失败');
				}
			}
			});
		} 	
	}
</script>
</body>
</html>