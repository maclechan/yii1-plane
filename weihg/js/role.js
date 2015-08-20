//权限模块JS
$(function(){
	$('#search').click(function(){
		var name = $('#name').val();
		if(name==''){
			alert('请输入查询角色名称');
			return false;
		}else{
			var type = $('#type').val();
			location.href="/admin/limit/handle/search/name/"+name+"/type/"+type;
		}
//		else{
//			$.ajax({
//				type: "POST",
//				url: "/admin/limit/handle/search",
//				data: {'name':name},
//				dataType:'json',
//				success:function(data){
//					$('#sample1').empty();
//					var tr1 = "<tr>"+
//								"<th width='20%'>角色名称</th>"+
//							    "<th>操作</th>"+
//								"</tr>";
//					$(tr1).appendTo($('#sample1'));
//					for(var s in data){
//						var tr= "<tr>"+
//									"<td>"+data[s].role_name+"</td>"+
//									"<td><a href='roleset/id/"+data[s].id+".html' class='red_color'>角色内人员</a>　<a href='roleedit/id/"+data[s].id+".html' class='Blue'>编辑</a>　<a href='javascript:void(0);' class='sel' onclick='roleDel("+data[s].id+")'>删除</a></td>"+
//								 "</tr>";
//						$(tr).appendTo($('#sample1'));
//					}
//				}
//			});
//		}
	});

	$('#role_add').click(function(){
		var name = $('#role').val();
		var intro = $('#intro').val();
		var is = document.getElementsByName("status").item(0).checked;
		if(is){
			var status = 1;
		}else{
			var status = 0;
		}		
		if(name==''){
			alert('请输入角色名称!');
		}else{
			$.ajax({
				type: "POST",
				url: "/admin/site/roleset/rolesave",
				data: {'name':name,'intro':intro,'status':status},
				success:function(a){
					if(a==1){
						alert('保存成功');
						location.href="/admin/site/roleset/role";
					}else if(a==2){
						alert('保存失败');
					}else if(a==3){
						alert('角色名已存在');
					}
				}
			});		
		}
	});

	$('#roleedit').click(function(){
		var name = $('#role').val();
		var intro = $('#intro').val();
		var is = document.getElementsByName("status").item(0).checked;
		if(is){
			var status = 1;
		}else{
			var status = 0;
		}		
		var id = $('#rid').val();
		if(name==''){
			alert('请输入角色名称');
		}else{
			$.ajax({
				type: "POST",
				url: "/admin/site/roleset/rolesave",
				data: {'name':name,'intro':intro,'id':id,'status':status},
				success:function(a){
					if(a==1){
						alert('保存成功');
						location.href="/admin/site/roleset/role";
					}else if(a==2){
						alert('保存失败');
					}else{
						alert('角色名已存在');
					}
				}
			});			
		}
	});

	$('#padd').click(function(){
		$('#role').empty();
		$("input[name='part[]']").each(function(){
			if($(this).attr('checked')==true){
				var partid = $(this).val();
				$.ajax({
					type: "POST",
					url: "/admin/limit/handle/staffall",
					data: {'partid':partid},
					dataType:'json',
					error:function(XMLResponse){
						alert(XMLResponse.responseText);
						return false;
					},
					success:function(data){
						for(var s in data){
							var li = "<li id='"+partid+"-"+data[s].staff_id+"'><label><input name='all"+data[s].part_id+"[]' type='checkbox' value='"+data[s].part_id+"|"+data[s].staff_id+"|"+data[s].staff_name+"' checked='checked'/>"+data[s].staff_name+"</label></li>";
							$(li).appendTo($('#role'));
						}
					}
				});					
			}
		});
	});

	$('#palladd').click(function(){
		$('#role').empty();
		$("input[name='part[]']").each(function(){
//			alert(i+"-"+num);
//			if(i==num){
//				$('#removeall').removeAttr('disabled');
//			}
			$(this).attr('checked','checked');
			if($(this).attr('checked')==true){
				var partid = $(this).val();
				$.ajax({
					type: "POST",
					url: "/admin/limit/handle/staffall",
					data: {'partid':partid},
					dataType:'json',
					error:function(XMLResponse){
						alert(XMLResponse.responseText);
						return false;
					},
					success:function(data){
						for(var s in data){
							li = "<li id='"+partid+"-"+data[s].staff_id+"'><label><input name='roll"+data[s].part_id+"[]' type='checkbox' value='"+data[s].part_id+"|"+data[s].staff_id+"|"+data[s].staff_name+"' checked='checked'/>"+data[s].staff_name+"</label></li>";
							liall = "<li id='"+partid+"-"+data[s].staff_id+"'><label><input name='all"+data[s].part_id+"[]' type='checkbox' value='"+data[s].part_id+"|"+data[s].staff_id+"|"+data[s].staff_name+"' checked='checked'/>"+data[s].staff_name+"</label></li>";
							$(li).appendTo($('#role'));
							$(liall).appendTo($('#all'));
						}
					}
				});					
			}
		});
//		if(i==num){
//			$('#removeall').attr('disabled',false);
//		}else{
//			$('#removeall').attr('disabled',true);
//		}
	});

	$('#add').click(function(){
		var vall='';
		$('#role').find('input').each(function(){
			var value = $(this).val();
			vall += value;
		});
		$("input[name^=all]").each(function(){
			if($(this).attr('checked')==true){
				var v = $(this).parent().text();
				var id = $(this).val();
				if(vall.indexOf(id)==-1){
					var li = "<li><label><input name='role[]' type='checkbox' value='"+id+"' checked='checked'/>"+v+"</label></li>";
					$(li).appendTo($('#role'));
				}
			}
		});
	});

	$('#alladd').click(function(){
		var vall='';
		$('#role').find('input').each(function(){
			var value = $(this).val();
			vall += value;
		});
		$("input[name^=all]").each(function(){
//			if($(this).attr('checked')==true){
				var v = $(this).parent().text();
				var id = $(this).val();
				if(vall.indexOf(id)==-1){
					var li = "<li><label><input name='role[]' type='checkbox' value='"+id+"' checked='checked'/>"+v+"</label></li>";
					$(li).appendTo($('#role'));
				}
//			}
		});
	});

	$('#remove').click(function(){
		if(confirm('确认删除？')){
			var i = 0 ;
			var id = $('#rid').val();
			var name = $('#rname').val();
			var role = '';		
			$("#role").find('li').each(function(){
				if($(this).find('input').attr('checked')==true){
					role +=$(this).find('input').val()+',';
					$(this).remove();
					i++;
				}
			});
			if(i==0){
				alert('请先选择至少一项');
			}
			$.ajax({
				type: "POST",
				url: "/admin/site/roleset/userdel",
				data: {'role':role},
				success:function(a){
					if(a==1){
						alert('删除成功');
					}else if(a==2){
						alert('删除失败');
					}
				}
			});	
		}
	});

	$('#removeall').click(function(){
		if(confirm('确认删除所有？')){
			var rid = $('#rid').val();
			var total = $('#role').find("li").length;
			if(total!=0){
				$('#role').empty();
			}
			$.ajax({
				type: "POST",
				url: "/admin/site/roleset/userdelall",
				data: {'rid':rid},
				success:function(a){
					if(a==1){
						alert('删除成功');
					}else if(a==2){
						alert('删除失败');
					}
				}
			});			
		}
	});
	
	$('#checkall').click(function(){
		var ckval = $('#checkall').val();
		if(ckval == '全选'){
			$("[name='roll[]']:checkbox").attr('checked', true);
			$('#checkall').val("全不选");
		}else{
			$('#checkall').val("全选");
			$("[name='roll[]']:checkbox").attr('checked', false);
		}
	});

//点击后加载
/* 	$("input[name='part[]']").each(function(){
		$(this).click(function(){
			var partid = $(this).val();
			if($(this).attr('checked')==true){
				$.ajax({
					type: "POST",
					url: "/admin/limit/handle/staffall",
					data: {'partid':partid},
					dataType:'json',
					error:function(XMLResponse){
						alert(XMLResponse.responseText);
						return false;
					},
					success:function(data){
						for(var s in data){
							var li = "<li id='"+partid+"-"+data[s].staff_id+"'><label><input name='all"+data[s].part_id+"[]' type='checkbox' value='"+data[s].part_id+"|"+data[s].staff_id+"|"+data[s].staff_name+"' />"+data[s].staff_name+"</label></li>";
							$(li).appendTo($('#all'));
						}  
					}
				});				
			}else{
				$("ul[id=all]").find('li').each(function(){
					var id = $(this).attr('id');
					var arr = id.split('-');
					if(arr[0]==partid){
						$(this).remove();
					}
				});
			}
		});
	});

	$('#sub').click(function(){
		var id = $('#id').val();
		var name = $('#name').val();
		var role = '';
		$('#role').find('input').each(function(){
//			if($(this).attr('checked')==true){
				role +=$(this).val()+',';
//			}
		});
//		alert(role);
//		return false;
		$.ajax({
			type: "POST",
			url: "/admin/limit/handle/save",
			data: {'id':id,'name':name,'role':role},
			error:function(XMLResponse){
				alert(XMLResponse.responseText);
				return false;
			},
			success:function(data){
				if(data==1){
					alert('保存成功');
					location.href="/admin/limit/handle/index";
				}else{
					alert('保存失败');
				}
			}
		});	
	}); */
});

function roleDel(id){
	if(id && confirm('确认删除？')){
		$.ajax({
			type: "POST",
			url: "/admin/site/roleset/roledel",
			data: {'id':id},
			success:function(a){
				if(a==1){
					$('#tr'+id).remove();
					alert('删除成功');
				}else if(a==2){
					alert('删除失败');
				}
			}
		});			
	}
}