<?php 
session_start();
function killSessionData($sessionValue){
    
    if(isset($_SESSION)){
        
    $_SESSION = array();
    if(session_id() != '' || isset($_COOKIE[session_name($_SESSION['userID'])])){
        setcookie(session_name(),'', time() - 36000, '/');
    session_destroy();
        header('location:index.php?msg=<font color="green">You are Now Logged Out</font>');
    
}
    }

}


killSessionData ($_SESSION['userID']);

?>