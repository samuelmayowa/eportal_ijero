 $(document).ready(function(){
	$('#payType').on('change', function(){
	var pay_Id=$('#payType').val();
	$.ajax({
	method:"POST", 
	url:"getFeesID.php",
	data:{PayType:pay_Id},
	dataType:"html",
	success:function(data){
	 $("#fid").html(data);
	}
	});
});


});
