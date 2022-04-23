<?php
include_once('../../functions.php');
require_once('../../connection.php');
$id="";
  confirmLogin();
  $stTitle="";
   $fname="";
   $lname="";
   $jobs="";
   $desig="";
   $deptCode="";
   $phno="";
   $staffCode="";
$screenData = filter_var_array($_GET, FILTER_SANITIZE_STRING);
if(isset($_GET['id'])){
$id = $_GET['id'];
$query=mysqli_query($con, "Select * From Staffs Where ID ='$id'");
while ($row=mysqli_fetch_array($query)){
     $stTitle = $row['Title'];
     $staffCode= $row['StaffCode'];
     $fname= $row['FirstName'];
     $lname= $row['Surname'];
      $jobs= $row['Job_Role'];
     $desig= $row['Designation'];
     $deptCode= $row['DeptID'];
     $phno= $row['PhoneNumber'];
}
}
    //prepare Data
if(isset($_POST['editStaff'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $id=$screenData['stID'];
     $stTitle = $screenData['title'];
     $staffCode= $screenData['staffCode'];
     $fname= $screenData['fname'];
     $lname= $screenData['lname'];
      $jobs= $screenData['jobs'];
     $desig= $screenData['desig'];
     $deptCode= $screenData['deptCode'];
     $phno= $screenData['phno'];

    
      
 // ======= Update Staff Details =====
   
     $query=mysqli_query($con,"Update Staffs SET StaffCode='$staffCode', FirstName='$fname', SUrname='$lname', Job_Role='$jobs', Designation='$desig', DeptID='$deptCode', PhoneNumber='$phno' WHERE ID='$id'");
        if(!$query){  
        $msg="Unable to Add Staf Member".mysqli_error($con);
        $msg="<script> alert('$msg');</script>";
        }  else {
            $msg="Staff Details Changed Successfully";
            $msg="<script> alert('$msg');</script>";
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
                        <a class="dropdown-item" href="../manageLectures.php">Admin Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
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
                                            <a class="nav-link" href="login.html">Assign Courses</a>
                                            <a class="nav-link" href="addCourses.php">Add New</a>
                                            <a class="nav-link" href="manageLectures.php">ManageCourses</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        <!--Student Assessment-->
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#">Load Results</a>
                                            <a class="nav-link" href="#">Process Results</a>
                                            <a class="nav-link" href="#">Approve Results</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">News</div>
                            <a class="nav-link" href="manageLectures.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                View All Lecturers
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Edit Staff Members Details for Portal Use</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="editStaff.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span> 
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input class="form-control py-4" id="inputFirstName" type="hidden" placeholder="Enter Title" name="stID" value="<?php echo $id; ?>" required />
                                                    <span style="color:green; font-size:18px;"><a href="dashboard.php?msg=<?php echo $_SESSION['userID']; ?>"> >>> Return Back <<<< </a> </span>
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Staff Title:</label></label><span style="color:red; font-size:10px;">**MR**DR**ENGR**PROF**MRS**</span>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter Title" name="title" value="<?php echo $stTitle; ?>" required />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Staff Code</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter your Staff Code" name="staffCode" value="<?php echo $staffCode; ?>"  required readonly />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                 <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Surname</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Enter Your SurName" name="lname" value="<?php echo $lname; ?>" required />
                                            </div>
                                            </div>
                                           <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">First Name</label></label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Enter Your FirstName" name="fname" value="<?php echo $fname; ?>" required />
                                            </div>
                                            </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department Code </label></label><span style="color:red; font-size:10px;"> * Department Code Where The Lectureer is Domicile*</span>
                                                        <!--<input class="form-control py-4" id="inputdeptCode" type="text" placeholder="Select Department Code" name="deptCode" value="<?php echo $deptCode; ?>" required />-->
                                                         <select name="deptCode" class="form-control py-4" id="inputFirstName" size="1">
                                                          <option value="<?php echo $deptCode; ?>">....Select Designation...</option> 
                                                        <?php 
                                                    // Fetch Department
                                                $dc="";
                                                $dptname="";
                                                $sql_department = "SELECT ID, DeptID,DeptName FROM Departments";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    $id = $row['ID'];
                                                    $dptname=$row['DeptName'];
                                                    $deptCode = $row['DeptID'];
                                                    $dc .="<option value='$id'>$deptCode($dptname)</option>";   
                                                  }
                                                  echo $dc;
                                                ?> </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Contact Phone Number</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Staff Phone Number" name="phno" value="<?php echo  $phno; ?>"  required />
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                            <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Staff Designation </label><span style="color:red; font-size:10px;">** Staff Duty Position In The School ** Lecturer ** Admin** Bursary etc. **</span>
                                                      <!--<input class="form-control py-4" id="inputPassword" name="desig" type="text" placeholder="Undergrate or Post Graduate"  value="<?php echo $desig; ?>" required/>-->
                                                         <select name="desig" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="<?php echo $desig; ?>"><?php echo $desig; ?></option>
                                                             <?php 

                                                                        $jts ='';
                                                                        $jcs ='';
                                                                        $jt ='';

                                                            $query = "SELECT JobCodes ,JobTitles  FROM Jobs";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($pjts = mysqli_fetch_array($query)){
                                                                $jts = $pjts ['JobTitles'];
                                                                $jcs = $pjts ['JobCodes'];
                                                               $jt .= "<option value='$jts'>$jts( $jcs )</option>";
                                                                     } 
                                                                     echo $jt;
                                                                        ?>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Job Title In The Portal</label>
                                                        <select name="jobs" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="<?php echo $jobs; ?>"><?php echo $jobs; ?></option>
                                                            <?php 
                                                                    $jbs ='';
                                                                    $jb="";
                                                            $query = "SELECT JobCodes  FROM Jobs";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($pjbs = mysqli_fetch_array($query)){
                                                                $jbs = $pjbs ['JobCodes'];
                                                               $jb .= "<option value='$jbs'>$jbs</option>";
                                                                     } 
                                                                     echo $jb;
                                                                        ?>
                                                                        </select>
                                                        <!--<input class="form-control py-4" id="inputConfirmPassword" name="StdCat" type="text" placeholder="CATEGORY ** ND, DIP, HND"  required/>-->
                                                    </div>
                                                </div>
                                                </div>
                                                
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="editStaff" class="btn btn-primary btn-block">Save Staff Changes</a></div>
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
