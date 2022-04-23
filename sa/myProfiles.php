<?php
include_once('../functions.php');
require_once('../connection.php');
$user="";
$citizen ="";
$st="";
//confirmLogin();
if(isset($_GET['user'])){
  $user = $_GET['user'];
  
  
   
}




// ===== Get StD states Local =====


    //prepare Data
if(isset($_POST['UpdateProfiles'])){
     $stdCode = $_SESSION['userID'];
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $gender = $screenData['gender'];
     $email= $screenData['email'];
     $fn= $screenData['firstName'];
     $sn= $screenData['surname'];
     $mn= $screenData['midleName'];
     $phno = $screenData['phno'];
     $quali=$screenData['quali'];
     $hrd=$screenData['hrd'];
      $contactAddr= $screenData['ContactAddr'];
      $city= $screenData ['city'];
      $lga =$screenData['lga'];
      $newPassword =$screenData['newPassword'];
      $oldPassword =$screenData['defPassword'];
      $grtName=$screenData['nextOfKin'];
      $grtNum= $screenData['kinPhone'];
      $newPassword = sha1($newPassword);
      // ======= Updating User Profiles ==========
      $tody=date('Y-M-D H:i:s a');
      $query="UPDATE Staffs SET Email ='$email', PhoneNumber='$phno', FirstName='$fn', Surname='$sn', Middlename='$mn',
      Gender ='$gender', ContactAddress ='$contactAddr', City ='$city', Qualification ='$quali',
      LGA ='$lga', GuarantorNumber ='$grtNum', GuarantorName ='$grtName', HiredDate='$hrd',
      LastUpdated ='$tody' WHERE StaffCode ='$stdCode'";
     
          $updateProfiles=mysqli_query($con,$query);
          if(!$updateProfiles){
             $msg = die (mysqli_error($con));
          } else{
              //$msg="<script> alert('Profiles Updated Successfully'); </script>";
             header('location:uploadPassport.php?msg=Upload Your Passport To Complete The Update Profile Challenge');
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
          <link rel="shortcut icon" type="image/x-icon" href="../../images/logo-eschsti.png"/>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
      <!--  <script type="text/javascript" src="js/dynamicStatesLgas.js"></script>-->
          <script src="jquery.min.js"></script>
    <script src="jquery.stateLga.js"></script>
    <script src="jquery.ucfirst.js"></script>
        
    </head>
    <body class="sb-nav-fixed">
        <?php include('topbar.php'); ?>
        <?php include('sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5"> <?php if(isset($msg)){ echo  $msg; }   ?> 
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Update Your BIODATA HERE</h3> </div>
                                 <span style="color:red; font-size:10px;"><?php if(isset($_GET['msg'])) { echo $_GET['msg']; } ?></span> 
                                    <div class="card-body">
                                        <form action="myProfiles.php" method="POST" enctype="multipart/form-data">
                                           <span class="text-center" style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your First Name" name="firstName" required style="color:black;"  Value="<?php if(isset($fn)){ echo $fn; } ?>"    />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">MiddleName</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Middle Name"  name="midleName" required   Value="<?php if(isset($mn)){ echo $mn; } ?>" />
                                                    </div>
                                                </div>
                                               </div>
                                                 
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Surname</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Surname" name="surname" required   Value="<?php if(isset($sn)){ echo $sn; } ?>"  />
                                                       
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Gender</label>
                                                        <select class="form-control py-4" id="inputFirstName" type="text" placeholder="Department Course Domicile" size="1" name="gender"     />
                                                        <option value="male">Male</option>
                                                        <option value="Female">Female</option>
                                                        
                                                        </select>
                                                        </div>
                                                </div>
                                               </div>
                                       
                                            <div class="form-row">
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Phone Number </label>
                                                       <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Phone Number"  name="phno" Value="<?php if(isset($phone)){ echo $phone; } ?>"  required />
                                                    </div>
                                                </div>
                                           <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Email</label>
                                                        <input class="form-control py-4" id="inputEmail" type="email" placeholder="Your Email"  name="email" Value="<?php if(isset($email)){ echo $email; } ?>"  required />
                                                        </div></div>
                                                       </div>
                                                       <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Contact Address</label>
                                                        <textarea class="form-control py-4" id="inputContactAddr" cols="100" rows="2" placeholder="Your Residential Address" name="ContactAddr" required  ><?php if(isset($addr)){ echo $addr; } ?></textarea>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">City</label>
                                                        <input class="form-control py-4" id="inputCity" type="text" placeholder="Your City"  name="city" required  Value="<?php if(isset($city)){ echo $city; } ?>"  />
                                                    </div>
                                                </div>
                                                
                                               </div>
                                                     
                                                        <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">State</label>
                                                        <!--<input class="form-control py-4" id="inputState" type="text" placeholder="Your State Of Origin"  name="stateOR" required  Value="<?php //if(isset($_SESSION['stOrigin'])){ echo $_SESSION['stOrigin']; }  ?>" />-->
                                                         <select name="states"   class="form-control py-4" id="states" size="1" required>
                                                          </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLga">LGA</label>
                                                      <!-- <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Your Local Govt Area" name="lga" required  Value="<?php // if(isset($_POST['lga'])){ echo $_POST['lga']; } ?>" />-->
                                                         <select name="lga" id="lgas"  class="form-control py-4" size="1" required></select>
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
                                                        <label class="small mb-1" for="inputLga">Date Hired</label>
                                                        <input class="form-control py-4" id="inputDateHired" type="text" placeholder="Enter Date LIKE  YYYY-MM-DD" name="hrd"  Value="" />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Qualification</label>
                                                        <input class="form-control py-4" id="inputQualification" type="text" placeholder="Enter Qualification"  name="quali" required  Value="" />
                                                    </div>
                                                </div>
                                               </div>
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLga">Name Of Guarantor</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Surname First" name="nextOfKin" required  Value="<?php if(isset($kin)){ echo $kin; } ?>"  />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Guarantor Phone NUmber</label>
                                                        <input class="form-control py-4" id="inputState" type="text" placeholder="Next of Kin Phone Number"  name="kinPhone" required  Value="<?php if(isset($kinNum)){ echo $kinNum; } ?>"  />
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