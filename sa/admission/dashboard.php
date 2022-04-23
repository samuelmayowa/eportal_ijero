

<?php
include_once('../../functions.php');
require_once('../../connection.php');
confirmAdmLogin();
    //prepare Data
    

$totalRev="";
$totalRev = getTotalRev($con);
if(isset($_GET['msg'])){
    $msg=$_GET['msg'];
    echo "<script> window.alert('$msg');</script>";
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero Ekiti" />
        <meta name="author" content="" />
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../../images/logo-eschsti.png"/>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            td{font-size:12px;}
            td a{ font-size:12px;}
        </style>
    </head>
    
    <body class="sb-nav-fixed">
         <?php include('../topbar.php'); ?>
        
        <div id="layoutSidenav" style="background-color:#20c997;">
            <div id="layoutSidenav_nav" style="background-color:dark; color:lavender;">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color:##20c997;">
                    <div class="sb-sidenav-menu" style="background-color:##20c997;">
                        <div class="nav" style="background-color:#28a745;">
                            <div class="sb-sidenav-menu-heading">ESCOHST-IJERO</div>
                            <a class="nav-link" href="https://eportal.escohsti-edu.ng/staffArea/admission/dashboard.php?msg=<?php echo $_SESSION['userID']; ?>">
                               Admission DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Admission Officer</div>
                            <a class="nav-link collapsed" href="https://eportal.escohsti-edu.ng/staffArea/admission/dashboard.php?msg=<?php echo $_SESSION['userID']; ?>" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Screening Results
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="https://eportal.escohsti-edu.ng/staffArea/uploadPUTMERe.php?msg=msg=<?php echo $_SESSION['userID']; ?>">Upload Screening Results</a>
                                    <a class="nav-link" href="#updateFees.php">View Results</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Admission Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Admission  Area
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="https://eportal.escohsti-edu.ng/staffArea/admission/utrs_updt.php?msg=<?php echo $_SESSION['userID']; ?>">Upload New Admission</a>
                                            <a class="nav-link" href="https://eportal.escohsti-edu.ng/staffArea/admission/uploadPUTMERe.php?msg=<?php echo $_SESSION['userID']; ?>">Update Admission</a>
                                            <a class="nav-link" href="#https://eportal.escohsti-edu.ng/staffArea/admission/getAllPayments.php?msg=<?php echo $_SESSION['userID']; ?>">View All Admission</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#getAllPayments.php">Get All Fees</a>
                                            <a class="nav-link" href="#UpdateFees.php">Update Fees</a>
                                            <a class="nav-link" href="#getAllPayments.php">Find Payments</a>
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
                       
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Applications and Admission Management Systems </h3></div>
                                  <span style="color:red; font-size:18px;"><?php if(isset($_GET['upd'])){ echo  $_GET['upd']; } ?></span>
                                    <div class="card-body"> 
                                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Gross Total Revenue: <?php if(isset($totalRev)){ setlocale(LC_MONETARY,"ig_NG"); /*echo sprintf("%0.2f", $totalRev);*/ /*echo money_format("%i ", $totalRev);*/ } ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="courseManager.php?msg=<?php echo $_GET['msg']; ?>"><?php if(isset($totalRev)){ setlocale(LC_MONETARY,"ig_NG"); /*echo sprintf("%0.2f", $totalRev);*/ /*echo money_format("%i ", $totalRev);*/ } ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Application Received: <?php echo getTotalAppl($con); ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between"><?php echo getCompleted($con); ?>
                                        <a class="small text-white stretched-link" href="completedAppl-xls.php?msg=<?php echo $_GET['msg']; ?>">Download All Completed</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Total Invoices Generated: <?php echo getAllApplInvoices($con); ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">Total Unpaid RRR: <?php echo getUnpaid($con); ?>
                                        <a class="small text-white stretched-link" href="#getFeesDetails.php?msg=<?php echo $_GET['msg']; ?>">Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Total Appl.Form Revenue: <?php setlocale(LC_MONETARY,"ig_NG"); /*echo sprintf("%0.2f", $totalRev);*/ echo money_format("%i ", getTotalFormRev($con));  ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#admission/dashbaord.php?msg=<?php echo $_GET['msg']; ?>"><?php setlocale(LC_MONETARY,"ig_NG"); /*echo sprintf("%0.2f", $totalRev);*/ echo money_format("%i ", getTotalFormRev($con));  ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                            
                             <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Edit Application Details</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="https://eportal.escohsti-edu.ng/staffArea/edit_Application.php?msg=<?php echo $_GET['msg']; ?>">Go To Applicants Data Manager</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">All Uncompleted Applications: <?php echo getUncompleted($con); ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="unCompleted-PDF.php?msg=<?php echo $_GET['msg']; ?>">Dowload Now</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Dowload Student Data Sheets </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#../studentSheets.xlsx?msg=<?php echo $_GET['msg']; ?>">Download Student DataSheet TO Upload Student Data</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Unpaid Invoices: <?php echo getUnpaid($con); ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between"> <?php echo getUnpaid($con); ?>
                                        <a class="small text-white stretched-link" href="unPaidInvoices-PDF.php?msg=<?php echo $_GET['msg']; ?>">Download Now</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                         
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Enter Fees For All Services</label>
                -->                                        <div class="form-group mt-4 mb-0"><a href="https://eportal.escohsti-edu.ng/staffArea/uploadPUTMERe.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Upload Screening Results</button></a></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Upload Admissions</label>
                -->                                        <div class="form-group mt-4 mb-0"><a href="utrs_updt.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Upload NEW Admission List</button></a></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Upload Admissions</label>
                -->                                        <div class="form-group mt-4 mb-0"><a href="uploadPUTMERe.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">UPDATE Existing Admission File Upload</button></a></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                            <div class="mt-4 mb-0">
                                                <a  href="https://eportal.escohsti-edu.ng/staffArea/photo_cardCheck.php" name="printCourseForm" class="btn btn-primary btn-block" >Verify Student</a></div>
                                        </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Update Fees For All Services</label>
            -->                                            <div class="form-group mt-4 mb-0"><a href="allAdmitted.php"><button type="button" name="addFees" class="btn btn-primary btn-block">View All Admitted Student</button></a></div>
                                                    </div>
                                                </div>
                                              
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Upload Existing Student payments</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="acceptedAdm.php"><button type="button" name="resetPswd" class="btn btn-primary btn-block">View Accepted Admissions</button></a></div>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Download All Students Payments</label>
    -->                                                    <div class="form-group mt-4 mb-0"><a href="expAllAppls.php"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Download All Applications TO PDF</button></a></div>
                                                    </div>
                                                </div>
                                          
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Download All Students Payments</label>
    -->                                                    <div class="form-group mt-4 mb-0"><a href="completedAppl-xls.php"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Download All Applications To EXCEL</button></a></div>
                                                    </div>
                                                </div>
                                             </div>
                                             
                                        </form>
                                        
                                        
                                    </div>
                                   
                                   <div class="card mb-4">
                            <div class="card-header" style="color:green;">
                                <i class="fas fa-table mr-1"></i>
                                <marquee behavior="scroll" direction="left" scrollamount="1" style="color:red;">All Application received So Far: <?php echo getTotalAppl($con); ?></marquee>
                            </div>
                               
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                                <!--<th>RegNumber</th>
                                                <th>FullName</th>
                                                <th>PhoneNumber</th>-->
                                                <th>Department</th>
                                                <!--<th>RefNumber</th>
                                                <th>StateOfOrigin</th>-->
                                                <th>Number Of Student IN Departmt</th>
                                                <th>Action</th>
                                                
                                           
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <!--<th>RegNumber</th>
                                                <th>FullName</th>
                                                <th>PhoneNumber</th>-->
                                                <th>Department</th>
                                                <!--<th>RefNumber</th>
                                                <th>StateOfOrigin</th>-->
                                                <th>Number Of Student IN Departmt</th>
                                                <th>Action</th>
                                                
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php echo getAllAppls($con); ?>
                                        </tbody>
                                    </table>
                                     <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                        <div class="form-group mt-4 mb-0"><a href="expAllAppls.php"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Download All Applications</button></a></div>
                                                    </div>
                                                </div>
                                </div>
                            </div>
                        </div>
                </main>
                <?php if(isset($_GET['upd'])){ echo $_GET['upd'];  } ?>
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