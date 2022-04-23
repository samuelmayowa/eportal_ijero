<?php
include_once('../../functions.php');
require_once('../../connection.php');
//confirmLogin();
    //prepare Data
 $jbt="";
    $user="";
    $logUser="";
    
    
$user=$_SESSION['userID'];
$loginUser =$_GET['msg'];
 if(isset($_GET['msg'])){
        $logUser=$_GET['msg'];
        $user=$_SESSION['userID'];
        $query=mysqli_query($con,"Select JobTitle From UserAdmins Where userName ='$user'");
        while($res=mysqli_fetch_array($query)){
            $jbt = $res['JobTitle'];
        }
    }
//confirmHOD($jbt);   

$courseCode ="";
$err="";
$msg="";
if(isset($_GET['c'])){
    $courseCode=$_GET['c'];
    $query=mysqli_query($con,"Update ScoreSheet Set Status =1 Where CourseCode='$courseCode'");
    if(!$query){
        $err="Unbale to Approve Uploaded Results".mysqli_error();
        $msg="<script> alert('$err'); </script>";
    }else{
        $err=$courseCode . " Results Approved Successfully";
        $msg="<script> alert('$err'); </script>";
    }
}

// disapprove Results ====
if(isset($_GET['dsap'])){
    $courseCode=$_GET['dsap'];
    $query=mysqli_query($con,"Update ScoreSheet Set Status =0 Where CourseCode='$courseCode'");
    if(!$query){
        $err="Unbale to Dis-Approve Uploaded Results".mysqli_error();
        $msg="<script> alert('$err'); </script>";
    }else{
        $err=$courseCode . " Results Dis-Approved Successfully";
        $msg="<script> alert('$err'); </script>";
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
                        <?php if(isset($msg)){ echo $msg; } ?>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">View Score Reports</h3></div>
                                  
                                    <div class="card-body">
                                       
                                   <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                All Student Results: Grouped By Courses<a href="manageLectures.php?msg=<?php echo $_GET['msg']; ?>">>> Return Back</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                                <!--<th>MatricNO</th>-->
                                                <!--<th>FullName</th>-->
                                                <!--<th>DeptCode</th>-->
                                                <th>CourseCode</th>
                                                <th>CA1</th>
                                                <th>CA2</th>
                                                <th>CA3</th>
                                                <th>ExamScore</th>
                                                <th>TotalSTD</th>
                                                <!--<th>Cum.TotalScore</th>-->
                                                <!--<th>Grade</th>-->
                                                <th>SubmittedBy</th>
                                                <th>Status</th>
                                                <!--<th>Visibility</th> -->
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <!--<th>MatricNO</th>-->
                                                <!--<th>FullName</th>-->
                                                <!--<th>DeptCode</th>-->
                                                <th>CourseCode</th>
                                                <th>CA1</th>
                                                <th>CA2</th>
                                                <th>CA3</th>
                                                <th>ExamScore</th>
                                                <!--<th>Cum.TotalScore</th>-->
                                                <!--<th>Grade</th>-->
                                                 <th>TotalSTD</th>
                                                <th>SubmittedBy</th>
                                                <th>Status</th>
                                                <!--<th>Visibility</th>--> 
                                                <th>Action</th> 
                                                
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php echo approveResults($con); ?>
                                        </tbody>
                                    </table>
                                     <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                        <div class="form-group mt-4 mb-0"><a href="expResults.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="ExpResults" class="btn btn-primary btn-block">Export Results To Excel(CSV) file</button></a></div>
                                                    </div>
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
require('../../close_connection.php');
?>