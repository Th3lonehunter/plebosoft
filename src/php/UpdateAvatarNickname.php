<?php
#http://stumyadmin.cms.gre.ac.uk
ob_start();
include_once("DBConnect.php");
session_start();


if(isset($_SESSION['uid'])){
    
  
    
    if(isset($_POST['User-avatar'])){
        
        $filename = $_FILES['idea-file']['name'];
        $target = "Avatar/";
        $fileTarget = $target.$filename;
        $tempfilename = $_FILES['idea-file']["tmp_name"];
        $result = move_uploaded_file($tempfilename,$fileTarget);
        if(isset($_POST['NickN'])){
            $NN = $_POST['NickN'];   
            $NN = stripcslashes($NN);
            $NN = strip_tags($NN);
            $NN = mysqli_real_escape_string($dblink, $NN);
            
            $sql = mysqli_query($dblink,"UPDATE Plebosoft_Users SET nickName='".$NN."' WHERE userID='".$_SESSION['uid']."'");
            if($sql){
            $_SESSION['NickName']=$NN;
                
            $sql2 = mysqli_query($dblink,"UPDATE Plebosoft_Users SET avatarPhoto='".$fileTarget."' WHERE userID='".$_SESSION['uid']."'");
            if($sql2){
            $_SESSION['NickName']=$fileTarget;
            }else{
                header("location: ../home.php?databaseFailure");
            }
                
                
            }else{
                header("location: ../home.php?databaseFailure");
            }
            
        }else{
            $sql2 = mysqli_query($dblink,"UPDATE Plebosoft_Users SET avatarPhoto='".$fileTarget."' WHERE userID='".$_SESSION['uid']."'");
            if($sql2){
            $_SESSION['NickName']=$fileTarget;
            }else{
                header("location: ../home.php?databaseFailure");
            }    
        }
        
    }else{
        $sql = mysqli_query($dblink,"UPDATE Plebosoft_Users SET nickName='".$NN."' WHERE userID='".$_SESSION['uid']."'");
            if($sql){
            $_SESSION['NickName']=$NN;
            }else{
                header("location: ../home.php?databaseFailure");
        }
    }
}



?>