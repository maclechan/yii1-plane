requirejs.config({
    baseUrl: '/js/crop/',
    paths: {
        jquery:'jquery-1.10.2.min',
        imgareaselect:'jquery.imgareaselect.min',
        uploadify:'jquery.uploadify.min'
    },
    shim:{
        'imgareaselect':['jquery'],
        'uploadify':['jquery']
    }
});
var requireApp = ["jquery","imgareaselect","uploadify"];
//JSON检测
if(  typeof JSON === 'undefined' ){
    requireApp.push('json2');
}

//调用依赖
require(requireApp, function($) {
    var $ = $.noConflict();
    var $field = $("input[type='file']");
    //Uploadify上传插件初始化
   //$("#init").click(function(e){
       // e.preventDefault();
        //$(this).remove();
       // $("#upload-wrap").show();
	$(function(e){
        //e.preventDefault();
        $field.uploadify({
             'buttonText': '上传图片'
            ,'swf': '/js/crop/uploadify.swf?v=' + ( parseInt(Math.random()*1000) )
            ,'uploader'  : "/admin/guwen/handle/guwensave"
            ,'auto'      : false    
            ,'multi'     : false   
            ,'method'    : 'post'
            ,'fileObjName' : 'upload'
            ,'queueSizeLimit' : 1
            ,'fileSizeLimit' : '2000KB'
            ,'fileTypeExts': '*.gif; *.jpg; *.png; *.jpeg'
            ,'fileTypeDesc': '只允许.gif .jpg .png .jpeg 图片！' 
            ,'onSelect': function(file) {//选择文件后的触发事件
                //$("#upload").show();  
				//修改为选择图片后自动上传
				$field.uploadify('upload','*')
            }
            ,'onUploadSuccess' : function(file, data, response){  //上传成功后的触发事件
                $field.uploadify('disable', true);
                //$("#upload").remove();
                var rst =JSON.parse(data);
                //document.write(rst.data.path);
                if( rst.status == 0 ){
                    alert('上传失败:'+rst.info);
                }else{
                    var imageData = rst.data;
                    var $image = $("<img src='"+imageData.path+"' id='image-uploaded' data-width='"+imageData.width+"' data-height='"+imageData.height+"' data-name='"+imageData.name+"' />");
                    $("#uploaded-wrap").append( $image ).show();
                    $("#ratio-wrap").show();
                    //$image.bind('click',function(e){
                     //   e.preventDefault();
                     //   alert('请先设置裁剪宽高比例！');
                   // });

                }
            }
            ,'onUploadError' : function(file, errorCode, errorMsg, errorString){
                alert('进入失败');
                alert(errorString);
            }
        });
    });

    //点击上传   
    //$("#upload").click(function(e){
    //    e.preventDefault();
    //    $field.uploadify('upload','*');
   // });
   //注释以上代码,不用点击接钮上传,让其选择图片后自动上传

    //点击裁剪初始化时
    $("#cutInit").click(function(e){
        e.preventDefault();
        //确定裁剪宽高比
        var ratio = parseFloat($("#ratio").val());
        if( isNaN(ratio) ){
            alert("请输入正确的宽高比，必须为数字，例如0.6或1.3");
            return ;
        }

        //相关元素
        var $uploaded = $("#image-uploaded"),
            $previewWrap = $("#cut-preview-wrap"),
            $preview = $("#cut-preview");

        //图片宽高参数
        var realWidth = $uploaded.data('width'),
            realHeight = $uploaded.data('height'),
            uploadedWidth = $uploaded.outerWidth(),
            uploadedHeight = $uploaded.outerHeight(),
            uploadedRate = uploadedWidth/realWidth; //缩放比例

        
        //其他操作
        $(this).hide();
        $("#ratio-input").hide();
        $("#cut-help").html('原图宽:'+realWidth+' 高:'+realHeight+'<strong style="color:red;"> 在图片上进行拖拽确定裁剪区域！</strong>');
        $("#preview-wrap").show();
        $uploaded.unbind('click');

        //预览框宽高参数
        var previewWrapWidth = $previewWrap.outerWidth();
            previewWrapHeight = Math.round(previewWrapWidth/ratio);

        //初始化预览框
        $previewWrap.css( {
            width:previewWrapWidth+'px',
            height:previewWrapHeight+'px'
        } );

        //初始化预览图
        $preview.prop( 'src',$uploaded.attr('src') );


        //构造AreaSelect选择器
		$(document).ready(function () {
			var imgArea = $uploaded.imgAreaSelect({
				x1: 0, y1: 0, x2: 200, y2: 200,
				instance: true,  
				handles: true,   
				fadeSpeed: 300,
				aspectRatio:'1:'+(1/ratio),
				onSelectChange: function(img,selection){//选区改变时的触发事件
					//selection包括x1,y1,x2,y2,width,height，分别为选区的偏移和高宽。
					//console.log(selection);

					var rate = previewWrapWidth/selection.width;//预览区相对于选择区的倍数
					$preview.css({
						width: Math.round(uploadedWidth*rate)+'px',
						height: Math.round(uploadedHeight*rate)+'px',
						"left": Math.round(selection.x1*rate*-1),
						"top": Math.round(selection.y1*rate*-1) 
					});

					//换算后的真实参数
					var realSize = {
						width:     Math.round(selection.width/uploadedRate),
						height:    Math.round(selection.height/uploadedRate),
						offsetLeft:Math.round(selection.x1/uploadedRate),
						offsetTop: Math.round(selection.y1/uploadedRate)
					}

					$("#log").text('实际裁剪参数 - 宽:'+realSize.width+
									' 高:'+realSize.height
									//' 左偏移:'+realSize.offsetLeft+
									//' 上偏移:'+realSize.offsetTop
								);

					$preview.data( realSize );

				}
			});
		});

        //点击确认裁剪时
        $("#cut").show().click(function(e){
            e.preventDefault();
            var $this = $(this);
            var data = $preview.data();
            if( typeof data['width'] === 'undefined' ||
                data['width'] == ''||
                data['width'] == 0 ||
                data['height'] == '' ||
                data['height'] == 0 ){
                    alert('请先选择裁剪区域！');
                    return ;
            }

            $this.addClass('active').text('裁剪中...');
            data['name'] = $uploaded.data('name');
            $.ajax({
                url:'/admin/guwen/handle/guwencut',
                type:'POST',
                data:data,
                success: function(data){
                    //console.log(data);
                    var rst = JSON.parse(data);
                    if( rst.status == 0 ){
                        alert('失败!'+rst.info);
                    }else{
                        $this.hide();
                        $('#cutone').hide();
                        $("#download").show().prop('href',rst.url).prop('target','_blank');
                        $("#cuted-wrap").show();
                        $("#image-cuted").prop('src',rst.path);
                        $("#hide-cuted").prop('value',rst.path);
                        $("#image-cutshow").prop('src',rst.path);
                        //imgArea.setOptions({'disable':true,'hide':true});//去掉选区功能
                        var imgArea = $uploaded.imgAreaSelect({hide:true,disable:true});
                    }
                }
                 
            });
        });

    });
});

