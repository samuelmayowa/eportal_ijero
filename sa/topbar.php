<?php 
if(isset($_GET['user'])){
    $id=$_GET['user'];
    $_SESSION['userID']=$id;
}else{
$id=$_SESSION['userID'];
}
//echo "<script> alert('$id'); </script>"; 
 $staffData=getStaffProfile($id);
 
 $sn=$staffData['Surname'];
// echo "<script> alert('$sn'); </script>"; 
 
 $name='';
 if($id){
    $user_data = mysqli_query($con, "SELECT * FROM Staffs Where StaffCode ='$id'");
    $fetch_user_data = mysqli_fetch_assoc($user_data);
    //$name = $fetch_user_data['Surname'].' '.$fetch_user_data['FirstName'];
    $phone = $fetch_user_data['PhoneNumber'];
    $email = $fetch_user_data['Email'];
    $designation = $fetch_user_data['Designation'];
    $pix=$fetch_user_data['passport'];
    $sn=$fetch_user_data['Surname'];
    $mn=$fetch_user_data['Middlename'];
    $fn=$fetch_user_data['FirstName'];
    $name= $fn .'  '. $mn . '  ' .$sn;
    $tit=$fetch_user_data['Title'];
    $jbr=$fetch_user_data['Job_Role'];
    $gender=$fetch_user_data['Gender'];
    $quali=$fetch_user_data['Qualification'];
    $hrd=$fetch_user_data['HiredDate'];
    $addr=$fetch_user_data['ContactAddress'];
    $city=$fetch_user_data['City'];
    $lga=$fetch_user_data['LGA'];
    $st=$fetch_user_data['State'];
    $kin=$fetch_user_data['GuarantorName'];
    $kinNum=$fetch_user_data['GuarantorNumber'];
    $dpt=$fetch_user_data['DeptID'];
    $hiredDate=$fetch_user_data['HiredDate'];
    $quali=$fetch_user_data['Qualification'];
    $facID=$fetch_user_data['FacID'];
}
$dfaulti_img="https://i.pinimg.com/originals/43/96/61/439661dcc0d410d476d6d421b1812540.jpg";
/*echo "<script> alert('Welcome ! ' + '$name'); </script>"; */
 ?>
 
 
<style>
     /*.image_inner_container{*/
     /*  	border-radius: 50%;*/
     /*  	padding: 5px;*/
     /*   background: #833ab4; */
     /*   background: -webkit-linear-gradient(to bottom, #fcb045, #fd1d1d, #833ab4); */
     /*   background: linear-gradient(to bottom, #fcb045, #fd1d1d, #833ab4);*/
     /*  }*/
       .image_inner_container img{
       	height: 80px;
       	width: 80px;
       	border-radius: 50%;
       	border: 5px solid white;
       }
       .container{
       	height: 100%;
       	align-content: center;
       }

       /*.image_outer_container{*/
       /*	margin-top: auto;*/
       /*	margin-bottom: auto;*/
       /*	border-radius: 50%;*/
       /*	position: relative;*/
       /*}*/
       input{
           color:black;
       }
 </style>
 <nav class="sb-topnav navbar navbar-expand navbar-gray bg-green" style="background-color:teal; color:#fff;">
            <a class="navbar-brand" href="dashboard.php?msg=<?php echo $_SESSION['userID']; ?>" style="color:#fff;"><?php if(isset($name)){ echo $name;  }else { echo 'ESCOHST-IJERO'; }  ?></a>
                                 <a class="nav-link" href="profiles.php?msg=<?php echo $_SESSION['userID']; ?>">
                                     <div class="image_inner_container">
					                   &nbsp; &nbsp;  <img src="<?php if(!empty($pix)) { echo $pix; } elseif($_GET['msg']=='ADMIN_OFFICER'){ echo '../lecturers/'.$pix; } else { echo $dfaulti_img; } ?>">
				                    </div>
				                </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
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
                        <a class="dropdown-item" href="../dashboard.php?msg=<?php echo $_GET['msg']; ?>">Admin Home</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="dashboard.php?msg=<?php echo $id; ?>">My Dashboard</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="staffProfile.php?msg=<?php echo $id; ?>">Edit Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="https://eportal.escohsti-edu.ng/staffArea/logout.php?msg=<?php echo $id; ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>