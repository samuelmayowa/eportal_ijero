<?php
include_once('../functions.php');
require_once('../connection.php');
confirmLogin();
if(isset($_GET['msg'])){
    $userAdm=confirmUserAdm($con, $_GET['msg']);
}

$deptId="";
$jbr="";
$dptID ="";
$deptName ="SCHOOL OF ";
$deptN="";
if(isset($_GET['msg'])){
    $jbr = $_GET['msg'];
    if(!empty($jbr)){
        $dept = mysqli_query($con, "Select DeptID From Staffs Where Job_Role ='$jbr'") or die(mysqli_error($con));
        while ($results = mysqli_fetch_array($dept)){
           $deptId = $results['DeptID'];
          }
        if(!empty($deptId)){
            $dptCode = mysqli_query($con,"Select DeptID,DeptName From Departments Where ID ='$deptId'")or  die(mysqli_error($con));
            while ($results = mysqli_fetch_array($dptCode)){
            $deptCode = $results['DeptID'];
            $deptN  = $results['DeptName'];
            $_SESSION['DeptN'] = $deptN; 
        }
        if(!empty($deptCode)){
            $dptCode = mysqli_query($con,"Select DeptID, DeptName From Departments Where DeptID ='$deptCode'")or   die(mysqli_error($con));
            while ($results = mysqli_fetch_array($dptCode)){
             $dptID .= strtoupper($results['DeptID']);
             $deptName .= strtoupper($results['DeptName']);
             $_SESSION['deptName']=$deptName ;
             $_SESSION['dpt']= $dptID;
        }
        
        }
    }
}
}

  $jbt="";
    $user="";
    $logUser="";
    
$user=$_SESSION['userID'];
$loginUser =$_GET['msg'];
 if(isset($_GET['msg'])){
        $logUser=$_GET['msg'];
        $user=$_SESSION['userID'];
        $query=mysqli_query($con,"Select * From Staffs Where StaffCode ='$user'");
        while($res=mysqli_fetch_array($query)){
          
            $jbt = $res['Job_Role'];
            $_SESSION['jbr']=$jbt;
        }
    }
 confirmSuper ($jbt);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Science And Technology, Ijero Ekiti" />
        <meta name="author" content="" />
        <title>Eportal-Staff Home</title>
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
                    <div class="container-fluid">
                        <h1 class="mt-4">Staff Admin Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Admin Area</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4"> <?php if(isset($_GET['msg'])){ $msg=$_GET['msg']; echo "<script>alert('$msg'); </script>"; } ?>
                                    <div class="card-body">Manage Department & Courses</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="courseManager.php?msg=<?php echo $_GET['msg']; ?>">Go To Manager</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Assign Courses</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="setLectures.php?msg=<?php echo $_GET['msg']; ?>">Assign Courses To Lecturer</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Get All Fees Details</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="getFeesDetails.php?msg=<?php echo $_GET['msg']; ?>">Get All Fees Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Manage Student Assessment</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#manageAss.php?msg=<?php echo $_GET['msg']; ?>">Go To Assessment Manager</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Import All Existing Students</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="uploadStudents.php?msg=<?php echo $_GET['msg']; ?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                           <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Manage All Payments</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="bursary/dashboard.php?msg=<?php echo $_GET['msg']; ?>">Go To Finace Manager</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Reset Passwords</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="passwordReset.php?msg=<?php echo $_GET['msg']; ?>">Go To Credential Manager</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Manage Portal Admin User</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#adminUsers.php?msg=<?php echo $_GET['msg']; ?>">Go to Staff Portal User Admin Manager</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Edit Student Details</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="editStudent.php?msg=<?php echo $_GET['msg']; ?>">Go To Student Data Manager</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                           <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Add Staff / Lecturer</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="addStaff.php?msg=<?php echo $_GET['msg']; ?>">Go To Lecturers Manager</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Manage Student Assessment</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="manageLectures.php?dpt=<?php echo  $dptID ?>&&msg=<?php echo $_GET['msg']; ?>">Go To Results Manager</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Manage Applications : <?php echo getTotalAppl($con); ?></div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="admission/dashboard.php?msg=<?php echo $_GET['msg']; ?>">Total Unpaid RRR: <?php echo getUnpaid($con); ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                             <div class="row">
                             <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Edit Application Details</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="edit_Application.php?msg=<?php echo $_GET['msg']; ?>">Go To Applicants Data Manager</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Manage Admissions : </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="admission/dashboard.php?msg=<?php echo $_GET['msg']; ?>">Uncompleted: <?php echo getUncompleted($con); ?></a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Download Student Data Sheets </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="studentSheets.xlsx?msg=<?php echo $_GET['msg']; ?>">Download Student DataSheet</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">GET SCRATCH PIN </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="printscratchpin.php?msg=<?php echo $_GET['msg']; ?>">PRINT SCRATCH CARD</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                <marquee behavior="scroll" direction="left" scrollamount="2" style="color:red;">All Application received So Far: <?php echo getTotalAppl($con); ?></marquee>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                
                                    <div class="row">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="mt-4 mb-0"><a  href="https://eportal.escohsti-edu.ng/staffArea/startCalender.php" name="printCourseForm" class="btn btn-primary btn-block" >START ACADEMIC SESSION </a></div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mt-4 mb-0"><a  href="https://eportal.escohsti-edu.ng/staffArea/photo_cardCheck.php" name="printCourseForm" class="btn btn-primary btn-block" >Verify Student</a></div>
                                        </div>
                                        
                                        <div class="col-md-6">        
                                            <div class="mt-4 mb-0"><a href="dashboard_copy.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Show All Students Data</button></a></div>
                                        </div>
<!--                                    </div>
                                    <div class="row">-->
                                        <div class="col-md-6">
                                            <div class="mt-4 mb-0"><a  href="newsMgt/dashboard.php?msg=<?php echo $_GET['msg']; ?>" name="printCourseForm" class="btn btn-primary btn-block" >PUBLISH ARTICLES to Portal For Students</a></div>
                                        </div>
                                        <div class="col-md-6">        
                                            <div class="mt-4 mb-0"><a href="newsMgt/dashboard.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Publish Notifications</button></a></div>
                                        </div>
                                   
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-4 mb-0"><a href="uploadPUTMERe.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Upload Post UTME Result</button></a></div>
                                                    </div>
                                                    <div class="col-md-6"> 
                                                        <div class="form-group mt-4 mb-0"><a href="getAllStudents.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Download All Students To Excel</button></a></div>
                                                    </div>
                                                    <div class="col-md-6">
                                            <div class="mt-4 mb-0"><a  href="https://eportal.escohsti-edu.ng/staffArea/closeApplications.php" name="printCourseForm" class="btn btn-primary btn-block" >START / CLOSE APPLICATION </a></div>
                                        </div>
                                                </div>
                                    <!-- <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                               <th>MatricNO.</th>
                                                <th>FullName</th>
                                                <th>Phone NUM</th>
                                                <th>Dept</th>
                                                <th>Gender</th>
                                                <th>StdLevel</th>
                                                <th>Action</th>
                                           
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>MatricNO.</th>
                                                <th>FullName</th>
                                                <th>Phone NUM</th>
                                                <th>Dept</th>
                                                <th>Gender</th>
                                                <th>StdLevel</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                           
                                           <?php //echo getAllStd($con); ?>
                                        </tbody>
                                    </table>-->
                                </div>

                            </div>
                        </div>
                    </div>
                </main>
                <?php include('footer.php'); ?>