<?php
include_once('../../functions.php');
require_once('../../connection.php');
$st="";
  confirmLogin();
if(isset($_GET['msg'])){
    $msg=$_GET['msg'];
}
    
$deptId="";
$jbr="";
$dptID ="";
$dptN ="";
$dp="";
$dpt="";
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
            $dpt= strtoupper($results['DeptID']);
             $dptN.= strtoupper($results['DeptID']);
             $dp = strtoupper($results['DeptName']);
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
          <link rel="shortcut icon" type="image/x-icon" href="../../images/logo-eschsti.png"/>
        <link href="../../css/styles.css" rel="stylesheet" />
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
                        <a class="dropdown-item" href="../dashboard.php?msg=<?php echo $_GET['msg']; ?>">Admin Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manageScore.php?msg=<?php echo $_GET['msg']; ?>">My Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php?msg=<?php echo $_GET['msg']; ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" style="background-color:#20c997;">
            <div id="layoutSidenav_nav" style="background-color:dark; color:lavender;">
               <?php
               include('lectSideBar.php');
               ?>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Student Scores & Assessment Manager</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="editStudent.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:red; font-size:18px;"><!--Welcome Back :--> <?php if(isset($msg)){ /*echo $msg;*/ } ?></span>
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
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                               <th>MatricNO.</th>
                                                <th>CourseCode</th>
                                                <th>CourseName</th>
                                                <th>CoursesUnits</th>
                                                <th>Reg As</th>
                                                <th>StdLevel</th>
                                                <th>Num Of Students</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>MatricNO.</th>
                                                <th>CourseCode</th>
                                                <th>CourseName</th>
                                                <th>CoursesUnits</th>
                                                <th>Reg As</th>
                                                <th>StdLevel</th>
                                                <th>Num Of Students</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                           <!-- <tr>-->
                                           <?php //echo getAllStd($con); ?>
                                           <?php echo getStdByCourses($con,$dp); ?>
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