var m_width=640,m_height=$(window).height();
var Ages=$("#Ages");
var Const=$("#Const");
var favArr=[];
var Fav=$("#Fav");
var Hlsty=$("#Hlsty");

// 上下滑动切换
function sec(){
	var aSec=$(".m-sec section");
	var len=aSec.length,cur=0,startY=0,endY=0,touchmove=false,oid;
	aSec.bind("touchstart",function(e){
		e.preventDefault();
		startY=e.originalEvent.targetTouches[0].pageY;
	});
	aSec.bind("touchmove",function(e){
		e.preventDefault();
		touchmove=true;
	});
	aSec.bind("touchend",function(e){
		e.preventDefault();
		endY=e.originalEvent.changedTouches[0].pageY;
		if(touchmove==true){
			if((startY-endY)>50){
				cur++;
				if(cur==len-1){
					$(".m-btn").css("display","block");
				}
				if(cur<len){
					$(this).removeClass("show fadeInB fadeInT");
					$(this).next().addClass("show fadeInB");
				}
				else{
					cur=len-1;
				}
			}
			if((endY-startY>50)){
				cur--;
				//============================================= 不能返回到第一页
				if(cur<1){
					cur=1;
				}
				else{
					$(this).removeClass("show fadeInB fadeInT");
					$(this).prev().addClass("show fadeInT");
				}
			}
		}
		touchmove=false;
	});
}
// 用户选择
function usrseleted(){
	var toumove=false;
	// 年代 单选
	$("#sec2 .m-cirimg").bind("touchstart",function(e){
		e.preventDefault();
	});
	$("#sec2 .m-cirimg").bind("touchmove",function(e){
		e.preventDefault();
		toumove=true;
	});
	$("#sec2 .m-cirimg").bind("touchend",function(e){
		e.preventDefault();
		if(toumove ==false){
			$("#sec2 .m-cirimg").removeClass("js-selected");
			$(this).addClass("js-selected");
			Ages.val($(this).attr("emsg"));
		}
		else{
			toumove=false;
			return;
		}	
	});
	// 星座 单选
	$("#sec3 .m-cirimg").bind("touchstart",function(e){
		e.preventDefault();
	});
	$("#sec3 .m-cirimg").bind("touchmove",function(e){
		e.preventDefault();
		toumove=true;
	});
	$("#sec3 .m-cirimg").bind("touchend",function(e){
		e.preventDefault();
		if(toumove ==false){
			$("#sec3 .m-cirimg").removeClass("js-selected");
			$(this).addClass("js-selected");
			Const.val($(this).attr("emsg"));
		}
		else{
			toumove=false;
			return;
		}	
	});
	// 爱好 多选
	$("#sec4 .m-cirimg").bind("touchstart",function(e){
		e.preventDefault();
	});
	$("#sec4 .m-cirimg").bind("touchmove",function(e){
		e.preventDefault();
		toumove=true;
	});
	$("#sec4 .m-cirimg").bind("touchend",function(e){
		e.preventDefault();
		if(toumove ==false){
			if($(this).hasClass("js-selected")){
				$(this).removeClass("js-selected");
				var n,fid=$(this).attr("emsg");
				for(var i=0;i<favArr.length;i++){
					if(favArr[i]==fid){
						n=i;
					}
				}
				favArr.splice(n,1);
			}
			else{
				$(this).addClass("js-selected");
				favArr.push($(this).attr("emsg"));
			}
			Fav.val(favArr);//将数组值赋给Fav
		}
		else{
			toumove=false;
			return;
		}	
	});
	// 风格 单选
	$("#sec5 .m-cirimg").bind("touchstart",function(e){
		e.preventDefault();
	});
	$("#sec5 .m-cirimg").bind("touchmove",function(e){
		e.preventDefault();
		toumove=true;
	});
	$("#sec5 .m-cirimg").bind("touchend",function(e){
		e.preventDefault();
		if(toumove ==false){
			$("#sec5 .m-cirimg").removeClass("js-selected");
			$(this).addClass("js-selected");
			Hlsty.val($(this).attr("emsg"));
		}
		else{
			toumove=false;
			return;
		}	
	});
}
// // 进入顾问个人主页
// function toPer(){
// 	var tmove=false;
// 	$("#sec5 .m-btn").bind("touchstart",function(e){
// 		e.preventDefault();
// 	});
// 	$("#sec5 .m-btn").bind("touchmove",function(e){
// 		e.preventDefault();
// 		tmove=true;
// 	});
// 	$("#sec5 .m-btn").bind("touchend",function(e){
// 		e.preventDefault();
// 		if(tmove==false){			
// 			location.href="rcmad.html";
// 		}
// 		tmove=false;
// 	});
// }
window.onload=function(){
		// 加载显示
		$(".sec").css({height:m_height,width:m_width});
		$(".g-load").hide();
		$(".g-body").show();
		$("section").css({height:m_height,width:m_width});
		sec();
		usrseleted();
}