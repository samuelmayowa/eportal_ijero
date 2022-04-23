<?php
include_once('../functions.php');
require_once('../connection.php');
if(!isset($_SESSION['userID'])){
  confirmLogin();
} else {
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
      //$newPassword = sha1($newPassword);
      // ======= Updating User Profiles ==========
      $tody=date();
      $query="UPDATE students SET studentEmail ='$email', stdPhoneNumber='$phno', 
      Gender ='$gender', ContactAddr ='$contactAddr', City ='$city', passKey ='$newPassword',
      LGA ='$lga', KinName ='$NextKinName', KinPhoneNumber ='$kinPhno', 
      LastUpdated ='$tody' WHERE matricNumber ='$stdCode'";
      if($oldPassword == $newPassword){
          $msg="<script> alert('Old and New Password Cannot Be The Same'); </script>";
      }else{
          $updateProfiles=mysqli_query($con,$query);
          if(!$updateProfiles){
              return mysqli_error($con);
          } else{
              $msg="<script> alert('Passport Uploaded Successfully'); </script>";
          }
      }
     
}
}
?>
<?php
  // Create database connection
  //$db = mysqli_connect("localhost", "root", "", "image_upload");
  $stdCode = $_SESSION['userID'];
$screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
  // Initialize message variable
  $msg = "";
     $target_dir = "passports/";
$target_file = $target_dir . basename($_FILES["passport"]["name"]);
  	// Get image name
  	$uploadOk = 1;
  	
  	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // If upload button is clicked ...
  if (isset($_POST['UpdatePassport'])) {
      $check = getimagesize($_FILES["passport"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
      
      

  	$image = $_FILES['passport']['name'];
  	$stdCode= $screenData['stdCode'];
  	// Get text
  	//$image_text = mysqli_real_escape_string($db, $_POST['image_text']);

  	// image file directory
  	$target= basename($image);
if ($_FILES["passport"]["size"] > 5000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}


// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "Sorry, only JPG, JPEG, PNG  files are allowed.";
  $uploadOk = 0;
}


  	$sql = "UPDATE  students SET StdPassport='$target_file' WHERE matricNumber ='$stdCode'";
  	// execute query
  	mysqli_query($con, $sql);

  	if (move_uploaded_file($_FILES['passport']['tmp_name'], $target_file)) {
  	    	$upds=mysqli_query($con, $sql);
  	    	if(!$upds){
  	    	    echo mysqli_error($con);
  	    	}else{
  		$msg = "<script> alert('Image uploaded successfully');</script>";
  		header('location:dashboard.php?msg=You Have Successfully Updated Your Profile');
  	}
  	}else{
  		$msg = "<script> alert('Failed to upload image');</script>";
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
                        <a class="dropdown-item" href="profiles.php">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
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
                            <div class="sb-sidenav-menu-heading">UpDate Your Passport</div>
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
                                Student Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                       Connect HOD Area
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#login.html">Assign Courses</a>
                                            <a class="nav-link" href="#register.html">Add New</a>
                                            <a class="nav-link" href="#password.html">Add Departments</a>
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
                                Updates
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Update Your PASSPORT HERE</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="uploadPassport.php" method="POST" enctype="multipart/form-data">
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
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your First Name" name="firstName" required readonly Value="<?php if(isset($_SESSION['fname'])){ echo $_SESSION['fname'] .'  ' . $_SESSION['lname']; } ?>"  />
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