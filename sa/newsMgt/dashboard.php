<?php
include_once('../../functions.php');
require_once('../../connection.php');

  confirmLogin();
$fid="";
    //prepare Data
if(isset($_POST['addStaff'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $stTitle = $screenData['title'];
     $staffCode= $screenData['staffCode'];
     $fname= $screenData['fname'];
     $lname= $screenData['lname'];
      $jobs= $screenData['jobs'];
     $desig= $screenData['desig'];
     $deptCode= $screenData['deptCode'];
     $phno= $screenData['phno'];
     $psw= $screenData['password'];
     $pswd=sha1($psw);

    $data = mysqli_query($con,"SELECT * from Departments where ID ='$deptCode'");
   $fetchdata = mysqli_fetch_assoc($data);
    $fid=$fetchdata["FacID"];
      //echo $msg = "<script> alert('$fid'); </script>";
    
 // ======= check Staff Already Exist  =====
        
        $query = "SELECT ID, StaffCode FROM Staffs WHERE StaffCode ='$staffCode'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 
        $data=mysqli_fetch_assoc($query);
        $id=$data["ID"];

            if($CCode >= 1){
                $msg = "<script> alert('Staff Already Added'); </script>";
                //===============
               
                       $addstaff = mysqli_query($con,"UPDATE Staffs SET StaffCode='$staffCode', Title='$stTitle', FirstName='$fname', 
        	Surname='$lname', Designation='$desig', Job_Role='$jobs',PhoneNumber='$phno', DeptID='$deptCode', FacID='$fid',password='$pswd' WHERE ID='$id'");
                   $msg="Unable to Add Staf Member".mysqli_error($con);
                   if(!$addstaff){
            //echo "<script> alert('Error In Query'); </script>".mysqli_error($con);
            $msg="Unable to Update Staf Member Record ".mysqli_error($con);
        }
        else { // Add A staff
                       
                            $msg="1 Staff Member Updated Successfully";
                       
                   }
               }
                
                
                
                //=====================
     else {
   

//Append Staff

 $addstaff = "INSERT INTO Staffs (StaffCode, Title, FirstName, 
        	Surname, Designation, Job_Role,PhoneNumber, DeptID, FacID,password) 
 VALUES ('$staffCode', '$stTitle', '$fname', '$lname',
         '$desig', '$jobs','$phno','$deptCode','$fid','$pswd')";
         
       
        // ======= check Staff Already Added =====
        
        
        $query = "SELECT  	StaffCode FROM Staffs WHERE  	StaffCode ='$staffCode'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 

        $ci="";
        $ci3="";
            if($CCode != 1){
        // ========End check ====== 
        
        $addCourse = mysqli_query($con,$addstaff) or die(mysqli_error($con));
        if(!$addCourse){
            //echo "<script> alert('Error In Query'); </script>".mysqli_error($con);
            $msg="Unable to Add Staf Member".mysqli_error($con);
        }
        else { // Add A staff
                       
                            $msg="1 Staff Member Added Successfully";
                       
                   }
                   }
                   else{
                   $msg="Unable to Add Staf Member".mysqli_error($con);
               }
               
               }
               
}
            


?>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero-Ekiti" />
        <meta name="author" content="" />
        <title>Eportal-Staff Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../../images/logo-eschsti.png"/>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
       <?php include('topbar.php'); ?>
       <?php if(empty($email) && empty($gender)){
     header('location:../staffProfile.php?msg='.$id);
 } ?>
        <?php include ('../sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Portal News / Notifications Management Dashboard </h3></div>
                                  
                                   <div class="card-body">
                                <div class="table-responsive">
                
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-4 mb-0"><a  href="addNews.php" name="printCourseForm" class="btn btn-primary btn-block" >Add Portal  News</a></div>
                                        </div>
                                        <div class="col-md-6">        
                                            <div class="mt-4 mb-0"><a href="getNews.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Edit Portal News</button></a></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-4 mb-0"><a  href="dashboard.php?msg=<?php echo $_GET['msg']; ?>" name="printCourseForm" class="btn btn-primary btn-block" >Delete Portal  News</a></div>
                                        </div>
                                        <div class="col-md-6">        
                                            <div class="mt-4 mb-0"><a href="dashboard.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Suspend Portal News</button></a></div>
                                        </div>
                                    </div>
                                                
                                                
                                    
                                </div>

                            </div>
                                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Ekiti State College Of Health Science and Technology, Ijero-Ekiti. 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/datatables-demo.js"></script>
    </body>
</html>
