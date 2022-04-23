<?php
include_once('../functions.php');
require_once('../connection.php');

  confirmLogin();
  
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
        <script type="text/javascript" src="js/dynamicStatesLgas.js"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
                        <a class="dropdown-item" href="myProfiles.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">Activity Log</a>
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
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">View Courses</a></a>
                                    <a class="nav-link" href="layout-sidenav-light.html">My payments</a>
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
                    <div class="card shadow-lg border-0 rounded-lg mt-5"> <?php if(isset($msg)){ echo  $msg; } ?>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Update Your BIODATA HERE</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="myProfiles.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
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
                                                        <select class="form-control py-4" id="inputFirstName" type="text" placeholder="Department Course Domicile" size="1" name="gender" required  Value="<?php if(isset($_POST['gender'])){ echo $_POST['gender']; } ?>" />
                                                        <option value="No Option Selected">...Select Your Gender....</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        </select>
                                                        </div>
                                                </div>
                                               </div>
                                       
                                            <div class="form-row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Phone Number </label>
                                                       <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Phone Number"  name="phno" Value="<?php if(isset($_POST['phno'])){ echo $_POST['phno']; } ?>" required />
                                                    </div>
                                                </div>
                                           <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Email</label>
                                                        <input class="form-control py-4" id="inputEmail" type="email" placeholder="Your Email"  name="email" Value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" required />
                                                        </div></div>
                                                       </div>
                                                       <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Contact Address</label>
                                                        <textarea class="form-control py-4" id="inputContactAddr" cols="100" rows="2" placeholder="Your Residential Address" name="ContactAddr" required><?php if(isset($_POST['ContactAddr'])){ echo $_POST['ContactAddr']; } ?></textarea>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">City</label>
                                                        <input class="form-control py-4" id="inputCity" type="text" placeholder="Your City"  name="city" required  Value="<?php if(isset($_POST['city'])){ echo $_POST['city']; } ?>" />
                                                    </div>
                                                </div>
                                                
                                               </div>
                                                     
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">State</label>
                                                        <!--<input class="form-control py-4" id="inputState" type="text" placeholder="Your State Of Origin"  name="stateOR" required  Value="<?php if(isset($_SESSION['stOrigin'])){ echo $_SESSION['stOrigin']; }  ?>" />-->
                                                         <select name="inputFirstName"  class="form-control py-4" id="states" size="1">
                                                          </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLga">LGA</label>
                                                       <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Local Govt Area" name="lga" required  Value="<?php if(isset($_POST['lga'])){ echo $_POST['lga']; } ?>" />
                                                         <!--<select name="lga" id="lgas"  class="form-control py-4" size="1">
                                                        </select>-->
                                                    </div>
                                                </div>
                                               </div>
                                                <script>	
var option = '';

var states=$.nigeria.states();
for (var i=0;i<states.length;i++){
   option += '<option value="'+ states[i] + '">' + $.ucfirst(states[i]) + '</option>';
}
$('#states').append(option).on('change',function() {

var option = '';
option += '<option value="">Local government</option>';

var lgas=eval('$.nigeria.'+ this.value);

for (var i=0; i < lgas.length; i++){
   option += '<option value="'+ lgas[i] + '">' + $.ucfirst(lgas[i]) + '</option>';
}

$('#lgas').find('option')
    .remove()
    .end().append(option);

})
.trigger('change');

</script>
                                      
                                               
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLga">Old Password</label>
                                                        <input class="form-control py-4" id="inputDefPassword" type="password" placeholder="Enter Your Default Password" name="defPassword"  Value="" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">New Password</label>
                                                        <input class="form-control py-4" id="inputpassword" type="password" placeholder="New Password"  name="newPassword" required  Value="" />
                                                    </div>
                                                </div>
                                               </div>
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLga">Name Of Next Of Kin</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Surname First" name="nextOfKin" required  Value="<?php if(isset($_POST['nextOfKin'])){ echo $_POST['nextOfKin']; } ?>" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Next Of Kin Phone NUmber</label>
                                                        <input class="form-control py-4" id="inputState" type="text" placeholder="Next of Kin Phone Number"  name="kinPhone" required  Value="<?php if(isset($_POST['nextofKinPhone'])){ echo $_POST['nextofKinPhone']; } ?>" />
                                                    </div>
                                                </div>
                                               </div>
                                               
                                                </div>
                                               </div>
                                          
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="UpdateProfiles" class="btn btn-primary btn-block">Update My Profile</a></div>
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