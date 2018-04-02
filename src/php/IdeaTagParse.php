<?php
#http://stumyadmin.cms.gre.ac.uk
ob_start();
include_once("DBConnect.php");
session_start();

if (isset($_POST['tagssub'])){
    if($_POST['tagssub'] == "Add Tag"){
 $tag="";
 $tag.=$_POST['Select-tag'];
        if(isset($_POST['Select-tag'])){
    
    
    
  $IDeaID = $_GET['id'];
  $UID =$_SESSION['uid'];



    
    $sql1 = " INSERT INTO Plebosoft_Ideas_Categories (ideaID, categoryID, userID) VALUES('".$IDeaID."', '".$tag."', '".$UID."')";
        $res1 = mysqli_query($dblink, $sql1) or die('Error: '.mysqli_error($dblink));
        if(($res1)){
            echo $_POST['Select-tag'];
            header("Location: ../Option_code.php?id={$IDeaID}");
        }else{
            echo " There was a problem with the creation of you user Post plase try again or contact suport staff";
            }
        }else{echo "Failed to get catagory";}

 
    }else if($_POST['tagssub'] == "Add Tag and go to Home"){
        
        $tag="";
        $tag.=$_POST['Select-tag'];
    
        
            $IDeaID = $_GET['id'];
            $UID =$_SESSION['uid'];
            $IDeaID = stripcslashes($IDeaID);
            $IDeaID = strip_tags($IDeaID);
            $IDeaID = mysqli_real_escape_string($dblink, $IDeaID);


    
        $sql1 = " INSERT INTO Plebosoft_Ideas_Categories (ideaID, categoryID, userID) VALUES('".$IDeaID."', '".$tag."', '".$UID."')";
        $res1 = mysqli_query($dblink, $sql1) or die('Error: '.mysqli_error($dblink));
        if(($res1)){
            header("Location: ../home.php");
        }else{
            echo " There was a problem with the creation of you user Post plase try again or contact suport staff";
            }
   

    }
    
    
}else{
    header("Location: ../home.php?Post_failed");
}

?>
