<?php
include_once('../functions.php');
require_once('../connection.php');

  confirmLogin();
//======== Get All Fees Details For Edit ==========
$id="";
if(isset($_GET['cc'])){
    $id=$_GET['cc'];
    $results=getFees($con,$id);
    while($row=mysqli_fetch_array($results)){
        $ID =$row['ID'];
        $payType =$row['payCategories'];
        $amt =$row['Amount'];
        $citizen =$row['Citizenship'];
        $semester =$row['Semester'];
        $sess =$row['AcademicSession'];
        $Level =$row['Level'];
        $ProgType =$row['ProgType'];
        
    }
}
    //prepare Data
if(isset($_POST['updateFees'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $descr = $screenData['progType'];
     $amount= $screenData['amount'];
     $payType = $screenData['payType'];
      $id= $screenData['id'];
     $Category = $screenData['Category'];
     $semester= $screenData['semester'];
     $sessionYear = $screenData['sess'];
        $query = mysqli_query($con,"UPDATE paymentCategories SET Amount ='$amount' , payCategories ='$payType',  ProgType='$descr',	payCategories  = '$Category', Semester = '$semester', AcademicSession ='$sessionYear'   WHERE ID ='$id'");
     if($query){
         $msg="<script> alert('Payments Updated Successfully'); </script>";
     } else {
         $msg="Unable To Add Payment : ".mysqli_error($con);
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
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        
          <script src="jquery.min.js"></script>                                                
        <script src="feesID.js" type="text/javascript"></script> 
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
                        <a class="dropdown-item" href="manageFinance.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manageFinance.php">Dashboard</a>
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
                            <a class="nav-link" href="manageFinance.php">
                                Bursary Admin DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Bursary Area</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Bursary Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="uploadPayments.php">UPLOAD Existing Payments</a>
                                    <a class="nav-link" href="#getAllPayments.php">View ALl</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="manageFinance.php" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Bursary Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Manage Finance
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="manageFinance.php">Assign Fees</a>
                                            <a class="nav-link" href="manageFees.php">Add New Fees</a>
                                            <a class="nav-link" href="updateFees.php">Update Fees</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="manageFinance.php" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        View All Student payments
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="manageFees.php">Add New Fees</a>
                                            <a class="nav-link" href="updateFees.php">Update Fees</a>
                                            <a class="nav-link" href="#getAllPayments.php">View Fees</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="#charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Updates
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Update Payment Fees</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="updateFees.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Enter New Fees</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter Amount" name="amount" required  Value="<?php if(isset($amt)){ echo $amt; }  ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Payments Type(Fee Type)</label>
                                                         <select name="payType" class="form-control py-4" id="payType" size="1">
                                                            <option value="Select Category">....Select Payment...</option>
                                                            <?php 
                                                                       $amountPayable="";
                                                                       $query = "SELECT payCategories FROM paymentCategories ORDER BY payCategories";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                // $amountPayable = $schl ['Amountpayable'];
                                                                 $payType = $schl ['payCategories'];
                                                                echo "<option value='$payType'>$payType</option>";
                                                               } ?>
                                                            </select>
                                                    </div>
                                                </div>
                                               </div>
                                                 
                                           
                                       
                                            <div class="form-row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Description Of Payments</label> </label>
                                                       <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Description Of Payments"  name="details" Value="<?php if(isset($deptUnit)){ echo $deptUnit; }  ?>" required />
                                                    </div>
                                                </div>
                                           <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Previous Amount Charged</label>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Faculty Dept is Domicile"  name="school" Value="<?php if(isset($school)){ echo $school; }  ?>" required />-->
                                                        <select name="fid" class="form-control py-4" id="fid" size="1" readonly>
                                                            <option value="Select School">....Select ...</option>
                                                        </select>
                                                    </div>
                                                </div>
                                               </div>
                                                <div class="form-row">
                                              <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Payment Category</label>
                                                        <select name="Category" class="form-control py-4" id="payCat" size="1">
                                                            <option value="Select Category">....Select Payment Category...</option>
                                                            <option value="INDIGENE">Indegene</option>
                                                            <option value="NON-INDIGENE">Non-Indigen</option>
                                                            <option value="General">General</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Semester</label>
                                                        <select name="semester" class="form-control py-4" id="payCat" size="1">
                                                            <option value="Select Category">..Select Semester as Applicable..</option>
                                                            <option value="first">First</option>
                                                            <option value="Second">Second</option>
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
                                                            <option value="2017/2018">2017/2018</option>
                                                            <option value="2019/2020">2019/2020</option>
                                                            <option value="2021/2022">2021/2022</option>
                                                            <option value="2023/2024">2023/2024</option>
                                                            <option value="2025/2026">2025/2026</option>
                                                            <option value="2027/2028">20272028</option>
                                                            </select>
                                                    </div>
                                                </div>
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
                                                        <label class="small mb-1" for="inputFirstName"></label>
                                                        <input class="form-control py-4" id="inputYear" type="hidden" placeholder="Enter Year" name="id" required  Value="<?php if(isset($id)){ echo $id; } ?>" min="2020" max="2050" />
                                                    </div>
                                                </div>
                                                
                                                </div>
                                          
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="updateFees" class="btn btn-primary btn-block">Update Fees</a></div>
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
        <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
      
    </body>
</html>

<?php 
require('../close_connection.php');

?>