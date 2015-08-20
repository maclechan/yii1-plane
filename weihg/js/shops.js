function del(id){
	var id = id;
	if(id && confirm('确认删除？')){
		$.ajax({
			type: "POST",
			url: "/admin/shangjia/handle/enrolldel",
			data: {'id':id},
			success:function(a){
				if(a==1){
					$('#tr'+id).remove();
					alert('删除成功');
				}else{
					alert('删除失败');
				}
			}
		});	
	}
}


$(function(){
	//与商家签定合同
	$("#shopscontract").click(function(){
		var len = $('input:checked').length;
		var id = "";
		if(len==1){
			id = $('input:checked').val();
			window.location.href="/admin/shangjia/shops/shopscontract/id/"+id;
		}else if(len==0){
			alert("请选择一个商家！");
		}else{
			alert("每次只能与一个商家签订合同！");
		}				
	});
	//查看商家合同
	$("#showcontract").click(function(){
		var len = $('input:checked').length;
		var id = "";
		if(len==1){
			id = $('input:checked').val();
			window.location.href="/admin/shangjia/shops/shopscontractshow/id/"+id;
		}else if(len==0){
			alert("请选择一个商家！");
		}else{
			alert("每次只能与一个商家签订合同！");
		}				
	});	
	
	//编辑商家信息
	$("#editShops").click(function(){
		var len = $('input:checked').length;
		var id = "";
		if(len==1){
			id = $('input:checked').val();
			/*$.post("/admin/shangjia/shops/shopsedit",{'id':id},function(msg){
				if(msg){
						document.write(msg);
					}
			});*/
			window.location.href="/admin/shangjia/shops/shopsedit/id/"+id;
		}else{
			alert("sorry！你必须，而且只能选择一个商家编辑");
		}				
	});
	
	$("#addShops").click(function(){
		window.location.href="/admin/shangjia/shops/shopsadd";
	});
	
//删除商家
$("#delShops").click(function(){
		var id="";
		$('[name=checkid]:checkbox:checked').each(function(){
			id+=$(this).val()+"&";			
		})
		if(id==0){
			alert('至少要选择一个商家才能删除！');
		}else if(id && confirm('确认删除？')){
			$.ajax({
					type: "POST",
					url: "/admin/shangjia/shops/shopsdel",
					data: {'id':id},
					success:function(msg){
						if(msg==1){
							//删除多行tr
							 $('table input[type=checkbox]').each(function () {
				                    if($(this).attr("checked")) {
				                        $(this).parent().parent().remove();
				                    }
				                });
							//$('#tr'+id).remove();					
							alert('删除成功');
							window.location.href='/admin/shangjia/shops/shopsmanage';
						}else{
							alert('删除失败');
						}
					}
			});
		}
	});
});

//审核商家，可以批量审核
$(function(){
	//全选
    $("#CheckedAll").click(function(){
	     $('[name=checkid]:checkbox').attr('checked', true);
	 });
	 //全不选
    $("#CheckedNo").click(function(){
	    $('[type=checkbox]:checkbox').attr('checked', false);
	 });
	 $("#checkDone").click(function(){
		var id="";
		$('[name=checkid]:checkbox:checked').each(function(){
			id+=$(this).val()+"&";
		})
		if(id==0){
			alert('至少要选择一个商家提交审核');
		}else{
			$.ajax({
					type: "POST",
					url: "/admin/shangjia/shops/checkshops",
					data: {'id':id},
					success:function(msg){
						if(msg==1){							
							alert('审核成功');
							window.location.href='/admin/shangjia/shops/shopsmanage';
						}else{
							alert('审核失败');
						}
					}
			});
		}
	});
});

//审核网友，可以批量审核
$(function(){
	//全选
    $("#netAll").click(function(){
	     $('[name=checkid]:checkbox').attr('checked', true);
	 });
	 //全不选
    $("#netNo").click(function(){
	    $('[type=checkbox]:checkbox').attr('checked', false);
	 });
	 $("#netDone").click(function(){
		var id="";
		$('[name=checkid]:checkbox:checked').each(function(){
			id+=$(this).val()+"&";
		})
		if(id==0){
			alert('至少要审核一个网友！');
		}else{
			$.ajax({
					type: "POST",
					url: "/admin/shangjia/shops/friendajax",
					data: {'id':id},
					success:function(msg){
						if(msg==1){							
							alert('审核成功');
							window.location.href='/admin/shangjia/shops/netfriend';
						}else{
							alert('审核失败');
						}
					}
			});
		}
	});
});

//商家店铺排序
function updatenote(id,sortrank){
	$("#sortrank").css("border","1px solid #fff");
	$.ajax({
		type: "POST",
		url: "/admin/shangjia/shops/ajaxnotes",
		data: {'id':id,'sortrank':sortrank},
		success:function(msg){
			if(msg==1){
				//alert("排序更新成功");		
				window.location.href='/admin/shangjia/shops/shopsmanage';
			}else{
				//alert("排序更新失败");
				window.location.href='/admin/shangjia/shops/shopsmanage';
			}
		}
	});	
}
