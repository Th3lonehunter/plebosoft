<!DOCTYPE html>

  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <title>Greenwich University Commenting - Login</title>
  </head>

  <body>
    <div class="page">

      <!-- Login Form -->
      <div class="centered">
        <div class="login">
          <form action="/src/php/LoginParse.php" method="POST">
            <div class="login-form">
              <div class="photo">
                <img src="images/greenwich-logo.png" alt="">
              </div>
                <div class="form-username">
                  <label class="user" for="login-username"><span class="hidden"></span></label>
                  <input id="login-username" type="text" class="form-input" placeholder="Username" required>
                </div>
                <div class="form-password">
                  <label class="lock" for="login-password"><span class="hidden"></span></label>
                  <input id="login-password" type="password" class="form-input" placeholder="Password" required>
                </div>
                <div class="form-submit">
                  <input type="submit" value="Log In">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </body>


</html>
