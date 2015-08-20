var touchfn=function(obj,type,fn){
		var sTime=0,eTime=0,startX,endX,startY,endY,touchmove=false;
		var type=type.toLowerCase();
		obj.bind("touchstart",function(e){
			e.preventDefault();
			startX=e.originalEvent.targetTouches[0].pageX;
			startY=e.originalEvent.targetTouches[0].pageY;
			sTime=new Date().getTime();
			
		});
		obj.bind("touchmove",function(e){
			e.preventDefault();
			touchmove = true;
		});
		obj.bind("touchend",function(e){
			e.preventDefault();
			eTime=new Date().getTime();
			if(touchmove == true){
				endX = e.originalEvent.changedTouches[0].pageX;
				endY = e.originalEvent.changedTouches[0].pageY;
				if((endY - startY)>50 && type.indexOf("top")!=-1){
					fn();
				}
				if((startY - endY) >50 && type.indexOf("down")!=-1){
					fn();
				}
				if((endX - startX)>50 && type.indexOf("right")!=-1){
					fn();
				}
				if((startX - endX)>50 && type.indexOf("left")!=-1){
					fn();
				}
				
			}
			else{// ===============================================2/13
				if((eTime - sTime>50) && type.indexOf("click")!=-1){
					fn();
				}
				return;
			}
			// ===============================================2/13
			touchmove=false;
		});
	}

var cur,aImg,oSrc;
// ================================================2/13
	$(".d-cmtbox").on("click",".d-img img",function(){
		cur=0;
		aImg=$(this).parent().children();
		cur=$(this).parent().children("img").index(this);
		$(".bigImg").css({"background-image":"url("+aImg[cur].src+")","display":"block"});
		$(".bigImg p").text((cur+1)+"/"+aImg.length);
	});
	// $(".bigImg").click(function(){
	// 	$(".bigImg").hide(300);
	// });
	// $(".d-img img").click(function(){
	// 	cur=0;
	// 	aImg=$(this).parent().children();
	// 	oSrc=$(this).attr("src");
	// 	// var aSrc=aImg[0].src;
	// 	// alert(1);
	// 	for(var i=0;i<aImg.length;i++){
	// 		if(oSrc == aImg[i].src){
	// 			cur=i;
	// 		}
	// 	}
	// 	$(".bigImg").css({"background-image":"url("+aImg[cur].src+")","display":"block"});
	// 	$(".bigImg p").text((cur+1)+"/"+aImg.length);
	// });
	// 滑动
	touchfn($(".bigImg"),"left",function(){
		cur++;
		if(cur>=aImg.length){
			cur=aImg.length-1;
		}
		$(".bigImg").css("background-image","url("+aImg[cur].src+")");
		$(".bigImg p").text((cur+1)+"/"+aImg.length);
	});
	touchfn($(".bigImg"),"right",function(){
		cur--;
		if(cur<0){
			cur=0;
		}
		$(".bigImg").css("background-image","url("+aImg[cur].src+")");
		$(".bigImg p").text((cur+1)+"/"+aImg.length);
	});
	// =============================================2/13
	touchfn($(".bigImg"),"click",function(){
		$(".bigImg").hide(300);
	});
	

var goodsnum=$("#goodsnum");
var temp,oVal=$("#numval").val();

$("#ltxt").click(function(){
	// 点赞加减
//	$(this).css("background-position", "-10px -380px");
		if($(this).css("background-position")=="-10px -94px"){
			$(this).css("background-position","-10px -380px");
				$.ajax({
					type: "POST",
					url: "/product/protjzan",
					data: {'id':$(this).attr("msgval"),'type':1},
					success:function(a){
					}
				});			
		}else{
			$(this).css("background-position","-10px -94px");
				$.ajax({
					type: "POST",
					url: "/product/protjzan",
					data: {'id':$(this).attr("msgval"),'type':2},
					success:function(a){
					}
				});			
		}	
});


