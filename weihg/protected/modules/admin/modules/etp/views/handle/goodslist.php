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
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">产品交易</a> > <a href="javascript:void(0);" class="ccc_color">产品管理</a> > <a href="javascript:void(0);" class="ccc_color">产品列表</a></div>
     </div>	
     <div class="search">
	 	<form class="form-search" method='get' action="<?php echo $this->createUrl('etpgoodssearch');?>">
        <ul class="searchSub ">
			<li><select name="cid" class="span2">
					<option value="">所有分类</option>
				<?php foreach($category as $list){?>
					<option value="<?php echo $list->c_id?>"><?php echo $list->c_name?></option>
				<?php }?>
			</select>
			</li>
			<input class="insearch input-large" name="search"  type="text" placeholder="产品搜索">
          	<input type="submit" name="submit" value="产品搜索" class="b_search btn" />		
			<?php if(isset($goodname)){?>&nbsp; 您搜索的关键词为<font color="red">"<?php echo $goodname;?>"</font><?php }?>
        </ul>
		</form>		
        <div class="clear"></div>
     </div>
     <div class="clear"></div>
      <div class="linellae"></div>	
     <table class="same_t table table-bordered table-hover" >
     	<thead>
        <tr>
            <th>产品id</th>
            <th>产品名称</th>
            <th>所属商家</th>
            <th>行业类别</th>
            <th>原价</th>
			<th>优惠价</th>
			<th>最后更新时间</th>
            <th><i class=" icon-wrench"> </i> 操作</th>
        </tr>
        </thead>
        <tbody>
		<?php 
			if($model){
				foreach($model as $val){
		?>
        <tr id="tr<?php echo $val->goods_id?>">
            <td><?php echo $val->goods_id?></td>
            <td><?php echo $val->goods_name?></td>
            <td><?php echo $val->bs_name;?></td>
            <td><?php echo $val->gc->c_name?></td>
            <td><?php echo $val->price?></td>
			<td><?php echo $val->shop_price?></td>
			<td><?php echo date('Y-m-d H:i',$val->last_update)?></td>
            <td><span class="b_blue"><a href="<?php echo $this->createUrl('etpgoodsadded',array('id'=>$val->goods_id,'type'=>$val->status==1?'2':'1'));?>"><?php echo $val->status==1?'<i class="icon-arrow-down"></i>下架':'<i class="icon-arrow-up"></i>上架';?> </a></span>　<span class="b_blue"><a href="<?php echo $this->createUrl('etpgoodsupdate',array('id'=>$val->goods_id));?>"><i class="icon-pencil"></i> 编辑 </a></span><span class="b_blue">　<a href="javascript:void(0);" class="sel" onclick="del(<?php echo $val->goods_id;?>)"><i class="icon-remove"></i> 删除&nbsp;</a></span>
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
			url: "/admin/shangjia/goods/etpgoodsdel",
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
</script>
</body>
</html>