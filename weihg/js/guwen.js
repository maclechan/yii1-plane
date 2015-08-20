//审核顾问
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
		//console.log(id);
		//return false;
		if(id==0){
			alert('至少要选择一个商家提交审核');
		}else{
			$.ajax({
					type: "POST",
					url: "/admin/guwen/handle/checkdone",
					data: {'id':id},
					success:function(msg){
						if(msg==1){							
							alert('审核成功');
							window.location.href='/admin/guwen/handle/gwenlist';
						}else{
							alert('审核失败');
						}
					}
			});
		}
	});
});

//单个顾问删除
function adviserdel(id){
	var id = id;
	if(id && confirm('该顾问下相关信息将全部删除')){
		$.ajax({
			type: "POST",
			url: "/admin/guwen/handle/gwendel",
			data: {'id':id},
			success:function(msg){
				if(msg==1){
					$('#tr'+id).remove();
					alert('删除成功');
				}else{
					alert('删除失败');
				}
			}
		});	
	}
}



