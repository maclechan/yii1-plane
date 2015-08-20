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
			alert('至少要选中一个提交审核');
		}else{
			$.ajax({
					type: "POST",
					url: "/admin/guwen/recommend/checkdone",
					data: {'id':id},
					success:function(msg){
						if(msg==1){							
							alert('审核成功');
							window.location.href='/admin/guwen/recommend/recommendlist';
						}else{
							alert('审核失败');
						}
					}
			});
		}
	});
});

