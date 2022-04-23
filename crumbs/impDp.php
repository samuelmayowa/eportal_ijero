<?php

?>
<html>
    <head>
        <title>Import Excel Data</title>
</head>
<body>
    
<form action="#" method="POST" enctype="multipart/form-data">
File Name:<input type="file" name="std">
<input  type="submit" name="submit">

</form>
<?php 
if(isset($_FILES['std']['name'])){
    $con=mysqli_connect("localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal");
    include("SimpleXLSX.php");
        if($con){
        //echo "Hi You Are Connected";
        $std=SimpleXLSX::parse($_FILES['std']['tmp_name']);
        echo "<pre>"; 
        //print_r($std->rows(1));
        print_r($std->dimension(2));
        print_r($std -> sheetNames());
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
            echo $query; 
            if(mysqli_query($con,$query)){
                echo "imported";
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
</body>
</html>