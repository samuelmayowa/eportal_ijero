<?php
require_once('../functions.php');
require_once('../connection.php');
//confirmLogin();



$screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    $matricNumber =  $_SESSION['userID'];
if(isset($_POST['generate_rrr'])){
    $email =$screenData['email'];
    $name = $_SESSION['fname'].' '.$_SESSION['lname'];
    $narration = $screenData['narration'];
    $amount = $screenData['amount'];
    $rrr = $screenData['rrr_value'];
    $_SESSION['dept'] = $screenData['dept'];
    $_SESSION['matricNumber'] = $screenData['MatricNumber'];
    $_SESSION['semester'] = $screenData['semester'];
    $phone = $_SESSION['stdPhno'];
    
    $statusCode = $screenData['rrr_statuscode'];
    $orderID= $_SESSION['orderID'];
    $stdID= $screenData['MatricNumber'];
    if($statusCode == '025' && !empty($rrr)){
        if( $_SESSION['stdLevel'] == 'Prospective'){
            $level = 100;
        }else{
            $level = $_SESSION['stdLevel'];
        }
        $type = $narration;
        $status_p = 'Payment Reference generated';
        $status_s = 'Successful';
        $stdID = $user_id = $screenData['MatricNumber'];
        $rrdata_p = getfeesWithType($level, $stdID,$status_p,$type,$con);
        $rrdata_s = getfeesWithType($level, $stdID,$status_s,$type,$con);
        if(!empty($rrdata_p) && !empty($rrdata_s)){
            $success= saveInvoice($level, $stdID,$amount,$type,$orderID,$rrr,$status_p,$con);
        }
    
}else{
    header('location:payments.php?msg=SchoolFees');
}
}
$sha_value =  $orderID = $apiKey = "";
$seletFromID = 2;
$MerchantID = apiCredential($seletFromID, 'MerchantID');
//$ServiceTypeID = apiCredential($seletFromID, 'ServiceTypeID');
$ser_id = 3;
$ServiceTypeID = ServiceTypeID($ser_id, 'Value');
$ApiKey = apiCredential($seletFromID, 'ApiKey');
$ApiKey = apiCredential($seletFromID, 'ApiKey');


$hash_value =hash("sha512",$MerchantID.$rrr.$ApiKey);
    
    $responseUrl = 'https://'.$_SERVER['SERVER_NAME'].'/studentArea/response_fees.php';
   
?>
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
         <link href="cssRm.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <!--<script src="http://www.remitademo.net/payment/v1/remita-pay-inline.bundle.js"></script>-->
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
                        <a class="dropdown-item" href="myProfiles.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Confirm Payment</h3></div>
                                  
                                    <div class="card-body">
                                    
<form >
    <ul class="form-style-1">
        <li>
            <label>Full Name <span class="required">*</span></label>
            <input type="text" id="js-firstName" value="<?php if(isset($name)){
                            echo $name;
                        }?>" name="fullname" class="form-control py-4" placeholder="First" readonly required />&nbsp;
                        
        </li>
        <li>
            <label>Phone <span class="required">*</span></label>
            <input type="text" id="js-lastName" value="<?php if(isset($phone ) ){
                            echo $phone;
                        }?>" name="phone" class="form-control py-4" placeholder="phone" readonly  required/>
        </li>
        <li>
            <label>Email <span class="required">*</span></label>
            <input type="email" id="js-email" value="<?php if(isset($email)){
                            echo $email;
                        }
                        ?>"  readonly required name="email" class="form-control py-4"/>
        </li>
        <li>
            <label>Narration <span class="required">*</span></label>
            <input type="text" id="js-narration" value="<?php if(isset($narration)){
                            echo $narration;
                        }
                        ?>"  readonly required name="narration" class="form-control py-4"/>
                        
                       
        </li>
        <li>
            <label>Amount <span class="required">*</span></label>
            <input type="number" id="js-amount" value="<?php if(isset($amount) ){
                            echo $amount;
                        }?>" name="amount" class="form-control py-4" required readonly />
        </li>
        <li>
             <label>RRR <span class="required">*</span></label>
            <input type="number" id="js-amount" value="<?php if(isset($rrr) ){
                            echo $rrr;
                        }?>" name="rcode" class="form-control py-4" required readonly />
        </li>
        </form>
        <li>
            
            <form action="https://login.remita.net/remita/ecomm/finalize.reg" name="SubmitRemitaForm" method="POST">

<input name="merchantId" value="<?php echo $MerchantID; ?>" type="hidden">

<!--<input name="merchantId" value="2547916" type="hidden">-->

<input name="hash" value="<?php echo $hash_value; ?>" type="hidden">

<!--<input name="hash" value="4f33dc2478836218506a12b4bb512f711eaadbf9ea521ba443a8da1bd233bf234c6f62d23b91675db2467aa2586e3d5f49e37cd594361c0938f30349410282cb"type="hidden">-->

<input name="rrr" value="<?php echo $rrr; ?>" type="hidden">

<!--<input name="rrr" value="280008217946" type="hidden">-->

<input name="responseurl" value="<?php echo $responseUrl; ?>" type="hidden">

<!--<input name="responseurl" value="http://www.startuppackng.com/response.php" type="hidden">-->

<input type="submit"  name="submit_btn" value="Pay Via Remita"/>
<!--<div class="card-header"><h3 class="text-center font-weight-light my-4"><input type ="submit" class="btn btn-primary" > </h3></div>-->
</form>
        </li>
    </ul>


</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
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
        
        
</body>
</html>