<?php
include_once('../functions.php');
require_once('../connection.php');
if(!isset($_SESSION['userID'])){
  confirmLogin();
} else {
    //prepare Data
if(isset($_POST['addCourses'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $MatricNumber = $screenData['MatricNumber'];
     $CourseName= $screenData['CourseName'];
     $CourseCode= $screenData['CourseCode'];
     $CourseUnits= $screenData['courseUnits'];
      $dept= $screenData['dept'];
     $Semester= $screenData['Semester'];
     $StdLevel= $screenData['StdLevel'];
     $faculty= $screenData['faculty'];

 //======= Check Payment Is MAde
/*$query = "SELECT RefNumber  FROM studentPayments WHERE matricID LIKE '&$MatricNumber'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 

            if($CCode ==0){
        // ========End check ====== 
          header('location:dashboard.php?msg=Please Make Payment  To Proceeds With Course Registration');
   
    }
    else{
        //$msg = "<script> alert('1 Payments Already Exist'); </script>";
           while($refNum=mysqli_fetch_array($query)){
               $userPayID = $refNum['RefNumber'];
           }     
                */
             // ======== End check =======   
    
    //getStaff($staffID, $password);
   /* $query = "Select userName, password FROM UserAdmins WHERE userName='$staffID' AND password = '$passkey' LIMIT 1";
    $query=mysqli_query($con,$query);
    if(!$query){
      $msg= mysqli_error($con);*/
      
 // ======= check Code Availability =====
        
        $query = "SELECT CourseCode  FROM studentCourseReg WHERE CourseCode ='$CourseCode'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 

            if($CCode == 1){
                $msg = "<script> alert('1 Course Already Exist'); </script>";
    } else {
   

// Getpyments Data
$userPayID="";
$stdEmail ="";
$query = "SELECT RefNumber, studentEmail  FROM studentPayments WHERE matricID ='$MatricNumber' LIMIT 1";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 
        while($refNum=mysqli_fetch_array($query)){
               $userPayID = $refNum['RefNumber'];
                $stdEmail = $refNum['studentEmail'];
           }   
        
        
        //Append Courses
        $stdEmail =$_SESSION['stdEmail'];
        $mydate=getdate(date("U"));
        $dateReg .=$mydate[weekday]. ",". $mydate[month] . $mydate[mday].",". $mydate[year];
 $addCourse = "INSERT INTO studentCourseReg (MatricNumber, CourseCode, CourseName, 
        Semester,faculty, CourseUnits,StdLevel, Department,ReceiptNumber,studentEmail,DateRegistered) 
 VALUES ('$MatricNumber','$CourseCode', '$CourseName','$Semester','$faculty',
         '$CourseUnits', '$StdLevel', '$dept','$userPayID','$stdEmail','$dateReg')";
       
        // ======= check Code Availability =====
        
        $query = "SELECT CourseCode  FROM studentCourseReg WHERE CourseCode ='$CourseCode'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 

            if($CCode != 1){
        // ========End check ====== 
        
        $addCourse = mysqli_query($con,$addCourse) or die(mysqli_error($con));
        if(!$addCourse){
            echo "<script> alert('Error In Query'); </script>".mysqli_error($con);
        }
        else {
           
            $msg="<script> alert('1 Course Added Successfully'); </script>";
           // $msg="1 Course Added Successfully";
        }
    }
    else{
        $msg = "<script> alert('1 Course Already Exist'); </script>";
                }
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
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Activity Log</a>
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
                            <a class="nav-link" href="dashboard.php">
                                Student DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Student Course Area</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Course Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Load Courses</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Load Units</a>
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
                                            <a class="nav-link" href="register.html">Add New</a>
                                            <a class="nav-link" href="password.html">Add Departments</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">Load Results</a>
                                            <a class="nav-link" href="404.html">Process Results</a>
                                            <a class="nav-link" href="500.html">Approve Results</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="uploadStudents.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Load Existing Students
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="Background-color:#28a745;">
                        <div class="small">Logged in as:</div>
                        <?php if(isset($_SESSION['userID'])){ echo $_SESSION['userID']; }  ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Course Management Panel</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="courseReg.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Matric Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Course Title" name="MatricNumber" value=" <?php if(isset($_SESSION['userID'])){ echo $_SESSION['userID']; }  ?>"  readonly required />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Courses Code</label>
                                                        <!--<input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Course Code" name="CourseCode"  required />-->
                                                        <select name="CourseCode" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select School">....Select Course Code...</option>
                                                             
                                                           
                                                            <?php 
                                                            //getCourseCode();
                                                                        $schlID ='';

                                                            $query = "SELECT CourseCode, Coursetitle FROM Courses";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $schlID = $schl ['CourseCode'];
                                                               $schools = $schl ['Coursetitle'];
                                                               echo $schools .= "<option value='$schools'>$schlID ". '  '. "($schools)</option>";}  ?>                                                                        ?>

                                                            </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Courses Name</label>
                                                 <select name="CourseName" class="form-control py-4" id="inputCourseName" size="1">
                                                            <option value="Select School">....Select Course Code...</option>
                                                 <?php 
                                                            //getCourseCode();
                                                                        $schlID ='';

                                                            $query = "SELECT  Coursetitle FROM Courses";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                               // $schlID = $schl ['CourseCode'];
                                                               $schools = $schl ['Coursetitle'];
                                                               echo $schools .= "<option value='$schools'>$schools</option>";}  ?>   
                                                               </select>
                                                <!--<input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Enter Course Name" name="CourseName" required />-->
                                            </div>
                                            </div>
                                           
                                       
                                            <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Semester </label>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <select name="Semester" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select Category">....Choose Semester...</option>
                                                            <option value="First Semester">First Semester</option>
                                                            <option value="Second Semester">Second Semester</option></option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Faculty Code</label>
                                                        <select name="faculty" class="form-control py-4" id="inputFirstName" size="1" readonly>
                                                            <option value="Select School">....Select Faculty...</option>
                                                             <?php 
                                                            //getCourseCode();
                                                                        $schlID ='';
                                                                        $matricID =$_SESSION['userID'];
                        
                                                            $query = "SELECT faculty FROM students where matricNumber ='$matricID'";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                //$schlID = $schl ['DeptID'];
                                                                $schools = $schl ['faculty'];
                                                               echo $school .= "<option value='$schools' selected>$schools</option>"; }  ?> 
                                                               </select>
                                                        <!--<input class="form-control py-4" id="inputConfirmPassword" name="StdCat" type="text" placeholder="CATEGORY ** ND, DIP, HND"  required/>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Number Of Units</label>
                                                        <select name="courseUnits" class="form-control py-4" id="inputFirstName" size="1" required>
                                                            <option value="Select School">....Select Course Unit(s)...</option>
                                                            <option value="1 Unit">1 Unit</option>
                                                            <option value="2 Units">2 Units</option>
                                                            <option value="3 Units">3 Units</option>
                                                            <option value="4 Units">4 Units</option>
                                                            <option value="5 Units">5 Units</option>
                                                            <option value="6 Units">6 Units</option>
                                                            <option value="7 Units">7 Units</option>
                                                            <option value="8 Units">8 Units</option>
                                                            <option value="9 Units">9 Units</option>
                                                            <option value="10 Units">10 Units</option>
                                                            <option value="11 Units">11 Units</option>
                                                            <option value="12 Units">12 Units</option>
                                                            </select>
                                                        <!--<input class="form-control py-4" id="inputFirstName" name="CourseUnits" type="text" placeholder="Course Units"  required/>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Level</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Level (100L)"  name="StdLevel" value=" <?php 
                                                            //getCourseCode();
                                                                        $stdLevel ='';
                                                                        $matricID =$_SESSION['userID'];
                        
                                                            $query = "SELECT studentLevel FROM students where matricNumber ='$matricID'";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                //$schlID = $schl ['DeptID'];
                                                                $stdLevel = $schl ['studentLevel'];
                                                               echo $stdL .= $stdLevel; }  ?>" readonly required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department</label>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Department Course Domicile"  name="dept" />-->
                                                        <select name="dept" class="form-control py-4" id="inputFirstName" size="1" readonly>
                                                            <option value="Select School">....Select Department Id...</option>
                                                             <?php 
                                                            //getCourseCode();
                                                                        $schlID ='';
                                                                        $matricID =$_SESSION['userID'];
                        
                                                            $query = "SELECT department FROM students where matricNumber ='$matricID'";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                //$schlID = $schl ['DeptID'];
                                                                $depts = $schl ['department'];
                                                               echo $depts .= "<option value='$depts' selected>$depts</option>"; }  ?> 
                                                                        </select>
                                                    </div>
                                                </div>
                                         </div>
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="addCourses" class="btn btn-primary btn-block">Register Course</button></div>
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
