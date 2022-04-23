
<?php
include("../connection.php");
require_once("../functions.php");
if(isset($_POST['staff'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
      $staffID = $screenData['staffId'];
     $passkey= $screenData['password'];
     $passkey =sha1($passkey);
     echo confirmUserAdm($con, $staffID);
     
    //getStaff($staffID, $password);
    $query = "Select  * From Staffs  WHERE StaffCode='$staffID' AND password = '$passkey'";
    $query=mysqli_query($con,$query);
    if(!$query){
      $msg= mysqli_error($con);
    }
    else{
        while($results=mysqli_fetch_array($query)){
            $id=$results['ID'];
           $user= $results['StaffCode'];
           $loginUser=$results['Job_Role'];
           $email=$results['Email'];
           if(empty($email)){
             header('location:staffProfile.php?msg='.$loginUser.' && user='.$user);
         }else{
           //session_start();
          $_SESSION['id'] = $id;
           $_SESSION['userID'] =$user;
           $_SESSION['jbr']=$loginUser;
           setcookie('userID', $_SESSION['userID'], time() + (3600), "/");
         
       if($loginUser =='PSWD_ADMIN'){
               header('location:passwordReset.php?msg='.$loginUser);
           }elseif($loginUser =='BURSAR'){
               header('location:manageFinance.php?msg='.$loginUser);
           }elseif($loginUser == 'HOD'){
               header('location:manageLectures.php?msg='.$loginUser);
           }
           elseif($loginUser == 'ADMIN_OFFICER'){
               header('location:admission/dashboard.php?msg='.$loginUser);
           }elseif($loginUser == 'AUDITOR'){
                header('location:manageFinance.php?msg='.$loginUser);
           }
        elseif($loginUser == 'LECTURER'){
                header('location:lecturers/dashboard.php?msg='.$loginUser.'&id='.$stf);
           }
           elseif($loginUser == 'PORTAL_ADM'){
                header('location:dashboard.php?msg='.$loginUser);
           }
            elseif($loginUser == 'DEAN'){
                header('location:manageLectures.php?msg='.$loginUser);
           }
           elseif($loginUser == 'IT_SUPPORT'){
           header('location:dashboard.php?msg='.$loginUser);
        }elseif($loginUser == 'PROVOST'){
           header('location:https://eportal.escohsti-edu.ng/staffArea/provost/dashboard.php?msg='.$loginUser);
        }
         }   
        }
        
   $msg="Invalid Key Credentials";
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
        <meta name="author" content="College Of Health Sciences and Technology, Ijero Ekiti" />
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
                            <div class="col-lg-10">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/logo-banner.png" width="80%"><br></h3></div>
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/staffLogin-02.jfif"><br><br>STAFF LOGIN AREA </h3></div>
                                    <div class="card-body">
                                        
                                        <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <div class="form-group"><span style="color:red; font-size:14px;"><?php if(isset($msg)){ echo $msg; } ?> <?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?></span> <br />
                                                <label class="small mb-1" for="inputEmailAddress">Your Staff ID</label>
                                                <input class="form-control py-4" id="inputEmailAddress" required name ="staffId" type="text" value="<?php if(isset($_POST['staffID'])){ echo $_POST['staffID']; } ?>" placeholder="Enter Staff ID Number" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" name="password"  required type="password" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>" placeholder="Enter Your Password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="#password.html">Forgot Password?</a>
                                                <Button type="submit"  name ="staff" class="btn btn-primary">Staff Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="../index.php">Return To Portal Home</a></div>
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
                            <div class="text-muted" style="Text-align:center;">Copyright &copy; Ekiti State College Of Health Science and Technology, Ijero-Ekiti, Ekiti State. 2020</div>
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
<?php 
include("../close_connection.php");
?>
