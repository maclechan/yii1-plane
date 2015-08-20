window.onload=function(){
	$(".g-load").hide();
	$(".g-body").show();
}
$("#sub-btn").click(function(){
	var oname=$("#name").val();
	var otel=$("#tel").val();
	var oaddr=$("#addr").val();
	var omsgg=$("#msgg").val();
	var regexp = /((\(\d{3}\))|(\d{3}\-))?13[0-9]\d{8}|15[0-9]\d{8}|18[0-9]\d{8}/g;
	if(oname == "" || otel == "" || oaddr == ""){
		alert("联系人、手机号和地址为必填项");
		return false;
	}
	if(!regexp.test(otel) || otel.length > 11){
		alert('输入正确的手机号');
		return false;
	}	

	$("#ordername").val(oname);
	$("#ordertel").val(otel);
	$("#orderaddr").val(oaddr);
	$("#ordermsgg").val(omsgg);
});