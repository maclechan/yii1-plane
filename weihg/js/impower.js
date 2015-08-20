$(function(){
	$('#dj').click(function(){
		var id = $('#rid').val();
		if(id==''){
			alert('数据已丢失，请重新打开！');
		}else{
			$.ajax({
				type: "POST",
				url: "/admin/limit/handle/roleblock",
				data: {'id':id},
				success:function(a){
					if(a==1){
						alert('冻结成功');
					}else if(a==2){
						alert('冻结失败');
					}
				}
			});			
		}
	});

	$('#cancel').click(function(){
		$('.show2').find('input').each(function(){
			$(this).attr('checked',false);
		});
	});

	$('#funcsub').click(function(){
		var id = $('#rid').val();
//		alert(id);return false;
		var m = '';
		var nav = '';
		var ac = '';

		$('input[name=m[]]').each(function(){
			if($(this).attr('checked')==true){
				m += $(this).val()+',';
			}
		});
		$('input[name=nav[]]').each(function(){
			if($(this).attr('checked')==true){
				nav += $(this).val()+',';
			}
		});
		$('input[name=ac[]]').each(function(){
			if($(this).attr('checked')==true){
				ac += $(this).val()+',';
			}
		});
		if(m==''){
			alert('请选择至少一项');
		}else{
			$.ajax({
				type: "POST",
				url: "/admin/site/roleset/authsave",
				data: {'id':id,'menu':m,'nav':nav,'ac':ac},
				error:function(XMLResponse){
					alert(XMLResponse.responseText);
					return false;
				},
				success:function(a){
					if(a==1){
						alert('保存成功');
					}else if(a==2){
						alert('保存失败');
					}else{
						alert('数据丢失');
					}
				}
			});		
		}
	});

});
function checkAll(obj){
	var bool = $(obj).attr("checked");
	$.each($(obj).parent().parent().siblings().find('input'),function(){
		$(this).attr("checked",bool);
	});
}

function checkNav(obj){
	var bool = $(obj).attr("checked");
	var i = 0;
	if(bool==true){
		$.each($(obj).parent().siblings().find('input'),function(){
			$(this).attr("checked",bool);
		});
		$.each($(obj).parent().parent().parent().parent().siblings().find('input'),function(){
			$(this).attr("checked",bool);
		});
	}else{
		$.each($(obj).parent().siblings().find('input'),function(){
			$(this).attr("checked",bool);
		});
		$.each($(obj).parent().parent().siblings().find('input'),function(){
			if($(this).attr("checked")==true){
				i++;
			}
		});
		if(i==0){
			$.each($(obj).parent().parent().parent().parent().siblings().find('input'),function(){
				$(this).attr("checked",false);
			});				
		}		
	}
}

function checkAc(obj){
	var i = 0;
	var j = 0;
	var bool = $(obj).attr("checked");
	if(bool==true){
		$.each($(obj).parent().parent().parent().siblings().find('input'),function(){
			$(this).attr("checked",bool);
		});
		$.each($(obj).parent().parent().parent().parent().parent().parent().siblings().find('input'),function(){
			$(this).attr("checked",bool);
		});
	}else{
		$.each($(obj).parent().parent().siblings().find('input'),function(){
			if($(this).attr("checked")==true){
				i++;
			}
		});		
		if(i==0){
			$.each($(obj).parent().parent().parent().parent().find('input'),function(){
				$(this).attr("checked",false);
			});
			$.each($(obj).parent().parent().parent().parent().siblings().find('input'),function(){
				if($(this).attr('checked')==true){
					j++;
				}
			});
			if(j==0){
				$.each($(obj).parent().parent().parent().parent().parent().parent().siblings().find('input'),function(){
					$(this).attr("checked",false);
				});					
			}
		}
	}
}