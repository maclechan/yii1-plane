var oImg=$("#img-ctn"),oUl=$("#imgul"),aLi=$("#imgul li"),oRight=$(".right"),oLeft=$(".left");
var oLeft=$(".left");
var oRight=$(".right");
var i=0,iNow=0,ready=true,wait=0;
var arr=[{b: 'webkit', e: 'webkitTransitionEnd'}, {b: 'firefox', e: 'transitionend'}];
var touchmove=false;
var startX,endX;
oImg.bind("touchstart",function(e){
	e.preventDefault();
	startX=e.originalEvent.targetTouches[0].pageX;
});
oImg.bind("touchmove",function(e){
	e.preventDefault();
	touchmove=true;
});
oImg.bind("touchend",function(e){
	e.preventDefault();
	endX=e.originalEvent.changedTouches[0].pageX;
	if(touchmove == true){
		if((startX - endX) > 50){
			tab((iNow+1)%aLi.length);
		}
		else if( (endX - startX) > 50 ){
			tab((iNow-1+aLi.length)%aLi.length);
		}
	}
	touchmove = false;
});
// oLeft.onclick=function(){
// 	tab((iNow-1+aLi.length)%aLi.length);
// }
// oRight.onclick=function(){
// 	tab((iNow+1)%aLi.length);
// }
function tEnd(ev){
	var obj=ev.srcElement || ev.target;
	if(obj.tagName!= "LI") return;
	wait --;
	if(wait <= 0) ready =true;
}
for(var i=0;i<aLi.length;i++){
	if(navigator.userAgent.toLowerCase().search(arr[i].b)!=-1)
	{
		document.addEventListener(arr[i].e, tEnd, false);
		break;
	}
}
function m(n){return (n+aLi.length)%aLi.length;}
function tab(now){
	if(!ready) return;
	ready=false;
	iNow = now;
	wait=aLi.length;
	for(var i=0;i<aLi.length;i++){
		aLi[i].className="";
		aLi.onclick=null;
	}
	aLi[m(iNow-2)].className="left2";
	aLi[m(iNow-1)].className="left";
	aLi[iNow].className="cur";
	aLi[m(iNow+1)].className="right";
	aLi[m(iNow+2)].className="right2";
	setEv();
}
setEv();
function setEv(){
	var scaled=false;
		aLi[m(iNow-1)].onclick=oLeft.onclick;
		// aLi[iNow].onclick=function ()	//放大
		// {
		// 	if(scaled)
		// 	{
		// 		this.className='active';
		// 	}
		// 	else
		// 	{
		// 		this.className='cur';
		// 	}
		// 	scaled=!scaled;
		// };
		aLi[m(iNow+1)].onclick=oRight.onclick;
}
	window.onload=function(){
		$(".g-load").hide();
		$(".g-body").show();
	}
$(function(){
	var t=false;
	$("#imgul li a").bind("touchstart",function(e){
		e.preventDefault();
	});
	$("#imgul li a").bind("touchmove",function(e){
		e.preventDefault();
		t=true;
	});
	$("#imgul li a").bind("touchend",function(e){
		e.preventDefault();
		if(t==false){
			location.href=$(this).attr("href");
		}
		t=false;
	});
});
