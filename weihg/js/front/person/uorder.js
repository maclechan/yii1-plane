window.onload=function(){
		$(".g-load").hide();
		$(".g-body").show();
	}
	$(function(){
		var oorder,onewo;
	});
	// 取消订单
	$(".cclorder").click(function(){
		$(".g-mask").css("display","block");
		$("#cancle").css("display","block");
		oorder=$(this).parent().parent();	
		$("#qxid").val($(this).attr("msgval"));
	});
	// 确认收货
	$(".m-opt .cfmget").click(function(){
		if($(this).text()=="立即评价"){
			//去评价
		}
		else{
			$(".g-mask").css("display","block");
			$("#rcvd").css("display","block");
			oorder=$(this).parent().parent();
			$("#qxid").val($(this).attr("msgval"));
		}
	});
	// 弹出框否事件
	$(".ccl").click(function(){
		$(this).parent().css("display","none");
		$(".g-mask").css("display","none");
	});
	// 取消订单弹出框 ->是事件
	$("#cancle .cfm").click(function(){
		$(this).parent().css("display","none");
		oorder.fadeOut(500);
		$(".g-mask").css("display","none");
		$.ajax({
			type: "POST",
			url: "/users/usersorderqx",
			data: {'id':$("#qxid").val()},
			success:function(a){
			}
		});				
	});
	// 确认收货弹出框 ->是事件
	$("#rcvd .cfm").click(function(){
		// 这里请求真实数据 
		$(this).parent().css("display","none");
		$(".g-mask").css("display","none");
		$.ajax({
			type: "POST",
			url: "/users/usersorderreceive",
			data: {'id':$("#qxid").val()},
			success:function(a){
				if(a==1){
					window.location.href="http://weihungo.com/users/usersorder/type/3.html";
				}
			}
		});		
	});
	$(window).scroll(function(){
		$(".g-head").css("position","fixed");
	});