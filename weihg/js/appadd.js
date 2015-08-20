$(function(){
	var loads;
	var unloads;
	var carriers;
//	var countrys = new Map();
	//------商家自动提示
	$('#shangjia').autocomplete('/admin/app/handle/ajaxloadsj',{
			width: 150,
			max: 10,
			minChars: 0,
			highlight: false,
			multiple: false,
			scroll: true,
			autoFill: false,
			scrollHeight: 300,
			mustMatch:false,
			matchCase: false,
			dataType:'json',
			parse: function(data) {
				return $.map(data, function(row) {
					return {
						data: row,
						value: row.name,
						result: row.name
					}
				});
			 },
			formatItem: function(row, i, max) {
				return row.name;
			},
			formatMatch: function(row, i, max) {
				return row.name;
			},
			formatResult: function(row) {
				return row.name;
			}				
	}).result(function(e, item) {
		$('#shangjia').val(item.id);
	});
	//------提交
	$('#add').click(function(){
		var type = $("input[name='type']:checked").val();
		var tpl = $("input[name='teplate']:checked").val();
		//alert(type);
		var name = $('#name').val(); //接口名称
		var shangjia = $('#shangjia').val();
		var options = '';
		var cid = '';
		var where = '';
		var id = $('#aid').val();
		if(id == ''){
			var tourl = 'appadd'; //增加
		}else{
			var tourl = 'appupdate'; //更新
		}
		$('input[name=options[]]').each(function(){
			if($(this).attr('checked')==true){
				options += $(this).val()+',';
			}
		});
		$('input[name=cid[]]').each(function(){
			if($(this).attr('checked')==true){
				cid += $(this).val()+',';
			}
		});		
		var startdate = $('#startdate').val();
		var enddate = $('#enddate').val();
		var width = $('#width').val();
		var height = $('#height').val();
		$('input[name=where[]]').each(function(){
			if($(this).attr('checked')==true){
				where += $(this).val()+',';
			}
		});			

		if(type == 3){
			//针对商家的
			if(name=='' || shangjia=='' || options=='' || width=='' || height==''){
				alert('*号为必填项，请输入完整！');
				return false;
			}
		}else{
			//针对类别的
			if(name=='' || cid=='' || options=='' || width=='' || height==''){
				alert('*号为必填项，请输入完整！');
				return false;
			}		
		}
		$.ajax({
			type: "POST",
			url: "/admin/app/handle/"+tourl,
			data: {'type':type,'name':name,'shangjia':shangjia,'options':options,'cid':cid,'width':width,'height':height,'startdate':startdate,'enddate':enddate,'where':where,'id':id,'tpl':tpl},
			error:function(XMLResponse){
				alert(XMLResponse.responseText);
				return false;
			},
			success:function(a){
				if(a.indexOf("pp") > 0){
				//	alert('保存成功');
					document.getElementById('api').style.display='block';
					var host = document.domain;
					document.getElementById('apicode').innerHTML = '&lt;script type="text/javascript" src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js"&gt;&lt;/script&gt;&lt;script type="text/javascript" src="http://'+host+'/app/'+a+'"&gt;&lt;/script&gt;';//&lt;script type="text/javascript" src="http://'+host+'/js/jquery.min.js"&gt;&lt;/script&gt;
				}else if(a==2){
					alert('保存失败');
				}else if(a==3){
					alert('接口名称已存在');
				}else{
					alert('数据丢失');
				}
			}
		});	
	});
});

function Map(){
 this.keys = new Array();
 this.datas = new Array();

 
 this.put = function(key,value){
  if(this.datas[key] == null){
   this.keys.push(value);
  }
  this.datas[key] = value;
 };

 
 this.get = function(key){
  return this.datas[key];
 };

 
 this.remove = function(key){
  this.keys.remove(key);
  this.datas[key] = null;
 };

 
 this.isEmpty = function(){
  return this.keys.length == 0;
 };

 
 this.size = function(){
  return this.keys.length;
 };
}
function showlast(obj){
	$(obj).click(function(){
		var type = $(obj).attr('id');
//		alert(type);
//		return false;
		var html = '';
		$.ajax({
			type: "POST",
			url: "/front/sea/handle/ajaxlast",
			data: {'type':type},
			dataType:'json',
			error:function(XMLResponse){
				alert(XMLResponse.responseText);
				return false;
			},
			success:function(data){
				for(var i=0;i<data.length;i++){
					if(type=='line'){
						html +="<div><a href='javascript:void(0);' id="+type+"_"+data[i].id+">"+data[i].cn+"</a></div>";
					}else if(type=='port'){
					
					}else{
						html +="<div><a href='javascript:void(0);' id="+type+"_"+data[i].id+">"+data[i].esn+"</a></div>";
					}
//					html +="<li><a href='javascript:void(0);' id="+data[i].id+">"+data[i].out+"</a></li>";
				}
				$('#'+type).parent().remove();
				$(html).appendTo('#'+type+'_div');
				$('#'+type+'_all').addClass('on');
				var sxlist = new Array();
				$("dt div").each(function (i, items){
					sxlist[i] = $(items);

					$(sxlist[i]).click(function(){
						$(this).siblings().find('a').removeClass("on");
						$(this).find('a').addClass("on");
//						$(this).find('a').attr('id');
					});
				});
				$('dt').find('div').find('a').each(function(){
					
						$(this).click(function(){
							var arr = $(this).attr('id').split('_');
							if(arr[1]!=undefined){
								location.href="/front/sea/handle/index/type/"+arr[0]+"/typeid/"+arr[1];
							}
						});
				});
//				$('dt').find('div').find('a').each(function(){
//					
//			//		if(typeof($(this).attr('id').split('-'))=='array'){
//						$(this).click(function(){
//			//				alert($(this).attr('id').split('_'));
//							var arr = $(this).attr('id').split('_');
//			//				alert(arr[1]);return false;
//							if(arr[1]!=undefined){
//								$()
//			//					alert($(this).attr('id'));
//							}
//						});
//			//		}
//				});
			}
		});	
	});
}