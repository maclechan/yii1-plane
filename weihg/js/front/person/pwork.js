window.onload=function(){
	$(".g-load").hide();
	$(".g-body").show();
	if($(document).scrollTop() > 0 ){
		$(".g-cmt .g-head").css("position","fixed");
		$(".g-box").css({"position":"fixed","top":"0"});
		$(".g-ctat").css({"position":"fixed","left":"0","bottom":"0"});
	}
	$(".g-box").css({"position":"fixed","top":"0"});
	$(".g-ctat").css({"position":"fixed","left":"0","bottom":"0"});
}
$(window).scroll(function(){
	// $(".g-box").css({"position":"fixed","top":"0"});
	// $(".g-ctat").css({"position":"fixed","left":"0","bottom":"0"});
	$(".g-cmt .g-head").css("position","fixed");
	$(".smsg").css({"position":"fixed","bottom":"0"});
});
$("#cmtbtn").click(function(){
	$(".g-body").hide();
	$(".g-ctat").hide();
	$(".g-cmt").show();
});
$(".back").click(function(){
	$(".g-cmt").hide();
	$(".g-body").show();
	$(".g-ctat").show();
});
// ==================================================================添加评论、喜欢、分享点击效果
//固定锁屏	
var popup = function(e){
    e.preventDefault();
   	e.stopPropagation();
};
$("#likebtn").click(function(){
	if($(this).css("background-position")=="-12px -138px"){
		$(this).css("background-position","-12px -620px");
			$.ajax({
				type: "POST",
				url: "/site/guwanlizan",
				data: {'id':$("#an_id").val(),'type':1},
				success:function(a){
				}
			});			
	}else{
		$(this).css("background-position","-12px -138px");
			$.ajax({
				type: "POST",
				url: "/site/guwanlizan",
				data: {'id':$("#an_id").val(),'type':2},
				success:function(a){
				}
			});			
	}
});
// 分享蒙版
$("#sharebtn").click(function(){
	$(".share-mask").css({"display":"block","position":"fixed"});
	document.addEventListener("touchmove",popup,false);
});
$(".share-mask").click(function(){
	$(this).css("display","none");
	document.removeEventListener("touchmove",popup,false);
});