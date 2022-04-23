<?php
include_once('../functions.php');
require_once('../connection.php');
if(!isset($_SESSION['userID'])){
  header("location:index.php?msg=You have not logged in") ;
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
                        <a class="dropdown-item" href="myProfiles.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashbaord.php">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" style="background-color:#20c997;">
            <div id="layoutSidenav_nav" style="background-color:#000; color:lavender;">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color:##20c997;">
                    <div class="sb-sidenav-menu" style="background-color:##20c997;">
                        <div class="nav" style="background-color:#28a745;">
                            <div class="sb-sidenav-menu-heading">ESCOHST-IJERO</div>
                            <a class="nav-link" href="dashboard.php">
                                Student Home DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Student Area</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Course Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="courseReg.php">Register Courses</a>
                                    <a class="nav-link" href="#myLectures.php">Lectures</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Payments Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="payments.php?msg=SchoolFees" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        School Fees
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="payments.php?msg=SchoolFees">School Fees</a>
                                            <a class="nav-link" href="payments.php?msg=CompulsoryFees">Acceptance Fees</a>
                                            <a class="nav-link" href="payments.php?msg=ApplicationFees">Application Fees</a>
                                             <a class="nav-link" href="payments.php?msg=CertificateFees">Certicate Fees</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#checkResults.php">Check Results</a>
                                            <a class="nav-link" href="#printResults">Process Results</a>
                                            <a class="nav-link" href="#myTranscripts.php">See Grades</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Receipts</div>
                            <a class="nav-link" href="generateReceipts.php?payID=$payID">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                RePrint Receipts
                            </a>
                            <a class="nav-link" href="uploadStudents.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Connect HOD
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
            <?php if(isset($msg)){ echo  $msg; } ?>
           
             <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-md border-0 rounded-md md-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                     <?php if(isset($_GET['msg'])){ echo '<span style="color:red;" >' .$_GET['msg'] .'</span>'; } ?>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Student Dashboard</h3><?php if(isset($payID)){ echo  '<span="color:green;">Your Payment Refernce ID: '.  $payID .'</span>'; } ?></div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><?php if(isset($upd)){ echo  $upd; } ?>
                                                        <?php 
                                                                        $stdEmail ="";
                                                                        $schlID ='';
                                                                        $matri =$_SESSION['userID'];
                                                            $query = "SELECT firstName, middleName,lastName, studentLevel,stdPhoneNumber, yearOfEntry, 
                                                            studentEmail, department, faculty FROM students WHERE matricNumber='$matri'";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $stdLevel = $schl ['studentLevel'];
                                                               $fname=$schl['firstName'];
                                                               $midName= $schl['middleName'];
                                                               $lname = $schl ['lastName'];
                                                               $stdCode = $_SESSION['userID'];
                                                               $dept = $schl ['department'];
                                                               $stdPhno =$schl['stdPhoneNumber'];
                                                               $yearOfEntry = $schl['yearOfEntry'];
                                                               $faculty = $schl['faculty'];
                                                               $stdEmail = $schl['studentEmail'];
                                                               $_SESSION['stdPhno'] = $stdPhno;
                                                               $_SESSION['stdEmail']= $stdEmail;
                                                              $_SESSION['fname'] =$fname;
                                                              $_SESSION['midName'] = $midName;
                                                              $_SESSION['lname'] = $lname;
                                                              $_SESSION['dept'] =$dept;
                                                              $_SESSION['yearOfEntry']= $yearOfEntry;
                                                              $_SESSION['faculty'] = $faculty;
                                                              $_SESSION['stdLevel'] = $stdLevel;
                                                              $_SESSION['stdPhno'] = $stdPhno;
                                                             
                                                              //setcookie('pid', $_SESSION['pid'], time() + (3600), "/");
                                                            } 
                                                            setcookie('stdEmail', $_SESSION['stdEmail'], time() + (3600), "/");
                                                               echo " StudentID : ".  $stdCode . "<br />";   
                                                               echo "FullName : ". $fname . '  '. $midName .' ' .  $lname . "<br />";
                                                               echo " Department: ".  $dept . "<br />";
                                                               echo " Course: ".  $dept . "<br />";
                                                               echo " Level: " .  $stdLevel . "<br />";
                                                               echo " Academic Calender: ".  $yearOfEntry . "<br />";
                                                                    //    if(isset($schools)){ echo $schools; } 
                                                                        ?></h3></div>
                                   <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                       <h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/courseReg.png" style="width:160px; height:120px;"><br><a href="courseReg.php">My Course Registration</a> </h3>
                                                    </div>
                                                </div>
                                                
                                      <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/payments.jpg" style="width:160px; height:120px;"><br><a href="payments.php">My Payments</a> </h3>
                                                       
                                                    </div>
                                                </div>
                                                </div>
                                                 
                                         <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                       <h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/profiles.jpg" style="width:160px; height:120px;"><br><a href="myProfiles.php" >Update My Profiles</a> </h3>
                                                    </div>
                                                </div>
                                                
                                      <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/profiles-01.jpg" style="width:160px; height:120px;"><br><a href="myProfiles.php">Change My Profile Passport</a> </h3>
                                                       
                                                    </div>
                                                </div>
                                                </div>
                                    </div>
                                     <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                My Registered Courses: <?php echo $_SESSION['stdEmail']; ?>
                            </div>
                            <div class="card-body">
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
                                                
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                           <!-- <tr>-->
                                           <?php
                                           $stdEmai ="";
                                                 $matr =$_SESSION['userID'];
                                                 $stdEmai = $_SESSION['stdEmail'];
                                                 if(!empty($stdEmai)){
                                                 //mysql_real_escape_string($con,$matr);
                                                 /*mysql_escape_mimic($matricID);
                                                 mysql_fix_string($matricID);
                                                 mysql_entities_fix_string();
                                                 sanitizeMySQL($matricID);*/
       $query = "SELECT MatricNumber,CourseUnits,CourseCode,CourseName,Semester, Department FROM studentCourseReg WHERE studentEmail ='$stdEmai' ORDER BY CourseUnits";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            echo   "<tr><td>" .$stdList ['MatricNumber'] . "</td>" .
        "<td>" . $stdList['CourseCode'] . "</td>". "<td>".  $stdList['CourseName'] . "</td>" .
         "<td>" . $stdList ['Department'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
         "<td>" . $stdList ['Semester'] . "</td>" ."</tr>";
    } }  
?>
 
                                                  
                                        </tbody>
                                    </table>
                                             <div class="col-md-6">
                                            <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="printCourseForm" class="btn btn-primary btn-block"><a class="btn btn-primary btn-block" href="courseForm.php?stdM=<?php echo $stdEmai; ?>">Print Course Form</a></button></div>
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
