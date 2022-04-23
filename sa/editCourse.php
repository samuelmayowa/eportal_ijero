<?php
include_once('../functions.php');
require_once('../connection.php');
$st="";
  confirmLogin();
  
  //================ Update The Edited Course ============
  
  if(isset($_POST['updateCourses'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $id= $screenData['id'];
     $courseTitle = $screenData['courseTitle'];
     $courseName= $screenData['courseName'];
     $courseCode= $screenData['CourseCode'];
     $CourseUnits= $screenData['CourseUnits'];
      $dept= $screenData['dept'];
     $progCat= $screenData['progCat'];
     $level= $screenData['StdLevel'];
     $stdCat= $screenData['schools'];
     if(!empty($id)){
        $query = mysqli_query($con, "UPDATE Courses SET  CourseCode='$courseCode', 
                              CourseTitle = '$courseTitle',
                              Department = '$dept',
                              CourseUnits = '$CourseUnits',
                              Category = '$progCat',
                              studentLevel = '$level',
                              Faculty ='$stdCat'
                              Where  CourseID='$id'");
                    if(!$query){
                        $msg = "Error In Performing Your Transactions".mysqli_error($con);
                    } else {
                        $msg = "<script> alert('Coures Updated Successfully'); </script>";
                    }
     }
     
}

//======== End ================

// ============ Delete Unwanted Courses ================

  $id="";
  $msg="";
  $C="";
  $id = $_GET['id'];
   $C = $_GET['cCode'];
   $Cid ="";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query=mysqli_query($con, "Delete From Courses Where CourseID ='$id'");
    if($query){
        $Id=mysqli_query($con,"Select Id From CourseCodes Where CourseCode ='$C'");
        while($id=mysqli_fetch_array($Id)){
            $Cid =$id['Id'];
        }
        //$msg = "<script> alert('1 Course Deleted Successfully: $id'); </script>";
        $query2=mysqli_query($con, "Delete From CourseCodes Where Id ='$Cid'") or die(mysqli_error($con));
        if($query2){
        //$msg = "<script> alert('1 Course Deleted Successfully: $id'); </script>";
        $query3=mysqli_query($con, "Delete From CourseTitles Where CourseID ='$Cid'")  or die(mysqli_error($con));
        } else if($query3){
        //$msg = "<script> alert('1 Course Deleted Successfully: $id'); </script>";
        $query4=mysqli_query($con, "Delete From CourseUnits Where CourseTitleID ='$Cid'")  or die(mysqli_error($con));
        if($query4){
             $msg = "<script> alert('1 CourseCodes,Titles , Units Deleted Successfully: $Cid, $id'); </script>";
        }
        }
    header('location:addCourses.php?msg=1 Course Details Deleted Successfully && id='. $id. 'CID: '.$Cid) ; 
        
    }
   
}

// =================== End =============

  $regNum=="";
   $cCode="";
   $cName="";
   $cUnits=="";
   $dpt ="";
   $stdL="";
   $facs="";
if(isset($_GET['msg'])){
    $msg=$_GET['msg'];
}
    //prepare Data
    $std ="";
    $user ="";
    $cNum = "";
if(isset($_GET['cc'])){
    $regCode = $_GET['cc'];
    $user = $_GET['user'];
    if(!empty($regCode)){
        $query = mysqli_query($con, "SELECT *  FROM Courses
                    Where  CourseID='$regCode'");
                    while($rs= mysqli_fetch_array($query)){
                        $id=$regCode;
                        $cNum = $rs['CourseID'];
                        $cCode = $rs['CourseCode'];
                        $cName = $rs['CourseTitle'];
                        $cUnits = $rs['CourseUnits'];
                        $dpt = $rs['Department'];
                        $stdL = $rs['Category'];
                        $facs = $rs['Faculty'];
                        
                    }
    }
}
$deptId="";
$jbr="";
$dptID ="";
$dptN ="";
$deptName ="SCHOOL OF ";
if(isset($_GET['msg'])){
    $jbr = $_GET['msg'];
    $_SESSION['msg']=$jbr;
    if(!empty($jbr)){
        $dept = mysqli_query($con, "Select DeptID From Staffs Where Job_Role ='$jbr' LIMIT 1") or die(mysqli_error($con));
        while ($results = mysqli_fetch_array($dept)){
            $deptId = $results['DeptID'];
           
        }
        if(!empty($deptId)){
            $dptCode = mysqli_query($con,"Select DeptID From Departments Where ID ='$deptId'")or  die(mysqli_error($con));
            while ($results = mysqli_fetch_array($dptCode)){
            $deptCode = $results['DeptID'];
            $_SESSION['dptID'] = $deptId;
        }
        if(!empty($deptCode)){
            $dptCode = mysqli_query($con,"Select DeptID, DeptName, FacultyID From Departments Where DeptID ='$deptCode'")or   die(mysqli_error($con));
            while ($results = mysqli_fetch_array($dptCode)){
             $dptID .= strtoupper($results['DeptID']);
             $deptName .= strtoupper($results['DeptName']);
              $facs = $results['FacultyID'];
              $dptN = strtoupper($results['DeptName']);
             $_SESSION['deptN']=$dptN;
             $_SESSION['dpt']= $dptID;
              $_SESSION['facs']= $facs;
        }
        
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
                        <a class="dropdown-item" href="dashboard.php?msg=<?php echo $_GET['msg']; ?>">Admin Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manageScore.php?msg=<?php echo $_GET['msg']; ?>">My Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php?msg=<?php echo $_GET['msg']; ?>">Logout</a>
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
                            <a class="nav-link" href="dashboard.php?msg=<?php echo $_GET['msg']; ?>">
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
                                            <a class="nav-link" href="assignCourses.php">Assign Courses</a>
                                            <a class="nav-link" href="addCourses.php">Add New</a>
                                            <a class="nav-link" href="addDept.php">Add Departments</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                   
                                </nav>
                            </div>
                            
                            <a class="nav-link" href="uploadStudents.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Load Existing Students
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Student Scores & Assessment Manager</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="editCourse.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:red; font-size:18px;">Welcome Back : <?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                       <div class="form-group mt-4 mb-0"><a href="getScoreSheet.php"><button type="button" name="download" class="btn btn-primary btn-block">Download Score Sheet</button></a></div>
                                                    </div>                                              
                                                    </div>
                                                    
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                       <a href="uploadScores.php"><div class="form-group mt-4 mb-0"><button type="button" name="uploadScores" class="btn btn-primary btn-block">Uplaod Score Sheet</button></div></a>
                                                    </div>                                             
                                                    </div>
                                                    </div>

                                                <div class="form-row">
                                                
                                                    
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                       <a href="viewResults.php"><div class="form-group mt-4 mb-0"><button type="button" name="ViewScores" class="btn btn-primary btn-block">View Uploaded Results</div></a>
                                                    </div>                                             
                                                    </div>
                                                    </div>
                                               </div>
                                          <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                My Students In : <?php echo $dptN; ?>
                            </div>
                            <div class="card-body">
                                        <form action="editCourse.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; echo  "   ID:". $id; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input class="form-control py-4" id="inputCourseID" type="hidden" placeholder="ID" name="id" value="<?php if(isset($id)){ echo $id; } ?>" required />
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Course Title</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Course Title" name="courseTitle" value="<?php if(isset($cName)){ echo $cName; } ?>" required />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Courses Code</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Course Code" name="CourseCode" value="<?php if(isset($cCode)){ echo $cCode; } ?>" required />
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Courses Name</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Enter Course Name" name="CourseName" value="<?php if(isset($cName)){ echo $cName; } ?>" required />
                                            </div>
                                            </div>
                                           
                                       
                                            <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Course Category </label>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <select name="progCat" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select Category">....Select Category...</option>
                                                            <option value="1ST Semester">1ST Semester</option>
                                                            <option value="2ND Semester">2ND Semester</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Faculty Code</label>
                                                        <select name="schools" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select School">....Select School Id...</option>
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
                                                        <input class="form-control py-4" id="inputFirstName" name="CourseUnits" type="text" placeholder="Course Units" value="<?php if(isset($cUnits)){ echo $cUnits; } ?>" required/>
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
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="updateCourses" class="btn btn-primary btn-block">SAVE CHANGES</div>
                                             </div>
                                             </div>
                                        </form>
                                    </div>
                        </div>
                                            <!--<div class="form-group mt-4 mb-0"><button type="submit" name="editStd" class="btn btn-primary btn-block">Upload Results</div>-->
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

<?php 
require('../close_connection.php');

?>