// 点击跳到评价
$("#cmt").click(function(){
	$("#detail").removeClass("js-selected");
	$("#other").removeClass("js-selected");;
	$(this).addClass("js-selected");
	var href=$(this).attr("href");
	var pos1=$(".d-cmt").offset().top;
	$("html,body").animate({scrollTop:pos1-60},300);
});
// 点击跳到商品详情
$("#detail").click(function(){
	$("#cmt").removeClass("js-selected");
	$("#other").removeClass("js-selected");;
	$(this).addClass("js-selected");
	var href=$(this).attr("href");
	var pos2=$(".d-imgtxt").offset().top;
	$("html,body").animate({scrollTop:pos2-60},300);
});
// 加入购物车
var cartnum=0;//原有数量
$("#addCart").click(function(){
	$("#cart").empty();
	cartnum++;
	$("#cart").append("<label id='cartnum' class='fadeInTop fc01 fs04 bg05 f-tac'>"+cartnum+"</label>");
	var t_id = $("#t_id").val();
	var a_id = $("#a_id").val();
	var g_id = $("#g_id").val();
	var goodsname = $("#goodsname").val();
	var goodsimg = $("#goodsimg").val();
	var adviname = $("#adviname").val();
	var price = $("#price").val();
	$.ajax({
		type: "POST",
		url: "/product/protjaddcar",
		data: {'t_id':t_id,'a_id':a_id,'g_id':g_id,'goodsname':goodsname,'goodsimg':goodsimg,'adviname':adviname,'price':price,'rows':cartnum},
		success:function(msg){
		
		}
	});		
});
// 立即购买
$("#buy").click(function(){
	$(".mask").css("display","block");
	// ==================================2/13
	document.addEventListener("touchmove",popup,false);
});
// -
$(".cut").click(function(){
	oVal--;
	// ============================================2/13
	if(oVal<1){
		oVal=1;
	}
	$("#numval").val(oVal);
});
// +
$(".plus").click(function(){
	oVal++;
	$("#numval").val(oVal);
});
// 确定
$(".done-btn").click(function(){
	var oNum=$("#numval").val();
	if(!isNaN(oNum)){
		goodsnum.val(oNum);
	}
	else{
		alert("输入数字");
	}

});
// 取消
$(".ccl-btn").click(function(){
	$(".mask").css("display","none");
	// ===========================================2/13
	document.removeEventListener("touchmove",popup,false);
});
window.onload=function(){
	$(".g-load").hide();
	$(".g-body").show();
	$(".g-btm").css("position","fixed");
}
window.reload=function(){
	$(".g-btm").css("position","fixed");
}
$(window).scroll(function(){
	// $(".g-btm").css("position","fixed");
	// 商品详情、评价、推荐悬浮
	var d_header=$(".m-detail").offset().top;
	if($(window).scrollTop()>d_header){
		$(".m-header").css({"position":"fixed","top":"0","left":"0","zIndex":"2"});
	}
	else{
		$(".m-header").css({"position":"relative"});
	}
});
$("#toshop").click(function(){
	if($(".s-info").css("display")=="none"){
		$(".s-info").css("display","block");
		// ================================================================2/13
		$(this).css("background-position","right -532px");
	}
	else{
		$(".s-info").css("display","none");
		// ================================================================2/13
		$(this).css("background-position","right -416px");
	}
});
$("#sname").click(function(){
	if($(".s-info").css("display")=="none"){
		$(".s-info").css("display","block");
		$("#toshop").css("background-position","96% -532px");
	}
	else{
		$(".s-info").css("display","none");
		$("#toshop").css("background-position","96% -416px");
	}
});
//分享固定锁屏	
var popup = function(e){
    e.preventDefault();
   	e.stopPropagation();
};
// 分享蒙版
$("#stxt").click(function(){
	$(".share-mask").css({"display":"block","position":"fixed"});
	document.addEventListener("touchmove",popup,false);
});
$(".share-mask").click(function(){
	$(this).css("display","none");
	document.removeEventListener("touchmove",popup,false);
});