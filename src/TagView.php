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
<?php
        
        
        $ideaL = 5;
        
        $sqlP = "SELECT count(ideaID) FROM Plebosoft_Ideas";
        $ret= mysqli_query($dblink,$sqlP);
        if(! $ret){
            die("Error could not get data : ".mysqli_error());
        }
        $rows = mysqli_fetch_array($ret, MYSQLI_NUM);
        $ideaC = $rows[0];
        if(isset($_GET{'page'})){
            $page = $_GET{'page'} +1 ;
            $offset = $ideaL * $page;
        }else{
            $page=0;
            $offset=0;
        }
        $left_idea = $ideaC - ($page * $ideaL);
        
        
        if(isset($_POST['viewoption'])){
            $filter=$_POST['viewoption'];
        }else{
            $filter="";
        }
        $sql2 = "SELECT * FROM Plebosoft_Categories WHERE CategoryID={$_GET['id']}";
               $res2 = mysqli_query($dblink,$sql2) or die(mysqli_error($dblink));
           if(mysqli_num_rows($res2) > 0){
           while($row2 = mysqli_fetch_array($res2, MYSQLI_ASSOC)){
            $catag = $row2['name'];
           }
           }
        
        
     echo" <div class='main-body'>
     <form method='POST'>
     
   
     
        <h3>Select an Idea to view:</h3>
        <p>Alternatively, you can create a new idea <a href='new-idea.php'>here.</a>  ";
        if(isset($_GET['id'])){
        
        echo "</p>
        <p> Displaying by tag: {$catag}</p>
        <div class='table-container'>
          <div class='table'>";
              
              $sql = "SELECT * FROM Plebosoft_Ideas INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID INNER JOIN Plebosoft_Ideas_Categories ON Plebosoft_Ideas.ideaID = Plebosoft_Ideas_Categories.ideaID WHERE Plebosoft_Ideas_Categories.categoryID={$_GET['id']} LIMIT $offset,$ideaL";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error($dblink));
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            $T= $row['title'];
            $tx = $row['ideaText'];
            $un="";
            $ID = $row['ideaID'];
            $anon = $row['isAnnonymus'];
               if($anon == true){
                   $un .="Annonymus";
               }else{
                   $un .= $row['userName'];
               }
               
               
               
               
           echo" <div class='idea-row'>
              <h3><a href='idea.php?id={$ID}'>".$T."</a></h3>
              <p>".$tx."</p>
              <div class='idea-user'>
                ".$un."
              </div>
            </div>";
                }
               
               }else{
               echo"database fail";
           }
           
           if($page > 0){
                   $last = $page-2;
               
               
                    echo "<a href = \"TagView.php?id={$_GET['id']}&&page=$last\">Last 5 Records</a> |";
                   echo "<a href = \"TagView.php?id={$_GET['id']}&&page=$page\">Next 5 Records</a>";
                    }else if( $page == 0 ) {
                   echo "<a href = \"TagView.php?id={$_GET['id']}&&page=$page\">Next 5 Records</a>";
                    }else if( $left_rec < $rec_limit ) {
                    $last = $page - 2;
                    echo "<a href = \"TagView.php?id={$_GET['id']}&&page=$last\">Last 5 Records</a>";
         }
            
            
        echo"  </div>
        </div>
      </div>";
        }
          ?>
      </div>
  </body>
