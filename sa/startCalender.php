<?php
include_once('../functions.php');
require_once('../connection.php');
confirmAdmLogin();
    //prepare Data
    $yrs='';
$y=date("Y");
$yr=date("Y")+1; 
//$y=date("Y"); echo $y .'/';  $d=date("Y"); echo $d+=1; 
$ses_cal=$y.'/'. $yr; 
$totalRev="";


echo "<script>alert('$ses_cal');</script>";
$totalRev = getTotalRev($con);
if(isset($_POST['sartCalender'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $sess = $screenData['sess'];
     $cat =  $screenData['cat'];
     if($sess==$ses_cal && $cat =='Prospective'){/* AND ID=4057*/
          $sql_department = "UPDATE students SET studentLevel =100, AcademicSession='$ses_cal'  WHERE  yearOfEntry=$y";
                            $department_data = mysqli_query($con,$sql_department) or die(mysqli_error($con));
                        if($count=mysqli_affected_rows($con)>=1) {
                            $msg="Session Started Successfuly";
                            echo "<script>alert('$msg For $count Students'); </script>";
                        }
     } elseif($sess==$ses_cal && $cat=='Returning'){/* AND ID=4057 AND matricNumber='CHT/ADM/001' */
          $sql_department = "UPDATE students SET studentLevel =studentLevel+100, AcademicSession='$ses_cal'  WHERE  yearOfEntry < $y AND studentLevel<400 ";
                            $department_data = mysqli_query($con,$sql_department) or die(mysqli_error($con));
                        if($count=mysqli_affected_rows($con)>=1) {
                            $msg="Session Started Successfuly";
                            echo "<script>alert('$msg For $count Students'); </script>";
                        }
     }
     /*elseif($sess==$ses_cal&& $cat=='Returning'){
          $sql_department = "UPDATE students SET studentLevel =studentLevel + 100 WHERE  yearOfEntry<$y";
                            $department_data = mysqli_query($con,$sql_department) or die(mysqli_error($con));
                        if($count=mysqli_affected_rows($con)>=1) {
                            $msg="Session Started Successfuly";
                            echo "<script>alert('$msg For $count Students'); </script>";
                        }
     }*//*elseif($sess=='2023/2024'){
          $sql_department = "UPDATE stds_bkp SET studentLevel ='100' WHERE  ID=773 AND studentLevel='Prospective'";
                                                $department_data = mysqli_query($con,$sql_department) or die(mysqli_error($con));
                        if(mysqli_affected_rows($con)==1) {
                            $msg="Session Started Successfuly";
                            echo "<script>alert('$msg'); </script>";
                        }
                }elseif($sess=='2021/2022'){
          //$sql_department = "UPDATE students SET studentLevel =studentLevel+100' WHERE  studentLevel>='100'";
                            $department_data = mysqli_query($con,$sql_department) or die(mysqli_error($con));
                        if($count=mysqli_affected_rows($con)>=1) {
                            $msg="Session Started Successfuly";
                            echo "<script>alert('$msg For $count Students'); </script>";
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
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            td{font-size:12px;}
            td a{ font-size:12px;}
        </style>
    </head>
    
    <body class="sb-nav-fixed">
         <?php include('topbar.php'); ?>
        
        <?php include ('sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                       
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> SCHOOL SESSION MANAGER </h3></div>
                                  <span style="color:red; font-size:18px;"><?php if(isset($_GET['upd'])){ echo  $_GET['upd']; } ?></span>
                    <div class="card-body"> 
                        
                                         
                                            <form action="startCalender.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                           
                                               <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Academic Session</label>
                                                        <select name="sess" class="form-control py-4" id="sess" size="1">
                                                            <option value="Select Category">..Select Session..</option>
                                                           <option value="2017/2018">2017/2018</option>
                                                            <option value="2018/2019">2018/2019</option>
                                                            <option value="2019/2020">2019/2020</option>
                                                            <option value="2020/2021">2020/2021</option>
                                                            <option value="2021/2022">2021/2022</option>
                                                            <option value="2022/2023">2022/2023</option>
                                                            <option value="2023/2024">2023/2024</option>
                                                            <option value="2024/2025">2024/2025</option>
                                                            <option value="2025/2026">2025/2026</option>
                                                            </select>
                                                    </div>
                                                </div>
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">STUDENT CATEGORY</label>
                                                       <select name="cat" class="form-control py-4" id="sess" size="1">
                                                            <option value="Select Category">..Select Student Category..</option>
                                                            <option value="Prospective">Newly Admitted Students</option>
                                                            <option value="Returning">Returning Students</option>
                                                              </select>    
                                                    </div>
                                                </div>
                                            </div>
                                                  <div class="col-md-8">
                                                    <div class="form-group">
                                          <div class="form-control py-4" ><button type="submit" name="sartCalender" class="btn btn-primary btn-block" onlick="button.attr:disable;">Start Academic Session</div>
                                            </div>
                                            </div>
                                             
                                        </form>
                                        
                                        
                                    </div>
                                   
                                   <div class="card mb-4">
                            <div class="card-header" style="color:green;">
                                <i class="fas fa-table mr-1"></i>
                                <marquee behavior="scroll" direction="left" scrollamount="1" style="color:red;">All Application received So Far: <?php echo getTotalAppl($con); ?></marquee>
                            </div>
                               
                            <div class="card-body">
                                 <div class="table-responsive">
                                    
                                     <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                       <!-- <div class="form-group mt-4 mb-0"><a href="getAllPayments.php"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Download All Payments</button></a></div>-->
                                                    </div>
                                                </div>
                                </div>
                            </div>
                        </div>
                </main>
                <?php if(isset($_GET['upd'])){ echo $_GET['upd'];  } ?>
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
    </body>
</html>

<?php 
require('../close_connection.php');

?>