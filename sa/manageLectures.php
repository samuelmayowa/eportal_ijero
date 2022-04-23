<?php
include_once('../functions.php');
require_once('../connection.php');
confirmLogin();
    //prepare Data
    $jbt="";
    $user="";
    $logUser="";
    
    if(isset($_GET['msg'])){
        $logUser=$_GET['msg'];
        $user=$_SESSION['userID'];
        $query=mysqli_query($con,"Select JobTitle From UserAdmins Where userName ='$user'");
        while($res=mysqli_fetch_array($query)){
            $jbt = $res['JobTitle'];
        }
    }
 if($jbt != $logUser){
       header('location:dashboard.php?msg=You Do Not Have View  Access to View This page.');
   } 
$deptId="";
$jbr="";
$dptId ="";
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
             $_SESSION['deptN']=$results['DeptName'];
             $_SESSION['dpt']= $dptID;
              $_SESSION['facs']= $facs;
        }
        
        }
    }
}
}
$stff="";
$courseCode="";
$stat="";
$details="";
if(isset($_GET['msg'])){
    $usrRole=$_GET['msg'];
    $query=mysqli_query($con, "Select CourseCode, SubmittedBy, Status From ScoreSheet Where Status=0 AND Visibility=0 LIMIT 10") or die(mysqli_error($con));
    while($row=mysqli_fetch_array($query)){
        $stff=$row['SubmittedBy'];
        $courseCode= $row['CourseCode'];
        $stat =$row['Status'];
        $details  = $stff=$row['SubmittedBy'];
        
        
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
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                            <a class="nav-link" href="manageLectures.php?msg=<?php echo $_GET['msg']; ?>">
                                Main Dashboard
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
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
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
                    <!--   Modal For Uploaded Scores Approval Notification -->  
                    
                    <div class="container mt-3">
  <h2>Results Upload Notification</h2>
  <!--<p>View Most Recently Uploaded Results Here For Approval.</p>-->
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Show Uploaded Results That Needs Approval Here Now
  </button>

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <?php if(isset($stff)){ echo '<div class="modal-header">
          <h4 class="modal-title">Lecturer With ID:  <font color="red">' .$stff. ' </font> Just Uploaded Results</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body"> <font color="red"> '.
         $stff . ' </font>  Have Uploaded Results for : CourseCode:  <font color="red;">'. $courseCode. ' </font> And Are Waiting For Approval'. 
        '</div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>'; } ?>
        
      </div>
    </div>
  </div>
  
</div>

        <!--   Modal For Uploaded Scores Approval Notification --> 
        
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Manage  Lectures </h3></div>
                                  
                                    <div class="card-body">
                                        <form action="passwordReset.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"> <span style="color:green; font-size:18px;"><?php //if(isset($deptName)){ echo $deptName. ' DEPT: '. $dptID; } ?></span>
                                                        <!--<label class="small mb-1" for="inputFirstName">Add Lecturers</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="addStaff.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="AddLectures" class="btn btn-primary btn-block">Add Lecturers</button></a></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Assign Courses</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="setLectures.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="AssignCourses" class="btn btn-primary btn-block">Assign Courses</button></a></div>
                                                    </div>
                                                </div>
                                               </div>
                                                  <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Upload Results</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="uploadScores.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Upload Results</button></a></div>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Download All Courses</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="viewResults.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">View All Student Results Uploaded</button></a></div>
                                                    </div>
                                                </div>
                                          
                                            
                                             </div>
                                             <div class="form-row">
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                       <div class="form-group mt-4 mb-0"><a href="scoreAssSystem.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="download" class="btn btn-primary btn-block">Authorize Results For Student View</button></a></div>
                                                    </div>                                              
                                                    </div>
                                                   
                                                    
                                              <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Download ScoreSheet Template</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="approveResults.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Approved Results</button></a></div>
                                                    </div>
                                                </div>
                                                
                                            </div>    
                                        </form>
                                        
                                        
                                    </div>
                                   
                                   <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                All Courses Available In ESCOHST-Ijero: 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                                <th>CourseID</th>
                                                <th>CourseCode</th>
                                                <th>CourseTitle</th>
                                                <th>CourseUnits</th>
                                                <th>Department</th>
                                                <th>Faculty</th>
                                                <th>Total Courses</th>
                                                
                                           
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                  <th>CourseID</th>
                                                <th>CourseCode</th>
                                                <th>CourseTitle</th>
                                                <th>CourseUnits</th>
                                                <th>Department</th>
                                                <th>Faculty</th>
                                                <th>Total Courses</th>
                                                
                                                
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php if(!empty ($deptName) && !empty($dptID)){ echo getAllCourses($con,$deptName,$dptID); } else { echo adminGetAllCourses($con); } ?>
                                        </tbody>
                                    </table>
                                     <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                        <div class="form-group mt-4 mb-0"><a href="expAllCourses.php?dpt=<?php echo  $dptID ;?>  msg=<?php echo $_GET['msg']; ?>"><button type="button" name="getAllCourses" class="btn btn-primary btn-block">Download All Courses</button></a></div>
                                                        <div class="form-group mt-4 mb-0"><a href="expAllStd.php?dpt=<?php echo  $deptName ;?>  msg=<?php echo $_GET['msg']; ?>"><button type="button" name="getAllCourses" class="btn btn-primary btn-block">Download All My Students</button></a></div>
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