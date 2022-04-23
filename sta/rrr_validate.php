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
                            $_SESSION['amt'] = $screenData['fees'];
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

$username = $_SESSION['stdEmail'];
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
                                  <p id="response"></p>
                                    <div class="card-body">
                                        <form name="SubmitRemitaForm" id="form-rrr" method="POST">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Input RRR Here</label></label>
                                                       
                                             <input class="form-control py-4" id="rrr_value" name="rrr_value" type="number" placeholder="Input RRR Here"  value="" required/>
                                             
                                             <input name="merchantId" value="<?php  ?>" type="hidden">

<!--<input name="merchantId" value="2547916" type="hidden">-->

<input name="hash" value="<?php  ?>" type="hidden">

<!--<input name="hash" value="4f33dc2478836218506a12b4bb512f711eaadbf9ea521ba443a8da1bd233bf234c6f62d23b91675db2467aa2586e3d5f49e37cd594361c0938f30349410282cb"type="hidden">-->



<!--<input name="rrr" value="280008217946" type="hidden">-->

<input name="responseurl" value="<?php  ?>" type="hidden">


                                                    </div>
                                                </div>
                                                
                                                
                                                
                                               
                                           
                                       
                                            
                                         </div>
                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                        <!--<script src="https://remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>-->
                                                          
                                                          <!--<script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>-->
                                            <div class="form-group mt-4 mb-0"></div>
                                            <button type="submit" name="payments_submit" id="payments_submit" class="btn btn-primary btn-block" > Validate Payment Now </button>
                                            
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
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        

 <script type="text/javascript">
            $(document).ready( function(){
                
         $('#form-rrr').submit(function(e){
                    e.preventDefault()
                    var rrr = $("#rrr_value").val();
                    
                $("#payments_submit").prop('disabled', true);
                      
        $.ajax({   
                            url:"/studentArea/rrr-paymentstatus-application.php?user=<?php echo $username; ?>&rrr="+rrr+"&orderId=<?php  ?>",
                            type: 'POST',
                            cache:false,
                            //data: dataString,
                            beforeSend: function() {},
                            timeout:10000,
                            error: function() {
                                /*Swal.fire({
                                title: "Error!",
                                text: "Error. Refresh and try again!",
                                type: "error",
                                confirmButtonClass: 'btn btn-primary',
                                buttonsStyling: false,
                                });*/
                             },    
                            success: function(response) {
                                 var data = JSON.parse(response);
                                $("#response").html(data.message+', Please wait, you will be redirected in few seconds...');
                               // alert("Deposit Placed");
                                /*Swal.fire({
                                title: "Success!",
                                text: "Success. "+response,
                                type: "success",
                                confirmButtonClass: 'btn btn-success',
                                buttonsStyling: false,
                                });*/
                                
                                if(data.message === 'Payment successful and approved'){
                                    setTimeout(function() { 
                                    window.location.href = "/studentArea/receipts.php?dr="+data.check;
                                    
                                    }, 6000);
                                }else if(data.message === ''){
                                    setTimeout(function() { 
                                    window.location.href = "/studentArea/dashboard.php?msg="+data.message;
                                    //location.reload();
                                    }, 6000);
                                }else if(data.message === 'Payment not successful'){
                                    setTimeout(function() { 
                                    window.location.href = "/studentArea/dashboard.php?msg="+data.message;
                                   
                                    }, 6000);
                                }else if(data.message === 'RRR not generated in favor of this Merchant'){
                                    setTimeout(function() { 
                                    window.location.href = "/studentArea/dashboard.php?msg=RRR not generated in favor of this Merchant";
                                   
                                    }, 6000);
                                }
                            
                            } 
                        });
         })          
    });
                        
       </script>
    </body>
</html>
