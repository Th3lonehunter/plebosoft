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
          <div class="nav-home"><a href="#">Home</a></div>
          <?php if (isset($_SESSION['uid'])){
   echo "<div class=.nav-user'><img src='{$_SESSION['Image']}' alt='Avitar'> Hello:".$_SESSION['NickName']." &bull; <a href='../src/php/Logout.php'>Logout</a></div>";  

 }
else {
 echo"<div class=.nav-user'>&bull;<a href='login.php'>Login</a></div>";
}
            $IdeaFail = isset($_GET['IdeaFail']);
            $DBFail = isset($_GET['databaseFailure']);
            $CD = isset($_GET['IdeasEnd']);
            $catFail = isset($_GET['catFail']);
            $DT = isset($_GET['TagDelFaIL']);
            $NTF = isset($_GET['newTF']);
    ?>

        </div>
      </div>

      <div class="main-body">
        <h3>Please select a Subject from the table below to view all ideas for each:</h3>
            <?php if($IdeaFail): ?><p>Idea Failed to Post</p>   
                <?php endif; ?>
          <?php if($DBFail): ?><p>Failure in database</p>   
                <?php endif; ?>
          <?php if($CD): ?><p>Idea posting closed</p>   
                <?php endif; ?>
          <?php if($catFail): ?><p>addition of catagories failed</p>   
                <?php endif; ?>
          
          
          <?php if($DT): ?><p>Cannot delete tag</p>   
                <?php endif; ?>
          <?php if($NTF): ?><p>addition of catagories failed</p>   
                <?php endif; ?>
        <div class="table-container">
          <div class="table">
            <?php
            $sql = "SELECT * FROM Plebosoft_Departments";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error());
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_assoc($res)){
            $depa = $row['name'];
               $ID= $row['departmentID'];

            echo "<div class='idea-row'>
              <a href='subject.php?id={$ID}&&page=-1'>{$depa}</a>  </div><br>
           ";
           }
           }
           else{ echo "failed to load departments";}
              ?>
          </div>
        </div>
      </div>

        <div class="main-body">
        <h3>Post Tags:</h3>
        <div class="table-container">
          <div class="table">
            <?php
            $sql = "SELECT * FROM Plebosoft_Categories";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error());
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_assoc($res)){
            $cat = $row['name'];
               $ID= $row['CategoryID'];

            echo "<div class='idea-row'>
              <a href='TagView.php?id={$ID}&&page=-1'>{$cat}</a>  </div><br>
           ";
           }
           }
           else{ echo "failed to load departments";}
              ?>
          </div>
        </div>
      </div>


    </div>
  </body>
</html>
