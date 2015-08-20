// JavaScript Document

function correctPNG()
{
   for(var i=0; i<document.images.length; i++)
   {
   var img = document.images[i]
   var imgName = img.src.toUpperCase()
   if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
   {
   var imgID = (img.id) ? "id='" + img.id + "' " : ""
   var imgClass = (img.className) ? "class='" + img.className + "' " : ""
   var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
   var imgStyle = "display:inline-block;" + img.style.cssText
   if (img.align == "left") imgStyle = "float:left;" + imgStyle
   if (img.align == "right") imgStyle = "float:right;" + imgStyle
   if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle
   var strNewHTML = "<span " + imgID + imgClass + imgTitle
   + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
   + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
   + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>"
   img.outerHTML = strNewHTML
   i = i-1
   };
   };
};

//初始颜色
function onNo(num){
    $(num).removeClass("bai_lan");
    $(num).removeClass("hui_lv");
    $(num).removeClass("bai_hong");
    $(num).addClass("hui_lan");
}
//点击颜色
function onNone(num){
	$(num).removeClass("hui_lan");
	$(num).removeClass("hui_lv");
	$(num).removeClass("bai_hong");
	$(num).addClass("bai_lan");
}
//错误颜色
function onError(num){
	$(num).removeClass("hui_lan");
	$(num).removeClass("bai_lan");
	$(num).removeClass("hui_lv");
	$(num).addClass("bai_hong");
}
//成功的样式
function onSuccess(num){
	$(num).removeClass("hui_lan");
	$(num).removeClass("bai_lan");
	$(num).removeClass("bai_hong");
	$(num).addClass("hui_lv");
	$(num).parent().find(".formtips").remove();
	$(num).parent().append('<span class="formtips onSuccess">&nbsp;</span>'); 
}
function onYes(num){
	$(num).removeClass("hui_lan");
	$(num).removeClass("bai_lan");
	$(num).removeClass("bai_hong");
	$(num).addClass("hui_lv");
}
function cdel(num){
   $(".menHx"+num).remove();
   $(".Qm_Add").remove();
}

function switchTag(content)
{
// alert(content);
for(i=1; i <3; i++)
{

if ("content"+i==content)
{
document.getElementById(content).className="";
document.getElementById("content1"+i).className="on";
}else{
document.getElementById("content"+i).className="hidecontent";
document.getElementById("content1"+i).className="";
}
document.getElementById("content").className=content;
}
}


