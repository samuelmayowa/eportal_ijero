<?php
include_once('../functions.php');
require_once('../connection.php');
$MatricNumber = "";
$payID ='';
$facult="";
$fId="";
$facultName="";
$rol=$_SESSION['rol'];
  confirmLogin();
      $id="";
      if(isset($_GET['facId'])){
    $fId=$_GET['facId'];
    $_SESSION['fId']=$fId;
    $facId=mysqli_query($con,"Select FacultyID, FacultyName From Faculties Where ID ='$fId'");
    while($facId=mysqli_fetch_array($facId)){
        $facult=$facId['FacultyID'];
        $facultName=$facId['FacultyName'];
    }
    //echo "<script> alert('$facult'); </script>";
    
}
     if(isset($_GET['stfId'])){
         $id=$_GET['stfId'];
         $_SESSION['stfID']= $id;
         $deptID = $_GET['dpt'];
         $_SESSION['dpt'] = $deptID;
         $sql="SELECT * FROM Staffs WHERE ID = '$id'";
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($result)) {
            $id=$row['ID'];
          $staffCode= $row['StaffCode'];
           $fname= $row['FirstName'];
           $sname= $row['Surname'] ;
            $phno= $row['PhoneNumber'];
}

if(isset($_GET['dpt'])){
    $deptID = $_GET['dpt'];
        $sql="SELECT DeptID FROM Departments WHERE ID = '$deptID'";
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_array($result)) {
            //$id=$row['ID'];
          $dept= $row['DeptID'];
}
     }
     }
        if(!isset($_SESSION['stfID'])){

    //header('location:dashboard.php?msg=You have not Updated Your Profile');
} else{
     $stdEmail =$_SESSION['stdEmail'];

        if(isset($_POST['assignCourses'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
     $stfCode = $screenData['stfCode'];
     $fulname = $screenData['fulname'];
     $CourseName= $screenData['CourseName'];
     $CourseCode= $screenData['CourseCode'];
     $CourseUnits= $screenData['courseUnits'];
     $phno =$screenData['phno'];
     $fac=$screenData['fac'];
      $dept= $screenData['dept'];
     $Semester= $screenData['Semester'];
     $level= $screenData['level'];
     $sess= $screenData['sess'];
   $stfId =$_SESSION['stfID'];
   $fid= $screenData['fid'];
   $coco ="";
   if(!empty($CourseCode)){
         $query = mysqli_query($con,"SELECT CourseCode  FROM CourseCodes WHERE  Id ='$CourseCode'");
         while($results=mysqli_fetch_array($query)){
               $coco =$results['CourseCode'];
         }
   
        
 $assignCourse = "INSERT INTO Lectures (StaffCode,FullName,PhoneNumber,FacID, DeptCode, CourseCodes, CourseTitles,CourseUnits,AcademicSession, Semester, Level,StaffID) 
 VALUES ('$stfCode','$fulname','$phno','$fid','$dept','$coco', '$CourseName','$CourseUnits','$sess','$Semester','$level',' $stfId')";
       
        // ======= check Code Availability =====
        $CCode="";
        $query = "SELECT CourseCodes  FROM Lectures WHERE StaffID ='$stfId' AND CourseCodes ='$coco'";
        $query = mysqli_query($con,$query);
         $CCode = mysqli_num_rows($query); 

    
     if($CCode ==0){
        // ========End check ====== 
        
        $assignCourse = mysqli_query($con,$assignCourse)or die(mysqli_error($con));
        if(mysqli_affected_rows($assignCourse)==0){
            $msg="Error In Query".mysqli_error($con);
        }
        if(!$assignCourse){
            $msg="Error In Query".mysqli_error($con);
             $msg= "<script> alert('$msg'); </script>";
            //echo "<script> alert('Error In Query'); </script>".mysqli_error($con);
            
        }
        else {
           
            $msg="<script> alert('1 Course Assigned Successfully'); </script>";
            $msg="1 Course Assigned Successfully";
        }
    }
    else{
        $msg = "<script> alert('1 Course Already Assigned To This Lectureer'); </script>";
                }
            } 
        }
}
?>

<!-- ==== Remove Courses Not Needed-->
<?php
$payID ="";
$cID="";
if(isset($_GET['cc'])){
    $cID= $_GET['cc'];
    $r =mysqli_query($con,"Delete From Lectures Where ID =$cID");
    if($r){
        $msg="<script> alert('1 Course Removed Successfully from Lectures Tables'); </script>";
    }
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
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="jquery.min.js"></script>
        <script src="getStaffAjax.js"></script>  
       
        
                                                         
          <script src="jquery.js" type="text/javascript"></script> 
    </head>
    <body class="sb-nav-fixed">
         <?php include('topbar.php'); ?>
       <?php if(empty($email) && empty($gender)){
     header('location:myProfiles.php?msg='.$id);
 } ?>
        <?php include ('sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main onload='loadCategories()'>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br>Ekiti State College Of Health Science and Technology</h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Course Assignment Panel</h3></div>
                                  
                                    <div class="card-body">
                                        <form action="assignCourses.php" method="POST" enctype="multipart/form-data">
                                           <span style="color:green; font-size:18px;"><?php if(isset($msg)){ echo $msg; } ?></span>
                            
                                             <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Staff Code </label> 
                                                        <input class="form-control py-4" id="inputStaffCode" type="text" placeholder="Lectureer's FullName" name="stfCode" value=" <?php if(isset($_POST['stfCode'])){ echo $_POST['stfCode']; } else{ echo $staffCode;  } ?>"  readonly required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputStaffName"> Lectureer's FullName </label> 
                                                        <input class="form-control py-4" id="inputFullName" type="text" placeholder="Lectureer's FullName" name="fulname" value=" <?php if(isset($_POST['fulname'])){ echo $_POST['fulname']; } else{ echo $fname. ' '.$sname;  } ?>"  readonly required />
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="form-row">
                                               <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPhoneNumber">Staff Phone Number</label>
                                                        <input class="form-control py-4" id="inputPhoneNumber" name="phno" type="text" placeholder="Lectureer's Contact Number" value="<?php if(isset($_POST['phno'])) { echo $_POST['phno']; }else { echo $phno; } ?>" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Faculty Code</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Department Staff Is  Domicile"  value="<?php if(isset($_POST['fac'])) { echo $_POST['fac']; } else { echo $facultName; } ?>" name="fac"  readonly />
                                                        
                                                    </div>
                                                    </div>
                                                     <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Department</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Department Staff Is  Domicile"  value="<?php if(isset($_POST['dept'])) { echo $_POST['dept']; } else { echo $dept; } ?>" name="dept"  readonly />
                                                        
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="CourseCode">Courses Code</label>
                                                        <!--<input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Course Code" name="CourseCode"  required />-->
                                                        <select name="CourseCode" class="form-control py-4" id="CourseCode" size="1">
                                                            <option value="">....Select Course Code...</option>
                                                            <?php 
                                                // Fetch Department
                                                $cc="";
                                                $sql_department = "SELECT * FROM CourseCodes";
                                                $department_data = mysqli_query($con,$sql_department);
                                                while($row = mysqli_fetch_assoc($department_data) ){
                                                    $courseId = $row['Id'];
                                                    $cId = $row['CourseCode'];
                                                    //$cT=$row['CourseTitle'];
                                                    //$cU = $row['CourseUnits'];
                                                     $cc .="<option value='$courseId'>$cId</option>";
                                                     
                                                  }
                                                    // Option
                                                   
                                            echo $cc;
                                                ?>
                                                             </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="CourseName">Courses Name</label>
                                                 <select name="CourseName" class="form-control py-4" id="CourseName" size="1"><option value="Select CourseTitle">....CourseName...</option></select>
                                                 </div>
                                            </div>
                                           </div>
                                           <div class="form-row">
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Number Of Units</label>
                                                        <select name="courseUnits" class="form-control py-4" id="courseUnits" size="1" required>
                                                            </select>
                                                    </div>
                                                </div>
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Semester </label>
                                                        <input class="form-control py-4" id="inputFid" name="fid" type="hidden" placeholder="Undergrate or Post Graduate"  value="<?php echo $_GET['facId']; ?>" />
                                                         <select name="Semester" class="form-control py-4" id="inputFirstName" size="1">
                                                            <option value="0">....Choose Semester...</option>
                                                            <option value="First Semester">First Semester</option>
                                                            <option value="Second Semester">Second Semester</option></option>
                                                            </select>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Level</label>
                                                        <select name="level" class="form-control py-4" id="level" size="1">
                                                            <option value="0">..Select Level..</option>
                                                            <option value="100">100</option>
                                                            <option value="200">200</option>
                                                            <option value="300">300</option>
                                                            <option value="400">400</option>
                                                            <option value="500">500</option>
                                                            <option value="600">600</option>
                                                            <option value="Extra">Extra</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Academic Session</label>
                                                        <select name="sess" class="form-control py-4" id="sess" size="1">
                                                            <option value="Select Category">..Select Session..</option>
                                                            <option value="2015/2016">2015/2016</option>
                                                            <option value="2017/2018">2017/2018</option>
                                                            <option value="2019/2020">2019/2020</option>
                                                            <option value="2021/2022">2021/2022</option>
                                                            <option value="2023/2024">2023/2024</option>
                                                            <option value="2025/2026">2025/2026</option>
                                                            <option value="2027/2028">2027/2028</option>
                                                            </select>
                                                    </div>
                                                </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="assignCourses" class="btn btn-primary btn-block">Assign Course Now</button></div>
                                             </div>
                                             </div>
                                        </form>
                                        <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                               <th>StaffCode</th>
                                                <th>FullName</th>
                                                <th>PhoneNumber</th>
                                                <th>CourseCode</th>
                                                <th>CourseTitles</th>
                                                <th>CourseUnits</th>
                                                <th>SESSION</th>
                                                <th>Action</th>
                                           
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>StaffCode</th>
                                                <th>FullName</th>
                                                <th>PhoneNumber</th>
                                                <th>CourseCode</th>
                                                <th>CourseTitles</th>
                                                <th>CourseUnits</th>
                                                <th>SESSION</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                           <!-- <tr>-->
                                           <?php echo getAllLectures($con,$_GET['facId']); ?>
                                          
 
                                                  
                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                        <div class="form-group mt-4 mb-0"><a href="expLectures.php"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Download All Lectures IN Excel</button></a></div>
                                                    </div>
                                                </div>
                                   
                                    </div>
           
               
                
                
                                    <!--   -->
                                    </div>
                </main> 
                
                <br />
                <br />
                 <?php include('footer.php'); ?>