 
    $(document).ready(function(){
       $("#search").keyup(function(){
          var query = $(this).val();
          if (query != "") {
            $.ajax({
              url: 'getStaffCodes.php',
              method: 'POST',
              data: {query:query},
              success: function(data){
 
                $('#getSt').html(data);
                $('#getSt').css('display', 'block');
 
                $("#search").focusout(function(){
                    $('#getSt').css('display', 'none');
                });
                $("#search").focusin(function(){
                    $('#getSt').css('display', 'block');
                });
              }
            });
          } else {
          $('#getSt').css('display', 'none');
        }
      });
    });
 