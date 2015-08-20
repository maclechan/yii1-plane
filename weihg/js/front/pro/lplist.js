
	window.onload=function(){
		$(".g-load").hide();
		$(".g-body").show();
		if($(".g-head").find("span").first().hasClass("js-selected")){
			$(".g-list1").css("display","block");
		}
		else{
			$(".g-list2").css("display","block");
		}
	}
	$(document).ready(function(){
		var olike;
	});
	// 取消喜欢(产品列表)
	$(".islike").click(function(){
		$(".g-pmt").css("display","block");
		olike=$(this).parent().parent().parent();
		$("#tjid").val($(this).attr("msgval"));
	});
	$(".g-pmt .cfm").click(function(){
		$(this).parent().css("display","none");
		olike.fadeOut(500);
		$.ajax({
			type: "POST",
			url: "/product/protjzan",
			data: {'id':$("#tjid").val(),'type':2},
			success:function(a){
			}
		});				
	});
	$(".g-pmt .ccl").click(function(){
		$(this).parent().css("display","none");
	});
	// 取消喜欢(作品推荐)============================================================2/14
	$(".islike_anli").click(function(e){
		e.preventDefault();
		e.stopPropagation();
		$(".g-pmt").css("display","block");
		olike=$(this).parent().parent();
		$("#tjid").val($(this).attr("msganli"));
	});
	$(".g-pmt .cfm").click(function(){
		$(this).parent().css("display","none");
		olike.fadeOut(500);
		$.ajax({
			type: "POST",
			url: "/site/guwanlizan",
			data: {'id':$("#tjid").val(),'type':2},
			success:function(a){
			}
		});				
	});
	$(".g-pmt .ccl").click(function(){
		$(this).parent().css("display","none");
	});
	//切换
	// ========================================切换添加置顶效果
	$(".g-head .sgg").click(function(){
		$(".g-head .cho").removeClass("js-selected");
		$(this).addClass("js-selected");
		$(".g-list2").css("display","none");
		$(".g-list1").css("display","block");
		$("html,body").animate({scrollTop:"0px"},300);//改
	});
	$(".g-head .cho").click(function(){
		$(".g-head .sgg").removeClass("js-selected");
		$(this).addClass("js-selected");
		$(".g-list1").css("display","none");
		$(".g-list2").css("display","block");
		$("html,body").animate({scrollTop:"0px"},300);//改
	});
	$(window).scroll(function(){
		$(".g-head").css({"position":"fixed","top":"0","left":"0"});
	});
	