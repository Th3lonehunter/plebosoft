<?php
ob_start();
include_once("DBConnect.php");
session_start();

if (isset($_POST['login-username'])){
  $username ="";
  $password="";
  
  $username .= $_POST['username'];
  $password .= $_POST['password'];

  $username = stripcslashes($username);
  $username = strip_tags($username);
  $username = mysqli_real_escape_string($dblink, $username);
  $password = stripcslashes($password);
  $password = strip_tags($password);
  $password = mysqli_real_escape_string($dblink, $password);
  
  $sql = "SELECT * FROM ***** WHERE USERNAME='".$username."' AND PASSWORD='".$password."' LIMIT 1";
  $res = mysqli_query($dblink,$sql) or die(mysqli_error());
  if(mysqli_num_rows($res)==1){
    $row = mysqli_fetch_assoc($res);
    $_SESSION['uid'] = $row['UserID'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['Ban'] = $row['ban'];
    $_SESSION['cantPost'] = $row['CantPost'];
    $_SESSION['ACLVL'] = $row['ACLVL'];
    $_SESSION['firstName'] = $row['firstName'];
  }else{
    header("Location: home.php?login_failed");
  }
  
  
}else{
  header("Location: home.php?login_failed");
}