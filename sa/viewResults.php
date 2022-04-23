<?php
include_once('../functions.php');
require_once('../connection.php');
confirmLogin();
    //prepare Data
 $jbt="";
    $user="";
    $logUser="";
    
$user=$_SESSION['userID'];
$loginUser =$_GET['msg'];
 if(isset($_GET['msg'])){
        $logUser=$_GET['msg'];
        $user=$_SESSION['userID'];
        $query=mysqli_query($con,"Select JobTitle From UserAdmins Where userName ='$user'");
        while($res=mysqli_fetch_array($query)){
            $jbt = $res['JobTitle'];
        }
    }
confirmHOD($jbt);   

$courseCode ="";
$err="";
$msg="";
if(isset($_GET['c'])){
    $courseCode=$_GET['c'];
    $query=mysqli_query($con,"Update ScoreSheet Set Status =1 Where CourseCode='$courseCode'");
    if(!$query){
        $err="Unbale to Approve Uploaded Results".mysqli_error();
        $msg="<script> alert('$err'); </script>";
    }else{
        $err=$courseCode . " Results Approved Successfully";
        $msg="<script> alert('$err'); </script>";
    }
}

// disapprove Results ====
if(isset($_GET['dsap'])){
    $courseCode=$_GET['dsap'];
    $query=mysqli_query($con,"Update ScoreSheet Set Status =0 Where CourseCode='$courseCode'");
    if(!$query){
        $err="Unbale to Dis-Approve Uploaded Results".mysqli_error();
        $msg="<script> alert('$err'); </script>";
    }else{
        $err=$courseCode . " Results Dis-Approved Successfully";
        $msg="<script> alert('$err'); </script>";
    }
}
dsap
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
                        <a class="dropdown-item" href="dashboard.php?msg=<?php echo $_GET['msg']; ?>">Admin Home</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manageFinance.php?msg=<?php echo $_GET['msg']; ?>">Dashboard</a>
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
                            <a class="nav-link" href="manageLectures.php?msg=<?php echo $_GET['msg']; ?>">
                                Lectures management DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Staff Area</div>
                            <a class="nav-link collapsed" href="manageLectures.php?msg=<?php echo $_GET['msg']; ?>" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Course Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="addCourses.php?msg=<?php echo $_GET['msg']; ?>">Add New Courses</a>
                                    <a class="nav-link" href="manageLectures.php?msg=<?php echo $_GET['msg']; ?>">Update Fees</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                HOD's Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#?msg=<?php echo $_GET['msg']; ?>" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        lecturers Area
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="addCourses.php?msg=<?php echo $_GET['msg']; ?>">Add New Courses</a>
                                            <a class="nav-link" href="#updateFees.php">Update Courses</a>
                                            <a class="nav-link" href="manageLectures.php?msg=<?php echo $_GET['msg']; ?>">View All Courses</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="getAllPCourses.php?msg=<?php echo $_GET['msg']; ?>">Get All Courses</a>
                                            <a class="nav-link" href="#UpdateFees.php">Update Courses</a>
                                            <a class="nav-link" href="#getAllPayments.php">Find Course</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            
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
                        <?php if(isset($msg)){ echo $msg; } ?>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">View Score Reports</h3></div>
                                  
                                    <div class="card-body">
                                       
                                   <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                All Student Results: Grouped By Courses<a href="manageLectures.php?msg=<?php echo $_GET['msg']; ?>">>> Return Back</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                                <!--<th>MatricNO</th>-->
                                                <!--<th>FullName</th>-->
                                                <!--<th>DeptCode</th>-->
                                                <th>CourseCode</th>
                                                <th>CA1</th>
                                                <th>CA2</th>
                                                <th>CA3</th>
                                                <th>ExamScore</th>
                                                <th>TotalSTD</th>
                                                <!--<th>Cum.TotalScore</th>-->
                                                <!--<th>Grade</th>-->
                                                <th>SubmittedBy</th>
                                                <th>Status</th>
                                                <!--<th>Visibility</th> -->
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <!--<th>MatricNO</th>-->
                                                <!--<th>FullName</th>-->
                                                <!--<th>DeptCode</th>-->
                                                <th>CourseCode</th>
                                                <th>CA1</th>
                                                <th>CA2</th>
                                                <th>CA3</th>
                                                <th>ExamScore</th>
                                                <!--<th>Cum.TotalScore</th>-->
                                                <!--<th>Grade</th>-->
                                                 <th>TotalSTD</th>
                                                <th>SubmittedBy</th>
                                                <th>Status</th>
                                                <!--<th>Visibility</th>--> 
                                                <th>Action</th> 
                                                
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php echo approveResults($con); ?>
                                        </tbody>
                                    </table>
                                     <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                        <div class="form-group mt-4 mb-0"><a href="expResults.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="ExpResults" class="btn btn-primary btn-block">Export Results To Excel(CSV) file</button></a></div>
                                                    </div>
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