<?php
include_once('../functions.php');
require_once('../connection.php');
$st="";
  confirmLogin();

    //prepare Data
if(isset($_POST['editStd'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $matric= $screenData['matricID'];
     
	              if($query = mysqli_query($con, "Select stateOfOrigin, Citizenship From students Where matricNumber ='$matric'")){
        while ($result = mysqli_fetch_array($query)){
            $st = $result['stateOfOrigin'];
            $citizen = $result['Citizenship'];
        }
        
	   $iD = getStates($con,$st);
	              
	      setcookie('user', $_SESSION['usr'], time()+3600,'/');
	      $_SESSION['usr'] = $matric;
    $schlID ='';
                                                                        $matricID =$_SESSION['usr'];
                                                                        $query="SELECT ID, firstName, middleName, 
                                                                        lastName, stateOfOrigin, studentLevel 
                                                                        FROM students 
                                                                        WHERE matricNumber='$matric'";

                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $StdCode = $schl ['MatricNumber'];
                                                                $stdID = $schl ['ID'];
                                                               $CourseName=$schl['firstName'];
                                                               $CourseCode= $schl['middleName'];
                                                               $CourseUnits = $schl ['lastName'];
                                                               $faculty = $schl['stateOfOrigin'];
                                                              // $depts = $schl ['department'];
                                                               $stdLevel =$schl['studentLevel'] ;
                                                              $_SESSION['fname'] =$CourseName;
                                                              $_SESSION['midName'] = $CourseCode;
                                                              $_SESSION['lname'] = $CourseUnits;
                                                             // $_SESSION['dept'] =$dept;
                                                              $_SESSION['stOrigin'] =$faculty;
                                                              $_SESSION['stdLevel'] =$stdLevel;
                                                              
                                                            }
	      header('location:myProfiles.php?user='.$matric. '&& Id='.$iD);
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
        <script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getStaffs.php?q="+str,true);
  xmlhttp.send();
}
</script>
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
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
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
                                    <a class="nav-link" href="#layout-static.html">Load Courses</a>
                                    <a class="nav-link" href="#layout-sidenav-light.html">Load Units</a>
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
                                        Connect  HOD 
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="setLectures.php">Assign Courses</a>
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
                                            <a class="nav-link" href="#">Load Results</a>
                                            <a class="nav-link" href="#">Process Results</a>
                                            <a class="nav-link" href="#">Approve Results</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Add Staff Admin</div>
                            <a class="nav-link" href="addStaff.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Add Staff Admins
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Lectureer's Course Assignment Panel</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="#" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department Code</label> <span style="color:red; font-size:9px;">&nbsp; &nbsp; (* Select The Department Of the Lectureer You Want TO Assign Course To*)</span>
                                                        <select class="form-control py-4"  name="users" onchange="showUser(this.value)" size="1">
                                                        <option value="0">Select  Dept Code:</option>
                                                            <?php 
                                                    // Fetch Department
                                                                    $dc="";
                                                                    $sql_department = "SELECT ID, DeptID FROM Departments";
                                                                    $department_data = mysqli_query($con,$sql_department);
                                                                    while($row = mysqli_fetch_assoc($department_data) ){
                                                                        $id = $row['ID'];
                                                                        $_SESSION['dptId'] = $id;
                                                                        $deptCode = $row['DeptID'];
                                                                       
                                                                        //$cU = $row['CourseUnits'];
                                                                         $dc .="<option value='$id'>$deptCode</option>";
                                                                          /*$_SESSION['deptCode'] = $deptCode;
                                                                          */ 
                                                                      }
                                                                        // Option
                                                                       
                                                                echo $dc;
                                                                    ?>
                                                                    </select>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter Matric Number" name="matricID" required  Value="<?php if(isset($staffID)){ echo $staffID; }  ?>" />-->
                                                    </div>
                                                </div>
                                                
                                               </div>
                                          <div class="form-group mt-4 mb-0" id="txtHint"><b>Staff Details will be listed here.</b></div>
                                            <!--<div class="form-group mt-4 mb-0"><button type="submit" name="getLectureer" class="btn btn-primary btn-block">Find Lectureer Now</div>-->
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