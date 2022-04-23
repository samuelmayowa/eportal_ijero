<?php
include_once('../../functions.php');
require_once('../../connection.php');

  confirmLogin();

        //prepare Data
/*if(isset($_POST['UpdateProfiles'])){
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
      //$newPassword = sha1($newPassword);
      // ======= Updating User Profiles ==========
      $tody=date();
      $query="UPDATE Staffs SET studentEmail ='$email', stdPhoneNumber='$phno', 
      Gender ='$gender', ContactAddr ='$contactAddr', City ='$city', passKey ='$newPassword',
      LGA ='$lga', KinName ='$NextKinName', KinPhoneNumber ='$kinPhno', 
      LastUpdated ='$tody' WHERE matricNumber ='$stdCode'";
     /* if($oldPassword == $newPassword){
          $msg="<script> alert('Old and New Password Cannot Be The Same'); </script>";
      }else{
          $updateProfiles=mysqli_query($con,$query);
          if(!$updateProfiles){
              return mysqli_error($con);
          } else{
              $msg="<script> alert('Passport Uploaded Successfully'); </script>";
          }
      }
     
//}
*/
?>
<?php
  // Create database connection
  //$db = mysqli_connect("localhost", "root", "", "image_upload");
  $stfCode = $_SESSION['userID'];
$screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
  // Initialize message variable
  
  
 //echo "<script>alert('$stfCode');</script>";
 
$target_dir = "uploads/";
$target_file =$target_dir.basename($_FILES["passport"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//echo "<script>alert('$target_file');</script>";
// Check if image file is a actual image or fake image
if(isset($_POST["UpdatePassport"])) {
  $check = getimagesize($_FILES["passport"]["tmp_name"]);
  if($check !== false) {
    $msg= "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $msg= "<font color='red'>File is not an image.</font>";
    $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
  $msg= "<font color='red'>Sorry, file already exists.</font>";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["passport"]["size"] > 500000) {
  $msg= "<font color='red'>Sorry, your file is too large.</font>";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $msg= "<font color='red'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</font>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $msg= "<font color='red'>Sorry, your file was not uploaded.</font>";
// if everything is ok, try to upload file
} else {
    //echo $target_file.=$_FILES["passport"]["name"];
    $sql = mysqli_query($con, "UPDATE Staffs SET passport ='$target_file' WHERE StaffCode='$stfCode'") or die(mysqli_error($con));
    if(!$sql){
        $msg= "Unable to Store Your Photograp".mysqli_error($con);
    }
    if (move_uploaded_file($_FILES["passport"]["tmp_name"], $target_file)) {
     
     $msg= "The file ". htmlspecialchars( basename( $_FILES["passport"]["name"])). " has been uploaded Successfully.";
     //header('location:dashboard.php?msg='.$msg. ' && user='.$stfCode. '&& img='.$target_file);
      }else{
          $msg="There was Error Storing Your Photograph".mysqli_error($con);
      }
  } 
}

  
  
  //}
  //$result = mysqli_query($db, "SELECT * FROM images");
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero-EKiti" />
        <meta name="author" content="" />
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../../images/logo-eschsti.png"/>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include('../topbar.php'); ?>
        <?php include('../sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5"> <?php if(isset($msg)){ echo  $msg; } ?>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Update Your PASSPORT HERE</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="staffPassport.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                           <div class="form-row">
                                           
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">NOTE:****</label>
                                                        <span style="color:red; font-size:20px;">ENsure Your Passport File is Saved with Your Phone Number</span>
                                                    </div>
                                                </div>
                                           <div class="form-group">
                                               <div class="col-lg-*">
                                                     <label class="small mb-1" for="inputFirstName">Your Passport</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="file" placeholder="Enter first name"  name="passport"/>
                                                    </div>
                                                    </div>
                                                    
                                                    </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your First Name" name="firstName" required readonly Value="<?php if(isset($name)){ echo $name; } ?>"  />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">MatricNumber</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Middle Name"  name="stdCode" required readonly  Value="<?php if(isset($_SESSION['userID'])){ echo $_SESSION['userID']; } ?>" />
                                                    </div>
                                                </div>
                                               </div>
                                                 
                                            
                                               </div>
                                               
                                                </div>

                                          
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="UpdatePassport" class="btn btn-primary btn-block">Upload My Passport</a></div>
                                             </div>
                                        </form>
                                    </div>
                                                                                  </div>
                </main>
                 <?php include('footer.php'); ?>