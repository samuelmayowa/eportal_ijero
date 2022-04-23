<?php
include_once('../../functions.php');
require_once('../../connection.php');
if(!isset($_SESSION['userID'])){
  confirmLogin();
} else {
    //prepare Data
if(isset($_POST['addAdmin'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $staffID = $screenData['StaffID'];
     $jobTitle= $screenData['jobTitle'];
     $username = $screenData['username'];
      $passw= $screenData['password'];
      $hashed = sha1($passw);
     if($username != $staffID){
         $msg="<script> alert('Username and Job Title Does Not Match'); </script>";
     }else{
 
    
    //getStaff($staffID, $password);
   /* $query = "Select userName, password FROM UserAdmins WHERE userName='$staffID' AND password = '$passkey' LIMIT 1";
    $query=mysqli_query($con,$query);
    if(!$query){
      $msg= mysqli_error($con);*/
      
 // ======= check Code Availability =====
        
        $query = "SELECT userName FROM UserAdmins WHERE userName ='$username'";
        $query = mysqli_query($con,$query);
        $Jt = mysqli_num_rows($query); 

            if($Jt == 1){
                $msg = "<script> alert('1 UserAdmin  Already Exist'); </script>";
    } else {
   

//Append Courses

 $addCourse = "INSERT INTO UserAdmins (userName, password, JobTitle ) 
 VALUES ('$username', '$hashed', '$jobTitle')";
       
        // ======= check Code Availability =====
        
         $query = "SELECT userName FROM UserAdmins WHERE userName ='$username'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 

            if($CCode != 1){
        // ========End check ====== 
        
        $addCourse = mysqli_query($con,$addCourse) or die(mysqli_error($con));
        if(!$addCourse){
            echo "<script> alert('Error In Query'); </script>".mysqli_error($con);
        }
        else {
           
            $msg="<script> alert('1 Admin User Was Added Successfully'); </script>";
            $msg="1 Admin User Was Added Successfully";
        }
    }
    else{
        $msg = "<script> alert('1 Admin User Was Already Exist'); </script>";
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
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>-->
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
                        <a class="dropdown-item" href="dashboard.php?msg=<?php echo $_GET['msg']; ?>">Admin Home</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="adminUsers.php?msg=<?php echo $_GET['msg']; ?>">My Dashboard</a>
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
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="getScoreSheet.php">DownloadScoreSheet</a>
                                            <a class="nav-link" href="uploadScores.php">Upload ScoreSheet</a>
                                            <a class="nav-link" href="approveResults.php">Approve Results</a>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Manage Admin Users</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="adminUsers.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">StaffID / User ID</label> <span style="color:red; font-size:10px;">&nbsp; &nbsp; ( ALL Staff Code LIKE :** CHT/STF/001 **)</span>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="staff Code: CHT/STF/001" name="StaffID" required  Value="<?php if(isset($staffID)){ echo $staffID; }  ?>" />-->
                                                        <select name="StaffID" class="form-control py-4" id="StaffID" size="1">
                                                            <option value="">....Select Staff Code...</option>
                                                            <?php 
                                                // Fetch Department
                                                $stf="";
                                                $sql_department = "SELECT ID, StaffCode, FirstName, Surname FROM Staffs";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    $staffId = $row['ID'];
                                                    $fullName = $row['FirstName'] . ' '. $row['Surname'] ;
                                                    $stfCode=$row['StaffCode'];
                                                    //$cU = $row['CourseUnits'];
                                                     $stf .="<option value='$staffId'>$stfCode ( $fullName )</option>";
                                                     
                                                  }
                                                    // Option
                                                   
                                            echo $stf;
                                                ?>
                                                             </select>
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Username:</label> 
                                                        <!--<input class="form-control py-4" id="username" type="text" placeholder="Enter Staff Code : CHT/STF/001"  name="username" required  Value="<?php if(isset($username)){ echo $username; }  ?>" />-->
                                                         <select name="username" class="form-control py-4" id="StaffID" size="1">
                                                            <option value="">....Select Staff Code...</option>
                                                            </select>
                                                    </div>
                                                </div>
                                               </div>
                                                 
                                           
                                       
                                            <div class="form-row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Password</label>
                                                       <input class="form-control py-4" id="inputFirstName" type="password" placeholder="Enter Staff Admin Password"  name="password" Value="<?php if(isset($password)){ echo $password; }  ?>" required />
                                                    </div>
                                                </div>
                                           <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Job Title(Job Role)</label><span style="color:red; font-size:10px;">&nbsp; &nbsp; (LIKE : BURSER ** HOD ** PWD_ADMIN ** AUDITOR ** ADMIN_OFFC)</span>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Faculty Dept is Domicile"  name="school" Value="<?php if(isset($jobTitle)){ echo $jobTitle; }  ?>" required />-->
                                                        <select name="jobTitle" class="form-control py-4" id="inputJobTitle" size="1">
                                                            <option value="Select School">....Job Role...</option>
                                                            <?php 

                                                                        $jobID ='';
                                                                        $jobTitle="";
                                                            $query = "SELECT JobCodes, JobTitles FROM Jobs";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $jobID = $schl ['JobCodes'];
                                                                $jobTitle = $schl ['JobTitles'];
                                                               echo $jobTitle .="<option value='$jobID'>$jobTitle</option>";

                                                            }

                                                                    //echo  $jobTitle;
                                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                               </div>
                                          
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="addAdmin" class="btn btn-primary btn-block">Add Admin Staff</a></div>
                                             </div>
                                        </form>
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