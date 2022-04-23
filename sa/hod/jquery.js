 $(document).ready(function(){
	$('#StaffID').on('change', function(){
	var course_Id=$('#StaffID').val();
	$.ajax({
	method:"POST", 
	url:"getStfCodes.php",
	data:{ID:course_Id},
	dataType:"html",
	success:function(data){
	 $("#username").html(data);
	}
	});
});


$('#CourseCode').on('change', function(){
	var course_Units=$('#CourseCode').val();
	$.ajax({
	method:"POST", 
	url:"getStfCodes.php",
	data:{CourseTitleID:course_Units},
	dataType:"html",
	success:function(data){
	 $("#courseUnits").html(data);
	}
	});
});

});
