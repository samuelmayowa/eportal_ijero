<?php
  require "../../connection.php";
 mysqli_select_db($con,"escohsti_studentPortal");
  if (isset($_POST['query'])) {
     
    $query = "SELECT ID,StaffCode,FirstName,Surname,Designation,Job_Role FROM Staffs WHERE ID  = '{$_POST['query']}' LIMIT 5";
    $result = mysqli_query($conn, $query);
 
  if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
      echo $user['ID']."<br/>";
      echo $user['StaffCode']."<br/>";
      //echo $user['Title']."<br/>";
      echo $user['FirstName']."<br/>";
      echo $user['Surname']."<br/>";
      echo $user['Designation']."<br/>";
      echo $user['Job_Role']."<br/>";
      
    }
  } else {
    echo "<p style='color:red'>User not found...</p>";
  }
 
}
?>