<?php
#http://stumyadmin.cms.gre.ac.uk
ob_start();
include_once("DBConnect.php");
session_start();

    
if (isset($_POST['login-username']) && isset($_POST['login-password'])){
  $username ="";
  $password="";
  
  $username .= $_POST['login-username'];
  $password .= $_POST['login-password'];

  $username = stripcslashes($username);
  $username = strip_tags($username);
  $username = mysqli_real_escape_string($dblink, $username);
  $password = stripcslashes($password);
  $password = strip_tags($password);
  $password = mysqli_real_escape_string($dblink, $password);
  
  $sql = "SELECT * FROM Plebosoft_Staff INNER JOIN Plebosoft_Users ON Plebosoft_Staff.staffID = Plebosoft_Users.userID WHERE Plebosoft_Staff.userName='".$username."' AND Plebosoft_Staff.password='".$password."' LIMIT 1";
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
    $_SESSION['logindate'] = $row['lastLogin'];
    $_SESSION['terms'] = $row['hasAgreedTerms'];
    $_SESSION['Image']= $row['avatarPhoto'];
    $logdate = date('Y-m-d'); 
    
      
    $sql2 = mysqli_query($dblink,"UPDATE Plebosoft_Users SET lastLogin='".$logdate."' WHERE userID='".$_SESSION['uid']."'");
      if($sql2){
          if($_SESSION['terms']==1 ){
             header("location: ../home.php");
           exit();
          }else if($_SESSION['terms']!=1 && $_SESSION['NickName'] == ""){
              header("location: ../Nickname_TC.php?id={$_SESSION['uid']}");
          }else{
              header("location: ../tc.php?id={$_SESSION['uid']}");
          }
      }else{
          
      }
    
}else{
    
 header("Location: ../login.php?login_failed");
}
}else{
   
 header("Location: ../login.php?login_failed");
}

?>