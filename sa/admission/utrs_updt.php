<?php
include_once('../../functions.php');
require_once('../../connection.php');
//confirmLogin();

 

?>
<?php 
if(isset($_FILES['stdresult']['name'])){
        $path = 'uploads/'; // upload directory
        //check if user asked to save fie on server
        $valid_extensions = ['xlsx', 'xls', 'csv']; // valid extensions
        $name = $_FILES['stdresult']['name'];
        $tmp = $_FILES['stdresult']['tmp_name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        // can upload same image using rand function
        $final_name = rand(1000, 1000000).$name;
        // check's valid format
        if (in_array($ext, $valid_extensions)) {
            $path = $path.strtolower($final_name);
            $move_file = move_uploaded_file($tmp, $path);
        } else {
            $err = 'invalid';
        }
    
    
    require_once("../../connection.php");
    include("../SimpleXLSX.php");
        if($con){
            
            $xlsx =  SimpleXLSX::parse($path);
            $dim = $xlsx->dimension(1);
            $num_cols = $dim[0];
            $num_rows = $dim[1];
            $tblName = "admissions";

            foreach ($xlsx->rows() as $k => $r) {
                
                if ($k === 0) {
                    $header = $r;
                    continue;
                }
                $val = $r;

                $set_errors = array_keys($r, true);
                if (!empty($set_errors)) {
                    $sql = "INSERT INTO $tblName (";
            		$i = 0;
            		foreach($header as $k => $v)
            		{   
            			if($i == (sizeof($header) - 1))
            			    $sql .= "`".htmlentities(trim($v),ENT_QUOTES)."`";
            			else
            
            				$sql .= "`".htmlentities(trim($v),ENT_QUOTES)."`,";
            
            			++$i;
            		}
            
            		$sql .= ") VALUES (";
            
            		$i = 0;
            		foreach($val as $k => $v)
            		{
            			if($i == (sizeof($val) - 1))
            			    $sql .= "'".htmlentities(trim($v),ENT_QUOTES)."'";
            			else
            				$sql .= "'".htmlentities(trim($v),ENT_QUOTES)."',";
            			++$i;
            		}
            
            		$sql .= ")";

                    if(mysqli_query($con,$sql)){
                        $mess = true;
                    }
                  
                    
                }
            } 
            if($mess){
                
                       echo  '<script> alert ("Result Data imported Successfully");</script>';
                    header("location:dashboard.php?msg=You Have Successfully Imported Student Data");
            }
}
}
            
            //unlink($path);
            
        //echo "<pre>"; 
        //print_r($std->rows(1));
       // print_r($std->dimension(2));
        //print_r($std -> sheetNames());
        /*for($sheet=0; $sheet<sizeof($std->sheetNames()); $sheet++){
            $rowcol =$std->dimension($sheet);
        $i=0;
        if($rowcol[0]!=1 && $rowcol[1]!=1){
        foreach ($std->rows($sheet) as $key => $row){
           // print_r($row);
            $q="";
            foreach ($row as $key => $cell){
               // echo $cell; echo "<br>";
                if($i==0){
                    $q.=$cell." Varchar(50),";
                    
                } else {
                    $q.="'".$cell ."',";
                    
                }
            }
            
          if($i==0){
            $query = "CREATE TABLE IF NOT EXISTS ". $std->sheetName($sheet)."(".rtrim($q,",").");"; 
            }else {
             $tblName = "students";
            $query = "INSERT INTO " .$tblName." Values (".rtrim($q,",").");";
            //$query = "INSERT INTO " .$std->sheetName($sheet)." Values (".rtrim($q,",").");";
            }
            //$msg = $query; 
            
            if(mysqli_query($con,$query)){ 
                $msg="Student Data Uploaded Successfully";
            echo  '<script> alert ("Student Data imported Successfully");</script>';
            //header("location:dashboard.php?msg=You Have Successfully Imported Student Data");
           }
            else{
               //echo "Error". mysqli_error($con);
              echo $msg="Unable to Upload Student Data:  " .mysqli_error($con);
           }
           
            echo "<br>";
            echo "<br />";
             $i++;
        }
        
    }
}
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
         <?php include('../topbar.php'); ?>
        <div id="layoutSidenav" style="background-color:#20c997;">
            <div id="layoutSidenav_nav" style="background-color:dark; color:lavender;">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color:##20c997;">
                    <div class="sb-sidenav-menu" style="background-color:##20c997;">
                        <div class="nav" style="background-color:#28a745;">
                            <div class="sb-sidenav-menu-heading">ESCOHST-IJERO</div>
                            <a class="nav-link" href="dashboard.php">
                                STAFF Admin DashBaord
                            </a>
                            <div class="sb-sidenav-menu-heading">Staff Area</div>
                            <a class="nav-link collapsed" href="addCourses.php?msg=<?php echo $_GET['msg']; ?>" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Course Manager
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                           
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Staff Area
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        HOD Area
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="setLectures.php?msg=<?php echo $_GET['msg']; ?>">Assign Courses</a>
                                            <a class="nav-link" href="addCourses.php?msg=<?php echo $_GET['msg']; ?>">Add New</a>
                                            <a class="nav-link" href="addDept.php?msg=<?php echo $_GET['msg']; ?>">Add Departments</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Student Assessment
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                        &nbsp;
                                    </div>
                                </nav>
                            </div>
                            
                            <a class="nav-link" href="#uploadStudents.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Load Existing Students
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
            <div id="layoutSidenav_content">
                <main>
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../../images/logo-eschsti.png" width="10%"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">UPLOAD ADMISSION  DATA </h3></div>
                                    <div class="card-body">
                                        <form action="utrs_updt.php" method="POST" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputfilename"> File Name:</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="file" name="stdresult"  />
                                           </div>
                                            <?php if(isset($msg)){ echo $msg; } ?>
                                         
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="submit" class="btn btn-primary btn-block">UPLOAD ADMISSION DATA</a></div>
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
                </footer>
                <div style="padding-left;40px; font-size:16px;">
                </div>
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
/*if(isset($_FILES['stdresult']['name'])){
     require_once("../connection.php");
    include("SimpleXLSX.php");
        if($con){
        //echo "Hi You Are Connected";
        $std=SimpleXLSX::parse($_FILES['stdresult']['tmp_name']);
        echo "<pre>"; 
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
                    $q.=$cell." Varchar(50),";
                    
                } else {
                    $q.="'".$cell ."',";
                    
                }
            }
            
            if($i==0){
            $query = "CREATE Table ". $std->sheetName($sheet)."(".rtrim($q,",").");"; 
            }else {
               //$tblName = "students";
            /*$query = "INSERT INTO " .$tblName." Values (".rtrim($q,",").");";*/
            //$query = "INSERT INTO " .$std->sheetName($sheet)." Values (".rtrim($q,",").");";
           // }
            //$msg = $query; 
            
            /*if(mysqli_query($con,$query)){ 
                $msg="Student Data Uploaded Successfully";
            echo  '<script> alert ("Student Data imported Successfully")</script>';
            //header("location:dashboard.php?msg=You Have Successfully Imported Student Data");
           }
            else{
               //echo "Error". mysqli_error($con);
              echo $msg="Unable to Upload Student Data:  " .mysqli_error($con);
           }
           
            echo "<br>";
            echo "<br />";
             $i++;
        }
        
    }
}
}*/
//}*/


?>