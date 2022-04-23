<?php
include_once('../functions.php');
require_once('../connection.php');
$st="";
  confirmLogin();
$_SESSION['rol']=$_GET['msg'];
    //prepare Data

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ile, Abiye" />
        <meta name="author" content="" />
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
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
    <body class="sb-nav-fixed">
         <?php include('topbar.php'); ?>
       <?php if(empty($email) && empty($gender)){
     header('location:staffProfile.php?msg='.$id);
 } ?>
        <?php include ('sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Staff Privileges Assignment Panel</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="#" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Staff Code</label> <span style="color:red; font-size:9px;">&nbsp; &nbsp; (* Select The Lectureer You Want TO Assign Course To*)</span>
                                                        <select class="form-control py-4"  name="users" onchange="showUser(this.value)" size="1">
                                                        <option value="0">Select  Staff Code:</option>
                                                            <?php 
                                                        // Fetch Department
                                                                    $dc="";
                                                                    // $sql_department = "SELECT ID, DeptID, FacID FROM Departments";
                                                                    // $department_data = mysqli_query($con,$sql_department);
                                                                    // while($row = mysqli_fetch_assoc($department_data) ){
                                                                    //     $id = $row['ID'];
                                                                    //     $_SESSION['dptId'] = $id;
                                                                    //     $facId= $row['FacID'];
                                                                    //     $deptCode = $row['DeptID'];
                                                                       $sql_department = "SELECT * FROM Staffs";
                                                                    $department_data = mysqli_query($con,$sql_department);
                                                                    while($row = mysqli_fetch_assoc($department_data) ){
                                                                        $id = $row['ID'];
                                                                        $_SESSION['id'] = $id;
                                                                        $fn= $row['FirstName'];
                                                                         $sn= $row['Surname'];
                                                                        $deptCode = $row['StaffCode'];
                                                                        //$cU = $row['CourseUnits'];
                                                                         $dc .="<option value='$id'>$deptCode ( $fn  $sn )</option>";
                                                                          /*$_SESSION['deptCode'] = $deptCode;
                                                                          */ 
                                                                      }
                                                                        // Option
                                                                       
                                                                echo $dc;
                                                                    ?>
                                                                    </select>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter Matric Number" name="matricID" required  Value="<?php if(isset($staffID)){ echo $staffID; }  ?>" />-->
                                                    </div>
                                                </div>
                                                
                                               </div>
                                          <div class="form-group mt-4 mb-0" id="txtHint"><b>Staff Details will be listed here.</b></div>
                                            <!--<div class="form-group mt-4 mb-0"><button type="submit" name="getLectureer" class="btn btn-primary btn-block">Find Lectureer Now</div>-->
                                             </div>
                                        </form>
                                    </div>
                                   
                </main>
                   <?php include('footer.php'); ?>