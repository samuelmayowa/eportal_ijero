<?php
include_once('../../functions.php');
require_once('../../connection.php');
//confirmLogin();
$msg="";
$usr="";
$usr=$_SESSION['userID'];
//prepare Data
    $std ="";
    $user ="";
if(isset($_GET['id'])){
    $regCode = $_GET['id'];
    $user = $_GET['user'];
    $dpt=$_GET['dpt'];
    if(!empty($regCode)){
        $query = mysqli_query($con, "UPDATE ScreeningResults SET Average =TotalScore/5");
                    if(!$query){
                            $msg="Error In Calculating Average".mysqli_error($con);
                        }else{
                             $qury=mysqli_query($con,"SELECT * 
                                    FROM    ScreeningResults
                                    Where ID ='$regCode'");
                                    while($rs= mysqli_fetch_array($qury)){
                                                
                            $id= $rs ['ID'];
                        //$_SESSION['dpt']= $rs ['Departments'];
                        $std.=  "<tr><td>" .$rs ['StudentID'] . "</td>" .
        "<td>" . $rs['FullName'] ."</td>".
        "<td>".  $rs['Maths'] . "</td>" .
         "<td>" . $rs ['Eng'] . "</td>" .
         "<td>" . $rs ['Chem'] . "</td>" .
         "<td>" . $rs['Phy'] . "</td>" .
          "<td>" . $rs ['Biol'] . "</td>" .
          "<td>" . $rs ['TotalScore'] . "</td>" .
          "<td>" . $rs ['Average'] . "</td>" .
          "<td>" ."<a href='scoreDetails.php?id=$id && msg=$msg' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure You Want to View Score Details?')\">Details</a>
          <a href='grantAdm.php?id=$id && msg=$msg' class='btn btn-primary btn-block' onclick=\"return confirm('Are you sure You Want to View Score Details?')\">Admit</a>
          </td>".
          "</tr>";
                   
                    }
   }
}
}
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
                            <a class="nav-link" href="dashboard.php.php">
                                Admission Officer DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Admission Area</div>
                            <a class="nav-link collapsed" href="dashboard.php.php" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Admission Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="dashboard.php">Screening Results</a>
                                    <a class="nav-link" href="dashboard.php">View All Application</a>
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
                                            <a class="nav-link" href="#manageFees.phpl">View Applicatio</a>
                                            <a class="nav-link" href="#updateFees.php">Update Fees</a>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/logo-eschsti.png" width="10%"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Upload Applicants Screening Results</h3></div>
                                    <div class="card-body"><span style="" olor:red; font-size:10px;><?php if(isset($msg)) { echo $msg; } ?></span>
                                        <form action="screeningResults.php" method="POST" enctype="multipart/form-data">
                                          
                                            <div class="form-row">
                                             <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Upload File Here:</label>
                                                         <input type="file" name="results" class="form-control py-4" id="inputFirstName"  placeholder="Select File" />
                                                    </div>
                                                    </div>
                                                
                                           </div>
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="submit" class="btn btn-primary btn-block">Upload Results</a></div>
                                        </form>
                                    </div>
                                     <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                               
                                               <th>MatricNO.</th>
                                                <th>FullName</th>
                                                <th>Maths</th>
                                                <th>English</th>
                                                <th>Chemistry</th>
                                                <th>Physics</th>
                                                <th>Biology</th>
                                                <th>TotalScore</th>
                                                <th>Average</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>MatricNO.</th>
                                                <th>FullName</th>
                                                <th>Maths</th>
                                                <th>English</th>
                                                <th>Chemistry</th>
                                                <th>Physics</th>
                                                <th>Biology</th>
                                                <th>TotalScore</th>
                                                <th>Average</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php echo $std; ?>
                                           <!-- <tr>
                                                <td><?php //echo  $regNum; ?></td>
                                                <td><?php //echo  $cCode; ?></td>
                                                <td><?php //echo  $cName; ?></td>
                                                <td><?php //echo  $cUnits; ?></td>
                                                <td><?php //echo  $regAs; ?></td>
                                                <td><?php //echo  $stdL; ?></td>
                                                <td><?php //echo  $total; ?></td>
                                                
                                            </tr>-->
                                           <!-- <tr>-->
                                           <?php //echo getAllStd($con); ?>
                                           <?php //echo getStdByCourses($con,$dptN); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="form-group mt-4 mb-0"><a href="dashboard.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block"> >> Return Back  << </button></a></div>
                                                        <div class="form-group mt-4 mb-0"><a href="logout.php?msg=<?php echo $_GET['msg']; ?>"><button type="button" name="stdDetails" class="btn btn-primary btn-block">Logout Here </button></a></div>
                                                    </div>
                                                </div>
                                                <div class="form-group mt-4 mb-0"><a href="expScreeningScore.php"><button type="button" name="expDepAppl" class="btn btn-primary btn-block">Download Screening Scores</button></a></div>
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


if(isset($_FILES['results']['name'])){
     require_once("../../connection.php");
    include("../SimpleXLSX.php");
        if($con){
        //echo "Hi You Are Connected";
        $std=SimpleXLSX::parse($_FILES['results']['tmp_name']);
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
            $tblName="ScreeningResults";
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
require('../../close_connection.php');

?>
