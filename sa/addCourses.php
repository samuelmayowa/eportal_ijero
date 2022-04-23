<?php
include_once('../functions.php');
require_once('../connection.php');

  confirmLogin();
$msg1="";
    //prepare Data
if(isset($_POST['addCourses'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $courseTitle = $screenData['courseTitle'];
     $courseName= $screenData['courseName'];
     $courseCode= $screenData['CourseCode'];
     $CourseUnits= $screenData['CourseUnits'];
      $dept= $screenData['dept'];
     $progCat= $screenData['progCat'];
     $level= $screenData['StdLevel'];
     $stdCat= $screenData['schools'];

    
      
 // ======= check Code Availability =====
        
        $query = "SELECT CourseCode  FROM Courses WHERE CourseCode ='$courseCode'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 

            if($CCode == 1){
                $msg = "<script> alert('Course Already Added'); </script>";
    } else {
   

//Append Courses

 $addCourse = "INSERT INTO Courses (CourseCode, CourseTitle,  
        Department, CourseUnits, Category, studentLevel, Faculty) 
 VALUES ('$courseCode', '$courseTitle',  '$dept',
         '$CourseUnits', '$progCat', '$level', '$stdCat')";
         
       
        // ======= check Code Availability =====
        
        
        $query = "SELECT CourseCode  FROM Courses WHERE CourseCode ='$courseCode'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 
        $ci="";
        $ci3="";
            if($CCode != 1){
        // ========End check ====== 
        
        $addCourse = mysqli_query($con,$addCourse) or die(mysqli_error($con));
        if(!$addCourse){
            echo "<script> alert('Error In Query'); </script>".mysqli_error($con);
        }
        else {
            //
            // Add Course COde===
        $query1=mysqli_query($con,"INSERT INTO CourseCodes(CourseCode) VALUES('$courseCode')");
       if($query1){
           $cID=mysqli_query($con,"SELECT Id FROM CourseCodes Where CourseCode='$courseCode'");
           while($c=mysqli_fetch_array($cID)){
               $ci=$c['Id'];
               //$_SESSION['Id'] =$ci;
           }
           if(!empty($ci)){
               $query2=mysqli_query($con,"INSERT INTO CourseTitles(CourseTitles,CourseID) VALUES('$courseTitle','$ci')");
               if($query2){
                   $query3=mysqli_query($con,"Select Id From CourseTitles Where CourseID ='$ci'") or die(mysqli_error($con));
                   while($c2=mysqli_fetch_array($query3)){
                       $ci3=$c2['Id'];
                   }
                   if($ci3){
                       $query4=mysqli_query($con,"INSERT INTO CourseUnits(CourseUnits, CourseTitleID) VALUES('$CourseUnits','$ci3')");
                       if($query4){
                            //$msg="<script> alert('1 CourseCode,CourseName, CourseUnits Added Successfully'); </script>";
                            $msg1="1 CourseCode,CourseName, CourseUnits Added Successfully";
                       }
                   }else{
                   $msg1="Unable to Add Units".mysqli_error($con);
               }
               }
               
           }
            /*$msg="<script> alert('1 Course Added Successfully'); </script>";
            $msg="1 Course Added Successfully";*/
        }else{
            $msg="<script> alert('Unable To Append CourseCode'); </script>";
        }
    }
            }
    else{
        $msg = "<script> alert('1 Course Already Exist'); </script>";
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
                                            <a class="nav-link" href="assignCourses.php">Assign Courses</a>
                                            <a class="nav-link" href="addCourses.php">Add New</a>
                                            <a class="nav-link" href="manageLectures.php">ManageCourses</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    
                            <div class="sb-sidenav-menu-heading">News</div>
                            <a class="nav-link" href="manageLectures.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                View All Lecturers
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology</h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Course Management Panel</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="addCourses.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg1)){ echo $msg1; /*echo  "   ID:". $ci;*/ } ?> <?php if(isset($_GET['msg'])) { echo /*$_GET['msg'] . */ " With ID: ".$_GET['id']; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Course Title</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Course Title" name="courseTitle" required />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Courses Code</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Course Code" name="CourseCode"  required />
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Courses Name</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Enter Course Name" name="CourseName" required />
                                            </div>
                                            </div>
                                           
                                       
                                            <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Course Category </label>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <select name="progCat" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select Category">....Select Category...</option>
                                                            <option value="First Semester">First Semester</option>
                                                            <option value="Second Semester">Second Semester</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Faculty Code</label>
                                                        <select name="schools" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select School">....Select School (Faculty Code)...</option>
                                                            <?php 

                                                                        $schlID ='';

                                                            $query = "SELECT FacultyID, FacultyName FROM Faculties";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $schlID = $schl ['FacultyID'];
                                                               
                                                                  $schools = $schl ['FacultyName'];
                                                               echo $schools .= "<option value='$schools'>$schlID ". '  '. "($schools)</option>";

                                                            }

                                                                    //    if(isset($schools)){ echo $schools; } 
                                                                        ?>
</select>
                                                        <!--<input class="form-control py-4" id="inputConfirmPassword" name="StdCat" type="text" placeholder="CATEGORY ** ND, DIP, HND"  required/>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Number Of Units</label>
                                                        <input class="form-control py-4" id="inputFirstName" name="CourseUnits" type="text" placeholder="Course Units"  required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Level</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Level (100L)"  name="StdLevel" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department</label>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Department Course Domicile"  name="dept" />-->
                                                        <select name="dept" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select School">....Select Department Id...</option>
                                                            <?php 

                                                                        $depts ='';
                                                                        $deeptID='';
                                                            $query = "SELECT DeptID, DeptName FROM Departments";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $deptID = $schl ['DeptID'];
                                                               
                                                                  $dept = $schl ['DeptName'];
                                                               echo "<option value='$deptID'>$deptID ". '  '. "($dept)</option>";

                                                            }

                                                                    //    if(isset($schools)){ echo $schools; } 
                                                                        ?>
                                                                        </select>
                                                    </div>
                                                </div>
                                         </div>
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="addCourses" class="btn btn-primary btn-block">Add Courses</a></div>
                                             </div>
                                             </div>
                                        </form>
                                    </div>
                                    <!--==   -->
                                            <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                My Students In : <?php echo $dptN; ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                               <th>CourseID</th>
                                                <th>CourseCode</th>
                                                <th>CourseName</th>
                                                <th>CoursesUnits</th>
                                                <th>Reg As</th>
                                                <th>StdLevel</th>
                                                <th>Action</th>
                                                <!--<th>TOTAL_COURSES</th>-->
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>CourseID.</th>
                                                <th>CourseCode</th>
                                                <th>CourseName</th>
                                                <th>CoursesUnits</th>
                                                <th>Department</th>
                                                <th>Faculty</th>
                                                <th>Action</th>
                                                <!-- <th>TOTAL_COURSES</th>-->
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                           <!-- <tr>-->
                                           <?php //echo getAllStd($con); ?>
                                           <?php //echo getStdByCourses($con,$dptN); ?>
                                            <?php echo getcourses1($con); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-group mt-4 mb-0"><a href="expStdByCCode.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Download All Students Reg Form My Course</button></a></div>
                                                        <div class="form-group mt-4 mb-0"><a href="expStdByDpt.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Download All Students In My Department </button></a></div>
                                                    </div>
                                                </div>
                            </div>
                        </div>
                                    <!--   -->
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
<?php 
require('../close_connection.php');

?>