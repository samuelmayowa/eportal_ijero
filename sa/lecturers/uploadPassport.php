<?php
include_once('../../functions.php');
require_once('../../connection.php');

  //confirmLogin();
    //prepare Dat

?>
<?php
  // Create database connection
  //$db = mysqli_connect("localhost", "root", "", "image_upload");
  $stdCode = $_SESSION['userID'];
$screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
  // Initialize message variable
  $msg = "";
     $target_dir = "uploads/";
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
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}


  	$sql = "UPDATE  Staffs SET passport='$target_file' WHERE StaffCode ='$stdCode'";
  	// execute query
  	mysqli_query($con, $sql);

  	if (move_uploaded_file($_FILES['passport']['tmp_name'], $target_file)) {
  	    	$upds=mysqli_query($con, $sql);
  	    	if(!$upds){
  	    	    echo mysqli_error($con);
  	    	}else{
  		$msg = "<script> alert('Image uploaded successfully');</script>";
  		//header('location:dashboard.php?msg=You Have Successfully Updated Your Profile');
  	}
  	}else{
  		$msg = "<script> alert('Failed to upload image');</script>";
  	}
  //}
  //$result = mysqli_query($db, "SELECT * FROM images");
?>


<!DOCTYPE html>
<?php include('headers.php'); ?>
    <body class="sb-nav-fixed">
        <?php include('topbar.php'); ?>
       <?php include ('sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5"> <?php if(isset($msg)){ echo  $msg; } ?>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
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
                                                        <input class="form-control py-4" id="inputFirstName" type="file" placeholder="Enter first name"  name="passport" />
                                                    </div>
                                                    </div>
                                                    
                                                    </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Full Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your First Name" name="firstName" required readonly Value="<?php if(isset($name)){ echo $name; } ?>"  />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Staff ID/ Username</label>
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
require('../../close_connection.php');

?>