$(function(){ 	//  等待DOM加载完毕.
	//enter 代替tab
//	$("input[type='text']").keypress(function (e) { 
//	var keyCode = e.keyCode ? e.keyCode : e.which ? e.which : e.charCode;  
//	if (keyCode == 13){ 
//	var i;  
//	for (i = 0; i < this.form.elements.length; i++)
//	if (this == this.form.elements[i])  
//	break;
//	i = (i + 1) % this.form.elements.length;
//	this.form.elements[i].focus();  
//	return false;
//	}
//	else  
//	return true;  
//	});

		var $category = $('.show:gt(0)');     	    //  获得索引值大于的集合对象	
		var $eqry = $('.show:eq(0)'); 
		$category.hide();							    //  隐藏上面获取到的jQuery对象。
		var $toggleBtn = $('.showmore > span');             //  获取按钮
		$toggleBtn.click(function(){
		      if($eqry.is(":visible")){
					$eqry.hide();
					$category.show();                   		 
					$('.showmore span')
					    .removeClass("showmore_r")
						.addClass("showmore_l");
			  }else{
					$eqry.show();
					$category.hide();                   		 
					$('.showmore span')
					    .removeClass("showmore_l")
						.addClass("showmore_r");
			  }
			return false;					      	//超链接不跳转
		});
		
	 $("#tabRight").click(function(){
		if($(".tabRight").is(":visible")){
		   $(".tabRight").hide();
		   $(".tabRightDown").show();
		}else{
		   $(".tabRightDown").hide();
		   $(".tabRight").show();
		}
	 });

	 //email 闪烁

	 $("#content1").click(function(){
		 $("#content21").hide();
		 $("#content2").children("a").removeClass("on2");
		 $("#content31").hide();
		 $("#content3").children("a").removeClass("on2");
		 if($("#content11").is(":visible")){
		   $("#content11").hide();
		   $(this).children("a").removeClass("on2");
		}else{
		   $("#content11").show();
		   $(this).children("a").addClass("on2");
		}
	 });
	 $("#content2").click(function(){
		 $("#content11").hide();
		 $("#content1").children("a").removeClass("on2");
		 $("#content31").hide();
		 $("#content3").children("a").removeClass("on2");
		 if($("#content21").is(":visible")){
		   $("#content21").hide();
		   $(this).children("a").removeClass("on2");
		}else{
		   $("#content21").show();
		   $(this).children("a").addClass("on2");
		}
	 });
	 $("#content3").click(function(){
		 $("#content11").hide();
		 $("#content1").children("a").removeClass("on2");
		 $("#content21").hide();
		 $("#content2").children("a").removeClass("on2");
		 if($("#content31").is(":visible")){
		   $("#content31").hide();
		   $(this).children("a").removeClass("on2");
		}else{
		   $("#content31").show();
		   $(this).children("a").addClass("on2");
		}
	 });
	 
//	 $(".tab_close").click(function(){
//		 alert('haha');
//		 $(".tabRightD").hide();
//		 $("#content1").children("a").removeClass("on2");
//		 $("#content2").children("a").removeClass("on2");
//     });
//	 
	 $(".historyBott").mouseover(function(){
		 $(".history").show();
	 }).mouseout(function(){
		 $(".history").hide();
	 });

//	 $(".sel").click(function(){
//		return confirm('确定删除？')?true:false; 
//	 })

	$('#first').click(function(){
		if($('#first').attr('checked')){
			$('#second').attr('checked','checked');
		}
	});
	
//	$('#part').blur(function(){
//
//	});
//	$('#one').click(function(){
//		var falg = 0;
//		var type = '';
//		$("input[name='type[]']:checkbox").each(function(){
//			if($(this).attr("checked")){
//				falg = 1;
//				return false;
//			}
//		});
//		if(falg==0){
//			alert('请选择会员类型');
//			return false;
//		}
//		if($('#code').val()=='' || $('#short').val()=='' || $('#name').val()==''){
//			alert('请完整输入会员代码，简称，以及名称');
//			return false;
//		}
//		$('#userone').submit();
//	});
	$('#short').blur(function(){
		if($('#mid').val()==''){
			if($('#short').val()!=''){
				$('#name').val($('#short').val());
			}
		}
	});

	$('#all').click(function(){
		var bool = $(this).attr("checked");
		$.each($(this).parent().siblings().find('input'),function(){
			$(this).attr("checked",bool);
		});	
	});
});
//ajax submit
// 	$('#one_ajax').click(function(){
// 		var falg = 0;
// 		var type = '';
// 		if($('#isoff').val()==1){
// 			$("input[name='type[]']:checkbox").each(function(){
// 				if($(this).attr("checked")){
// 					falg = 1;
// 					return false;
// 				}
// 			});
// 			if(falg==0){
// 				alert('请选择会员类型');
// 				return false;
// 			}
// 		}
// 		if($('#code').val()=='' || $('#short').val()=='' || $('#name').val()=='' || $('#area').val()=='' || $('#country').val()=='' || $('#state').val()=='' || $('#city').val()=='' || $('#add').val()==''){
// 			alert('请完整输入带*号数据');
// 			return false;
// 		}else{
// 			if($('input:checkbox[name=type[]][checked]').length>0){
// 				$('input:checkbox[name=type[]][checked]').each(function(){
// 					var val=$(this).val();  
// 					type = type+','+val;
// 	////                alert(val);
// 				});
// 			}
// //			var mbr_tag = $('input:radio[name=mbr[mbr_tag]][checked]').val();
// 			var dataStr = {'mbr_types':type+',',
// //				'mbr_tag':mbr_tag,
// 				'mbr_code':$('#code').val(),
// 				'mbr_short':$('#short').val(),
// 				'mbr_name':$('#name').val(),
// 				'mbr_area':$('#area').val(),
// 				'mbr_country':$('#country').val(),
// 				'mbr_state':$('#state').val(),
// 				'mbr_city':$('#city').val(),
// 				'mbr_add':$('#add').val(),
// 				'mbr_url':$('#url').val(),
// 				'mbr_zip':$('#zip').val(),
// 				'mbr_no':$('#no').val(),
// 				'mbr_com':$('#com').val(),
// 				'mbr_industry':$('#industry').val(),
// 				'mbr_bill':$('#bill').text(),
// 				'mbr_remark':$('#remark').text(),
// 				'mbr_id':$('#mid').val(),
// 				'mbr_source':$('#source').val()
// 			};
// 			$.ajax({
// 				type: "POST",
// 				url: "/admin/user/handle/mbrajaxsave",
// 				data: dataStr,
// 				success:function(a){
// 					if(a>3){
// 						$('#mid').val(a);
// 						$('ul li a').each(function(){
// 							if($(this).attr('id')==2){
// 								$(this).attr('href','addtwo.html');
// 							}
// 							if($(this).attr('id')==3){
// 								$(this).attr('href','addthree.html');
// 							}
// 							if($(this).attr('id')==4){
// 								$(this).attr('href','addfour.html');
// 							}
// 						});
// 						alert('保存成功');
// 					}else if(a==2){
// 						alert('非法数据');
// 					}else{
// 						alert('保存失败');
// 					}
// 				}
// 			});
// 		}
// 	});

