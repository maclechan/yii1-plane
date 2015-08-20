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
<style>
.bg_body {
    background: none repeat scroll 0 0 #000000;
    border: 1px solid #CECECE;
    height: 100%;
    left: 0;
    opacity: 0.2;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 998;
	}
.frombox{ 
	width:549px; margin:0  auto;
	background: none repeat scroll 0 0 #FFFFFF;
    border: 3px solid #4F94CD;
    border-radius: 5px 5px 5px 5px;
    box-shadow: 2px 2px 3px #888888, -2px -2px 3px #888888;
    height: auto;
    left: 25%;
    overflow: hidden;
    position: fixed;
    top: 23%;
    z-index: 999;
}
.title {
    border-bottom: 1px solid #7EC0EE;
    font-size: 16px;
    height: 36px;
    line-height: 36px;
    padding: 0 10px;
    text-align: left;
    text-indent: 5px;
	margin-bottom: 5px
	}
.closed {
	float: right;
    height: 20px;
    width: 40px;
	}
.closed2 {
	float: right;
    height: 20px;
    width: 40px;
	}
</style>
</head>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">产品交易</a> > 
     <a href="javascript:void(0);" class="ccc_color">类别管理</a> > 
     <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">标签管理</a>
     </div>
     </div>	
     <div class="search">
         <dl>
         <form action="<?php echo $this->createUrl('etptagsearch',array("c_id"=>$c_id));?>" method="get" class="form-search" name="search" />
		    <ul class="searchSub ">	 
       		<input id="keyword" class="insearch input-large" placeholder="标签搜索" type="text" value="<?php echo isset($keyword)?$keyword:'';?>" name="keyword" />
       		<input class="b_search btn" type="submit" value="标签搜索" />
			</ul>
         </form>
         </dl>
         <!-- 搜索框部分 -->
        <ul class="searchSub">
          <li><a href="javascript:;" onclick="tagadd()" class="btn"><i class="icon-plus-sign"></i> 新增标签</a></li>
		  <?php if(isset($tagname)){?>&nbsp; 您搜索的关键词为<font color="red">"<?php echo $tagname;?>"</font><?php }?>
        </ul>
        <div class="clear"></div>
     </div>
     <div class="clear"></div>
     <div class="linellae"></div>	
    <table class="same_t table table-bordered table-hover" >
        <thead>
        <tr>
        	<th>ID</th>
            <th>标签名称</th>
			<th>所属类别</th>
            <th>排序</th>
            <th><i class=" icon-wrench"> </i>操作</th>
        </tr>
        </thead>
        <tbody>
		<?php 
			if($tags){
				foreach($tags as $val){
		?>
       		<tr id="tr<?php echo $val->tag_id?>">
            <td><?php echo $val->tag_id;?></td>
            <td><?php echo $val->tag_name;?></td>
			<td><?php echo $val->cate->c_name;?></td>
            <td><?php echo $val->sort_order;?></td>
            <td>
				<span class="b_blue">
					<a href="javascript:;"  onclick="tagupd(<?php echo $val->tag_id;?>,'<?php echo $val->cat_id;?>','<?php echo $val->tag_name;?>',<?php echo $val->sort_order;?>)"><i class="icon-pencil"> </i> 修改</a>
				</span>&nbsp;&nbsp;|&nbsp;&nbsp;
				<span class="b_blue">
					<a href="javascript:;"  onclick="del(<?php echo $val->tag_id;?>)"><i class="icon-remove"> </i> 删除</a>
				</span>		
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
        <div class="pageBG_R fr">共<?php echo $pages->pageCount;?>页</div>
		<?php endif;?>
        <div class="clear"></div>
    </div>
</div>
<!-- 添加弹出层 start -->
<div class="frombox" style="display:none" id="addPro">
	<div class="title"><a title="关闭" class="closed" href="javascript:;">关闭</a>标签添加</div>

    <table class="same_t table table-hover">
		<thead style="background-color:#FFF">		
		<tr>
			<td width="120" style="text-align:right">
				<strong style="font-size:14px;">标签名:</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align:left">
				<input type="text" id="tname_d" name="tname_d">&nbsp;&nbsp;(必填)&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<td width="120" style="text-align:right">
				<strong style="font-size:14px;">所属类别:</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align:left">
				<select id="cid_d" name="cid_d">
				<?php foreach($category as $list){ ?>
				<option value="<?php echo $list->c_id;?>"/><?php echo $list->c_name;?></option>
				<?php }?>								
				</select>&nbsp;&nbsp;(必填)&nbsp;&nbsp;
			</td>
		</tr>	
		<tr>
			<td width="120" style="text-align:right">
				<strong style="font-size:14px;" id="jbcz_d">排序:</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align:left">
				<input type="text" id="sort_d" name="sort_d" onafterpaste="this.value=this.value.replace(/\D/g,'')" onkeyup="this.value=this.value.replace(/\D/g,'')">&nbsp;&nbsp;(仅限数字)&nbsp;&nbsp;
			</td>
		</tr>		
		<tr>   	 
			<td align="center" colspan="2">
				<input type="button"  class="btn btn-primary" name="保存" onclick="add_save()" value="确定" />
			</td>
		</tr>		
		</thead>
	</table>	

</div>
<!-- 添加弹出层 end -->
<!-- 修改弹出层 start -->
<div class="frombox" style="display:none" id="updPro">
	<div class="title"><a title="关闭" class="closed2" href="javascript:;">关闭</a>标签修改</div>

    <table class="same_t table table-hover">
		<thead style="background-color:#FFF">		
		<tr>
			<td width="120" style="text-align:right">
				<strong style="font-size:14px;">标签名:</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align:left">
				<input type="hidden" id="tagid">
				<input type="text" id="tname" name="tname">&nbsp;&nbsp;(必填)&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<td width="120" style="text-align:right">
				<strong style="font-size:14px;">所属类别:</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align:left">
				<select id="cid" name="cid">
				<?php foreach($category as $list){ ?>
				<option value="<?php echo $list->c_id;?>"/><?php echo $list->c_name;?></option>
				<?php }?>								
				</select>&nbsp;&nbsp;(必填)&nbsp;&nbsp;
			</td>
		</tr>	
		<tr>
			<td width="120" style="text-align:right">
				<strong style="font-size:14px;" id="jbcz">排序:</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align:left">
				<input type="text" id="sort" name="sort" onafterpaste="this.value=this.value.replace(/\D/g,'')" onkeyup="this.value=this.value.replace(/\D/g,'')">&nbsp;&nbsp;(仅限数字)&nbsp;&nbsp;
			</td>
		</tr>		
		<tr>   	 
			<td align="center" colspan="2">
				<input type="button"  class="btn btn-primary" name="保存" onclick="upd_save()" value="确定" />
			</td>
		</tr>		
		</thead>
	</table>	

</div>
<!-- 修改弹出层 end -->
<div style="opacity: 0.2;filter:alpha(opacity=20); display:none;" id="bg_b" class="bg_body"></div>
<script type="text/javascript">
$(function(){
	$(".closed").click(function(){
		$("#addPro").hide();
		$("#bg_b").hide();
		$("#bg_b", parent.document).hide();
	});	
	$(".closed2").click(function(){
		$("#updPro").hide();
		$("#bg_b").hide();
		$("#bg_b", parent.document).hide();
	});	
});
	function tagadd(){	
		$("#bg_b", parent.document).show();
		$("#bg_b").show();
		$("#addPro").show();	
	}
	function tagupd(id,cid,name,px){
		$("#tagid").val(id);
		$("#tname").val(name);
		$("#cid").val(cid);
		$("#sort").val(px);
		
		$("#bg_b", parent.document).show();
		$("#bg_b").show();
		$("#updPro").show();	
	}
	function upd_save(){
		var tagid = $("#tagid").val();
		var tname = $("#tname").val();	
		var cid = $("#cid").val();
		var sort = $("#sort").val();
		if(tname && tagid && cid){
			$.ajax({
				type: "POST",
				url: "/admin/etp/handle/etptagupd",
				data: {'id':tagid,'tname':tname,'cid':cid,'sort':sort},
				success:function(msg){
					if(msg == 1){
						alert("修改成功");
						$("#updPro").hide();
						$("#bg_b").hide();
						$("#bg_b", parent.document).hide();					
					}else if(msg == 3){
						alert('数据丢失');
					}else{
						alert('修改失败');
					}
				}
			});					
		}else{
			alert("请输入必填项");
			return false;
		}
	}
	function add_save(){
		var tname = $("#tname_d").val();	
		var cid = $("#cid_d").val();
		var sort = $("#sort_d").val();
		if(tname && cid){
			$.ajax({
				type: "POST",
				url: "/admin/etp/handle/etptagadd",
				data: {'tname':tname,'cid':cid,'sort':sort},
				success:function(msg){
					if(msg == 1){
						alert("添加成功");
						$("#addPro").hide();
						$("#bg_b").hide();
						$("#bg_b", parent.document).hide();					
					}else if(msg == 3){
						alert('数据丢失');
					}else{
						alert('添加失败');
					}
				}
			});					
		}else{
			alert("请输入必填项");
			return false;
		}	
	}
	function del(id){
		var id = id;
		if(id && confirm('确认删除？')){
			$.ajax({
			type: "POST",
			url: "/admin/etp/handle/etptagdel",
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