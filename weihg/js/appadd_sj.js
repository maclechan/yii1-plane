$(function(){
	//------提交
	$('#add').click(function(){
		var tpl = $("input[name='teplate']:checked").val();
		var name = $('#name').val(); //接口名称
		var options = '';
		var where = '';
		var id = $('#aid').val();
		if(id == ''){
			var tourl = 'sjappadd'; //增加
		}else{
			var tourl = 'sjappupdate'; //更新
		}
		$('input[name=options[]]').each(function(){
			if($(this).attr('checked')==true){
				options += $(this).val()+',';
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

		if(name=='' || options=='' || width=='' || height==''){
			alert('*号为必填项，请输入完整！');
			return false;
		}		
		$.ajax({
			type: "POST",
			url: "/admin/app/sjenroll/"+tourl,
			data: {'name':name,'options':options,'width':width,'height':height,'startdate':startdate,'enddate':enddate,'where':where,'id':id,'tpl':tpl},
			error:function(XMLResponse){
				alert(XMLResponse.responseText);
				return false;
			},
			success:function(a){
				if(a.indexOf("pp") > 0){
				//	alert('保存成功');
					document.getElementById('api').style.display='block';
					var host = document.domain;
					document.getElementById('apicode').innerHTML = '&lt;script type="text/javascript" src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js"&gt;&lt;/script&gt;&lt;script type="text/javascript" src="http://'+host+'/appsj/'+a+'"&gt;&lt;/script&gt;';//&lt;script type="text/javascript" src="http://'+host+'/js/jquery.min.js"&gt;&lt;/script&gt;
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