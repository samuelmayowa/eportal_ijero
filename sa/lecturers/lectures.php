<?php
include_once('../../functions.php');
require_once('../../connection.php');
confirmLogin();
    //prepare Data
    $jbt="";
    $user="";
    $logUser="";
    $stfId="";
    if(isset($_GET['id'])){
        $stfId=$_GET['id'];
       
    }
    if(isset($_GET['msg'])){
        $logUser=$_GET['msg'];
        $user=$_SESSION['userID'];
         $query=mysqli_query($con,"Select Job_Role From Staffs Where StaffCode ='$user'");
        while($res=mysqli_fetch_array($query)){
            $jbt = $res['Job_Role'];
        }
    }
 if($jbt != $logUser){
       header('location:../logout.php?msg=You Do Not Have View  Access to View This page.');
   } 
$deptId="";
$jbr="";
$dptID ="";
$deptName ="SCHOOL OF ";
if(isset($_GET['msg'])){
    $jbr = $_GET['msg'];
    $_SESSION['msg']=$jbr;
    if(!empty($jbr)){
        $dept = mysqli_query($con, "Select ID,  DeptID From Staffs Where Job_Role ='$jbr' LIMIT 1") or die(mysqli_error($con));
        while ($results = mysqli_fetch_array($dept)){
            $stfId=$results['DeptID'];
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
$lt="";
$_SESSION['stf']=$stfId;
$id=$_SESSION['id'];
echo "<script>alert($id');</script>";
$data=mysqli_query($con,"Select * From Lectures Where StaffID='$id'")or die(mysqli_error($con));
while($getMyLectures=mysqli_fetch_array($data)){

$id=$getMyLectures['ID'];
$lt.= "<tr>".
  
   "<td>" . $getMyLectures['CourseCodes'] . "</td>".
   "<td>" . $getMyLectures['CourseTitles'] . "</td>".
   "<td>" . $getMyLectures['CourseUnits'] . "</td>".
   "<td>" . $getMyLectures['Level'] . "</td>".
   "<td>" . $getMyLectures['AcademicSession'] . "</td>".
   "<td>" . $getMyLectures['Semester'] . "</td>".
   /*"<td>" ."<a href='assignCourses.php?stfId=$id && dpt=$dptID && facId=$facId && msg=$rol' class='btn btn-primary btn-block'>Select Staff</a></td>".*/
   "</tr>";
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
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"> My Lecturers Schedules </h3></div>
                                  
                                    <!--<div class="card-body">
                                        <form action="passwordReset.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group"> <span style="color:green; font-size:18px;"></span>
                                                        <!--<label class="small mb-1" for="inputFirstName">Add Lecturers</label>-->
                                                        <!--<div class="form-group mt-4 mb-0"><a href="#../addStaff.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="AddLectures" class="btn btn-primary btn-block">View All My Registered Students</button></a></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <!--<label class="small mb-1" for="inputFirstName">Assign Courses</label>-->
                                                        <!--<div class="form-group mt-4 mb-0"><a href="#../setLectures.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="AssignCourses" class="btn btn-primary btn-block">See My Lectures</button></a></div>
                                                    </div>
                                                </div>
                                               </div>
                                                  <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">-->
                                                        <!--<label class="small mb-1" for="inputFirstName">Upload Results</label>-->
                                                        <!--<div class="form-group mt-4 mb-0"><a href="#uploadScores.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">Upload Results</button></a></div>
                                                    </div>
                                                </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">-->
                                                        <!--<label class="small mb-1" for="inputFirstName">Download All Courses</label>-->
                                                       <!-- <div class="form-group mt-4 mb-0"><a href="viewResults.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="resetPswd" class="btn btn-primary btn-block">View All Student Results Uploaded</button></a></div>
                                                    </div>
                                                </div>
                                          
                                            
                                             </div>
                                              
                                            
                                        </form>
                                        
                                        
                                    </div>-->
                                   
                                   <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                               <marquee behavior="alternate" direction="right" scrollamount="3">Shwoing ALL COurses Registered To Me: <span style="color:green; font-size:18px;"><?php echo $name; ?></span></marquee>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"  border="1">
                                        <thead>
                                            <tr>
                                               
                                                <th>CourseCode</th>
                                                <th>Course Name</th>
                                                <th>Course Units</th>
                                                <th>Level</th>
                                                <th>SESSION</th>
                                                <th>Semester</th>
                                                <!--<th>Action</th>-->
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>CourseCode</th>
                                                <th>Course Name</th>
                                                <th>Course Units</th>
                                                <th>Level</th>
                                                <th>SESSION</th>
                                                <th>Semester</th>
                                                <!--<th>Action</th>-->
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                           <?php  echo $lt; ?>
                                        </tbody>
                                    </table>
                                     <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                        <div class="form-group mt-4 mb-0"><button type="button" name="getAllCourses" class="btn btn-primary btn-block" onclick="window.print();">Print This Page</button></div>
                                                        <!--<div class="form-group mt-4 mb-0"><a href="expAllStd.php?dpt=<?php echo  $deptName ;?>  msg=<?php echo $_GET['msg']; ?>"><button type="button" name="getAllCourses" class="btn btn-primary btn-block">Download All My Students</button></a></div>-->
                                                        </div>
                                                </div>
                                </div>
                            </div>
                        </div>
                </main>
               <?php include('footer.php'); ?>