// 联系人信息ajax提交
// 	$('#two_ajax').click(function(){
// 		var falg = 0;
// 		var type = '';
// 		var sex = $('input:radio:checked').val();
// 		if($("#isdefault").attr("checked")==true){
// 			var isdefault = 2;
// 		}else{
// 			var isdefault = 1;
// 		}
// 		if($('#linkname').val()==''){
// 			alert('请输入联系人姓名');
// 			return false;
// 		}else if($('#linkmobile').val()=='' && $('#linktel').val()==''){
// 			alert('手机，电话需选填一项！');
// 			return false;
// 		}else{
// 			var dataStr = {'link_name':$('#linkname').val(),
// 				'link_part':$('#linkpart').val(),
// 				'link_job':$('#linkjob').val(),
// 				'link_limit':$('#linklimit').val(),
// 				'link_up':$('#linkup').val(),
// 				'link_mobile':$('#linkmobile').val(),
// 				'link_tel':$('#linktel').val(),
// 				'link_fax':$('#linkfax').val(),
// 				'link_email':$('#linkemail').val(),
// 				'link_sex':sex,
// 				'is_default':isdefault,
// 				'id':$('#id').val()
// 			};
// 			$.ajax({
// 				type: "POST",
// 				url: "/admin/user/handle/linkajaxsave",
// 				data: dataStr,
// 				dataType:'json',
// //				error:function(XMLResponse){
// //					alert(XMLResponse.responseText);
// //					return false;
// //				},
// 				success:function(a){
// 					if(a==2){
// 						alert('非法数据');
// 					}else if(a==3){
// 						alert('保存失败');
// 					}else{
// 						var xb = (sex==1)?'男':'女';
// 						var de = (isdefault==2)?'√':'×';
// 						$('#sample3').find('tr').each(function(){
// 							if(a.isdefault==2){
// 								$(this).find('td').eq(10).text('×');
// 							}
// 						});
// 						if($('#id').val()){
// 							var theid = $('#tr'+a.id);
// 							theid.find('td').eq(0).text(a.linkname);
// 							theid.find('td').eq(1).text(a.linkpart);
// 							theid.find('td').eq(2).text(xb);
// 							theid.find('td').eq(3).text(a.linkjob);
// 							theid.find('td').eq(4).text(a.linklimit);
// 							theid.find('td').eq(5).text(a.linkup);
// 							theid.find('td').eq(6).text(a.linkmobile);
// 							theid.find('td').eq(7).text(a.linktel);
// 							theid.find('td').eq(8).text(a.linkfax);
// 							theid.find('td').eq(9).text(a.linkemail);
// 							theid.find('td').eq(10).text(de);
// 							alert('编辑成功');
// 						}else{
// 							var tr = "<tr id=tr"+a.id+">"+
// 									"<input type='hidden' value='"+a.id+"'>"+
// 									"<td>"+$('#linkname').val()+"</td>"+
// 									"<td>"+$('#linkpart').val()+"</td>"+
// 									"<td>"+xb+"</td>"+
// 									"<td>"+$('#linkjob').val()+"</td>"+
// 									"<td>"+$('#linklimit').val()+"</td>"+
// 									"<td>"+$('#linkup').val()+"</td>"+
// 									"<td>"+$('#linkmobile').val()+"</td>"+
// 									"<td>"+$('#linktel').val()+"</td>"+
// 									"<td>"+$('#linkfax').val()+"</td>"+
// 									"<td>"+$('#linkemail').val()+"</td>"+
// 									"<td>"+de+"</td>"+
// 								 "</tr>";
// 							$(tr).appendTo("#sample3");
// 							$.cookie('theaddid',a.id);
// 	//						alert($.cookie('theaddid'));
// 							$('#tr'+a.id).trigger('click');
// 							alert('保存成功');
// 						}
// 					}
// 				}
// 			});
// 		}
// 	});
// 财务信息ajax提交
// 	$('#three_ajax').click(function(){
// 		var falg = 0;
// 		var type = '';
// 		var isblack = $("input[name='mbr[mbr_isblack]']:checked").val();
// 		var limit = $("input[name='mbr[mbr_limit]']:checked").val();
// 		var dataStr = {'mbr_rating':$('#rating').val(),
// 			'mbr_expires':$('#expires').val(),
// 			'mbr_isblack':isblack,
// 			'mbr_limit':limit
// 		};
// 		$.ajax({
// 			type: "POST",
// 			url: "/admin/user/handle/fundajaxsave",
// 			data: dataStr,
// 			success:function(a){
// 				if(a==1){
// 					alert('保存成功');
// 				}else if(a==2){
// 					alert('非法数据');
// 				}else if(a==3){
// 					alert('保存失败');
// 				}else{
// 					alert('用户信息丢失,请重新选择');
// 				}
// 			}
// 		});
// 	});

