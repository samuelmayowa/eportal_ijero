 $(document).ready(function(){
	$('#payType').on('change', function(){
	var pay_Id=$('#payType').val();
	$.ajax({
	method:"POST", 
	url:"getFees.php",
	data:{PayType:pay_Id},
	dataType:"html",
	success:function(data){
	 $("#fees").html(data);
	}
	});
});

$('#paymode').on('change', function(){
	var pay_m = $('#paymode').val();
	var MatricNumber = $('#MatricNumber').val();
	var payID = $('#payType').val();
	
	$.ajax({
    	method:"POST", 
    	url:"getFees.php",
    	data:{PayType:pay_m, MatricNumber: MatricNumber, payID: payID},
    	//dataType:"html",
    	success:function(data){
    	 
    	 if(data == 0){
    	      $("#payments_submit").prop('disabled', true);
    	      $("#info").html('Congrats! You are cleared for the session');
    	 }else{
    	      $("#payments_submit").prop('disabled', false);
    	      $("#info").html('');
    	 }
    	 $("#amount_to_pay").val(data);
    	}
	});
});




		$('#CourseCode').on('change', function(){
	var course_Units=$('#CourseCode').val();
	$.ajax({
	method:"POST", 
	url:"getPay.php",
	data:{CourseTitleID:course_Units},
	dataType:"html",
	success:function(data){
	 $("#courseUnits").html(data);
	}
	});
});

});
