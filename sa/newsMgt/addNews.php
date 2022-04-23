<?php
include_once('../../functions.php');
require_once('../../connection.php');

  confirmLogin();
$fid="";
    //prepare Data
if(isset($_POST['addStaff'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $newstitle = htmlentities($screenData['title']);
     $staffCode = htmlentities($screenData['stfcode']);
     $catgr= htmlentities($screenData['category']);
     $closindate= htmlentities($screenData['cldate']);
     $newBody= htmlentities($screenData['news']);
     $purpose= htmlentities($screenData['purpose']);
    
$query=mysqli_query($con,"INSERT INTO portalNews(menuName,forWhom,newsTitle, newsBody , closingDate, staffCode ) 
                            VALUES('$purpose','$catgr','$newstitle','$newBody','$closindate','$staffCode')");
                            if(!$query){
                                $msg="Unable To Publish Notification";
                            }else {
                                $msg="News Publushed Successfully";
                                
                            }
   /* $data = mysqli_query($con,"SELECT * from Departments where ID ='$deptCode'");
   $fetchdata = mysqli_fetch_assoc($data);
    $fid=$fetchdata["FacID"];
      //echo $msg = "<script> alert('$fid'); </script>";
    
 // ======= check Staff Already Exist  =====
        
        $query = "SELECT ID, StaffCode FROM Staffs WHERE StaffCode ='$staffCode'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 
        $data=mysqli_fetch_assoc($query);
        $id=$data["ID"];

            if($CCode >= 1){
                $msg = "<script> alert('Staff Already Added'); </script>";
                //===============
               
                       $addstaff = mysqli_query($con,"UPDATE Staffs SET StaffCode='$staffCode', Title='$stTitle', FirstName='$fname', 
        	Surname='$lname', Designation='$desig', Job_Role='$jobs',PhoneNumber='$phno', DeptID='$deptCode', FacID='$fid',password='$pswd' WHERE ID='$id'");
                   $msg="Unable to Add Staf Member".mysqli_error($con);
                   if(!$addstaff){
            //echo "<script> alert('Error In Query'); </script>".mysqli_error($con);
            $msg="Unable to Update Staf Member Record ".mysqli_error($con);
        }
        else { // Add A staff
                       
                            $msg="1 Staff Member Updated Successfully";
                       
                   }
               }
                
                
                
                //=====================
     else {
   

//Append Staff

 $addstaff = "INSERT INTO Staffs (StaffCode, Title, FirstName, 
        	Surname, Designation, Job_Role,PhoneNumber, DeptID, FacID,password) 
 VALUES ('$staffCode', '$stTitle', '$fname', '$lname',
         '$desig', '$jobs','$phno','$deptCode','$fid','$pswd')";
         
       
        // ======= check Staff Already Added =====
        
        
        $query = "SELECT  	StaffCode FROM Staffs WHERE  	StaffCode ='$staffCode'";
        $query = mysqli_query($con,$query);
        $CCode = mysqli_num_rows($query); 

        $ci="";
        $ci3="";
            if($CCode != 1){
        // ========End check ====== 
        
        $addCourse = mysqli_query($con,$addstaff) or die(mysqli_error($con));
        if(!$addCourse){
            //echo "<script> alert('Error In Query'); </script>".mysqli_error($con);
            $msg="Unable to Add Staf Member".mysqli_error($con);
        }
        else { // Add A staff
                       
                            $msg="1 Staff Member Added Successfully";
                       
                   }
                   }
                   else{
                   $msg="Unable to Add Staf Member".mysqli_error($con);
               }
               
               }*/
               
}
            


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero-Ekiti" />
        <meta name="author" content="" />
        <title>Eportal-Staff Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../../images/logo-eschsti.png"/>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
 
<!--<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>-->
    </head>
    <body class="sb-nav-fixed">
        
     <div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ekiti State College Of HSTI  News Board</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">

                
                <h2  class="text-center font-weight-light my-4">Notification Results Release For 2021/2022 Admission</h2>

<hr>
<h3  class="text-center font-weight-light my-4">ATTENTION: This Is News Dashboard For 2021/2022 Admission </h3>
<hr>
<p data-bracket-id="23">
    
<?php  echo getNws($con);  ?>    
<br>
    <br>
<!--<a href="register.php" target="_blank" align="center"><button type="button">Proceed to Create Profile</button></a><hr>-->
    <br>
    <span style="color:#322; font-size:16px;">Phone: +2348130925149 OR +2348038143003 <br> 
Email: admins@escohsti-edu.ng
</span>
    <br>
    - Management
       
</p>

            </div>
        </div>
    </div>
</div>

       <?php include('topbar.php'); ?>
       <?php if(empty($email) && empty($gender)){
     header('location:../staffProfile.php?msg='.$id);
 } ?>
        <?php include ('../sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Notification To Portal For Students/Admission</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="addNews.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">News Title:</label></label><span style="color:red; font-size:10px;">Enter The News title for **ADMISSION****RESULTS**EXAM**</span>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter News Title" name="title" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>" required />
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">NEWS CATEGORY: **ADMISSION****STUDENTS** STAFF**</label>
                                                                <select name="category" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="Select Notification"> ....Select Notification ... </option>
                                                            <option value="Admission"> Admission </option>
                                                            <option value="Students"> Students </option>
                                                            <option value="Staffs">Staffs </option>
                                                            </select>  </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                 <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Enter News Body</label>
                                                <textarea class="form-control py-4" id="inputEmailAddress" name="news" aria-describedby="emailHelp" placeholder="Enter Your News Body Here"   required /><?php if(isset($_POST['news'])) { echo $_POST['news']; } ?></textarea>
                                            </div>
                                            </div>
                                           <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Ending Date</label></label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="date" aria-describedby="emailHelp" placeholder="Enter date in 2021-10-10" name="cldate" value="<?php if(isset($_POST['date'])) { echo $_POST['date']; } ?>" required />
                                            </div>
                                            </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">PURPOSE </label></label><span style="color:red; font-size:10px;">(Purpose The Notification Intended For ) </span>
                                                        <!--<input class="form-control py-4" id="inputdeptCode" type="text" placeholder="Select Department Code" name="deptCode" required />-->
                                                         <select name="purpose" class="form-control py-4" id="inputFirstName" size="1">
                                                           <option value="Select Notification"> ....Select Type ... </option>
                                                            <option value="Admission"> Admission </option>
                                                            <option value="Examination"> Examination </option>
                                                            <option value="Resumption">Resumption </option>
                                                            <option value="Results">Results </option>
                                                            <option value="School Fees">School Fees</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Published By</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Staff Code" name="stfcode" value="<?php if(isset($_POST['stfcode'])) { echo $_POST['stfcode']; } ?>" required />
                                                    </div>
                                                </div>
                                                </div>
                                                
                                                
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="addStaff" class="btn btn-primary btn-block">Add News To Portal</a></div>
                                             </div>
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
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/datatables-demo.js"></script>
        <script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
    </body>
</html>
