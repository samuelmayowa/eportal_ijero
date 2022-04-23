<?php
include_once('../functions.php');
require_once('../connection.php');
//confirmLogin();
$msg="";

/*if(isset($_POST['submit'])){
     $screenData = filter_var_array($_POST, FILTER_SANITIZE_STRING);
                      $level =$screenData['level'];
                      $semester = $screenData['Semester'];
                      $sess = $screenData['sess'];
                $que =mysqli_query($con,"UPDATE  ScoreSheet SET Level='$level', AcademicSession='$sess' Semester='$semester' Where ID =mysqli_insert_id($con)");
                    if($que){
            echo  '<script> alert ("Student Level, Session, Semester Updated Successfully");</script>';
            //header("location:dashboard.php?msg=You Have Successfully Imported Student Data");
                    }
                 else{
                    echo "Error". mysqli_error($con);
                }

}*/
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="College Of Health Sciences And Technology, Ijero-Ekiti" />
        <meta name="author" content="" />
        <title>Eportal-Student Home</title>
          <link rel="shortcut icon" type="image/x-icon" href="../../images/logo-eschsti.png"/>
        <link href="../../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-gray bg-green" style="background-color:teal; color:#fff;">
            <a class="navbar-brand" href="index.html" style="color:#fff;">ESCOHST-IJERO</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search--><h3> College Of Health Sc. and Tech.</h3>
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
                        <a class="dropdown-item" href="manageFinance.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manageFinance.php">Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav" style="background-color:#20c997;">
            <div id="layoutSidenav_nav" style="background-color:dark; color:lavender;">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color:##20c997;">
                    <div class="sb-sidenav-menu" style="background-color:##20c997;">
                        <div class="nav" style="background-color:#28a745;">
                            <div class="sb-sidenav-menu-heading">ESCOHST-IJERO</div>
                            <a class="nav-link" href="manageFinance.php">
                                Burser Admin DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Bursary Area</div>
                            <a class="nav-link collapsed" href="manageFinance.php" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Bursary Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Load Courses</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Load Units</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Payments Records
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Payments Area
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="manageFees.phpl">Add New Fees</a>
                                            <a class="nav-link" href="updateFees.php">Update Fees</a>
                                            <a class="nav-link" href="#getAllPayments.php">View All Payments</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Payment Histories
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="uploadPayments.php">Upload Payments</a>
                                            <a class="nav-link" href="#getAllPayments">View All Payments</a>
                                            <a class="nav-link" href="#findPayments.php">Search Payments</a>
                                        </nav>
                                    </div>
                                </nav>
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
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/logo-eschsti.png" width="10%"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Upload Student Score Records</h3></div>
                                    <div class="card-body"><span style="" olor:red; font-size:10px;><?php if(isset($msg)) { echo $msg; } ?></span>
                                        <form action="uploadScores.php" method="POST" enctype="multipart/form-data">
                                           
                                            <div class="form-row">
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Semester </label>
                                                        <!--<input class="form-control py-4" id="inputPassword" name="progCat" type="text" placeholder="Undergrate or Post Graduate"  required/>-->
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
                                                        <label class="small mb-1" for="inputFirstName">Upload File Here:</label>
                                                         <input type="file" name="scores" class="form-control py-4" id="inputFirstName"  placeholder="Select File" />
                                                    </div>
                                                    </div>
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
                                           </div>
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="submit" class="btn btn-primary btn-block">Upload Scores</a></div>
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
                </footer>  <div style="padding-left:30px;">
        <?php 


if(isset($_FILES['scores']['name'])){
     require_once("../connection.php");
    include("SimpleXLSX.php");
        if($con){
        //echo "Hi You Are Connected";
        $std=SimpleXLSX::parse($_FILES['scores']['tmp_name']);
        //echo "<pre>"; 
        //print_r($std->rows(1));
       // print_r($std->dimension(2));
        //print_r($std -> sheetNames());
        for($sheet=0; $sheet<sizeof($std->sheetNames()); $sheet++){
            $rowcol =$std->dimension($sheet);
        $i=0;
        if($rowcol[0]!=1 && $rowcol[1]!=1){
        foreach ($std->rows($sheet) as $key => $row){
           // print_r($row);
            $q="";
            foreach ($row as $key => $cell){
               // echo $cell; echo "<br>";
                if($i==0){
                    $q.=$cell. " Varchar(50),";
                    
                } else {
                    $q.="'".$cell ."',";
                    
                }
            }
            $tblName="";
            $tblName="ScoreSheet";
            if($i==0){
            $query = "CREATE TABLE IF NOT EXISTS ". $std->sheetName($sheet)." (".rtrim($q,",").");"; 
            }else {
                    //$query = "INSERT INTO " .$std->sheetName($sheet)." Values (".rtrim($q,",").");";
                    $query = "INSERT INTO " .$tblName." Values (".rtrim($q,",").");";
            }
            //echo  $query; 
            
            if(mysqli_query($con,$query)){ 
               
                if($query){
                      

            echo  '<script> alert ("Student Score Sheets Imported Successfully");</script>';
            //header("location:dashboard.php?msg=You Have Successfully Imported Student Data");
                    //}
                } else{
                    echo "Error". mysqli_error($con);
                }
           }
           else{
               echo "Error". mysqli_error($con);
           }
           
            echo "<br>";
            //echo sumScores($con);
             $i++;
        }
        
    }
}
}



                     
}



?></div>
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
