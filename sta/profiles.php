<?php
include_once('../functions.php');
require_once('../connection.php');

confirmLogin();
  
  //==== Verify student Payments ======
  
 /* if(isset($_SESSION['userID'])){
 $payID = getPayId($con,$_SESSION['userID']);
 if(empty($payID)){
    header("location:index.php?msg=Access Denied,<br>Pay Your Outstanding Fees To Procceds to Course Registration,<br> Contact Bursar With Your Payment Evidence");
    }
} */
     
   
  
    //prepare Data
if(isset($_POST['UpdateProfiles'])){
     $stdCode = $_SESSION['userID'];
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $gender = $screenData['gender'];
     $email= $screenData['email'];
     $phno = $screenData['phno'];
      $contactAddr= $screenData['ContactAddr'];
      $city= $screenData ['city'];
      $lga =$screenData['lga'];
      $newPassword =$screenData['newPassword'];
      $oldPassword =$screenData['defPassword'];
      $NextKinName=$screenData['nextOfKin'];
      $kinPhno = $screenData['kinPhone'];
      $newPassword = sha1($newPassword);
      // ======= Updating User Profiles ==========
      $tody=date('YYYY-MM-DD H:i:s a');
      $query="UPDATE students SET studentEmail ='$email', stdPhoneNumber='$phno', 
      Gender ='$gender', ContactAddr ='$contactAddr', City ='$city', passKey ='$newPassword',
      LGA ='$lga', KinName ='$NextKinName', KinPhoneNumber ='$kinPhno' WHERE matricNumber ='$stdCode'";
      if($oldPassword == $newPassword){
          $msg="<script> alert('Old and New Password Cannot Be The Same'); </script>";
      }else{
          $updateProfiles=mysqli_query($con,$query);
          if(!$updateProfiles){
             $msg = die (mysqli_error($con));
          } else{
              //$msg="<script> alert('Profiles Updated Successfully'); </script>";
              header('location:uploadPassport.php?msg=Upload Your Passport To COmplete The Update Profile Challenge');
          }
      }
     
}


?>
 
             <!--   End Menu-->

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
      <!--  <script type="text/javascript" src="js/dynamicStatesLgas.js"></script>-->
          <script src="jquery.min.js"></script>
    <script src="jquery.stateLga.js"></script>
    <script src="jquery.ucfirst.js"></script>
        
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
                        <a class="dropdown-item" href="profiles.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">My Dashboard</a>
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
                            <a class="nav-link" href="dashboard.php">
                                Student DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Student Area</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Student Profiles Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
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
                    <div class="card shadow-lg border-0 rounded-lg mt-5"> <?php if(isset($msg)){ echo  $msg; }   ?> 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Update Your BIODATA HERE</h3></div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">
                                        <?php 
                                        $email ="";
                                        if(isset($_SESSION['stdEmail'])){
                                            $email = $_SESSION['stdEmail'];
                                            $file_path =getImage($con,$email);
                                        }
                                        ?>
                                     <img src="<?php if(isset($file_path)){
                                                     echo  $file_path;  } else { echo 'passports/profiles.jpg'; }?>" alt="Avatar" style="width:10%" align="center"  > 
                                        </h3>  </div>
                                 <span style="color:red; font-size:10px;"><?php if(isset($_GET['msg'])) { echo $_GET['msg']; } ?></span> 
                                    <div class="card-body">
                                        <form action="myProfiles.php" method="POST" enctype="multipart/form-data">
                                           <span class="text-center" style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your First Name" name="firstName" required readonly Value="<?php if(isset($_SESSION['fname'])){ echo $_SESSION['fname']; } ?>"  />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">MiddleName</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Middle Name"  name="midleName" required readonly  Value="<?php if(isset($_SESSION['midName'])){ echo $_SESSION['midName']; } ?>" />
                                                    </div>
                                                </div>
                                               </div>
                                                 
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Surname</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Surname" name="surname" required  readonly Value="<?php if(isset($_SESSION['lname'])){ echo $_SESSION['lname']; } ?>"  />
                                                       
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Gender</label>
                                                        <select class="form-control py-4" id="inputFirstName" type="text" placeholder="Department Course Domicile" size="1" name="gender" required   readonly />
                                                        <option value="No Option Selected"><?php if(isset($_SESSION['gender'])){ echo $_SESSION['gender']; } ?></option>
                                                        
                                                        </select>
                                                        </div>
                                                </div>
                                               </div>
                                       
                                            <div class="form-row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Phone Number </label>
                                                       <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Phone Number"  name="phno" Value="<?php if(isset($_SESSION['stdPhno'])){ echo $_SESSION['stdPhno']; } ?>" readonly required />
                                                    </div>
                                                </div>
                                           <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Email</label>
                                                        <input class="form-control py-4" id="inputEmail" type="email" placeholder="Your Email"  name="email" Value="<?php if(isset($_SESSION['stdEmail'])){ echo $_SESSION['stdEmail']; } ?>" readonly required />
                                                        </div></div>
                                                       </div>
                                                       <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Contact Address</label>
                                                        <textarea class="form-control py-4" id="inputContactAddr" cols="100" rows="2" placeholder="Your Residential Address" name="ContactAddr" required readonly ><?php if(isset($_SESSION['addr'])){ echo $_SESSION['addr']; } ?></textarea>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">City</label>
                                                        <input class="form-control py-4" id="inputCity" type="text" placeholder="Your City"  name="city" required  Value="<?php if(isset($_SESSION['city'])){ echo $_SESSION['city']; } ?>" readonly />
                                                    </div>
                                                </div>
                                                
                                               </div>
                                                     
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">State</label>
                                                        <input class="form-control py-4" id="inputState" type="text" placeholder="Your State Of Origin"  name="stateOR" required  Value="<?php if(isset($_SESSION['st'])){ echo $_SESSION['st']; }  ?>" readonly />
                                                         <!--<select name="inputFirstName"  class="form-control py-4" id="states" size="1">-->
                                                          </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLga">LGA</label>
                                                      <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Local Govt Area" name="lga" required  Value="<?php if(isset($_SESSION['lga'])){ echo $_SESSION['lga']; } ?>" readonly />
                                                         <!--<select name="lga" id="lgas"  class="form-control py-4" size="1"></select>-->
                                                    </div>
                                                </div>
                                               </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLga">Name Of Next Of Kin</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Surname First" name="nextOfKin" required  Value="<?php if(isset($_SESSION['kin'])){ echo $_SESSION['kin']; } ?>" readonly />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Next Of Kin Phone NUmber</label>
                                                        <input class="form-control py-4" id="inputState" type="text" placeholder="Next of Kin Phone Number"  name="kinPhone" required  Value="<?php if(isset($_SESSION['kinNum'])){ echo $_SESSION['kinNum']; } ?>" readonly />
                                                    </div>
                                                </div>
                                               </div>
                                               
                                                </div>
                                               </div>
                                          
                                            
                                             </div>
                                        </form>
                                    </div>
                                  
                                   
                 <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
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