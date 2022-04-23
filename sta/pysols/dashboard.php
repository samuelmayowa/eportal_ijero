<?php
include_once('../functions.php');
require_once('../connection.php');
confirmLogin();
$user="";
$citizen ="";
$amtPaid="";
$amtpayable="";
$totalDue="";
$totalPaid="";
 $user = $_SESSION['userID'];
 $email = $_SESSION['stdEmail'];
 if(isset($_GET['userId']) || isset($_SESSION['userID'])){
$payID = getPayId($con,$_GET['userId'],$email);
$_SESSION['payID'] = $payID;
}
    $payID = getPayId($con,$user,$email);
    $_SESSION['payID'] = $payID;

$email = $_SESSION['stdEmail'];
 if(isset($_SESSION['userID'])){
     
     if($query = mysqli_query($con, "Select stateOfOrigin, Citizenship, studentLevel From students Where matricNumber ='$user'")){
        while ($result = mysqli_fetch_array($query)){
            $st = $result['stateOfOrigin'];
             $citizen = $result['Citizenship'];
             $stdLevel = $result ['studentLevel'];
             $_SESSION['stdLev'] = $stdLevel;
            $_SESSION['citizen'] = $citizen;
        }
     }

        if($query = mysqli_query($con, "Select sum(AmountPaid) AS TOTAL From studentPayments Where matricID ='$user'")){
        while ($result = mysqli_fetch_array($query)){
            $amtPaid = $result['TOTAL'];
            
        }
        }
       
        if($query = mysqli_query($con, "Select Amount From paymentCategories Where Citizenship ='$citizen' AND Level LIKE '$stdLevel' LIMIT 1")){
        while ($result = mysqli_fetch_array($query)){
            $amtpayable = $result['Amount'];
            $_SESSION['amtPayable'] = $amtpayable;
        }
}
}
if(empty($amtpayable)){
     if($query = mysqli_query($con, "Select Amount From paymentCategories Where Citizenship ='$citizen' OR Level LIKE '$stdLevel%' ")){
        while ($result = mysqli_fetch_array($query)){
            $amtpayable = $result['Amount'];
            $totalDue=abs($amtpayable - $amtPaid);
            //$_SESSION['amtPayable'] = $amtpayable;
            $totalDue=$amtpayable;
             $_SESSION['totalDue'] = $totalDue;
             
            
            
        }
       
}
}else{
     //=====Get All payment Total=======
     
 if($query = mysqli_query($con, "Select Sum(AmountPaid)AS TOTAL From studentPayments Where matricID ='$user'")){
              while ($result = mysqli_fetch_array($query)){
            $totalPaid = $result['TOTAL'];
              }
        }
if(empty($amtPaid)){
     $totalDue="<font color='orange'>NotCleared($amtpayable)</font>";
    $_SESSION['totalDue'] = $totalDue;
}
if(empty($amtPaid)){
    $amtPaid="<font color='red'>Not Paid</font>";
}
$totalDue=abs($amtpayable-$amtPaid);
$_SESSION['totalDue'] = $totalDue;
if($totalDue==0){
    $totalDue="<font color='green'>Cleared($amtPaid)". " of (". $_SESSION['amtPayable'].")</font>";
    //$_SESSION['totalDue'] = $totalDue;
}elseif(empty($amtPaid) && ($totalDue==0)){
     $totalDue="<font color='orange'>NotCleared($amtPaid)</font>";
    //$_SESSION['totalDue'] = $totalDue;
}

}
?>
                      
  <!-- ==== Remove Courses Not Needed-->
