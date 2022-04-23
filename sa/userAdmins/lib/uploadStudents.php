<?php
/*if($_SESSION['userID']==$_POST['staffID']){
    header('location:index.php');
}*/


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Eport-Student Data</title>
        <link href="../css/styles.css" rel="stylesheet" />
         <link rel="shortcut icon" type="image/x-icon" href="../images/logo-eschsti.png"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4" style="color:#28a745; font-family:Arial Black;"><img src="../images/echstijero-logo.png"><br><hr />Ekiti State College Of Health Science and Technology<hr /></h3></div>
                                    
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Import Existing Students Data</h3></div>
                                    <div class="card-body">
                                        <form action="#" method="POST" enctype="multipart/form-data">
                                            File Name:<input type="file" name="std">
                                           
                                            
                                         
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Student Level</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Department</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Department" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Faculty</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" aria-describedby="emailHelp" placeholder="Enter Faculty" />
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Programme ** ND** HND** DIPL** </label>
                                                        <input class="form-control py-4" id="inputPassword" type="text" placeholder="Enter Programme Type" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Category ** FULL-TIME ** PART-TIME</label>
                                                        <input class="form-control py-4" id="inputConfirmPassword" type="text" placeholder="CATEGORY ** ND, DIP, HND" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><button type="submit" name="submit" class="btn btn-primary btn-block">IMPORT DATA</a></div>
                                        </form>
                                    </div>
    

                                    <div class="card-footer text-center">
                                        <div class="small"><a href="#login.html">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; College of Health Science and Technology, Ijero-Ekiti. 2021, AllRight Reserved</div>
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
    </body>
</html>
<?php

?>



<?php 
if(isset($_FILES['std']['name'])){
     require_once("../connection.php");
    include("SimpleXLSX.php");
        if($con){
        //echo "Hi You Are Connected";
        $std=SimpleXLSX::parse($_FILES['std']['tmp_name']);
        echo "<pre>"; 
        //print_r($std->rows(1));
       // print_r($std->dimension(2));
        //print_r($std -> sheetNames());
        for($sheet=0; $sheet < sizeof($std->sheetNames()); $sheet++){
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
            $query = "INSERT INTO " .$std->sheetName($sheet)." Values (".rtrim($q,",").");";
            }
            $msg = $query; 
            if(mysqli_query($con,$query)){
                //header("location:dashbaord.php?msg=You Have Successfully Imported Student Data");
            echo  '<script> alert ("Student Data imported Successfully")</script>';
            
           }
           
            echo "<br>";
            echo "<br />";
             $i++;
        }
        
    }
}
}
}


?>
  
<?php
require('close_connection.php');
?>

