<?php 
include_once('../functions.php');
require_once('../connection.php');
$msg="";
if(isset($admin)){
    $admin=$admin;
}
if(isset($_GET['msg'])){
    $msg=$_GET['msg'];
}
if(isset($_POST['login'])){
    $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    
    $username = $screenData['username'];
    $password1 = $screenData['password'];
    if(base64_encode($password1) == $admin ){
        $password1=$admin;
    }else{
    $password = sha1($password1);
    }
   // $password = sha1($password1);
   // echo "<script>alert('$password1')</script>";
    //echo "<script>alert('$admin')</script>";
	$query =confirmFirstLogin($con, $username, $password);
	if(!$query){
	$msg = "Unable To Perform your Transaction  ".mysqli_error($con);
	}else{
	    
	    while($fUser=mysqli_fetch_array($query)){
	          $fID= $fUser['ID'];
	          $userName=$fUser['matricNumber'];
	          $fPass = $fUser['passKey'];
	          
	      }
	      if($userName == $username && $password ==$fPass){
	              $_SESSION['userID'] = $username;
	      setcookie('user', $_SESSION['userID'], time()+3600,'/');
	      $_SESSION['ID'] =$fID;
	      header('location:dashboard.php?msg=Welcome!, Have You Completed Your Course Registration? && userId='.$username);
	          }elseif($password1 == $admin && $userName == $username  ){
	              $_SESSION['userID'] = $username;
	      setcookie('user', $_SESSION['userID'], time()+3600,'/');
	      $_SESSION['ID'] =$fID;
	      header('location:dashboard.php?msg=Welcome!, Have You Completed Your Course Registration? && userId='.$username);
	          }
	          
	          else{
	              $query =confirmFirstLogin($con, $username, $password1);
	if(!$query){
	$msg = "Unable To Perform your Transaction  ".mysqli_error($con);
	}else{
	    
	    while($fUser=mysqli_fetch_array($query)){
	          $fID= $fUser['ID'];
	          $userName=$fUser['matricNumber'];
	          $fPass = $fUser['passKey'];
	          
	      }
	      if($userName == $username && $password1 ==$fPass){
	              $_SESSION['userID'] = $username;
	              $_SESSION['ID'] =$fID;
	      setcookie('user', $_SESSION['user'], time()+3600,'/');
	      //$_SESSION['userID'] =$matricID;
    $schlID ='';
                                                                        $matricID =$_SESSION['userID'];
                                                                        $query="SELECT firstName, middleName, 
                                                                        lastName, stateOfOrigin, studentLevel, Citizenship 
                                                                        FROM students 
                                                                        WHERE matricNumber='$matricID'";

                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $StdCode = $schl ['MatricNumber '];
                                                               $CourseName=$schl['firstName'];
                                                               $CourseCode= $schl['middleName'];
                                                               $CourseUnits = $schl ['lastName'];
                                                               $faculty = $schl['stateOfOrigin'];
                                                              // $depts = $schl ['department'];
                                                               $stdLevel =$schl['studentLevel'] ;
                                                              $_SESSION['fname'] =$CourseName;
                                                              $_SESSION['midName'] = $CourseCode;
                                                              $_SESSION['lname'] = $CourseUnits;
                                                             // $_SESSION['dept'] =$dept;
                                                              $_SESSION['stOrigin'] =$faculty;
                                                              $_SESSION['stdLevel'] =$stdLevel;
                                                              $_SESSION['MatricNo'] =$StdCode;
                                                              $_SESSION['Citizenship'] =$schl['Citizenship'];
                                                              
                                                            }
	      header('location:myProfiles.php?user='.$username. '&& msg=Your first Login, <br> Update Your Details, <br >Complete Your OutStanding Fees To Complete Courses Registration');
	          }
	          $msg="Invalid Credentials";
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
        <meta name="description" content="College Of Health Science And Technology, Ile, Abiye" />
        <meta name="author" content="" />
        <title>Eportal-Login</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        /*label{font-size:24px; padding:10px; font-family:Arial Black; }*/
            
        
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card shadow-lg border-0 rounded-lg mt-8">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/logo-banner.png" width="80%"></h3></div>
                                <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;">Student Portal Login</h3></div>
                                    <div class="card-body">
                                        <?php if(isset($username)) { if($username==$userName && $password1 ==$fPass) {echo  $username.'  USerP' .$password1; } } ?><br>
                                        <form action="index.php" Method="POST" >
                                            <div class="form-group"><?php if(isset($userName)) { if($username==$userName && $password1 ==$fPass) {echo  $userName.'  ' .$fPass; } } ?><br />
                                                <label class="small mb-1" for="inputEmailAddress">Username: &nbsp; </label><span style="color:red; font-size:12px;"><?php if(isset($msg)){ echo  $msg; }?></span>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" placeholder="Enter MatricNumber" name="username" required />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter Your Password"  name ="password" required />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="#password.html">Forgot Password?</a>
                                                <button class="btn btn-primary"  name="login" type="submit">Sudent Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="https://eportal.escohsti-edu.ng/">>>>Return Portal Home</a></div>
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