<?php
$payID ="";
$cID="";
if(isset($_GET['cc'])){
    $cID= $_GET['cc'];
    $r =mysqli_query($con,"Delete From studentCourseReg Where ID =$cID");
    if(mysqli_affected_rows($r)==1){
        $msg="<script> alert('1 Course Removed Successfully'); </script>";
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
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <style>
           /* label{background-color:skyblue; color:#fefefe; }*/
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-gray bg-green" style="background-color:teal; color:#fff;">
            <a class="navbar-brand" href="index.html" style="color:#fff;">ESCOHST-IJERO</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0" style="color:#fff;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color:#fff;"  id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profiles.php">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" style="background-color:#20c997;">
            <div id="layoutSidenav_nav" style="background-color:#000; color:lavender;">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color:##20c997;">
                    <div class="sb-sidenav-menu" style="background-color:##20c997;">
                        <div class="nav" style="background-color:#28a745;">
                            <div class="sb-sidenav-menu-heading">ESCOHST-IJERO</div>
                            <a class="nav-link" href="dashboard.php">
                                Student Home DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Student Area</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Course Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="courseReg.php?payID=<?php echo $_SESSION['payID']; ?>">Register Courses</a>
                                    <a class="nav-link" href="#myLectures.php">Lectures</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Payments Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="payments.php?msg=SchoolFees" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        School Fees
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="payments.php?msg=SchoolFees">School Fees</a>
                                            <a class="nav-link" href="payments.php?msg=CompulsoryFees">Acceptance Fees</a>
                                            <a class="nav-link" href="payments.php?msg=ApplicationFees">Application Fees</a>
                                             <a class="nav-link" href="payments.php?msg=CertificateFees">Certicate Fees</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#checkResults.php">Check Results</a>
                                            <a class="nav-link" href="checkResults.php?id=<?php echo $email; ?>">Print Results</a>
                                            <a class="nav-link" href="#myTranscripts.php">See Grades</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Receipts</div>
                            <?php $payID= $_SESSION['payID']; ?>
                            <a class="nav-link" href="rePrintReceipts.php?payID=<?php echo $payID; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                RePrint Receipts
                            </a>
                            <a class="nav-link" href="paymentHistories.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Payment History
                            </a>
                            <a class="nav-link" href="myResults.php?id=<?php echo $user; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Check My Results
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer" style="Background-color:#28a745;">
                        <div class="small">Logged in as:</div>
                        <?php if(isset($_SESSION['userID'])){
                            echo $_SESSION['userID'];
                        }
                        ?>
                    </div>
                </nav>
            </div>
            <?php if(isset($msg)){ echo  $msg; } ?>
           <?php 
                                        $email ="";
                                        if(isset($_SESSION['stdEmail'])){
                                            $email = $_SESSION['stdEmail'];
                                            $file_path =getImage($con,$email);
                                        }
                                         $_SESSION['file_path'] =$file_path;
                                        ?>
             <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-md border-0 rounded-md md-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                     <?php if(isset($_GET['msg'])){ echo '<span style="color:red;" >' .$_GET['msg'] .'</span>'; } ?>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Student Dashboard </h3><?php// if(isset($totalPaid)){ echo  "TotalPaid: ".$totalPaid; } ?></div>
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><?php if(isset($upd)){ echo  $upd; } ?>
                                                        <?php 
                                                                        $stdEmail ="";
                                                                        $schlID ='';
                                                                        $matri =$_SESSION['ID'];
                                                            $query = "SELECT * FROM students WHERE ID='$matri'";
                                                            $query = mysqli_query($con, $query) or die (mysqli_error($con));
                                                            while ($schl = mysqli_fetch_array($query)){
                                                                $stdLevel = $schl ['studentLevel'];
                                                               $fname=$schl['firstName'];
                                                               $midName= $schl['middleName'];
                                                               $lname = $schl ['lastName'];
                                                               $stdCode = $_SESSION['userID'];
                                                               $dept = $schl ['department'];
                                                               $stdPhno =$schl['stdPhoneNumber'];
                                                               $yearOfEntry = $schl['yearOfEntry'];
                                                               $faculty = $schl['faculty'];
                                                               $gender = $schl['Gender'];
                                                               $addr = $schl['ContactAddr'];
                                                               $city = $schl ['City'];
                                                               $st = $schl ['stateOfOrigin'];
                                                               $lga = $schl['LGA'];
                                                               $kin = $schl['KinName'];
                                                               $kinNum = $schl['KinPhoneNumber'];
                                                               $stdEmail = $schl['studentEmail'];
                                                               $_SESSION['stdPhno'] = $stdPhno;
                                                               $_SESSION['stdEmail']= $stdEmail;
                                                              $_SESSION['fname'] =$fname;
                                                              $_SESSION['midName'] = $midName;
                                                              $_SESSION['lname'] = $lname;
                                                              $_SESSION['dept'] =$dept;
                                                              $_SESSION['gender'] = $gender;
                                                              $_SESSION['addr'] =$addr;
                                                              $_SESSION['city'] = $city;
                                                              $_SESSION['st'] = $st;
                                                              $_SESSION['lga'] = $lga;
                                                              $_SESSION['kin'] = $kin;
                                                              $_SESSION['kinNum'] = $kinNum;
                                                              $_SESSION['yearOfEntry']= $yearOfEntry;
                                                              $_SESSION['faculty'] = $faculty;
                                                              $_SESSION['stdLevel'] = $stdLevel;
                                                              $_SESSION['stdPhno'] = $stdPhno;
                                                             
                                                              //setcookie('pid', $_SESSION['pid'], time() + (3600), "/");
                                                            } 
                                                             $stdEmail=$_SESSION['stdEmail'];
                                                             $stdPhno= $_SESSION['stdPhno'];
    
    
   
                                                            setcookie('stdEmail', $_SESSION['stdEmail'], time() + (3600), "/");
                                                            echo '<table border="2" style="text-align:left; float:left; margin-right:20px; font-size:16px;" cellpadding="5" cellspaccing="5">';
                                                               echo "<tr><td style='background-color:green; color:#fff;'> Matric Number : </td><td style='background-color:green; color:#fff;'>".  $stdCode . "</td></tr>";   
                                                               echo "<tr><td style='background-color:green; color:lavender'>FullName : </td><td style='background-color:maroon; color:lavender;'>". $fname . '  '. $midName .' ' .  $lname . "</td></tr>";
                                                               echo "<tr><td style='background-color:green;  color:lavender'> Department: </td><td style='background-color:maroon; color:lavender;'>".  $dept . "</td></tr>";
                                                               echo "<tr><td style='background-color:green;  color:lavender'> Course: </td><td style='background-color:maroon; color:lavender;'>".  $dept . "</td></tr>";
                                                               echo "<tr><td style='background-color:green;  color:lavender'> Level: </td><td style='background-color:maroon; color:lavender;'>" .  $stdLevel . "</td></tr>";
                                                               echo "<tr><td style='background-color:green; color:#fff;'> Academic Calender: </td><td style='background-color:green; color:#fff;'>".  $yearOfEntry . "</td></tr>";
                                                               echo "<tr><td style='background-color:green; color:#fff;'> State Of Origin: </td><td style='background-color:green; color:#fff;'>".  $st . "</td></tr>";
                                                                    //    if(isset($schools)){ echo $schools; } 
                                                                    echo "</table>"; 
                                                                    echo '<table border="2" style="text-align:left; font-size:16px;" cellpadding="5" cellspaccing="5" width="53%">';
                                                               echo "<tr><td style='background-color:green; color:lavender'> Paymemnt Ref : </td><td style='background-color:maroon; color:lavender;'>".  $_SESSION['payID'] . "</td><td rowspan='4' valign='top'><img   src='$file_path' alt='Passport Here' style='width:auto; height:100px; border:5px solid green;' align='center'  ></td></tr>";   
                                                               echo "<tr><td style='background-color:green; color:lavender'>Amount Payable : </td><td style='background-color:maroon; color:lavender;'>". $amtpayable. "</td></tr>";
                                                               echo "<tr><td style='background-color:green; color:lavender'> Amount Paid: </td><td style='background-color:green; color:#fff;'>#".  $amtPaid. " .00</td></tr>";
                                                               echo "<tr><td style='background-color:green; color:lavender'> Total Due Balance:</td><td style='background-color:maroon; color:lavender;'>#".$amtD=abs($amtpayable-$amtPaid). '.00 '. "</td></tr>";
                                                               echo "<tr><td style='background-color:green; color:lavender'> Citizenship:</td><td style='background-color:maroon; color:lavender;'>". $_SESSION['citizen']. "</td></tr>";
                                                               $_SESSION['amtD'] =$amtD;
                                                                    //    if(isset($schools)){ echo $schools; } 
                                                                    echo "</table>";
                                                                    
                                                                        ?> 
                                      </h3></div>
                                                                        
                                   <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                       <h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/courseReg.png" style="width:160px; height:120px;"><br><a href="courseReg.php?payID=<?php echo $_SESSION['payID']; ?>">My Course Registration</a> </h3>
                                                    </div>
                                                </div>
                                                
                                      <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/payments.jpg" style="width:160px; height:120px;"><br><a href="payments.php">My Payments</a> </h3>
                                                       
                                                    </div>
                                                </div>
                                                </div>
                                                 
                                         <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        
                                                       <h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/profiles.jpg" style="width:160px; height:120px;"><br><a href="profiles.php" >Update My Profiles</a> </h3>
                                                    </div>
                                                </div>
                                                
                                      <!--<div class="form-row">-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                      <h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/profiles-01.jpg" style="width:160px; height:120px;"><br><a href="profiles.php">Change My Profile Passport</a> </h3>
                                                       
                                                    </div>
                                                </div>
                                                </div>
                                    </div>
                                     <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                My Registered Courses: <?php echo $_SESSION['stdEmail']; ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                               <th>MatricNO.</th>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Dept</th>
                                                <th>Course Units</th>
                                                <th>Semester</th>
                                                <th>RegisteredAs</th>
                                                <th>Action</th>
                                           
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>MatricNO.</th>
                                                <th>Course Code</th>
                                                <th>Course Name</th>
                                                <th>Dept</th>
                                                <th>Course Units</th>
                                                <th>Semester</th>
                                                <th>RegisteredAs</th>
                                                <th>Action</th>
                                                
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            
                                           <!-- <tr>-->
                                           <?php
                                           $stdEmai ="";
                                           $pid= $_SESSION['payID'];
                                                 $matr =$_SESSION['userID'];
                                                 $stdEmai = $_SESSION['stdEmail'];
                                                 if(!empty($stdEmai)){
                                                 
       $query = "SELECT ID, MatricNumber,CourseUnits,CourseCode,CourseName,Semester, RegisteredAs, Department FROM studentCourseReg WHERE studentEmail ='$stdEmai' ORDER BY CourseUnits";
        $query = mysqli_query($con,$query) or die(mysqli_error($con));
        while($stdList = mysqli_fetch_array($query)){
            $id = $stdList['ID'];
            echo   "<tr><td>" .$stdList ['MatricNumber'] . "</td>" .
        "<td>" . $stdList['CourseCode'] . "</td>". "<td>".  $stdList['CourseName'] . "</td>" .
         "<td>" . $stdList ['Department'] . "</td>" .
         "<td>" . $stdList ['CourseUnits'] . "</td>" .
         "<td>" . $stdList ['Semester'] . "</td>" .
         "<td>" . $stdList ['RegisteredAs'] . "</td>" .
         "<td>" ."<a href='dashboard.php?cc=$id&&payID=$pid' class='btn btn-primary btn-block'".' onclick="'.'confirm("Are You Sure");'."> Remove </a></td>". "</tr>";
    } }  
?>
 
                                                  
                                        </tbody>
                                    </table>
                                             <div class="col-md-6">
                                            <div class="form-group">
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="printCourseForm" class="btn btn-primary btn-block"><a class="btn btn-primary btn-block" href="courseForm.php?stdM=<?php echo $stdEmai; ?>">Print Course Form</a></button></div>
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
