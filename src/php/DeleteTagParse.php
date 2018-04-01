<?php
ob_start();
include_once("DBConnect.php");
session_start();

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
        
    }
}else{
    header('Location: ');
}





?>