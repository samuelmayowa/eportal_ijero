
<!DOCTYPE html>
<html>
<head>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
  padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

/*$con = mysqli_connect('localhost','peter','abc123','my_db');*/
require_once "../functions.php";
require_once "../connection.php";

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}
$dptID="";
mysqli_select_db($con,"escohsti_studentPortal");
$sql="SELECT * FROM Staffs WHERE DeptID = '".$q."'";
$result = mysqli_query($con,$sql);
$id="";
$dptID = $_SESSION['dptId'];
echo "<table>
<tr>
<th>StaffCode</th>
<th>Firstname</th>
<th>Lastname</th>
<th>Designation</th>
<th>DeptCode</th>
<th>Job_Role</th>
<th>Action</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
   $id=$row['ID'];
   $dptID= $row['DeptID'];
   $_SESSION['dptId']=$dptID;
  echo "<tr>".
  "<td>" . $row['StaffCode'] . "</td>".
   "<td>" . $row['FirstName'] . "</td>".
   "<td>" . $row['Surname'] . "</td>".
   "<td>" . $row['Designation'] . "</td>".
   "<td>" . $row['DeptID'] . "</td>".
   "<td>" . $row['Job_Role'] . "</td>".
   "<td>" ."<a href='assignCourses.php?stfId=$id && dpt=$dptID' class='btn btn-primary btn-block'>Select Staff</a></td>".
   "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html> 