// //所属业务员信息ajax提交
// 	$('#four_ajax').click(function(){
// 		var falg = 0;
// 		var type = '';
// 		var iswait = $('#iswait').val();
// 		if($("#isdefault").attr("checked")==true){
// 			var isdefault = 1;
// 		}else{
// 			var isdefault = 0;
// 		}
// 		var dataStr = {'belong_partId':$('#partid').val(),
// 			'belong_partName':$('#part').val(),
// 			'belong_staff':$('#staffid').val(),
// 			'belong_staffName':$('#staff').val(),
// 			'link_id':$('#link_id').val(),
// //			'link_name':$('#link').val(),
// 			'is_default':isdefault,
// 			'id':$('#id').val(),
// 			'iswait':iswait
// 		};
// 		if($('#part').val()=='' || $('#staff').val()==''){
// 			alert('请完整输入带*号数据');
// 		}else{
// 			$.ajax({
// 				type: "POST",
// 				url: "/admin/user/handle/staffajaxsave",
// 				data: dataStr,
// 				dataType:'json',
// 				error:function(XMLResponse){
// 					alert(XMLResponse.responseText);
// 					return false;
// 				},
// 				success:function(a){
// 					if(a==2){
// 						alert('非法数据');
// 					}else if(a==3){
// 						alert('保存失败');
// 					}else{
// 						var stafflink_tel = a.stafftel?a.stafftel+"&nbsp;/&nbsp;":'';
// 						var linklink_tel = a.linktel?a.linktel+"&nbsp;/&nbsp;":'';
// 						var isdefault = a.isdefault==1?'√':'×';
// 						$('#sample2').find('tr').each(function(){
// 							if(a.isdefault==1){
// 								$(this).find('td').eq(5).text('×');
// 							}
// 						});
// 						if($('#id').val()){
// 							var theid = $('#tr'+a.id);
// 							theid.find('td').eq(0).text(a.partname);
// 							theid.find('td').eq(1).text(a.staffname);
// 							theid.find('td').eq(2).html(stafflink_tel+a.staffmobile);
// 							theid.find('td').eq(3).text(a.linkname);
// 							theid.find('td').eq(4).html(linklink_tel+a.linkmobile);
// 							theid.find('td').eq(5).text(isdefault);
// 							alert('编辑成功');
// 						}else{
// 							var tr ="<tr id=tr"+a.id+">"+
// 									"<input type='hidden' value='"+a.id+"'>"+
// 									"<td>"+a.partname+"</td>"+
// 									"<td>"+a.staffname+"</td>"+
// 									"<td>"+stafflink_tel+a.staffmobile+"</td>"+
// 									"<td>"+a.linkname+"</td>"+
// 									"<td>"+linklink_tel+a.linkmobile+"</td>"+
// 									"<td>"+isdefault+"</td>"+
// 								 "</tr>";
// 							$(tr).appendTo("#sample2");
// 							if(iswait==1){
// 								alert('分配成功');
// 								history.go(-1);
// 							}else{
// 								alert('保存成功');
// 							}
// 						}
// 					}
// 				}
// 			});
// 		}
// 	});

