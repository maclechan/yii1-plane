window.onload=function(){
		$(".g-load").hide();
		$(".g-body").show();
		// var scr=0;
}

	var offset=0;
	$(".m-btn").click(function(){
		var cid=$(this).attr("data-id");
		if($(this).css("background-position")=="350px -424px"){
			$(this).css("background-position","320px -542px");
			$(this).text("收起");
			var cont=$(this).prev();
			cont.css("display","block");
			// 加载
			$.ajax({
				type:"POST",
				url:"/tminus/tminusajaxl",
				data:{"page_index":offset,
					  "cid":cid
					 },
				beforeSend:function(){
					$(".loadmore").show();
				},
				error:function(XMLResponse){
					$(".loadmore").css("background","none");
					$(".loadmore").html("加载失败···");
				},
				success:function(msg){
					$(".loadmore").hide();
					if(msg==1){

					}
					else{
						var datas = JSON.parse(msg); 
						$.each(datas,function(i,item){
							var oTime="<a href='/tminus/tminusatc/id/"+item.param_1+".html'>"+
										"<img class='f-fl' src='"+item.param_2+"'>"+
										"<span class='ttl f-fl fs08 fc09 f-tf'>"+item.param_3+"</span>"+
										"<span class='f-fr fs06 fc10'>浏览"+item.param_4+"</span>"+
									"</a>";
							cont.append(oTime);
						});
					}
				}
			});
		}
		else{
			$(this).css("background-position","350px -424px");
			$(this).text("查看更多");
			$(this).prev().css("display","none");
			cont.empty();
		}
	});
	// ==========
	var startY,endY,touchmove=0;
	$(".m-container").bind("touchstart",function(e){
		startY=e.originalEvent.targetTouches[0].pageY;
	});
	$(".m-container").bind("touchmove",function(e){
		touchmove=true;
	});
	$(".m-container").bind("touchend",function(e){
		endY=e.originalEvent.changedTouches[0].pageY;
		if(touchmove==true && startY - endY > 50){
			offset++;
			var oContainer=$(this);
			cid=oContainer.next().attr("data-id");
			$.ajax({
				type:"POST",
				url:"/tminus/tminusajaxl",
				data:{"page_index":offset,
					  "cid":cid
					 },
				beforeSend:function(){
					// $(".loadmore").show();
				},
				error:function(XMLResponse){
					// $(".loadmore").css("background","none");
					// $(".loadmore").html("加载失败···");
				},
				success:function(msg){
					if(msg==1){
						 $(".loadmore").html("没有更多");
					}
					else{
						// $(".loadmore").hide();
						var datas = JSON.parse(msg); 
						$.each(datas,function(i,item){
							var oTime="<a href='/tminus/tminusatc/id/"+item.param_1+".html'>"+
										"<img class='f-fl' src='"+item.param_2+"'>"+
										"<span class='ttl f-fl fs08 fc09 f-tf'>"+item.param_3+"</span>"+
										"<span class='f-fr fs06 fc10'>浏览"+item.param_4+"</span>"+
									"</a>";
							oContainer.append(oTime);
						});
					}
				}
			});
		}
	});
		

