<?php
include_once('../../functions.php');
require_once('../../connection.php');
$st="";
  confirmLogin();
  $regNum=="";
   $cCode="";
   $cName="";
   $cUnits=="";
   $regAs ="";
   $stdL="";
   $total="";
   $user="";
if(isset($_GET['msg'])){
    $msg=$_GET['msg'];
}
    //prepare Data
    $std ="";
    $user ="";
    $dpt="";
if(isset($_GET['stdId'])){
    $stdId = $_GET['stdId'];
    echo "<script>alert('$stdId');</script>";
    $user = $_GET['user'];
    $dpt=$_GET['dpt'];
    if(!empty($stdId)){
        $query = mysqli_query($con, "SELECT  RegNumber, CONCAT(FirstName,' , ',  MiddleName,'  ',  Surname) AS FULLNAME,
                                            PhoneNO, Departments,Schools, StOrigin,AmountPaid,Gender  
                                    FROM    onlineApplications
                                    Where   ID ='$stdId'");
                    while($rs= mysqli_fetch_array($query)){
                        $regNum=$rs['RegNumber'];
                        $dtp=$rs ['Departments'];
                        $_SESSION['dpt']= $dpt;
                        $fname=$rs['FULLNAME'];
                        $gender=$rs['Gender'];
                        $phno= $rs['PhoneNO'];
                        $dpt= $rs['Departments'];
                        $facs= $rs['Schools'];
                        $states=$rs['StOrigin'];
                        $std.=  "<tr><td>" .$rs ['RegNumber'] . "</td>" .
        "<td>" . $rs['FULLNAME'] ."</td>". "<td>".  $rs['PhoneNO'] . "</td>" .
         "<td>" . $rs ['Departments'] . "</td>" .
         "<td>" . $rs ['RefNum'] . "</td>" .
         "<td>" . $rs['StOrigin'] . "</td>" .
          "<td>" . $rs ['AmountPaid'] . "</td>" .
          "<td>" ."<a href='grantAdm.php?cc=$id && msg=$msg' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure You Want to Admit This Student?')\">Admit</a>
                    <a href='#admtToOther.php?cc=$id && msg=$msg && dpt=$dpt' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure You Want To Admit this Studenty Into Another Department?')\">Admit into Another Dept</a></td>" .
          
          "</tr>";
                    }
    }
}
$user=$_GET['msg'];
$rs="";
echo "<script>alert('$user');</script>";
    if(isset($_POST['admit'])){
         $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
         $regNum =$screenData['regNum'];
         $dpt=$screenData['dept'];
         if(empty($dpt)){
             $dpt=$screenData['dpt'];
         }
        if(!empty($regNum)){
            $rs=mysqli_num_rows(confirmResultsUploaded($con,$regNum));
          if($rs==0){
              header('location:dashboard.php?msg=$user && upd=Your Results Has not been Uploaded for Admission Processing');
          }else{
              if($rs>=1){
                  $query=confirmResultsUploaded($con,$regNum);
                 while ($result = mysqli_fetch_array($query)){
                     $avg= $results['Average'];
                     if($avg<15){
                         header('location:dashboard.php?msg='.$user.' && upd=Your Results Results Did not Meet Admission Requirement');
                     }else{
                         echo "<script>alert('You have been Admitted into: $dpt );</script>";
                     }
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
                                            <a class="nav-link" href="login.html">Assign Courses</a>
                                            <a class="nav-link" href="register.html">Add New</a>
                                            <a class="nav-link" href="password.html">Add Departments</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">Load Results</a>
                                            <a class="nav-link" href="404.html">Process Results</a>
                                            <a class="nav-link" href="500.html">Approve Results</a>
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Applicants Admission Manager</h3></div>
                                  
                                    <div class="card-body">
                                       
                                          
                                            
                                                
                                               </div>
                                          <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                My Students In : <span style="color:red; font-size:18px;"><?php echo strtoupper($dpt); ?></span> 
                            </div>
                            <div class="card-body">
                                        <form action="admtToOther.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg1; echo  "   ID:". $_GET['stdId']; } ?></span><span style="color:red; font-size:18px;"><?php if(isset($_GET['stdId'])) { echo $_GET['stdId']; } ?></span>
                                            <div class="form-row">
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Registration Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="" name="regNum" value="<?php echo $regNum; ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                                
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" name="fname" value="<?php if(isset($fname)){ echo $fname; } ?>" readonly required/>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Phone Number</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" name="phno" value="<?php if(isset($phno)){ echo $phno; } ?>" readonly required/>
                                                    </div>
                                                </div>
                                           
                                       
                                            <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Department </label>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <select name="dpt" class="form-control py-4" id="inputDepartment" size="1" readonly>
                                                            <option value="Select Category"><?php if(isset($dpt)){ echo $dpt; } ?></option>
                                                           
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Faculty Code</label>
                                                        <select name="schools" class="form-control py-4" id="inputFirstName" size="1" readonly>
                                                                <option value="Select Category"><?php if(isset($facs)){ echo $facs; } ?></option>
                                                           
                                                            </select>
                                                        <!--<input class="form-control py-4" id="inputConfirmPassword" name="StdCat" type="text" placeholder="CATEGORY ** ND, DIP, HND"  required/>-->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">State Of Origin</label>
                                                        <input class="form-control py-4" id="inputFirstName" name="CourseUnits" type="text" placeholder="Course Units" value="<?php if(isset($states)){ echo strtoupper($states); } ?>" readonly required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Gender</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Level (100L)" value="<?php if(isset($gender)){ echo $gender; } ?>"   name="gender" readonly required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Admit Into New Department</label>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Department Course Domicile"  name="dept" />-->
                                                        <select name="dept" class="form-control py-4" id="inputNewDepartment" size="1">
                                                            <option value="">....Select Department Id...</option>
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
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="admit" class="btn btn-primary btn-block">Admit NOW</div>
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