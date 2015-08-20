	window.onload=function(){
		$(".g-load").hide();
		$(".g-body").show();
	}
	$(window).scroll(function(){
		$(".g-head").css("position","fixed");
	});
	// 取消事件=返回事件
	$(".g-back").click(function(){
		window.history.go(-1);
	});
/* 	$("#ccl").click(function(){
		window.history.back(-1);
	}); */
$(function(){
	var oSer,oSkill,oGuide;
	// 顾问打分
	$("#ser span").click(function(){
		$("#ser span").css("background-position","-10px -146px");
		$(this).css("background-position","-10px -628px");
		oSer=$(this).attr("score");
		$(this).prevAll().css("background-position","-10px -628px");
	});
	$("#skill span").click(function(){
		$("#skill span").css("background-position","-10px -146px");
		$(this).css("background-position","-10px -628px");
		oSkill=$(this).attr("score");
		$(this).prevAll().css("background-position","-10px -628px");
	});
	$("#guide span").click(function(){
		$("#guide span").css("background-position","-10px -146px");
		$(this).css("background-position","-10px -628px");
		oGuide=$(this).attr("score");
		$(this).prevAll().css("background-position","-10px -628px");
	});
	$("#sbm").click(function(){
		//分数
		// alert(oSer+oSkill+oGuide);
		var proCmt=$("#proCmt").val();
		var perCmt=$("#perCmt").val();		
		// 评论内容 
		$("#procomment").val(proCmt);
		$("#percomment").val(perCmt);
		$("#serScore").val(oSer);
		$("#skScore").val(oSkill);
		$("#guScore").val(oGuide);
		if(proCmt!="" && perCmt!=""){
			
		}else{
			alert("评论内容不能为空！");
			return false;
		}
		
	});

	// 上传图片,预览用bg-s cover实现
	$(".imgb input").change(function(e){
		var obj=$(this);
        	var file = e.target.files[0];
	        var freader = new FileReader();
	        freader.readAsDataURL(file);
	        freader.onload=function(e)
	        {
	            obj.parent().css("background-image","url("+e.target.result+")");
	        }
	});
});