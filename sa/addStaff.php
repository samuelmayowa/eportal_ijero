<?php
include_once('../functions.php');
require_once('../connection.php');

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
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-gray bg-green" style="background-color:teal; color:#fff;">
            <a class="navbar-brand" href="index.html" style="color:#fff;">ESCOHST-IJERO</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0" style="color:#fff;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color:#fff;"  id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="manageLectures.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manageLectures.php">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" style="background-color:#20c997;">
            <div id="layoutSidenav_nav" style="background-color:dark; color:lavender;">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color:##20c997;">
                    <div class="sb-sidenav-menu" style="background-color:##20c997;">
                        <div class="nav" style="background-color:#28a745;">
                            <div class="sb-sidenav-menu-heading">ESCOHST-IJERO</div>
                            <a class="nav-link" href="manageLectures.php">
                                STAFF Admin DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Staff Area</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Course Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="manageLectures.php">Load Courses</a>
                                    <a class="nav-link" href="manageLectures.php">Load Units</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Staff Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        HOD Area
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Assign Courses</a>
                                            <a class="nav-link" href="addCourses.php">Add New</a>
                                            <a class="nav-link" href="manageLectures.php">ManageCourses</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#?msg=<?php echo $_GET['msg']; ?>">Load Results</a>
                                            <a class="nav-link" href="#?msg=<?php echo $_GET['msg']; ?>">Process Results</a>
                                            <a class="nav-link" href="#?msg=<?php echo $_GET['msg']; ?>">Approve Results</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Lectures </div>
                            <a class="nav-link" href="manageLectures.php?msg=<?php echo $_GET['msg']; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                View All Lecturers
                            </a>
                            <a class="nav-link" href="lecturers/dashboard.php?msg=<?php echo $_GET['msg']; ?>?msg=<?php echo $_GET['msg']; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Edit Staff Details
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="Background-color:#28a745;">
                        <div class="small">Logged in as:</div>
                        <?php if(isset($_SESSION['userID'])){
                            echo $_SESSION['userID'];
                        }
                        ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Staff Members To The  Portal for Portal Use</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="addStaff.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Staff Title:</label></label><span style="color:red; font-size:10px;">**MR**DR**ENGR**PROF**MRS**</span>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter Title" name="title" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>" required />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Staff Code (USERNAME)</label>
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
                                                        <?php 
                                // Fetch Department
                                                $dc="";
                                                $fid="";
                                                $sql_department = "SELECT ID, DeptID, FacID FROM Departments";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    $id = $row['ID'];
                                                    $deptCode = $row['DeptID'];
                                                     $dc .="<option value='$id'>$deptCode</option>";
                                                    
                                                }
                                                    echo $dc;
                                                ?> </select>
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
                                                             <?php 

                                                                        $jts ='';
                                                                        $jcs ='';
                                                                        $jt ='';

                                                            $query = "SELECT JobCodes ,JobTitles  FROM Jobs";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($pjts = mysqli_fetch_array($query)){
                                                                $jts = $pjts ['JobTitles'];
                                                                $jcs = $pjts ['JobCodes'];
                                                               $jt .= "<option value='$jts'>$jts( $jcs )</option>";
                                                                     } 
                                                                     echo $jt;
                                                                        ?>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Job Title In The Portal</label>
                                                        <select name="jobs" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select School">....Select School Id...</option>
                                                            <?php 

                                                                        $jbs ='';

                                                            $query = "SELECT JobCodes  FROM Jobs";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($pjbs = mysqli_fetch_array($query)){
                                                                $jbs = $pjbs ['JobCodes'];
                                                               $jb .= "<option value='$jbs'>$jbs</option>";
                                                                     } 
                                                                     echo $jb;
                                                                        ?>
                                                                        </select>
                                                        <!--<input class="form-control py-4" id="inputConfirmPassword" name="StdCat" type="text" placeholder="CATEGORY ** ND, DIP, HND"  required/>-->
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Password</label>
                                                       <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter Staff Admin Password"  name="password" Value="<?php if(isset($_POST['password'])){ echo $_POST['password']; }  ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Confirm Password</label>
                                                       <input class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Enter Staff Admin Password"  name="confirm_password" Value="<?php if(isset($password)){ echo $password; }  ?>" required />
                                                    </div>
                                                </div>
                                                <script>
                                                    var password = document.getElementById("inputPassword")
                                                              , confirm_password = document.getElementById("inputConfirmPassword");
                                                            
                                                            function validatePassword(){
                                                              if(password.value != confirm_password.value) {
                                                                confirm_password.setCustomValidity("Passwords Don't Match");
                                                              } else {
                                                                confirm_password.setCustomValidity('');
                                                              }
                                                            }
                                                            
                                                            password.onchange = validatePassword;
                                                            confirm_password.onkeyup = validatePassword;
                                                </script>
                                                </div>
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="addStaff" class="btn btn-primary btn-block">Add Staff Member</a></div>
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
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
