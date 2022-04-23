<?php
include_once('../../functions.php');
require_once('../../connection.php');
$st="";
  confirmLogin();
  $regNum=="";
   $cCode="";
   $cName="";
   $cUnits=="";
   $regAs ="";
   $stdL="";
   $total="";
if(isset($_GET['msg'])){
    $msg=$_GET['msg'];
}

$deptId="";
$jbr="";
$dptID ="";
$dptN ="";
$dp="";
$dpt="";
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
             $dpt= strtoupper($results['DeptID']);
             $dptN.= strtoupper($results['DeptID']);
             $dp = strtoupper($results['DeptName']);
             $deptName .= strtoupper($results['DeptName']);
              $facs = $results['FacultyID'];
              $dptN = strtoupper($results['DeptName']);
             $_SESSION['deptN']=$dptN;
             $_SESSION['dpt']= $dptID;
              $_SESSION['facs']= $facs;
        }
        
        }
    }
}
}


    //prepare Data
    $std ="";
    $user ="";
if(isset($_GET['cc'])){
    $regCode = $_GET['cc'];
    $user = $_GET['user'];
    if(!empty($regCode)){
        $query = mysqli_query($con, "SELECT MatricNumber,CourseCode ,CourseName,CourseUnits, 
                    RegisteredAs, StdLevel  FROM studentCourseReg
                    Where  MatricNumber='$user' AND Department='$dp' ORDER BY CourseUnits");
                    while($rs= mysqli_fetch_array($query)){
                        /*$regNum = $rs['MatricNumber'];
                        $cCode = $rs['CourseCode'];
                        $cName = $rs['CourseName'];
                        $cUnits = $rs['CourseUnits'];
                        $regAs = $rs['RegisteredAs'];
                        $stdL = $rs['StdLevel'];*/
                        //$total = $rs['TOTAL'];
                        $std.=  "<tr><td>" .$rs ['MatricNumber'] . "</td>" .
        "<td>" . $rs['CourseCode'] ."</td>". "<td>".  $rs['CourseName'] . "</td>" .
         "<td>" . $rs ['CourseUnits'] . "</td>" .
         "<td>" . $rs ['RegisteredAs'] . "</td>" .
         "<td>" . $rs['StdLevel'] . "</td>" 
         /* "<td>" . $stdList ['TOTAL'] . "</td>" */."</tr>";
                    }
    }
}

?>


<!DOCTYPE html>
<!DOCTYPE html>
<?php include('headers.php'); ?>
    <body class="sb-nav-fixed">
       <?php include('topbar.php'); ?>
        <?php include('sidebar.php'); ?>
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Course Assessment Manager</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="editStudent.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:red; font-size:18px;">Welcome Back : <?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                       <div class="form-group mt-4 mb-0"><a href="getScoreSheet.php"><button type="button" name="download" class="btn btn-primary btn-block">Download Score Sheet</button></a></div>
                                                    </div>                                              
                                                    </div>
                                                    
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                       <a href="uploadScores.php"><div class="form-group mt-4 mb-0"><button type="button" name="uploadScores" class="btn btn-primary btn-block">Uplaod Score Sheet</button></div></a>
                                                    </div>                                             
                                                    </div>
                                                    </div>

                                                <div class="form-row">
                                                
                                                    
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                       <a href="viewResults.php"><div class="form-group mt-4 mb-0"><button type="button" name="ViewScores" class="btn btn-primary btn-block">View Uploaded Results</div></a>
                                                    </div>                                             
                                                    </div>
                                                    </div>
                                               </div>
                                          <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                My Students In : <?php echo $dpt; ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                               
                                                <th>CourseCode</th>
                                                <th>CourseName</th>
                                                <th>CourseUnits</th>
                                               <th>SESSION</th>
                                                <th>Action</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 
                                                <th>CourseCode</th>
                                                <th>CourseName</th>
                                                <th>CourseUnits</th>
                                                <th>SESSION</th>
                                                 <th>Action</th>
                                                
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                            <?php
                                            $std="";
                                            $user=$_SESSION['userID'];
                                            echo getLectures($con,$user);
                                            ?>
                                           
                                           <?php //echo getStdByCourses($con,$dptN); ?>
                                        </tbody>
                                    </table>
                                </div><?php echo " Data : " . $std; ?>
                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-group mt-4 mb-0"><a href="manageScore.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block"> >> Return Back  << </button></a></div>
                                                        <div class="form-group mt-4 mb-0"><a href="logout.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Logout Here </button></a></div>
                                                    </div>
                                                </div>
                            </div>
                        </div>
                                            <!--<div class="form-group mt-4 mb-0"><button type="submit" name="editStd" class="btn btn-primary btn-block">Upload Results</div>-->
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