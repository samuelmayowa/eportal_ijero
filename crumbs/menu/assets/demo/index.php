<?php
include("../connection.php");
require_once("../functions.php");
if(isset($_POST['std'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $matricID = $screenData['matricID'];
     $passkey= $screenData['password'];
    
    //getStaff($staffID, $password);
    $query = "Select matricNumber, passKey FROM students WHERE matricNumber='$matricID' AND passKey = '$passkey' LIMIT 1";
    $query=mysqli_query($con,$query);
    if(!$query){
      $msg= mysqli_error($con);
    }
    else{
        while($results=mysqli_fetch_array($query)){
           $user= $results['matricNumber'];
           $passw = $results['password'];
           //session_start();
           $_SESSION['userID'] =$user;
           $_SESSION['pid'] =$passw;
           setcookie('userID', $_SESSION['userID'], time() + (3600), "/");
           setcookie('pid', $_SESSION['pid'], time() + (3600), "/");
           header('location:dashboard.php?msg=You are Welcome');
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
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Eportal-eschsti</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br>Ekiti State College Of Health Science and Technology</h3></div>
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/std-icon-2.jfif"><br>STUDENT LOGIN </h3></div>
                                    <div class="card-body">
                                        
                                        <form method="POST" action="#">
                                            <div class="form-group"> <span style="color:green; font-size:18px;" ><?php if(isset($msg)){ echo $msg; } ?> <?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?> </span><br />
                                                <label class="small mb-1" for="inputEmailAddress">Your Matric Number</label>
                                                <input class="form-control py-4" id="inputFirtName" type="text" placeholder="Enter MatricNumber" name="matricID" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter Your Password"  name="password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="#password.html">Forgot Password?</a>
                                                <button class="btn btn-primary" Name="std">Login</Button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="../index.php">Return To Portal Hoome!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted" style="Text-align:center; margin-left:150px;">Copyright &copy; Ekiti State College Of Health Science and Technology, Ijero-Ekiti, Ekiti State. 2020</div>
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
    </body>
</html>
