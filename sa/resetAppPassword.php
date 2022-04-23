<?php
include_once('../functions.php');
require_once('../connection.php');
confirmLogin();
    //prepare Data
if(isset($_POST['resetPswd'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $username = $screenData['username'];
     /*$email= $screenData['email'];*/
     $password = $screenData['password'];
     $hashed = sha1($password);
     $rsPswd = mysqli_query($con,"UPDATE userAccounts SET Password  = '$hashed' WHERE Username ='$username'");
     //$resetPwd=mysqli_affected_rows($con);
     
      /*if($rsPswd){*/
      if(mysqli_affected_rows($con) == 1){
          //$msg="<script> alert('Applicants Password Was Reset Successfully'); </script>";
           $msg="Student Password Was Reset Successfully For ".mysqli_affected_rows($con) .'  '. $username ." Applicant";
     }
     /*else if(mysqli_affected_rows($con)==0){
          //$msg="<script> alert('Applicants Password Was Reset Successfully'); </script>";
            $msg="Unable To Reset Password for The Applicant, Ensure Email and Username are Valid";
     }*/ else {
       $msg="Unable To Reset Password Successfully:  ".mysqli_affected_rows($con). $username;  
     
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
                        <a class="dropdown-item" href="passwordReset.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="passwordReset.php">Dashboard</a>
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
                                STAFF Admin DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Staff Area</div>
                            <a class="nav-link collapsed" href="passwordReset.php" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Password Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#layout-static.html">Manage Password</a>
                                    <a class="nav-link" href="#layout-sidenav-light.html">Reset Passwords</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Staff Password Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="resetStaffPassword.php" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Staff Password  Area
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="resetStaffPassword.php">Update Password</a>
                                            <a class="nav-link" href="resetStaffPassword.php">Recover My Password</a>
                                            <a class="nav-link" href="#password.html">Mail My Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Password History
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#401.html">Updates</a>
                                            <a class="nav-link" href="#3404.html">Faculty News</a>
                                            <a class="nav-link" href="#500.html">College News</a>
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
                        
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Manage Applicants Password</h3></div>
                                 
                                    <div class="card-body">
                                        <form action="resetAppPassword.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                 <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Applicants Username </label>
                                                        <input class="form-control py-4" id="inputUsername" type="text" placeholder="Your Username"  name="username" Value="<?php if(isset($username)){ echo $username; }  ?>" required />
                                                        
                                                                        
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                               </div>
                                                 <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Password</label>
                                                       <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter Applicant Password"  name="password" Value="<?php if(isset($_POST['password'])){ echo $_POST['password']; }  ?>" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Confirm Password</label>
                                                       <input class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirm Applicant Password"  name="confirm_password" Value="<?php if(isset($password)){ echo $password; }  ?>" required />
                                                    </div>
                                                </div>
                                                <script>
                                                    var password = document.getElementById("inputPassword")
                                                              , confirm_password = document.getElementById("inputConfirmPassword");
                                                            
                                                            function validatePassword(){
                                                              if(password.value != confirm_password.value) {
                                                                confirm_password.setCustomValidity("Passwords Don't Match");
                                                              } else {
                                                                confirm_password.setCustomValidity('');
                                                              }
                                                            }
                                                            
                                                            password.onchange = validatePassword;
                                                            confirm_password.onkeyup = validatePassword;
                                                </script>
                                                </div>
                                           
                                       
                                           <!-- <div class="form-row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Applicants Email</label> </label>
                                                       <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter Applicants Email"  name="email" Value="<?php if(isset($email)){ echo $email; }  ?>" required />
                                                    </div>
                                                </div>
                                           
                                               </div>-->
                                          
                                             <div class="form-group mt-4 mb-0"><button type="submit" name="resetPswd" class="btn btn-primary btn-block">RESET APPLICANT'S PASSWORD</button></div>
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
require('../close_connection.php');

?>