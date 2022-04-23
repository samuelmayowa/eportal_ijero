<?php
include_once('../../functions.php');
require_once('../../connection.php');

  confirmLogin();

    //prepare Data
if(isset($_POST['addFees'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $amount = $screenData['amount'];
     $payType= $screenData['payType'];
     $Category = $screenData['Category'];
     $semester= $screenData['semester'];
     $sessionYear = $screenData['sess'];
     $level = $screenData['level'];
     $progType = $screenData['progType'];
     $lastUpdated = date('Y'-'M'-'D');
     $ratios= $screenData['ratios'];
     $checkpaymentExists="";
     if(!empty($semester)){
         $sql_department = "SELECT ID, DeptID, DeptName,FacID FROM Departments Where DetpID='$semester'";
                                                $department_data = mysqli_query($con,$sql_department);
                                                if(mysqli_num_rows($department_data) >=1){
                                                    $msg1="Payment Already Added for This department";
                                                    $msg="<script> alert('Payment Already Added for This department'); </script>";
                                                }else{
                                                    $query = mysqli_query($con,"INSERT INTO paymentCategories(Amount, payCategories,Citizenship, PayPercentages, Department,AcademicSession,Level, ProgType) VALUES('$amount', '$payType','$Category','$ratios', '$semester','$sessionYear','$level','$progType')");
             if($query){
                 $msg="<script> alert('Payments  Added Successfully'); </script>";
             } else {
                 $msg="Unable To Add Payment : ".mysqli_error($con);
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
        <meta name="description" content="College Of Health Science And Technology, Ijero-Ekiti" />
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
                            <a class="nav-link" href="dashboard.php">
                                Bursary DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Staff Area</div>
                            <a class="nav-link collapsed" href="dashboard.php" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Bursary Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="manageFees.php">Add New Fees</a>
                                    <a class="nav-link" href="updateFees.php">Update Fees</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Bursary Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Auditor Area
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="manageFees.php">Add New Fees</a>
                                            <a class="nav-link" href="updateFees.php">Update Fees</a>
                                            <a class="nav-link" href="getAllPayments.php">View All Fees</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#getAllPayments.php">Get All Fees</a>
                                            <a class="nav-link" href="updateFees.php">Update Fees</a>
                                            <a class="nav-link" href="getAllPayments.php">Find Payments</a>
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Manage Payment Fees</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="manageFees.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } echo $msg1; ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Enter New Fees Amount</label> [<span style="Color:red; font-size:14px;">Total Amount Payable</span>]
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter Amount" name="amount" required  Value="<?php if(isset($deptID)){ echo $deptID; }  ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Payments Type(Fee Type)</label>
                                                        <select name="payType" class="form-control py-4" id="payType" size="1">
                                                            <option value="Select one">..Select Fee Type..</option>
                                                            <option value="Application Form Fees">Application Form Fees</option>
                                                             <option value="Compulsory Fees">Compulsory Fees</option>
                                                              <option value="School Fees">School Fees</option>
                                                               <option value="Certificate Fee">Certificate Fees</option>
                                                               <option value"Acceptance"> Acceptance  Fees</option>
                                                            <option value="Scratch Pin">Scratch Pin</option>
                                                            <option value="Application Fees"> Application Fees</option>
                                                            </select>
                                                    </div>
                                                </div>
                                               </div>
                                               <div class="form-row">
                                              <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Citizenship</label>
                                                        <select name="Category" class="form-control py-4" id="payCat" size="1">
                                                            <option value="Select Category">..Select Payment Citizen..</option>
                                                            <option value="INDIGENE">School  Fees(Indigene)</option>
                                                            <option value="NON-INDIGENE">School Fees (Non-Indigene)</option>
                                                            <option value="All Citizen">General</option>
                                                            
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department</label>: <!--<span style="color:red;"> Optional</span>-->
                                                        <select name="semester" class="form-control py-4" id="semester" size="1">
                                                            <option value="Select Category">..Select Department as Applicable..</option>
                                                            <?php 
                                // Fetch Department
                                                $dc="";
                                                $depN="";
                                                $sql_department = "SELECT ID, DeptID, DeptName,FacID FROM Departments Order By DeptID";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    $id = $row['ID'];
                                                    $depN = $row['DeptName'];
                                                    $deptCode = $row['DeptID'];
                                                     $dc .="<option value='$deptCode'>$depN($deptCode)</option>";
                                                    
                                                }
                                                    echo $dc;
                                                ?> 
                                                            </select>
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="form-row">
                                              <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Academic Session</label>
                                                        <select name="sess" class="form-control py-4" id="sess" size="1">
                                                            <option value="Select Category">..Select Session..</option>
                                                            <option value="2015/2016">2015/2016</option>
                                                            <option value="2016/2017">2016/2017</option>
                                                            <option value="2017/2018">2017/2018</option>
                                                            <option value="2018/2019">2018/2019</option>
                                                            <option value="2019/2020">2019/2020</option>
                                                            <option value="2020/2021">2020/2021</option>
                                                            <option value="2021/2022">2021/2022</option>
                                                            <option value="<?php $y=date("Y"); echo $y .'/';  $d=date("Y"); echo $d+=1; ?>"><?php $y=date("Y"); echo $y .'/';  $d=date("Y"); echo $d+=1; ?></option> 
                                                            </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Fees For Level</label>
                                                        <select name="level" class="form-control py-4" id="FeeLevel" size="1">
                                                            <option value="Select Category">..Select Level..</option>
                                                            <option value="100">100 Level</option>
                                                            <option value="200">200 Level</option>
                                                            <option value="300">300 Level</option>
                                                            <option value="400">400 Level</option>
                                                            <option value="500">500 Level</option>
                                                            <option value="600">600 Level</option>
                                                            <option value="Extra">Extra Year</option>
                                                             <option value="Admission">Admission</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="form-row">
                                              <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Programme Type</label>
                                                        <select name="progType" class="form-control py-4" id="PaySess" size="1">
                                                            <option value="Select Category">..Select Programme..</option>
                                                            <option value="Certificate">Basic Certificate </option>
                                                            <option value="Diploma(ND)">Diploma(ND)</option>
                                                            <option value="Higher Diploma(HND)">Higher Diploam(HND)</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Payment Percentage Ratio: </label> [<span style="color:red; font-size:14px;">Select Installment Percent Ratio</span>]
                                                        <select name="ratios" class="form-control py-4" id="PaySess" size="1">
                                                            <option value="Select Percentage">..Select Percentage Ratio.</option>
                                                            <option value="0.60"> First Installment [60%] </option>
                                                            <option value="0.70">First Installment [70%]</option>
                                                            <option value="100">No Installment [100%]</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                </div>
                                                
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="addFees" class="btn btn-primary btn-block">Add Fees Payment</a></div>
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
require('../../close_connection.php');

?>