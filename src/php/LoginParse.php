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
  
  $sql = "SELECT * FROM Plebosoft_Staff INNER JOIN Plebosoft_Users ON Plebosoft_Staff.staffID = Plebosoft_Users.staffID WHERE Plebosoft_Staff.userName='".$username."' AND Plebosoft_Staff.password='".$password."' LIMIT 1";
  $res = mysqli_query($dblink,$sql) or die(mysqli_error());
  if(mysqli_num_rows($res)==1){
    $row = mysqli_fetch_assoc($res);
    $_SESSION['uid'] = $row['staffID'];
    $_SESSION['username'] = $row['userName'];
    $_SESSION['Ban'] = $row['isBanned'];
    $_SESSION['NickName'] = $row['nickName'];
    $_SESSION['roleID'] = $row['roleID'];
    $_SESSION['departmentID'] = $row['departmentID'];
    $_SESSION['firstName'] = $row['firstName'];
    $_SESSION['email'] = $row['email'];
  }else{
    header("Location: ../src/login.php?login_failed");
  }
  
  
}else{
  header("Location: ../src/login.php?login_failed");
}