//	$('.ul').find('a').each(function(){
//		$(this).click(function(){
//			alert($('#step').val());
////			var mid = $('#mid').val();
////			if(mid==''){
////				$(this).attr('class','on');
//////				alert($(this).attr('class'));
//////				if($(this).attr('id')!='ba'){
//////					$(this).removeClass('on');
//////				}
////			}
//		});
//	});
//
$(function() {
	if($("#rating").length>0){
		$("#rating").autocomplete(["A", "B", "C", "D", "E"], {
			width: 110,
			max: 5,
			highlight: false,
			multiple: false,
			multipleSeparator: "",
			scroll: true,
			scrollHeight: 300,
			mustMatch:true,
			autoFill:true 
		});
	}
	if($("#expires").length>0){
		$("#expires").autocomplete(["一个月", "二个月", "三个月"], {
			width: 110,
			max: 3,
			highlight: false,
			multiple: false,
			multipleSeparator: "",
			scroll: true,
			scrollHeight: 300,
			mustMatch:true
		});
	}
	if($('#part').length>0){
	var parts;
	var staffs;
	$.ajax({
		url:"/admin/user/handle/ajaxtest?type=part",
		dataType:'json',
		success:function(data){
			parts = data;
		},
		async:false
	});
		$("#part").autocomplete(parts, {
			width: 180,
			max: 10,
			minChars: 0,
			highlight: false,
			multiple: false,
			scroll: true,
			autoFill: false,
			scrollHeight: 300,
			mustMatch:false,
			matchCase: false,
			formatItem: function(row, i, max) {
				return row.part_name;
			},
			formatMatch: function(row, i, max) {
				return row.part_name;
			},
			formatResult: function(row) {
				return row.part_name;
			}
		}).result(function(e, item) {
			$('#partid').val(item.part_id);
			staffs = null;
			$.ajax({
				url:"/admin/user/handle/ajaxtest?type=staff&p="+item.part_id,
				dataType:'json',
				success:function(data){
					staffs = data;
				},
				async:false
			});
			$("#staff").autocomplete(staffs, {
				width: 180,
				max: 10,
				minChars: 0,
				highlight: false,
				multiple: false,
				scroll: true,
				autoFill: false,
				scrollHeight: 300,
				mustMatch:false,
				matchCase: false,
				formatItem: function(row, i, max) {
					return row.staff_name;
				},
				formatMatch: function(row, i, max) {
					return row.staff_name;
				},
				formatResult: function(row) {
					return row.staff_name;
				}
			}).result(function(e, item) {
				$('#staffid').val(item.staff_id);
			});
		});

	$('#part').change(function(){
		$('#staff').val('');
	});
	}
});



function tabclose(){
	$(".tabRightD").hide();
	$("#content1").children("a").removeClass("on2");
	$("#content2").children("a").removeClass("on2");
	$("#content3").children("a").removeClass("on2");
}

function sub(id){
	var off = $('#offline').val();
	if(id){
		$.ajax({
			type: "POST",
			url: "/admin/user/handle/sub",
			data:{'id':id,'off':off},
			success:function(data){
				if(data==1){
					window.location.href='/admin/user/handle/addone';
				}else{
					alert('无实际数据');
				}
			}
		});
	}
}

function submbr(id){
	var off = $('#offline').val();
	if(id){
		$.ajax({
			type: "POST",
			url: "/admin/user/mbr/sub",
			data:{'id':id,'off':off},
			success:function(data){
				if(data==1){
					window.location.href='/admin/user/mbr/addone';
				}else{
					alert('无实际数据');
				}
			}
		});
	}
}

function delmbr(id){
	var off = $('#offline').val();
	if(confirm('确认删除么？')){
		if(id){
			$.ajax({
				type: "POST",
				url: "/admin/user/mbr/del",
				data:{'id':id,'off':off},
				success:function(data){
					if(data==1){
						alert('删除成功！');
						$('#'+id).remove();
					}else{
						alert('删除失败！');
					}
				}
			});
		}
	}
}

function dis(){
	var mid = $('#mid').val();
	if(mid==''){
		$('.ul').find('a').each(function(){
			if($(this).attr('id')!='ba'){
				alert('请先输入基本信息');
				return false;
			}
		});
		location.reload();
	}
}

//锁定
function setblack(id)
{
	var is = $('#b'+id).val();
	var islock = (is==1)?2:1;
	var st = (is==1) ? '锁定' : '未锁定';
	var ac = (is==1) ? "解锁" : "锁定";
	var msg = (is==1) ? '锁定成功' : '解锁成功';
	var oldcss = (is==1) ? 'Blue' : 'red';
	var newcss = (is==1) ? 'red' : 'Blue';
	$.ajax({
	    type:"POST",
	    url:"/admin/user/handle/black",
	    data:{"id":id,"lock":islock},
	    error:function(XMLResponse){
		   	alert(XMLResponse.responseText);
	   		return false;
		},
		success:function(data){
		    if(data== 1){
				$('#b'+id).val(islock);
				$('#'+id).find('td').eq(7).text(st);
				$('#'+id).find('td').eq(12).find('a').eq(0).removeClass(oldcss);
				$('#'+id).find('td').eq(12).find('a').eq(0).addClass(newcss);
				$('#'+id).find('td').eq(12).find('a').eq(0).text(ac);
		   		alert(msg);
			}
		}
	});

}

