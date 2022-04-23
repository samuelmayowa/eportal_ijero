<?php
require_once('../functions.php');
require_once('../connection.php');
confirmLogin();

$check_fees = getusefeesdata($_SESSION['stdLevel'], $_SESSION['MatricNo'], 'School Fees');
$user = $_SESSION['userID'];
if(empty($_SESSION['stdEmail']) && empty($_SESSION['stdPhno'])){
    header('location:myProfiles.php?msg=You Have Not Updated Your Profile details');
}

//========= Confirm User Have Updated There Profiles ==========

if($stdCat = mysqli_query($con,"Select studentEmail From students WHERE matricNumber ='$user'")){
    while ($cat = mysqli_fetch_array($stdCat)){
        $stdEmail = $cat['studentEmail'];
    }
    if(empty($stdEmail)){
    header('location:myProfiles.php?msg=Your Profile Details Have Not Been Updated');
}
}

//========== End COnfirm user Profiles ==================


confirmPswd();
if(isset($_POST['payments'])){
    if($_SESSION['totalDue']==0){
    header('location:dashboard.php?msg=You have Been Cleared For this SESSION');
} else{
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
                            $matricNumber =  $_SESSION['userID'];
                            if(isset($_POST['payments'])){
                            $_SESSION['email'] =$screenData['email'];
                            $_SESSION['courseCode'] = $screenData['courseCode'];
                            $_SESSION['stdPhno'] = $screenData['stdPhno'];
                            $_SESSION['payType'] = $screenData['payType'];
                            $_SESSION['amt'] = $screenData['amount_to_pay'];
                            $_SESSION['dept'] = $screenData['dept'];
                            $_SESSION['matricNumber'] = $screenData['MatricNumber'];
                            $_SESSION['semester'] = $screenData['semester'];
                            $_SESSION['stdLevel'] = $screenData['stdLevel'];
                            $fname = $_SESSION['fname'];
                            $lname =$_SESSION['lname'];
                            
                            header('location:completePayments.php?userID='.$matricNumber);
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
        <meta name="description" content="College Of Health Science And Technology, Ijero-Ekti" />
        <meta name="author" content="" />
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <style>a { color:white;}</style>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        
         <script src="jquery.min.js"></script>                                                
        <script src="feesJS.js" type="text/javascript"></script> 
        
        
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
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Activity Log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" style="background-color:#20c997;">
            <?php include('sidebar.php')?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Welcome To Student Online Payment System</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="payments.php" method="POST" id="paymentForm">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Email Address</label></label>
                                                       
                                             <input class="form-control py-3" id="email-address" name="email" type="email" placeholder="Email" readonly  value="<?php if(isset($_SESSION['stdEmail'])) { echo $_SESSION['stdEmail']; } ?>" required/>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLevel">Phone Number</label></label>
                                                       
                                             <input class="form-control py-3" id="stdPhno" name="stdPhno" type="text" placeholder="Your Phone Number"  readonly value="<?php if(isset($_SESSION['stdPhno'])){ echo $_SESSION['stdPhno']; } ?>" required/>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPayment">Select Payment Category </label>
                                                        <!--<input class="form-control py-3" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
                                                         <input class="form-control py-3" id="payType" name="payType" type="text" placeholder="School Fees"  readonly value="School Fees" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputSemester">Choose Payment Mode </label>
                                                         <select name="paymode" class="form-control py-40" id="paymode" size="1">
                                                            <option value="select Pay Mode">...Select Category...</option>
                                                            <option value="Fully Paid">FULL PAYMENT</option>
                                                            <option value="First Installment">FIRST INSTALLMENT PAYMENT</option>
                                                            <option value="Second Installment">SECOND INSTALLMENT PAYMENT</option>
                                                            </select>
                                                             </div>
                                                             
                                                </div>
                                                
                                                
                                                </div>
                                               
                                           
                                       
                                            <!--<div class="form-row">-->
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName"> Course Of Study</label></label>
                                                         <input class="form-control py-3" id="inputFirstName" type="text" placeholder="Course Of Study" readonly name="courseCode" value="<?php if(isset($_SESSION['dept'])){ echo $_SESSION['dept']; } ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="amount">Payment Amount </label><span style="color:red; font-size:10px;"> (** Amount Here Is Automatically Calculated By The Portal From Your Initial Balance Due **)</span>
                                                     <input class="form-control py-3" id="amount_to_pay" name="amount_to_pay" type="text" placeholder="Amount"  readonly value="<?php if(isset($amount)){ echo $amount; } ?>" required/>
                                         
                                                    </div>
                                                </div>
                                               </div>
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department</label>
                                                        <input class="form-control py-3" id="inputFirstName" type="text" placeholder="amount"  name="dept" readonly  value="<?php if(isset($_SESSION['dept'])){ echo $_SESSION['dept']; } ?>" />
                                                        
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Matric Number</label></label>
                                                       
                                         <input class="form-control py-3" id="MatricNumber" name="MatricNumber" type="text" placeholder="matricNumber"  value="<?php if(isset($_SESSION['userID'])){
                            echo $_SESSION['userID'];
                        }
                        ?>" readonly required/>
                                                    </div>
                                                </div>
                                         </div>
                                         <div class="form-row">
                                             <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<script src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>-->
                                                          
                                                          <!--<script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>-->
                                            <div class="form-group mt-4 mb-0"></div>
                                            <button type="submit" name="payments" id="payments_submit" class="btn btn-primary btn-block" > INITIALIZE Payment Now </button>
                                            
                                             </div>
                                             </div>
                                             <div class="col-md-6">
                                                 <p class="badge-success" id="info"></p>
                                                 </div>
                                         </div>
                                            
                                        </form>
                                    </div>
                                    </div>
                </main>


        <!--
            GET STARTED WITH YOUR OWN FILES
        -->
        
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        


    </body>
</html>
