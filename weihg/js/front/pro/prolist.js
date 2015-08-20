	window.onload=function(){
		$(".g-load").hide();
		$(".g-body").show();
	}
	$(".islike").click(function(){
		// 点赞加减
		if($(this).css("background-position")=="0px -106px"){
			$(this).css("background-position","0px -450px");
				$.ajax({
					type: "POST",
					url: "/product/protjzan",
					data: {'id':$(this).attr("msgval"),'type':1},
					success:function(a){
					}
				});			
		}else{
			$(this).css("background-position","0px -106px");
				$.ajax({
					type: "POST",
					url: "/product/protjzan",
					data: {'id':$(this).attr("msgval"),'type':2},
					success:function(a){
					}
				});			
		}		
	});