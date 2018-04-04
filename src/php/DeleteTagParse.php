<?php
ob_start();
include_once("DBConnect.php");
session_start();

if($_SESSION['roleID'] == 1 || $_SESSION['roleID'] == 2 || $_SESSION['roleID'] == 4){
if(isset($_GET['TagID'])){
    $TagID = $_GET['TagID'];
    $sql = " SELECT * FROM Plebosoft_Ideas_Categories WHERE categoryID='".$TagID."'";
    $res = mysqli_query($dblink,$sql);
    if(mysqli_num_rows($res)>0){
        
       echo "tag is in use";
        header('Location: ');
        
    }else{
    
         $sql1 = "DELETE FROM Plebosoft_Categories WHERE CategoryID={$TagID}";
        $res = mysqli_query($link,$sql) or die(mysqli_error());
        header('Location: ');
        
    }else{
        header("location: ../home.php?databaseFailure");
    }
}else{
    header("location: ../home.php?TagDelFaIL");
}
}else{
    header('Location: ../home.php');
}




?>