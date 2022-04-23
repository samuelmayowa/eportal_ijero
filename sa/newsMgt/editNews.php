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
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ile, Abiye" />
        <meta name="author" content="" />
        <title>Eportal-Staff Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../../images/logo-eschsti.png"/>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
       <?php include('../topbar.php'); ?>
       <?php if(empty($email) && empty($gender)){
     header('location:../staffProfile.php?msg='.$id);
 } ?>
        <?php include ('../sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Notification To Portal For Students/Admission</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="addStaff.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">News Title:</label></label><span style="color:red; font-size:10px;">Enter The News title for **ADMISSION****RESULTS**EXAM**</span>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter News Title" name="title" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>" required />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">NEWS NAME: **ADMISSION****RESULTS**EXAMINATION**</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter your Staff Code" name="staffCode" value="<?php if(isset($_POST['staffCode'])) { echo $_POST['staffCode']; } ?>"  required />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                 <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Surname</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Enter Your SurName" name="lname" value="<?php if(isset($_POST['lname'])) { echo $_POST['lname']; } ?>" required />
                                            </div>
                                            </div>
                                           <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">First Name</label></label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Enter Your FirstName" name="fname" value="<?php if(isset($_POST['fname'])) { echo $_POST['fname']; } ?>" required />
                                            </div>
                                            </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department Code</label></label><span style="color:red; font-size:10px;">*Department Code Where The Lectureer is Domicile*</span>
                                                        <!--<input class="form-control py-4" id="inputdeptCode" type="text" placeholder="Select Department Code" name="deptCode" required />-->
                                                         <select name="deptCode" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select Category">....Select Designation...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Contact Phone Number</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Staff Phone Number" name="phno" value="<?php if(isset($_POST['phno'])) { echo $_POST['phno']; } ?>" required />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                           
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Staff Designation </label><span style="color:red; font-size:10px;">** Staff Duty Position In The School ** Lecturer ** Admin** Bursary etc. **</span>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <select name="desig" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select Category">....Select Designation...</option>
                                                         </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Job Title In The Portal</label>
                                                        <select name="jobs" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select School"> ....Select School Id ... </option>
                                                            </select>
                                                        <!--<input class="form-control py-4" id="inputConfirmPassword" name="StdCat" type="text" placeholder="CATEGORY ** ND, DIP, HND"  required/>-->
                                                    </div>
                                                </div>
                                                </div>
                                                
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="addStaff" class="btn btn-primary btn-block">Add News To Portal</a></div>
                                             </div>
                                             </div>
                                        </form>
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
