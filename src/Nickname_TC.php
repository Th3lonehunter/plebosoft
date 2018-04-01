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
    <title>Greenwich University Commenting - T&Cs</title>
  </head>

  <body>
    <div class="page">

      
      <div class="centered">
        <div class="main-body">
          <h1>Welcome to the Greenwich University Comment System</h1>

          <br>

          <p>In order to to ensure the safety of everyone using the system,
            we ask that all staff and students keep in mind the following principles when proposing
            new ideas or commenting on existing ideas: <br><br>


            <ul>
              <li>Any offensive language or ideas will result in a ban from the system and further punitive action.</li>
              <li>Everyone has the right to an idea.</li>
              <li>Criticisms must be constructive.</li>
              <li>Respect each others opinions.</li>
            </ul>

            <br />

            Keep in mind that proceeding to the system implies that you agree with the principles and will uphold
            them to the best of your ability.
          </p>

          <br>

          <?php
          
          echo "<form action='../src/php/tcparse.php?id={$_GET['id']}' method='POST'>
                
                <input id='idea-title' name='NickName' type='text' class='form-input' placeholder='Enter a NickName' required>
                
                <input type='submit' name'accept' value='Accept'>
                
                </form>
                ";
?>
        </div>
      </div>

    </div>
  </body>


</html>
