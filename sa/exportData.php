<?php
include_once('../functions.php');
require_once('../connection.php');
confirmLogin();
    //prepare Data
if(isset($_POST['resetPswd'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $username = $screenData['jobTitle'];
     $email= $screenData['email'];
     $password = $screenData['password'];
     $hashed = sha1($password);
     //$rsPswd = mysqli_query($con,"UPDATE Staffs SET password  = '$hashed' WHERE StaffCode ='$username'");
    
  $query = "SELECT RegNumber, FirstName, MiddleName, Surname, PhoneNO, Email, Schools, Departments,StOrigin,LGA, Address,Gender,Username,Amount,Invoices.RefNum FROM onlineApplications JOIN Invoices Using (StudentID) Where Invoices.ServiceType='2021/2022 Acceptance Fee' AND Invoices.InvoiceStatus='Successful' AND onlineApplications.Acceptance =1";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}

 
$students = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $students[] = $row;
    }
}
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Acceptance PaymentReport.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('RegNumber', 'FirstName', 'MiddleName', 'Surname', 'PhoneNO', 'Email', 'Schools', 'Departments','StOrigin','LGA',' Address','Gender','Username','Amount Paid','RRR NUMBER'));

if (count($students) > 0) {
    foreach ($students as $row) {
        fputcsv($output, $row);
    }
}
    /* if($rsPswd){
          $msg="<script> alert('Saff Password Was Reset Successfully'); </script>";
           // $msg="Student Password Was Reset Successfully";
     } else {
       $msg="Unable To Reset Password Successfully:  ".mysqli_error($con);  
     
}*/
    
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
        <?php include('topbar.php'); ?>
       <?php if(empty($email) && empty($gender)){
     header('location:staffProfile.php?msg='.$id);
 } ?>
        <?php include ('sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Bursary Admin Finance  Report Dashboard</h3></div>
                                 
                                    <div class="card-body">
                                        <form action="https://eportal.escohsti-edu.ng/staffArea/bursary/getAllAcceptFees_xlxs.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputGroup">Select Report Type</label>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Faculty Dept is Domicile"  name="school" Value="<?php if(isset($jobTitle)){ echo $jobTitle; }  ?>" required />-->
                                                        <select name="rtype" class="form-control py-4" id="inputJobTitle" size="1">
                                                            <option value="Select School">..Select Fees Type..</option>
                                                            <option value="Acceptance">Acceptance </option>
                                                            <option value="Compulsory">Compulsory Fees</option>
                                                             <option value="Reg">Registration Form Fees</option>
                                                             <option value="School">School Form Fees</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                               
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputGroup">Select Export Method</label>
                                                        <!--<input class="form-control py-4" id="inputFirstName" type="text" placeholder="Faculty Dept is Domicile"  name="school" Value="<?php if(isset($jobTitle)){ echo $jobTitle; }  ?>" required />-->
                                                        <select name="grp" class="form-control py-4" id="inputJobTitle" size="1">
                                                            <option value="Select School">..Select Group..</option>
                                                            <option value="All">All</option>
                                                            <option value="Dept">By Department</option>
                                                            <?php 
                                // Fetch Department
                                                $dc="";
                                                $fid="";
                                                $sql_department = "SELECT ID, DeptID, FacID FROM Departments";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    $id = $row['ID'];
                                                    $deptCode = $row['DeptID'];
                                                     $dc .="<option value='$deptCode'>$deptCode</option>";
                                                    
                                                }
                                                    echo $dc;
                                                ?> 
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <!--<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Staff Email</label> </label>
                                                       <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter Student Email"  name="email" Value="<?php if(isset($email)){ echo $email; }  ?>" required />
                                                    </div>
                                                </div>-->
                                           
                                               </div>
                                          
                                             <div class="form-group mt-4 mb-0"><button type="submit" name="resetPswd" class="btn btn-primary btn-block">EXPORT FEES</button></div>
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
                                                     