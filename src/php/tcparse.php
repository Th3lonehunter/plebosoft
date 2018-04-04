<?php
#http://stumyadmin.cms.gre.ac.uk
ob_start();
include_once("DBConnect.php");
session_start();
if(isset($_POST['NickName'])){
    
    if(isset($_GET['id'])){
        
  $NN = $_POST['NickName'];   
  $NN = stripcslashes($NN);
  $NN = strip_tags($NN);
  $NN = mysqli_real_escape_string($dblink, $NN);
        
    $aggreed = 1;
    $sql = mysqli_query($dblink,"UPDATE Plebosoft_Users SET hasAgreedTerms='".$aggreed."' WHERE userID='".$_SESSION['uid']."'");
    if($sql){
        $sql2 = mysqli_query($dblink,"UPDATE Plebosoft_Users SET nickName='".$NN."' WHERE userID='".$_SESSION['uid']."'");
    if($sql2){
        $_SESSION['NickName']=$NN;
        
    header("location: ../home.php");
    
        }else{
        header("location: ..login.php?databaseFailure");
    }
    
    }else{
        header("location: ..login.php?databaseFailure");
    }
    }else{
        
    }
    
    
}else{
    

if(isset($_GET['id'])){
    $aggreed = 1;
    $sql = mysqli_query($dblink,"UPDATE Plebosoft_Users SET hasAgreedTerms='".$aggreed."' WHERE userID='".$_SESSION['uid']."'");
    if($sql){
  header("location: ../home.php");
    }else{
        header("location: ..login.php?databaseFailure");
    }
    
}else{
    
}
}



?>