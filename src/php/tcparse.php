<?php
#http://stumyadmin.cms.gre.ac.uk
ob_start();
include_once("DBConnect.php");
session_start();
if(isset($_POST['NickName'])){
    
    if(isset($_GET['id'])){
    $aggreed = 1;
    $sql = mysqli_query($dblink,"UPDATE Plebosoft_Users SET hasAgreedTerms='".$aggreed."' WHERE userID='".$_SESSION['uid']."'");
    if($sql){
        $sql2 = mysqli_query($dblink,"UPDATE Plebosoft_Users SET nickName='".$_POST['NickName']."' WHERE userID='".$_SESSION['uid']."'");
    if($sql2){
        $_SESSION['NickName']=$_POST['NickName'];
        
    header("location: ../home.php");
    
        }else {
    }
    
    }else{
        
    }
    }else{
        
    }
    
    
}else{
    

if(isset($_GET['id'])){
    $aggreed = 1;
    $sql = mysqli_query($dblink,"UPDATE Plebosoft_Users SET hasAgreedTerms='".$aggreed."' WHERE userID='".$_SESSION['uid']."'");
    if($sql){
  //  header("location: ../home.php");
    }else{
        
    }
    
}else{
    
}
}


?>