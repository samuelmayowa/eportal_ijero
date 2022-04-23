<?php
include_once('../../functions.php');
require_once('../../connection.php');
//confirmLogin();
$msg="";
$usr="";
$usr=$_SESSION['userID'];
//prepare Data
    $std ="";
    $user ="";

   
                             $qury=mysqli_query($con,"SELECT RegNumber, CONCAT(Surname,' ', MiddleName,' ',FirstName)AS FullName, 
                                                      Gender, PhoneNO,Schools, Departments,StOrigin,LGA
                                    FROM    onlineApplications
                                    Where Acceptance =1");
                                    while($rs= mysqli_fetch_array($qury)){
                                                
                            
                        
                        $std.=  "<tr><td>" .$rs ['RegNumber'] . "</td>" .
        "<td>" . $rs['FullName'] ."</td>".
        "<td>".  $rs['Gender'] . "</td>" .
         "<td>" . $rs ['PhoneNO'] . "</td>" .
         "<td>" . $rs ['Departments'] . "</td>" .
         "<td>" . $rs['StOrigin'] . "</td>" .
          "<td>" . $rs ['LGA'] . "</td>" .
          "<td>" . $rs ['Schools'] . "</td>" .
          "<td>" . $rs ['RefNum']."</td></tr>";
                   
                    }
   


?>



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Sciences And Technology, Ijero-Ekiti" />
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
            <!-- Navbar Search--><h3> College Of Health Sc. and Tech.</h3>
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
                        <a class="dropdown-item" href="../dashboard.php?msg=<?php echo $_GET['msg']; ?>">Admin Dashbaord</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php?msg=<?php echo $_GET['msg']; ?>">Dashboard</a>
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
                            <a class="nav-link" href="dashboard.php?msg=<?php echo $_GET['msg']; ?>">
                                Admission DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Admission Area</div>
                            <a class="nav-link collapsed" href="dashboard.php.php" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Admission Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="screeningResults.php?msg=<?php echo $_GET['msg']; ?>">Screening Results</a>
                                    <a class="nav-link" href="dashboard.php?msg=<?php echo $_GET['msg']; ?>">View All Application</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Payments Records
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Payments Area
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#manageFees.php?msg=<?php echo $_GET['msg']; ?>">View Applicatio</a>
                                            <a class="nav-link" href="#updateFees.php?msg=<?php echo $_GET['msg']; ?>">Update Fees</a>
                                            <a class="nav-link" href="#getAllPayments.php?msg=<?php echo $_GET['msg']; ?>">View All Payments</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Payment Histories
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="uploadPayments.php?msg=<?php echo $_GET['msg']; ?>">Upload Payments</a>
                                            <a class="nav-link" href="#getAllPayments">View All Payments</a>
                                            <a class="nav-link" href="#findPayments.php">Search Payments</a>
                                        </nav>
                                    </div>
                                </nav>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/logo-eschsti.png" width="10%"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Accepted Admissions</h3></div>
                                    <div class="card-body"><span style="" olor:red; font-size:10px;><?php if(isset($msg)) { echo $msg; } ?></span>
                                        <div class="form-group mt-4 mb-0"><button type="submit" name="submit" class="btn btn-primary btn-block">Upload Results</a></div>
                                        </form>
                                    </div>
                                     <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                               <th>MatricNO</th>
                                                <th>FullName</th>
                                                <th>Gender</th>
                                                <th>Phone Number</th>
                                                <th>CourseOfStudy</th>
                                                <th>StateOfOrigin</th>
                                                <th>Local Govt</th>
                                                <th>Faculty</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>MatricNO</th>
                                                <th>FullName</th>
                                                <th>Gender</th>
                                                <th>Phone Number</th>
                                                <th>CourseOfStudy</th>
                                                <th>StateOfOrigin</th>
                                                <th>Local Govt</th>
                                                <th>Faculty</th></tr>
                                        </tfoot>
                                        <tbody>
                                            <?php echo $std; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-group mt-4 mb-0"><a href="dashboard.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block"> >> Return Back  << </button></a></div>
                                                        <div class="form-group mt-4 mb-0"><a href="../logout.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Logout Here </button></a></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-4 mb-0"><a href="expAccepted.php"><button type="button" name="expDepAppl" class="btn btn-primary btn-block">Download All Accepted Admission</button></a></div>
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
                </footer>  <div style="padding-left:30px;">
       </div>
            </div>
          
        </div>
        
         <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/datatables-demo.js"></script>
    </body>
</html>

<?php 
require('../../close_connection.php');

?>