function resetall(id){
	$('#'+id).find('input').each(function(){
//				if($(this).attr('type')=='hidden'){
//			alert($(this).val());
//		}
//		alert($(this).attr('type'));
		if($(this).attr('type')=='radio'){
			if($(this).attr('name')=="link[link_sex]" && $(this).attr('value')==1){
				$(this).attr('checked','checked');
			}
		}else if($(this).attr('type')=='checkbox'){
			$(this).attr('checked','');
		}else{
			$(this).val('');
		}
	});
	$("input[type='text']").each(function(){
		$(this).val('');
	});
}

	 $(".sel").click(function(){
		return confirm('确定删除？')?true:false; 
	 })
	 
	 

function filter(id)
{
	//alert(id);
    //var eLeft = $("+id+").offsetLeft;
	//var eLeft=$("#"+id).position().left-17;

	
	$('#son_list').show();
	$("#son_listR").css({"left":"70px","top":"5px"});
	
	if(id!="all_f"){
		$("#father_list").find('#all_f').removeClass("on");
		$("#father_list").find('a').removeClass("on2");
		$("#"+id).addClass("on2");
	}else{
		$("#father_list").find('a').removeClass("on2");
		$("#all_f").addClass("on");
	}

	if(id!="all_f"){
		$("#father_stu").val(id);
	}
	if(id=="booking"||id=="entrycut"||id=="packing"||id=="stor"){
		$("#unfinished").show();
		$("#complete").show();
		$("#running").hide();
		$("#overdate").hide();
		$("#warning").hide();
	}else if(id=="feesub"||id=="feecheck"||id=="signbill"){
		$("#unfinished").show();
		$("#complete").show();
		$("#running").show();
		$("#overdate").show();
		$("#warning").show();
	}else if(id=="all_f"){
		$('#son_list').hide();	
	}
	//alert($("#father_stu").val());
}

function filter_s(id)
{
	if(id!="all_s"&&id!="running"&&id!="overdate"&&id!="warning"){
		$("#son_stu").val(id);
	}
	if(id!="running"&&id!="overdate"&&id!="warning"){
	$("#son_list").find('a').removeClass("on");
	$("#"+id).addClass("on");
	}
	
	//alert($("#son_stu").val());
}
function source(id)
{
	if(id!="all_t"){
		$("#source_stu").val(id);
	}
	$("#source_list").find('a').removeClass("on");
	$("#"+id).addClass("on");
	
	
	//alert($("#son_stu").val());
}


function calculate(vd)
  {
	var ob=document.getElementById(vd);
	if(ob.style.display=="block" || ob.style.display=="")
	{
	   ob.style.display="none";
	}
	else
	{
	  ob.style.display="block";
	}
  }
  
$(function(){
	//input点击有颜色，移开物色
	$(".huibai").mouseover(function(){
		$(this).css("border","1px solid #dbdfe6");
    }).mouseout(function(){
	    $(this).css("border","1px solid #ffffff");
	});
	
	$('li').click(function(){
		var cul="";
		var cul=$(this).parent('ul[class]').attr('class');
		if(cul!="no_click" ){
			var cl = $(this).siblings().find('a[class]').attr('class');
			$(this).siblings().find('a').each(function(){
				$(this).removeClass(cl);
			});
			$(this).find('a').addClass(cl);
		}
	});
})

function seachDown(id)
{
	id_short= id.substring(0, 6);   // 取子字符串。     
	//$(".son_listR").css({"left":"70px","top":"5px"});
	
	$("#"+id_short+"_seach").find(".son_list").hide();          
	$("#"+id_short+"_seach").find("#"+id+"1").show();
	
	if($("#"+id+"1").size()>0){
		$("."+id_short+"_menu").find('a').removeClass("on");
		$("."+id_short+"_menu").find('a').removeClass("on2");
		$("#"+id).addClass("on2");
	}else{
		$("."+id_short+"_menu").find('a').removeClass("on");
		$("."+id_short+"_menu").find('a').removeClass("on2");
		$("#"+id).addClass("on");
	}
}

