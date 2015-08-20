$(function(){
	var alist = new Array();
	$("ul li a").each(function (i, items){
		alist[i] = $(items);

		$(alist[i]).click(function(){
			$("ul li a").removeClass("on");
			$(this).addClass("on");
		});
	});

	$('#navadd').click(function(){
		var name = $('#name').val();
		var mid = $('option:selected').val();
		var navid = $('#nid').val()?$('#nid').val():'';
		var sort = $('#sort').val();
		if(name==''){
			alert('请输入名称');
		}else{
			$.ajax({
				type: "POST",
				url: "/admin/site/roleset/ajaxnavsave",
				data: {'name':name,'mid':mid,'nid':navid,'sort':sort},
				success:function(a){
					if(a==1){
						if(confirm('保存成功，继续添加？')){
							$('#name').val('');
						}else{
							window.location.href='/admin/site/roleset/index';
						}
					}else{
						alert('保存失败');
					}
				}
			});
		}
	});
	$('#navreset').click(function(){
		$('#name').val('');
	});
	$('#navback').click(function(){
		window.location.href='/admin/site/roleset/index';
	});

	$('#mid').change(function(){
		var mid = $('option:selected').val();
		if(mid){
			$.ajax({
				type: "POST",
				url: "/admin/site/roleset/ajaxnav",
				data: {'mid':mid},
				dataType:'json',
				success:function(data){
					if(data){
						$('#nav').empty();
						for(var s in data){
							var op = "<option value='"+data[s].id+"'>"+data[s].nav_cn+"</option>";
							$(op).appendTo($('#nav'));
						}
					}else{
						alert('读取失败');
					}
				}
			});		
		}
	});

	$('#acadd').click(function(){
		var accn = $('#accn').val();
		var acen = $('#acen').val();
		var ctl = $('#ctl').val();
		var mid = $('#mid').find('option:selected').val();
		var navid = $('#nav').find('option:selected').val();
		var acid = $('#ac').val();
		var sort = $('#sort').val();
		var acbeling = $('#acbeling').val();
		if(accn==''){
			alert('请输入动作名称');
		}else if(acen==''){
			alert('请输入动作英文');
		}else if(ctl==''){
			alert('请输入默认控制器');
		}else{
			if(navid==undefined){
				alert('请先添加导航!');
			}else{
				$.ajax({
					type: "POST",
					url: "/admin/site/roleset/ajaxacsave",
					data: {'accn':accn,'acen':acen,'ctl':ctl,'mid':mid,'navid':navid,'acid':acid,'sort':sort,'acbeling':acbeling},
					success:function(a){
						if(a==1){
							if(acid==''){
								if(confirm('保存成功，继续添加？')){
									$('#accn').val('');
									$('#acen').val('');
								}else{
									history.go(-1);
//									window.location.href='/site/aclist';
								}
							}else{
								alert('保存成功');
								history.go(-1);
//								window.location.href='/site/aclist';
							}
						}else{
							alert('保存失败');
						}
					}
				});			
			}
		}
	});
	$('#acreset').click(function(){
		$('#accn').val('');
		$('#acen').val('');
	});
	$('#acback').click(function(){
		history.go(-1);
//		window.location.href='/site/aclist';
	});
});

function navDel(id){
	var id = id;
	if(id && confirm('确认删除？')){
		$.ajax({
			type: "POST",
			url: "/admin/site/roleset/ajaxnavdel",
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

function acDel(id){
	var id = id;
	if(id && confirm('确认删除？')){
		$.ajax({
			type: "POST",
			url: "/admin/site/roleset/ajaxacdel",
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