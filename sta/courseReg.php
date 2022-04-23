<?php
include_once('../functions.php');
require_once('../connection.php');
$MatricNumber = "";
$payID ='';
  confirmLogin();
    
    
    $matric_no = $_SESSION['userID'];
    //$ses= $_SESSION['sess'];
    $query1="SELECT * FROM students WHERE matricNumber='$matric_no'";
    $query1 = mysqli_query($con, $query1);
    while ($stdata = mysqli_fetch_array($query1)){
        $citizenship = $stdata['Citizenship'];
        $studentLevel = $stdata['studentLevel'];
        $email= $stdata['studentEmail'];
        $ses = $stdata['AcademicSession'];
    }
    $paid_amount = paidamount($con, $_SESSION['userID'], $studentLevel);
    $payfixed = fixedpayment($con, $citizenship, $studentLevel);
    
    while($paydata=mysqli_fetch_array($payfixed)){
        $fixed_amount = $paydata ['Amount'];
        $percent = $paydata ['PayPercentages'];
    }
    $allowed_amount = $fixed_amount * $percent;
     
       if($paid_amount < 0 || $paid_amount < $allowed_amount){
           $message = base64_encode('You have to pay a minimum of (#'.number_format($allowed_amount,2).') To proceed with Course Registrations, but you paid (#'.number_format($paid_amount,2). ')');
          header('location:dashboard.php?msga='.$message);
       }
        if(empty($email)){

    header('location:dashboard.php?msg=You have not Updated Your Profile');
} else{
      $stdEmail =$email;

        if(isset($_POST['addCourses'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $MatricNumber = $screenData['MatricNumber'];
     $CourseName= $screenData['CourseName'];
     $CourseCode= $screenData['CourseCode'];
     $CourseUnits= $screenData['courseUnits'];
     $purpose =$screenData['purpose'];
      $dept= $screenData['dept'];
     $Semester= $screenData['Semester'];
     $StdLevel= $screenData['StdLevel'];
     $faculty= $screenData['faculty'];
     $sess= $screenData['sess'];
   $stdEmail =$email;
        $mydate=getdate(date("U"));
        //$dateReg .=$mydate[weekday]. ",". $mydate[month] . $mydate[mday].",". $mydate[year];
        $CourseCode=getCode($con,$CourseCode);
        
 $addCourse = "INSERT INTO studentCourseReg (MatricNumber, CourseCode, CourseName, RegisteredAs,
        Semester,AcademicSession,faculty, CourseUnits,StdLevel, Department,ReceiptNumber,studentEmail) 
 VALUES ('$MatricNumber','$CourseCode', '$CourseName','$purpose','$Semester','$sess','$faculty',
         '$CourseUnits', '$StdLevel', '$dept','$payID','$stdEmail')";
       
        // ======= check Code Availability =====
        
        $query = "SELECT CourseCode  FROM studentCourseReg WHERE MatricNumber ='$MatricNumber' AND CourseCode ='$CourseCode' AND AcademicSession= '$ses'";
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
        <link href="../css/styles.css" rel="stylesheet" />
       
        
          <script src="jquery.min.js"></script>                                               
          <script src="jquery.js" type="text/javascript"></script> 
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
            <?php include('sidebar.php')?>
            <div id="layoutSidenav_content">
                <main onload='loadCategories()'>
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
                                                </div>
                                                <div class="form-row">
                                                 <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="CourseName">Courses Name</label>
                                                 <select name="CourseName" class="form-control py-4" id="CourseName" size="1"><option value="Select CourseTitle">....CourseName...</option></select></div>
                                            </div>
                                           
                                           
                                       
                                            <!--<div class="form-row">-->
                                                
                                                
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Number Of Units</label>
                                                        <select name="courseUnits" class="form-control py-4" id="courseUnits" size="1" required>
                                                            </select>
                                                    </div>
                                                </div>
                                                </div>
                                                
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Faculty Code</label>
                                                        <select name="faculty" class="form-control py-4" id="inputFirstName" size="1" readonly>
                                                            <option value="Select School">....Select Faculty...</option>
                                                             <?php 
                                                            //getCourseCode();
                                                                        $schlID ='';
                                                                        $matricID =$_SESSION['ID'];
                        
                                                            $query = "SELECT faculty FROM students where ID ='$matricID'";
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
                                                        <label class="small mb-1" for="inputPassword">Semester </label>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <select name="Semester" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select Category">....Choose Semester...</option>
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
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Level (100L)"  name="StdLevel" value=" <?php 
                                                            //getCourseCode();
                                                                        $stdLevel ='';
                                                                        $StdID =$_SESSION['ID'];
                                                                        $stdL="";
                                                            $query = "SELECT studentLevel FROM students where ID ='$StdID'";
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
                                         <div class="form-row">
                                         <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Registered As </label>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <select name="purpose" class="form-control py-4" id="inputFirstName" size="1" required>
                                                            <option value="Select Category">....Choose Purpose...</option>
                                                            <option value="M">Main Course</option>
                                                            <option value="C">Carry Over</option></option>
                                                            <option value="Elective">Elective</option></option>
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
                                                            <option value="2020/2021">2020/2021</option>
                                                            <option value="2021/2022">2021/2022</option>
                                                            <option value="2022/2023">2022/2023</option>
                                                            <option value="2023/2024">2023/2024</option>
                                                            <option value="2024/2025">2024/2025</option>
                                                            <option value="2025/2026">2025/2026</option>
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
                                        <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                               <th>MatricNO.</th>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Dept</th>
                                                <th>Course Units</th>
                                                <th>Semester</th>
                                                <th>RegisteredAs</th>
                                                <th>Action</th>
                                           
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>MatricNO.</th>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Dept</th>
                                                <th>Course Units</th>
                                                <th>Semester</th>
                                                <th>RegisteredAs</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                           <!-- <tr>-->
                                           <?php
                                           $pid= $_SESSION['payID'];
                                           $stdEmai ="";
                                          
                                           
                                                 $matr =$_SESSION['ID'];
                                                 //$stdEmai = $_SESSION['stdEmail'];
                                                 if(!empty($email)){
                                                
       $query = "SELECT ID, MatricNumber,CourseUnits,CourseCode,CourseName,Semester, RegisteredAs, Department FROM studentCourseReg WHERE studentEmail ='$email' AND AcademicSession ='$ses' ORDER BY CourseUnits";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id = $stdList['ID'];
            echo   "<tr><td>" .$stdList ['MatricNumber'] . "</td>" .
        "<td>" . $stdList['CourseCode'] . "</td>". "<td>".  $stdList['CourseName'] . "</td>" .
         "<td>" . $stdList ['Department'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
         "<td>" . $stdList ['Semester'] . "</td>" .
         "<td>" . $stdList ['RegisteredAs'] . "</td>" .
         "<td>" ."<a href='courseReg.php?cc=$id&&payID=$pid' class='btn btn-primary btn-block'>Remove </a></td>". "</tr>";
         /*"<td>" .'<a class="btn btn-primary btn-block" href="courseReg.php?c="'.$stdList['ID'].'">Remove</a>' . "</td>". "</tr>";*/
    } }  
?>
 
                                                  
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
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
