<?php
include_once('../../functions.php');
require_once('../../connection.php');
$MatricNumber = "";
$payID ='';
  confirmLogin();
      $id="";
     if(isset($_GET['stfId'])){
         $id=$_GET['stfId'];
         $_SESSION['stfID']= $id;
         $deptID = $_GET['dpt'];
         $_SESSION['dpt'] = $deptID;
         $sql="SELECT * FROM Staffs WHERE DeptID = '$deptID'";
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($result)) {
            $id=$row['ID'];
          $staffCode= $row['StaffCode'];
           $fname= $row['FirstName'];
           $sname= $row['Surname'] ;
            $phno= $row['PhoneNumber'];
}

if(isset($_GET['dpt'])){
    $deptID = $_GET['dpt'];
        $sql="SELECT DeptID FROM Departments WHERE ID = '$deptID'";
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($result)) {
            //$id=$row['ID'];
          $dept= $row['DeptID'];
}
     }
     }
        if(!isset($_SESSION['stfID'])){

    //header('location:dashboard.php?msg=You have not Updated Your Profile');
} else{
     $stdEmail =$_SESSION['stdEmail'];

        if(isset($_POST['assignCourses'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $stfCode = $screenData['stfCode'];
     $fulname = $screenData['fulname'];
     $CourseName= $screenData['CourseName'];
     $CourseCode= $screenData['CourseCode'];
     $CourseUnits= $screenData['courseUnits'];
     $phno =$screenData['phno'];
      $dept= $screenData['dept'];
     $Semester= $screenData['Semester'];
     $level= $screenData['level'];
     $sess= $screenData['sess'];
   $stfId =$_SESSION['stfID'];
   $coco ="";
   if(!empty($CourseCode)){
         $query = mysqli_query($con,"SELECT CourseCode  FROM CourseCodes WHERE  Id ='$CourseCode'");
         while($results=mysqli_fetch_array($query)){
              echo $coco =$results['CourseCode'];
         }
   
        
 $assignCourse = "INSERT INTO Lectures (StaffCode,FullName,PhoneNumber,DeptCode, CourseCodes, CourseTitles,CourseUnits,AcademicSession, Semester, Level,StaffID) 
 VALUES ('$stfCode','$fulname','$phno','$dept','$coco', '$CourseName','$CourseUnits','$sess','$Semester','$level',' $stfId')";
       
        // ======= check Code Availability =====
        $CCode="";
        $query = "SELECT CourseCodes  FROM Lectures WHERE StaffID ='$stfId' AND CourseCodes ='$coco'";
        $query = mysqli_query($con,$query);
         $CCode = mysqli_num_rows($query); 

    
     if($CCode ==0){
        // ========End check ====== 
        
        $addCourse = mysqli_query($con,$assignCourse)or die($mysqli_error($con));
        if(mysqli_affected_rows($assignCourse)==0){
            $msg="Error In Query".mysqli_error($con);
        }
        if(!$assignCourse){
            $msg="Error In Query".mysqli_error($con);
             $msg= "<script> alert('$msg'); </script>";
            //echo "<script> alert('Error In Query'); </script>".mysqli_error($con);
            
        }
        else {
           
            $msg="<script> alert('1 Course Assigned Successfully'); </script>";
            $msg="1 Course Assigned Successfully";
        }
    }
    else{
        $msg = "<script> alert('1 Course Already Assigned To This Lectureer'); </script>";
                }
            } 
        }
}
?>

<!-- ==== Remove Courses Not Needed-->
<?php
$payID ="";
$cID="";
if(isset($_GET['cc'])){
    $cID= $_GET['cc'];
    $r =mysqli_query($con,"Delete From studentCourseReg Where ID =$cID");
    if(mysqli_affected_rows($r)==1){
        $msg="<script> alert('1 Course Removed Successfully'); </script>";
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
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="../jquery.min.js"></script>
        <script src="getStaffAjax.js"></script>                                              
          <script src="jquery.js" type="text/javascript"></script>
          <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
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
                        <a class="dropdown-item" href="profiles.php">My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
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
                                    <a class="nav-link" href="#layout-static.html">Reg Course</a>
                                    <a class="nav-link" href="#layout-sidenav-light.html">Remove Courses</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Payment Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                       Payment History
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="rePrintReceipts.php?payID=<?php echo $_SESSION['payID']; ?>">Schools Fees</a>
                                            <a class="nav-link" href="#register.html">Compulsory</a>
                                            <a class="nav-link" href="#password.html">Certificate</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#401.html">Load Results</a>
                                            <a class="nav-link" href="#404.html">Process Results</a>
                                            <a class="nav-link" href="#500.html">Approve Results</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Faculty News
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
                <main onload='loadCategories()'>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Course Assignment Panel</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="index.php?id=$stfId" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Staff Code </label> 
                                                        <input class="form-control py-4" id="inputStaffCode" type="text" placeholder="Lectureer's FullName" name="stfCode" value=" <?php if(isset($_POST['stfCode'])){ echo $_POST['stfCode']; } else{ echo $staffCode;  } ?>"  readonly required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputStaffName"> Lectureer's FullName </label> 
                                                        <input class="form-control py-4" id="inputFullName" type="text" placeholder="Lectureer's FullName" name="fulname" value=" <?php if(isset($_POST['fulname'])){ echo $_POST['fulname']; } else{ echo $fname. ' '.$sname;  } ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="form-row">
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPhoneNumber">Staff Phone Number</label>
                                                        <input class="form-control py-4" id="inputPhoneNumber" name="phno" type="text" placeholder="Lectureer's Contact Number" value="<?php if(isset($_POST['phno'])) { echo $_POST['phno']; }else { echo $phno; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Department Staff Is  Domicile"  value="<?php if(isset($_POST['dept'])) { echo $_POST['dept']; } else { echo $dept; } ?>" name="dept"  readonly />
                                                        
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="CourseCode">Courses Code</label>
                                                        <!--<input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Course Code" name="CourseCode"  required />-->
                                                        <select name="CourseCode" class="form-control py-4" id="CourseCode" size="1">
                                                            <option value="">....Select Course Code...</option>
                                                            <?php 
                                                // Fetch Department
                                                $cc="";
                                                $sql_department = "SELECT * FROM CourseCodes";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    $courseId = $row['Id'];
                                                    $cId = $row['CourseCode'];
                                                    //$cT=$row['CourseTitle'];
                                                    //$cU = $row['CourseUnits'];
                                                     $cc .="<option value='$courseId'>$cId</option>";
                                                     
                                                  }
                                                    // Option
                                                   
                                            echo $cc;
                                                ?>
                                                             </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="CourseName">Courses Name</label>
                                                 <select name="CourseName" class="form-control py-4" id="CourseName" size="1"><option value="Select CourseTitle">....CourseName...</option></select>
                                                 </div>
                                            </div>
                                           </div>
                                           <div class="form-row">
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Number Of Units</label>
                                                        <select name="courseUnits" class="form-control py-4" id="courseUnits" size="1" required>
                                                            </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Semester </label>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <select name="Semester" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="0">....Choose Semester...</option>
                                                            <option value="First Semester">First Semester</option>
                                                            <option value="Second Semester">Second Semester</option></option>
                                                            </select>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Level</label>
                                                        <select name="level" class="form-control py-4" id="level" size="1">
                                                            <option value="0">..Select Level..</option>
                                                            <option value="100">100</option>
                                                            <option value="200">200</option>
                                                            <option value="300">300</option>
                                                            <option value="400">400</option>
                                                            <option value="500">500</option>
                                                            <option value="600">600</option>
                                                            <option value="Extra">Extra</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Academic Session</label>
                                                        <select name="sess" class="form-control py-4" id="sess" size="1">
                                                            <option value="Select Category">..Select Session..</option>
                                                            <option value="2015/2016">2015/2016</option>
                                                            <option value="2017/2018">2017/2018</option>
                                                            <option value="2019/2020">2019/2020</option>
                                                            <option value="2021/2022">2021/2022</option>
                                                            <option value="2023/2024">2023/2024</option>
                                                            <option value="2025/2026">2025/2026</option>
                                                            <option value="2027/2028">2027/2028</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="assignCourses" class="btn btn-primary btn-block">Assign Course Now</button></div>
                                             </div>
                                             </div>
                                        </form>
                                        <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                               <th>StaffCode</th>
                                                <th>FullName</th>
                                                <th>PhoneNumber</th>
                                                <th>CourseCode</th>
                                                <th>CourseTitles</th>
                                                <th>Semester</th>
                                                <th>SESSION</th>
                                                <th>Action</th>
                                           
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>StaffCode</th>
                                                <th>FullName</th>
                                                <th>PhoneNumber</th>
                                                <th>CourseCode</th>
                                                <th>CourseTitles</th>
                                                <th>Semester</th>
                                                <th>SESSION</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                           <!-- <tr>-->
                                           <?php echo getAllLectures($con); ?>
                                          
 
                                                  
                                        </tbody>
                                    </table>
                                    </div>
                                   
                                    </div>
           
                
                
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
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        
        <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
       <!-- <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>-->
        
    </body>
</html>
