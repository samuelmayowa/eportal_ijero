<?php
//UPDATE students SET students.Department_id = (SELECT ID FROM Departments WHERE Departments.DeptName = initcap(students.Department)); 
include('../connection.php');


/*$query="UPDATE Depts_Backup Set DeptName = (Select ucfirst(DeptName) From Departments Where ID=(Select ID From Depts_Backup))";
$query=mysqli_query($con,$query) or die (mysqli_error($con));
if(mysqli_affect_rows($con)>=1){
    echo "Department Backup Updated Successfully";

}
else{
    echo  "you have errors in your query".mysqli_error($con);
}*/
//"localhost", "escohsti_portalAdmin","IT;manager","escohsti_studentPortal"


try{
  $con = new PDO("mysql:host=localhost;dbname=escohsti_studentPortal", "escohsti_portalAdmin", "IT;manager");
}
catch(PDOException $e){
  echo "error" . $e-getMessage();
}

$select = $con->prepare("SELECT * FROM Departments");
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();

while($data=$select->fetch()) {

  $id = $data['ID'];
  $column = $data['DeptName'];
  $column = ucwords(strtolower($column)); // Capitalize each word

  $update = $con->prepare("UPDATE Departments SET DeptName=:DeptName WHERE id='$id'");
  $update->bindParam(':DeptName', $column);
  $update->execute();
}

// Update Improper Casing of Student Departments

/*try{
  $con = new PDO("mysql:host=localhost;dbname=escohsti_studentPortal", "escohsti_portalAdmin", "IT;manager");
}
catch(PDOException $e){
  echo "error" . $e-getMessage();
}

$select = $con->prepare("SELECT * FROM students");
$select->setFetchMode(PDO::FETCH_ASSOC);
$select->execute();

while($data=$select->fetch()) {

  $id = $data['ID'];
  $column = $data['department'];
  $column = ucwords(strtolower($column)); // Capitalize each word

  $update = $con->prepare("UPDATE students SET department=:department WHERE id='$id'");
  $update->bindParam(':department', $column);
  $update->execute();
}*/
?>