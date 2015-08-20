window.onload=function(){
		$(".g-load").hide();
		$(".g-body").show();
	}
	$(function(){
		var oUl=$(".oul");
		var touchmove=false,startX,endX,moveX;
		var len=$(".g-head ul li").length;
		var current=0;
		var oLeft,timer;
		// 自动播放
		function autoPlay(){
			current++;
			if(current>len-1){
				current=0;
				oUl.css("left","0");
			}
			oUl.animate({left:"-"+current+"00%"},300);
			$(".g-head p span").removeClass("curdot");
			$(".g-head p span").eq(current).addClass("curdot");
		}
		timer=setInterval(autoPlay,3000);
		// 手动播放
		function imgPlay(){
			oUl.bind("touchstart",function(e){
				clearInterval(timer);
				e.preventDefault();
				startX=e.originalEvent.targetTouches[0].pageX;
				oLeft=oUl.offset().left;
			});
			oUl.bind("touchmove",function(e){
				e.preventDefault();
				moveX=e.originalEvent.changedTouches[0].clientX - startX;
				if(current==0 && moveX>0){

				}
				else if(current==len-1 && moveX<0){

				}
				else{
					oUl.css("left",oLeft+moveX);
				}
				touchmove=true;

			})
			oUl.bind("touchend",function(e){
				timer=setInterval(autoPlay,3000);
				e.preventDefault();
				endX=e.originalEvent.changedTouches[0].pageX;
				if(touchmove==true){
					if((startX-endX)>100){
						//左滑，右侧图片出现
						current++;
						if(current>=len){
							current=len-1;
						}
						oUl.animate({left:"-"+current+"00%"},100);
						oUl.css("left","-"+current+"00%");
						touchmove=false;
					}
					if((endX-startX)>100){
						current--;
						if(current<0){
							current=0;
						}
						oUl.animate({left:"-"+current+"00%"},100);
						oUl.css("left","-"+current+"00%");
						touchmove=false;
					}
					else{
						oUl.animate({left:"-"+current+"00%"},100);
						oUl.css("left","-"+current+"00%");
					}
					$(".g-head p span").removeClass("curdot");
					$(".g-head p span").eq(current).addClass("curdot");
				}
			});
		}
		imgPlay();
		//点赞效果=======================================================2/14
		$(".m-info .nice").click(function(e){
			e.preventDefault();
			e.stopPropagation();
			if($(this).css("background-position")=="0px -3px"){
				$(this).addClass("redheart");				
				$.ajax({
					type: "POST",
					url: "/site/guwanlizan",
					data: {'id':$(this).attr("msgval"),'type':1},
					success:function(a){
					}
				});					
			}
			else{
				$(this).removeClass("redheart");
				$.ajax({
					type: "POST",
					url: "/site/guwanlizan",
					data: {'id':$(this).attr("msgval"),'type':2},
					success:function(a){
					}
				});					
			}
		});
	});