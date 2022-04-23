<?php 
include_once('../../functions.php');
require_once('../../connection.php');
$rol="";
$id="";
$rol = $_GET['msg'];
confirmLogin();
if(isset($_GET['cc'])){
    $id=$_GET['cc'];
    $rol= $_GET['msg'];
    $query=mysqli_query($con,"Delete From Staffs Where ID ='$id'") or die(mysqli_error($con));
    if($query){
        header('location:dashboard.php?msg='.$rol.' && upd=Staff Removed Successfully for ID: '.$id);
    }
}
?>