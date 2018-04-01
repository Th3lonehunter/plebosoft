<?php
ob_start();
include_once("DBConnect.php");
session_start();
if (isset($_POST['Register-username'])){
  $username ="";
  $password="";
  $nickname="";
  
  $username .= $_POST['username'];
  $password .= $_POST['password'];
  $nickname .= $_POST['password'];

  $username = stripcslashes($username);
  $username = strip_tags($username);
  $username = mysqli_real_escape_string($dblink, $username);
  $password = stripcslashes($password);
  $password = strip_tags($password);
  $password = mysqli_real_escape_string($dblink, $password);
  $nickname = stripcslashes($nickname);
  $nickname = strip_tags($nickname);
  $nickname = mysqli_real_escape_string($dblink, $nickname);

  $boolean = true;
  $boolean2= false;
  
  
$sql = "SELECT * FROM Plebosoft_Staff WHERE userName='".$username."' AND password='".$password."' LIMIT 1";
  $res = mysqli_query($dblink,$sql) or die(mysqli_error());
  if(mysqli_num_rows($res)==1){
    $row = mysqli_fetch_assoc($res);
    $staffID = $row['staffID'];
    $DID = $row['departmentID'];
    
  }else{
    header("Location: login.php?login_failed");
  }
  
  
}else{
  header("Location: login.php?login_failed");
}

$role = 1;
 
$sql1 = " INSERT INTO Plebosoft_Users (hasAgreedTerms, isBanned, staffID, deparmentID, roleID,nickName) VALUES('".$boolean."','".$boolean2."','".$staffID."','".$DID."','".$role."','".$nickname."')"
$res1 = mysqli_query($dblink, $sql1) or die('Error: '.mysqli_error($dblink));
if(($res1)){
  header("Location: login.html");
}else{
  echo " There was a problem with the creation of you user account plase try again or contact suport staff";
}
?>
