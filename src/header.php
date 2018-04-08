<!DOCTYPE html>

  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <title>Greenwich University Commenting</title>
  </head>
<?php if($VoteFail): ?><p>Vote Fail</p>
                <?php endif; ?>
<?php if($ReportFail): ?><p>Report Failed to post</p>
                <?php endif; ?>
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
          ?>
        </div>
      </div>
