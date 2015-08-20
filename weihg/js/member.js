$(function(){
	var alist = new Array();
	$("ul li a").each(function (i, items){
		alist[i] = $(items);

		$(alist[i]).click(function(){
			$("ul li a").removeClass("on");
			$(this).addClass("on");
		});
	});	
	
	//隔行换色
	
	  //$("tr").hover(
	    // function(){$(this).addClass("on")},
	     //function(){$(this).removeClass("on")
	 // });//鼠标移动改变背景色   
	  //$("tr:even").addClass("even");  
	 // $("tr:odd").addClass("odd"); 
	  
	//分配网友
	$("#allot").click(function(){
		var b_id = $('#b_id').find('option:selected').val();
		var contid = $('#contid').find('option:selected').val();
		var notes = $('#notes').val();
		var allotid= $('#allotid').val();
		var memberid= $('#memberid').val(); //网友的备注字段对应的id
		if(b_id==0 || !contid){
			alert('请分配一个商家及合同给该网友');
		}else{
			$.ajax({
					type: "POST",
					url: "/admin/member/member/ajaxallot",
					data: {'b_id':b_id,'allotid':allotid,'notes':notes,'contid':contid,'memberid':memberid},
					success:function(msg){
						if(msg==1){							
							alert('分配成功');
							window.location.href='/admin/member/member/undoneMem';
						}else if(msg==3){
							alert('数据丢失');
						}else{
							alert('分配失败');
						}
					}
			});
		}
		
	});
	
	//网友审核
	//全选
    $("#CheckedAll").click(function(){
	     $('[name=checkid]:checkbox').attr('checked', true);
	 });
	 //全不选
    $("#CheckedNo").click(function(){
	    $('[type=checkbox]:checkbox').attr('checked', false);
	 });
    $("#checkDone").click(function(){
		var allot_id="";
		$('[name=checkid]:checkbox:checked').each(function(){
			allot_id+=$(this).val()+"&";
		})
		if(allot_id==0){
			alert('至少要选择一个提交审核');
		}else{
			$.ajax({
					type: "POST",
					url: "/admin/member/member/ajaxcheck",
					data: {'allot_id':allot_id},
					success:function(msg){
						if(msg==1){							
							alert('审核成功');
							window.location.href='/admin/member/member/checkMem';
						}else{
							alert('审核失败');
						}
					}
			});
		}
	}); 	
});
//己审己分配网友对备注的单个值ajax修改
function updatenote(id,notes){
	$("#edit_notes").css("border","1px solid #fff");
	$.ajax({
		type: "POST",
		url: "/admin/member/member/ajaxnotes",
		data: {'id':id,'notes':notes},
		success:function(msg){
			if(msg==1){			
				window.location.href='/admin/member/member/donemem';
			}else{
				window.location.href='/admin/member/member/donemem';
			}
		}
	});	
}

//单个员工删除
function empDel(user_id){
	var user_id = user_id;
	if(user_id && confirm('确认删除？')){
		$.ajax({
			type: "POST",
			url: "/admin/member/employee/ajaxempdel",
			data: {'user_id':user_id},
			success:function(msg){
				if(msg==1){
					$('#tr'+user_id).remove();
					alert('删除成功');
				}else{
					alert('删除失败');
				}
			}
		});	
	}
}

//给员工数据授权
function impower(id){
	var c_id="";
	var uid = id;
	$('[name=impower]:checkbox:checked').each(function(){
		c_id+=$(this).val()+",";
	})
	if(c_id==0){
		alert('请给该用户授权！');
	}
	$.ajax({
				type: "POST",
				url: "/admin/member/employee/impower",
				data: {'c_id':c_id,'uid':uid},
				success:function(msg){
					if(msg==1){							
						alert('数据授权成功');
						window.location.href='/admin/member/employee/impower/user_id/'+uid;
					}else{
						alert('数据授权失败');
						window.location.href='/admin/member/employee/impower/user_id/'+uid;
					}
				}
	});
	
}


