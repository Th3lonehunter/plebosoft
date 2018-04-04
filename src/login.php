<!DOCTYPE html>

  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <title>Greenwich University Commenting - Login</title>
  </head>
<?php   

$login_failed = isset($_GET['login_failed']);
$databaseFail = isset($_GET['databaseFailure']);

?>
  <body>
    <div class="page">
      <div class="centered">
        <div class="login">
          <form action="../src/php/LoginParse.php" method="POST">
            <div class="login-form">
              <div class="photo">
                <img src="images/greenwich-logo.png" alt="">
              </div>
                <?php if($login_failed): ?><p>UserName or Password was incorrect</p>   
                <?php endif; ?>
                <?php if($databaseFail): ?><p>Database Failure </p>   
                <?php endif; ?>
                <div class="form-username">
                  <input id="login-username" name ="login-username" type="text" class="form-input" placeholder="Username" required>
                </div>
                <div class="form-password">
                  <input id="login-password" name ="login-password" type="password" class="form-input" placeholder="Password" required>
                </div>
                
                <div class="form-submit">
                  <input type="submit" value="Log In">
                </div>
              </div>
            
          </form>
        </div>
      </div>

    </div>
  </body>



