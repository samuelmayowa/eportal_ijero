<?php
include_once('../../functions.php');
require_once('../../connection.php');
confirmLogin();
    //prepare Data
    $jbt="";
    $user="";
    $logUser="";
    
    if(isset($_GET['msg'])){
        $logUser=$_GET['msg'];
        $user=$_SESSION['userID'];
        $query=mysqli_query($con,"Select JobTitle From UserAdmins Where userName ='$user'");
        while($res=mysqli_fetch_array($query)){
            $jbt = $res['JobTitle'];
        }
    }
 if($jbt != $logUser){
       header('location:manageScore.php?msg=You Do Not Have View  Access to View This page.');
   } 
$deptId="";
$jbr="";
$dptID ="";
$deptName ="SCHOOL OF ";
if(isset($_GET['msg'])){
    $jbr = $_GET['msg'];
    $_SESSION['msg']=$jbr;
    if(!empty($jbr)){
        $dept = mysqli_query($con, "Select DeptID From Staffs Where Job_Role ='$jbr' LIMIT 1") or die(mysqli_error($con));
        while ($results = mysqli_fetch_array($dept)){
            $deptId = $results['DeptID'];
           
        }
        if(!empty($deptId)){
            $dptCode = mysqli_query($con,"Select DeptID From Departments Where ID ='$deptId'")or  die(mysqli_error($con));
            while ($results = mysqli_fetch_array($dptCode)){
            $deptCode = $results['DeptID'];
            $_SESSION['dptID'] = $deptId;
        }
        if(!empty($deptCode)){
            $dptCode = mysqli_query($con,"Select DeptID, DeptName, FacultyID From Departments Where DeptID ='$deptCode'")or   die(mysqli_error($con));
            while ($results = mysqli_fetch_array($dptCode)){
             $dptID .= strtoupper($results['DeptID']);
             $deptName .= strtoupper($results['DeptName']);
              $facs = $results['FacultyID'];
             $_SESSION['deptN']=$results['DeptName'];
             $_SESSION['dpt']= $dptID;
              $_SESSION['facs']= $facs;
        }
        
        }
    }
}
}
?>


<!DOCTYPE html>
<?php include('headers.php'); ?>
    <body class="sb-nav-fixed">
       <?php include('topbar.php'); ?>
        <?php include('sidebar.php'); ?>
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> Lecturers Management Dashboard </h3></div>
                                  
                                    <div class="card-body">
                                        <form action="passwordReset.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"> <span style="color:green; font-size:18px;"></span>
                                                        <!--<label class="small mb-1" for="inputFirstName">Add Lecturers</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="../addStaff.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="AddLectures" class="btn btn-primary btn-block">Add Lecturers</button></a></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Assign Courses</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="../setLectures.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="AssignCourses" class="btn btn-primary btn-block">Assign Courses</button></a></div>
                                                    </div>
                                                </div>
                                               </div>
                                                  <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Upload Results</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="//.uploadScores.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Upload Results</button></a></div>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Download All Courses</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="../viewResults.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">View All Student Results Uploaded</button></a></div>
                                                    </div>
                                                </div>
                                          
                                            
                                             </div>
                                             <div class="form-row">
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                       <div class="form-group mt-4 mb-0"><a href="../scoreAssSystem.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="download" class="btn btn-primary btn-block">Authorize Results For Student View</button></a></div>
                                                    </div>                                              
                                                    </div>
                                                   
                                                    
                                              <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Download ScoreSheet Template</label>-->
                                                        <div class="form-group mt-4 mb-0"><a href="../approveResults.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Approved Results</button></a></div>
                                                    </div>
                                                </div>
                                                
                                            </div>  
                                            
                                        </form>
                                        
                                        
                                    </div>
                                   
                                   <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                               <marquee behavior="alternate" direction="right" scrollamount="3">Shwoing All Staff Available In ESCOHST-Ijero: <span style="color:green; font-size:18px;"> CLick Details Button to Select Staff to Edit OR Remove Button to Drop STAFF</span></marquee>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                                <th>Staff ID</th>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Surname</th>
                                                <th>Job Role</th>
                                                <th>PhoneNO</th>
                                                <th>Designation</th>
                                                <th>TotalInFaculty</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                  <th>Staff ID</th>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Surname</th>
                                                <th>Job Role</th>
                                                <th>PhoneNO</th>
                                                <th>TDesignation</th>
                                                <th>TotalinFaculty</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php  echo getStaffs($con); ?>
                                        </tbody>
                                    </table>
                                     <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                        <div class="form-group mt-4 mb-0"><a href="expAllStaffs.php?dpt=<?php echo  $dptID ;?>  msg=<?php echo $_GET['msg']; ?>"><button type="button" name="getAllCourses" class="btn btn-primary btn-block">Download All Staff</button></a></div>
                                                        <!--<div class="form-group mt-4 mb-0"><a href="expAllStd.php?dpt=<?php echo  $deptName ;?>  msg=<?php echo $_GET['msg']; ?>"><button type="button" name="getAllCourses" class="btn btn-primary btn-block">Download All My Students</button></a></div>-->
                                                        </div>
                                                </div>
                                </div>
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