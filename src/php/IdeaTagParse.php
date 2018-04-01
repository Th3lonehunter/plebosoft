<?php
#http://stumyadmin.cms.gre.ac.uk
ob_start();
include_once("DBConnect.php");
session_start();

if (isset($_POST['tagssub'])){
    if($_POST['tagssub'] == "add another"){
 $tag="";
 $tag.=$_POST['Select-tag'];
    
    $sql="SELECT * FROM Plebosoft_Categories WHERE name='".$tag."'";
    $res = mysqli_query($dblink,$sql) or die(mysqli_error());
    if(mysqli_num_rows($res)==1){
    $row = mysqli_fetch_assoc($res);
        $ntag = $row['CategoryID'];
    
  $IDeaID = $_GET['IdeaID'];
  $UID =$_SESSION['uid'];
  $IDeaID = stripcslashes($IDeaID);
  $IDeaID = strip_tags($IDeaID);
  $IDeaID = mysqli_real_escape_string($dblink, $IDeaID);


    
    $sql1 = " INSERT INTO Plebosoft_Ideas_Categories (ideaID, categoryID, userID) VALUES('".$IDeaID."', '".$ntag."', '".$UID."')"
        $res1 = mysqli_query($dblink, $sql1) or die('Error: '.mysqli_error($dblink));
        if(($res1)){
            header("Location: ");
        }else{
            echo " There was a problem with the creation of you user Post plase try again or contact suport staff";
            }
   
}
else{
    header("Location: ");
}
 
    }else if($_POST['tagssub'] == "Post Idea"){
        
        $tag="";
        $tag.=$_POST['Select-tag'];
    
        $sql="SELECT * FROM Plebosoft_Categories WHERE name='".$tag."'";
        $res = mysqli_query($dblink,$sql) or die(mysqli_error());
        if(mysqli_num_rows($res)==1){
        $row = mysqli_fetch_assoc($res);
        $ntag = $row['CategoryID'];
    
            $IDeaID = $_GET['IdeaID'];
            $UID =$_SESSION['uid'];
            $IDeaID = stripcslashes($IDeaID);
            $IDeaID = strip_tags($IDeaID);
            $IDeaID = mysqli_real_escape_string($dblink, $IDeaID);


    
        $sql1 = " INSERT INTO Plebosoft_Ideas_Categories (ideaID, categoryID, userID) VALUES('".$IDeaID."', '".$ntag."', '".$UID."')"
        $res1 = mysqli_query($dblink, $sql1) or die('Error: '.mysqli_error($dblink));
        if(($res1)){
            header("Location: ");
        }else{
            echo " There was a problem with the creation of you user Post plase try again or contact suport staff";
            }
   
}else{
    header("Location: ");
}
    }
    
    
}else{
    header("Location: ");
}

?>
