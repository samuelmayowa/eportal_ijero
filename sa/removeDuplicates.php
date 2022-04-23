<?php 
include_once('../functions.php');
require_once('../connection.php');
$refNum="";
$regNum="";
$user = $_SESSION['user'];
confirmLogin();
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $usr= $_GET['user'];
    $query=mysqli_query($con,"Delete From students Where ID ='$id'") or die(mysqli_error($con));
    if($query){
        header('location:dashboard.php?msg=Duplicate Student Removed for ID: '.$usr);
    }
}
?>