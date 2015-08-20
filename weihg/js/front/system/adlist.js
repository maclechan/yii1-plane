	$("#inputT").val("请输入顾问姓名");
	$("#cur-area").click(function(){
		if($(".m-select").css("display") == "block"){
			$(".m-select").css("display","none");
		}
		else{
			$(".m-select").css("display","block");
			$(".g-mask").css({"display":"block","position":"fixed"});
		}
		
	});
	$(".m-select span").click(function(){
		var temp=$(this).text();
		$(this).text($("#cur-area").text());
		$("#cur-area").text(temp);
		$(".m-select").css("display","none");	
		$(".g-mask").css("display","none");		
	});
	$(".g-mask").bind("touchstart",function(){
		$(this).css("display","none");
		$(".m-select").css("display","none");
	});
	// 输入时
	document.getElementById("inputT").onfocus=function(e){
		$("#inputT").val("");
		$(".m-area").css("display","none");
		$(".m-fit").css("display","none");
		$(".m-back").css("display","block");
		$(".m-sch").css("display","block");
		$("#closebtn").css({"display":"block","position":"fixed"});
	}
	function showclose(){
		$("#closebtn").css("display","block");
	}
	// 点击筛选
	
	
	$("#filter").click(function(){
		$(".g-list").css("display","none");
		$(".m-area").css("display","none");
		$("#filter").css("display","none");
		$(".m-input").css("display","none");
		$(".m-back").css("display","block");
		$("#m-done").css("display","block");
		$("#filttl").css("display","block");
		$(".g-filt").css("display","block");
	});
	
	// 返回时
	$(".m-back").click(function(){

		$(".m-back").css("display","none");
		$(".m-sch").css("display","none");
		$("#closebtn").css("display","none");
		$("#filttl").css("display","none");
		$("#m-done").css("display","none");
		$(".g-filt").css("display","none");
		$("#inputT").val("请输入顾问姓名");
		$(".m-area").css("display","block");
		$(".m-fit").css("display","block");
		$(".m-input").css("display","block");
		$(".g-list").css("display","block");
		bSear=false;
		bFilt=false;		
		
	});
	// 点击关闭按钮时
	$("#closebtn").click(function(){
		$("#inputT").val("请输入顾问姓名");
	});
	
	// alert(oStyle.val()+" "+oSex.val()+" "+oJibie.val()+" "+oCost.val());
	window.onload=function(){
		$(".g-load").hide();
		$(".g-body").show();
	}
	$(window).scroll(function(){
		 $(".g-head").css({"position":"fixed","top":"0"});
	});
	// ==============================================================
	$(function(){
		var bSear=false,bFilt=false;
		var oTxt=$.trim($("#inputT").val());	
		var isNull=false;
		var oCmt;
		// 筛选条件
		var oStyle,oSex,oClass,oCost;
		var offset=0;
		// 筛选答案
		$("#stycnt span").click(function(){
			$("#stycnt span").removeClass("js-selected");
			$(this).addClass("js-selected");
			oStyle=$(this).attr("mval");
		});
		$("#sexcnt span").click(function(){
			$("#sexcnt span").removeClass("js-selected");
			$(this).addClass("js-selected");
			oSex=$(this).attr("mval");
		});
		$("#clacnt span").click(function(){
			$("#clacnt span").removeClass("js-selected");
			$(this).addClass("js-selected");
			oClass=$(this).attr("mval");
		});
		$("#costcnt span").click(function(){
			$("#costcnt span").removeClass("js-selected");
			$(this).addClass("js-selected");
			oCost=$(this).attr("mval");
			// var oVal4=$(this).text();
			// oCost.val(oVal4);
		});
		// 向上滑动
		$(window).scroll(function(){
			// 滑动高度大于50 时
			if($(window).scrollTop()>=$(document).height()-$(window).height()-50  &&  isNull==false){

				offset++;
			//	console.log(offset);
				var data={
					"page_index":offset
				};
				if(bSear == true && oCmt!=""){
					data["param_name"]=oCmt;
				}
				if(bFilt == true && (!oStyle || !oSex || !oClass || !oCost)){
					data["param_1"]=oStyle; //风格
					data["param_2"]=oSex; //性别
					data["param_3"]=oClass; //等级
					data["param_4"]=oCost; //婚礼预算
				}			
				// 加载
				$.ajax({
					type: "POST",
					url: "/site/guwlistmore",
					data: data,
					beforeSend:function(){
						$("#loadmore").css("display","block");
					},		
					error:function(XMLResponse){
						$("#loadmore").html('加载失败');
					},
					success:function(msg){
						if(msg==2){
							isNull=true;
							$("#loadmore").html('..End..');
						}else{
							$("#loadmore").css("display","none");
							var datas = JSON.parse(msg); 
							//id:param_1  姓名:param_2  头像:param_3  案例数:param_4   赞数:param_5
							// $("#listmore").html(msg);
							// 第一行添加链接url
							$.each(datas,function(i,item){
								var oPer="<a class='m-per bg06' href='/site/guwhome/id/"+item.param_1+"'>"+
									"<div class='m-list'>"+
									"<img class='f-fl' src='"+item.param_3+"'>"+
									"<div class='m-info f-fl'>"+
									"<p class='m-intr'><span class='pname fs08 fc05'>"+item.param_2+"</span><span class='pttl  f-tac fs07 fc06'>特级婚礼顾问</span></p>"+
									"<p class='m-intr fs07 fc06'><span class='pname'>作品:<span>"+item.param_4+"</span></span><span class='pttl f-tac'>粉丝:<span>"+item.param_5+"</span></span></p>"+
									"</div>"+
									"</div>"+
									"</a>";
									$(".g-list").append(oPer);
							});
						}
					}
				});
			}
			else{
				$("#loadmore").css("display","block");
			}
		});
		//筛选完成
		$("#m-done").click(function(){
			$(".g-filt").css("display","none");
			$(".m-back").css("display","none");
			$(".m-sch").css("display","none");
			$("#closebtn").css("display","none");
			$("#filttl").css("display","none");
			$("#m-done").css("display","none");
			$("#inputT").val("请输入顾问姓名");
			$(".m-area").css("display","block");
			$(".m-fit").css("display","block");
			$(".m-input").css("display","block");
			$(".g-list").css("display","block");

			if(!oSex && !oStyle && !oCost && !oClass){
				// 没有筛选条件，不处理
			}
			else{
				bFilt=true;
				$.ajax({
					type:"POST",
					url:"/site/guwlistmore",
					data:{
						"param_1":oStyle,//风格
						"param_2":oSex,//性别
						"param_3":oClass,//等级
						"param_4":oCost//价格
					},
					beforeSend:function(){
						$(".g-list").empty();
						$("#loadmore").css("display","block");
					},
					error:function(XMLResponse){
						$("#loadmore").html('未能成功匹配');
					},
					success:function(msg){
						if(msg==2){
							$("#loadmore").html('..End..');
						}
						else{
							$("#loadmore").css("display","none");
							var datas = JSON.parse(msg); 
							offset=0;
							$.each(datas,function(i,item){
								var oPer="<a class='m-per bg06' href='/site/guwhome/id/"+item.param_1+"'>"+
									"<div class='m-list'>"+
									"<img class='f-fl' src='"+item.param_3+"'>"+
									"<div class='m-info f-fl'>"+
									"<p class='m-intr'><span class='pname fs08 fc05'>"+item.param_2+"</span><span class='pttl  f-tac fs07 fc06'>特级婚礼顾问</span></p>"+
									"<p class='m-intr fs07 fc06'><span class='pname'>作品:<span>"+item.param_4+"</span></span><span class='pttl f-tac'>粉丝:<span>"+item.param_5+"</span></span></p>"+
									"</div>"+
									"</div>"+
									"</a>";
									$(".g-list").append(oPer);
							});
						}
					}

				});
			}	
		}); 
		// 点击搜索
		$("#search").click(function(){
			if($("#inputT").val()!="请输入顾问姓名" && $.trim($("#inputT").val())!="")
			{
				oCmt=$.trim($("#inputT").val());
				bSear=true;
				$.ajax({
					type:"POST",
					url:"/site/guwlistmore",
					data:{'param_name':oCmt},
					beforeSend:function(){
						$(".g-list").empty();
						$("#loadmore").css("display","block");
					},
					error:function(XMLResponse){
						$("#loadmore").html('未能成功匹配');
					},
					success:function(msg){
						if(msg==2){
							$("#loadmore").html('..End..');
						}
						else{
							$("#loadmore").css("display","none");
							var datas = JSON.parse(msg); 
							offset=0;
							$.each(datas,function(i,item){
								var oPer="<a class='m-per bg06' href='/site/guwhome/id/"+item.param_1+"'>"+
									"<div class='m-list'>"+
									"<img class='f-fl' src='"+item.param_3+"'>"+
									"<div class='m-info f-fl'>"+
									"<p class='m-intr'><span class='pname fs08 fc05'>"+item.param_2+"</span><span class='pttl  f-tac fs07 fc06'>特级婚礼顾问</span></p>"+
									"<p class='m-intr fs07 fc06'><span class='pname'>作品:<span>"+item.param_4+"</span></span><span class='pttl f-tac'>粉丝:<span>"+item.param_5+"</span></span></p>"+
									"</div>"+
									"</div>"+
									"</a>";
									$(".g-list").append(oPer);
							});
						}
					}
				});
			}
		});
	})