//发布运价弹出备注
$(function(){
   $("#btnShow").click(function(){
      $("#BgDiv").css({ display:"block",height:$(document).height()});
      var yscroll=document.documentElement.scrollTop;
      $("#DialogDiv").css("top","100px");
      $("#DialogDiv").css("display","block");
      document.documentElement.scrollTop=0;
   });
   
   $("#btnClose").click(function(){
      $("#BgDiv").css("display","none");
      $("#DialogDiv").css("display","none");
   });

    //添加意向会员验证
	var tel = /^(0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?$/;
	var qqtest = /^([1-9][0-9]{4})|([0-9]{6,10})$/;
	$("#regedit_xx :text").addClass("hui_lan");
	$("#regedit_xx :password").addClass("hui_lan");
	$('#regedit_xx :input').blur(function(){
		    var $parent = $(this).parent();
		    $parent.find(".formtips").remove();
			 
			 //验证邮件
			 if( $(this).is('#mail') ){
				$parent.find(".formtips").remove();
				if( this.value!="" && !/.+@.+\.[a-zA-Z]{2,4}$/.test(this.value)){
					  var errorMsg = '请输入正确的E-Mail地址';
					  onError(this);
					  $parent.append('<span class="formtips onError">'+errorMsg+'</span>');
				}else{
					onNo(this);
				}
			 }
			 
			 //企业名称
			 if( $(this).is('#name') ){
				 if( this.value==""){
					    var errorMsg = '请输入企业名称';
						onNone(this);
					    $parent.append('<span class="formtips onNone">'+errorMsg+'</span>');
					}else{
						if( this.value.length < 7){
							var errorMsg = '企业名称长度不能少于7位';
							onNone(this);
							$parent.append('<span class="formtips onNone">'+errorMsg+'</span>');
						}else{
							if(!/^[\u4e00-\u9fa5]+$/.test(this.value)){
								var errorMsg = '企业名称只能为中文';
						        onError(this);
						        $parent.append('<span class="formtips onError">'+errorMsg+'</span>');
							}else{
						        onSuccess(this);
							}	
						}
					}
			 }
			 //个体户名称
			 if( $(this).is('#name1') ){
				 if( this.value==""){
					    var errorMsg = '请输入个体户名称';
						onNone(this);
					    $parent.append('<span class="formtips onNone">'+errorMsg+'</span>');
					}else{
						//if( this.value.length < 7){
//							var errorMsg = '个体户名称长度不能少于7位';
//							onError(this);
//							$parent.append('<span class="formtips onNone">'+errorMsg+'</span>');
//						}else{
//							if( this.value!=/^[\u4e00-\u9fa5]+$/.test(this.value)){
//								var errorMsg = '个体户名称只能为中文';
//						        onError(this);
//						        $parent.append('<span class="formtips onError">'+errorMsg+'</span>');
//							}else{
						        onSuccess(this);
							//}	
//						}
					}
			 }
			 //联系人姓名
			 if( $(this).is('#linkman') ){
				 if( this.value==""){
					    var errorMsg = '请输入联系人姓名';
						onNone(this);
					    $parent.append('<span class="formtips onNone">'+errorMsg+'</span>');
					}else{
						if(/([0-9a-zA-Z])\1{5,}/.test(this.value)){
							var errorMsg = '联系人姓名不能出现连续5个以上的数字或英文';
							onError(this);
							$parent.append('<span class="formtips onError">'+errorMsg+'</span>');
						}else{
							onSuccess(this);
						}
					}
			 }
			 //手机号码
			 if( $(this).is('#mobile')){
				 $parent.find(".formtips").remove();
//				 if(this.value=="" && $('#dtel2').val()==""){
				 if(this.value==""){
//					 var errorMsg = '手机，固话请填写一项';
					 var errorMsg = '请填写手机号码';
					 onNone(this);
				     $(this).parent().append('<span class="formtips onNone">'+errorMsg+'</span>');
				 }else{
						if( this.value.length != 11){
							var errorMsg = '手机号码位数不正确';
							onError(this);
							$parent.append('<span class="formtips onError">'+errorMsg+'</span>');
						}else{
							if(!/^(13|14|15|18)[0-9]{9}$/.test(this.value)){
								var errorMsg = '手机号码不合乎规则';
								onError(this);
								$parent.append('<span class="formtips onError">'+errorMsg+'</span>');
							}else{
								/* $.ajax({
										type:"post",
										url:"/front/member/handle/checkmobile",
										data:{"mobile":$(this).val()},
										success:function(data){
											if(data==1){
												var errorMsg = '该手机已注册，请重新输入';
												onError(this);
												$parent.append('<span class="formtips onError">'+errorMsg+'</span>');
											}else{*/
												onSuccess('#mobile');
											/*}
										}
								 });*/
							}
					    }
				 }
			 }
		}).keyup(function(){
		   $(this).triggerHandler("blur");
		}).focus(function(){
	  	   $(this).triggerHandler("blur");
		});//end blur
		
		$('#dtel1,#dtel2').blur(function(){
		    var $parent = $(this).parent();
			$parent.find(".formtips").remove();
			if($('#dtel1').val()==''){
				onNo('#dtel1');
				if($('#dtel2').val()==''){
					onNo('#dtel2');
				}else{
					var errorMsg = '请输入区号';
					onError(this);
					$(this).parent().append('<span class="formtips onError">'+errorMsg+'</span>');
				}
			}else{
				if($('#dtel2').val()==''){
					var errorMsg = '请输入固定电话';
					onNone('#dtel2');
					$(this).parent().append('<span class="formtips onNone">'+errorMsg+'</span>');	
				}else{
					var dtel = $('#dtel1').val()+'-'+$('#dtel2').val();
					if(!tel.test(dtel)){
						var errorMsg = '固定电话格式不正确，请重新输入';
						onError(this);
						$(this).parent().append('<span class="formtips onError">'+errorMsg+'</span>');
					}else{
						onNo('#dtel1');
						onNo('#dtel2');
					}
				}
			}
		});
		
		$('#qq').focus(function(){
			if(this.value==''){
				onNo(this);
			}
		});
		$('#qq').blur(function(){
			var $parent = $(this).parent();
			$parent.find(".formtips").remove();
			if(this.value==''){
				onNo(this);
			}else{
				if(!qqtest.test(this.value)){
					var errorMsg = "QQ号码非法";
					onError(this);
					$(this).parent().append('<span class="formtips onError">'+errorMsg+'</span>');
				}else{
					onNo(this);
				}
			}
		});
		$('#Add').focus(function(){onNone(this);});
		$('#Add').blur(function(){onNo(this);});

		
		
	//提交，最终验证。
	$('#send').click(function(){
		var radio = $("input:radio[name='info[info_eptype]']:checked").val();
		$("form :input").trigger('blur');
		var numError = $('form .onError').length;
		var numNone = $('form .onNone').length;
		var i = 0;
		var j = 0;
		if(radio=='3'){
			$("form :input").each(function(){
				if($(this).is('#mail,#linkman,#mobile,#dtel1,#qq,#Add')){
					var $parent = $(this).parent();
					var is = $parent.find("span").attr('class');
					if(is=='formtips onNone'){
						i++;
					}
					if(is=='formtips onError'){
						j++;
					}
				}
			});
			if(j>0){
				alert('请检查错误');
				return false;
			}else if(i>0){
				alert('请完成所有必填项');
				return false;
			}else{
				alert("添加成功");
			}
		}else{
			$("form :input").each(function(){
				if($(this).is('#mail,#name,#linkman,#mobile,#dtel1,#qq,#Add')){
					var $parent = $(this).parent();
					var is = $parent.find("span").attr('class');
					if(is=='formtips onNone'){
						i++;
					}
					if(is=='formtips onError'){
						j++;
					}
				}
			});
			if(j>0){
				alert('请检查错误');
				return false;
			}else if(i>0){
				alert('请完成所有必填项');
				return false;
			}else{
				alert("添加成功");
			}
		}
	 });
	 
	 $('#addGankou').click(function() {
		var topload=$('#topload').val();
		var topunload=$('#topunload').val();
		ch_num=$(".menber_regeditHanxian2").children("ul").length;
		if(topload==""){
			$(".Qm_Add").remove();
			var toploadname = '请添加起运港';
			$("#addGankou").parent().parent().append('<div class="Qm_Add position_ab">'+toploadname+'</div>');
		}else{
			if(topunload==""){
				$(".Qm_Add").remove();
				var topunloadname = '请添加目的港';
				$("#addGankou").parent().parent().append('<div class="Qm_Add position_ab">'+topunloadname+'</div>');
			}else{		
				if(ch_num==0){
				   $(".Qm_Add").remove();
				   nid=1
				}else if(ch_num>0 && ch_num<=4){
				   $(".Qm_Add").remove();
				   nid=ch_num+1
				}
				else{
					$(".Qm_Add").remove();
					var errorMsg = '最多添加5个';
					$("#addGankou").parent().parent().append('<div class="Qm_Add position_ab">'+errorMsg+'</div>');
					return false;
				}
			   var ul = " <ul class='menHx"+nid+"'>"+
				"<li>"+topload+"→"+topunload+"</li>"+
				"<li><a href='javascript:void(0);' class='lan' onclick='cdel("+nid+")'><img src='images/zhuce_rightDel.jpg' width='22' height='20' /></a></li>"+
				"</ul>";
			   $(ul).appendTo(".menber_regeditHanxian2");
			}
		}
	});

});
//function document.onkeydown(){
//	if(event.keyCode==13)
//	event.keyCode=9;
//}