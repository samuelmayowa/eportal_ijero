<?php
include_once('../../functions.php');
require_once('../../connection.php');

?>
<!DOCTYPE html>
<html>
<head>
<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getStaffs.php?q="+str,true);
  xmlhttp.send();
}
</script>
</head>
<body>

<form>
<select name="users" onchange="showUser(this.value)">
<option value="">Select  Dept Code:</option>
<?php 
                                // Fetch Department
                                                $dc="";
                                                $sql_department = "SELECT ID, DeptID FROM Departments";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    $id = $row['ID'];
                                                    $_SESSION['dptId'] = $id;
                                                    $deptCode = $row['DeptID'];
                                                   
                                                    //$cU = $row['CourseUnits'];
                                                     $dc .="<option value='$id'>$deptCode</option>";
                                                      /*$_SESSION['deptCode'] = $deptCode;
                                                      */ 
                                                  }
                                                    // Option
                                                   
                                            echo $dc;
                                                ?>
</select>
</form>
<br>
<div id="txtHint"><b>Staff Details will be listed here.</b></div>

</body>
</html>
