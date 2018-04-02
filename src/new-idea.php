<?php
session_start();
  ob_start();
include_once("../src/php/DBConnect.php");
?>
<!DOCTYPE html>

  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <title>Greenwich University Commenting</title>
  </head>

  <body>
    <div class="page">
      <!-- Header -->
      <div class="section header">
        <div class="nav">
          <div class="nav-home"><a href="home.php">Home</a></div>
          <?php if (isset($_SESSION['uid'])){
echo "<div class=.nav-user'><img src='{$_SESSION['Image']}' alt='Avitar'> <br> Hello:".$_SESSION['NickName']." &bull; <a href='../src/php/Logout.php'>Logout</a></div>";     
 }
else {
 echo"<div class=.nav-user'>&bull;<a href='login.php'>Login</a></div>";
}
            
    if(isset($_SESSION['terms'])){ 
      echo"</div>
      </div>
      <div class='section'>
        <div class='new-idea'>
          <form action='../src/php/IdeaParse.php' method='POST' enctype='multipart/form-data'>
            <div class='idea-form'>
              <h3>Create an Idea:</h3>
              <div class='idea-title'>
                <input id='idea-title' name='idea-title' type='text' class='form-input' placeholder='Title' required>
              </div>
              <div class='idea-text'>
                <textarea name='text' id='idea-text' cols='120' rows='15'></textarea>
              </div>
              <div class='idea-attachment'>
                <input  name='idea-file' type='file'>
              </div>
                
                
              <div class='idea-submit>
                  <p>Do you want the post to be anonymous<input type='checkbox' name='anonymous' value='yes'></p>
                <input type='submit' value='Submit Idea'>
              </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </body>";
    }else{
        header("location: home.php");
    }

?>