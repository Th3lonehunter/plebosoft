<?php
session_start();
  ob_start();
include_once("../src/php/DBConnect.php");


if(isset($_POST['files']))
{
 
    if(isset($_POST['zip'])){
        
        $p = $_POST;
        $file_folder ="../src/php/Files/";
        if(extension_loaded('zip')){
            
            
            if(isset($p['files']) and count($p['files']) >0){
                
                
            $zip = new ZipArchive();
            $zipName = time().".zip";
                if($zip->open($zipName, ZIPARCHIVE::CREATE) !== TRUE){
                    echo"fail";
                }
                foreach($p['files'] as $file){
                   echo $file;
                    $zip->addFile($file_folder.$file,$file);
                    
                   
                }             
            
                $zip->close();
                
                if(file_exists($zipName)){
                    header('Content-Description: File Transfer');
                    header('Content-type: application/zip');
                    header('Content-Disposition: attachment; filename="'.$zipName.'"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    ob_clean();
                    readfile($zipName);

                    unlink($zipName);
                }else{
                    echo"failed to download";
                }
                
            
            }else{
                echo "please select a file";
            }
            
            
        }
    }
    
}


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
    ?>
        </div>
      </div>

      <div class="section">
        <div class="main-body">
        <?php   
             $sql = "SELECT * FROM Plebosoft_Ideas INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID INNER JOIN Plebosoft_Users ON Plebosoft_Staff.staffID = Plebosoft_Users.userID WHERE Plebosoft_Ideas.ideaID={$_GET['id']}";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error());
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_assoc($res)){
            $T= $row['title'];
            $tx = $row['ideaText'];
            $un="";
            $ID = $row['ideaID'];
               $vC = $row['viewCount'];
               $image = $row['avatarPhoto'];
            $anon = $row['isAnnonymus'];
               if($anon == true){
                   $un .="Annonymus";
               }else{
                   $un .= $row['userName'];
               }
            $datep = $row['submitedDate'];
               
               $counter = $vC + 1;
               
               $sql6 = mysqli_query($dblink,"UPDATE Plebosoft_Ideas SET viewCount='".$counter."' WHERE ideaID={$ID}");
                if($sql6){}
            
         echo " <h3>".$T."</h3>
          <div class='idea-text'>
            <p>".$tx."</p>
            
            <div class='idea-info'>
              <div>
                <p>".$un."<img src='{$image}' alt='Avitar'></p>
              </div>
              <div>
                <p>".$datep."</p>
              </div>";
            $sql7 = "SELECT * FROM Plebosoft_Documents WHERE ideaID ={$_GET['id']}";
                $res7 = mysqli_query($dblink,$sql7);
                    if(mysqli_num_rows($res7)>0){
                        while($row7 = mysqli_fetch_assoc($res7)){
                            $docid =$row7['documentID'];
                            $fileN = $row7['extension'];
                            $fileP = $row7['fileName'];
                        }
                        
                        echo"<form name='zip' method='POST'>
                        <input type='checkbox' name='files[]' value='{$fileN}'/><label>Download</label><br />
                        
                        <input type='submit' name='zip' value='Download ZIP' />
                        </form>";
                        
                    }else{
                        echo"<form>
                        <p>no documents attached</p>
                        </form>";
                    }
               
               
               
               if(isset($_SESSION['uid'])){
              $SQL5 = "SELECT * FROM Plebosoft_Votes where ideaID='".$_GET['id']."' AND userID='".$_SESSION['uid']."'";
                   $res5 = mysqli_query($dblink,$SQL5);
                    if(mysqli_num_rows($res5)>0){
                        echo " You have already Voted";
                    }else{
            echo" <form action='../src/php/voteParse.php' method='POST'>
            <input type='submit' name='vote' value='UP-Vote'>
            <input type='submit' name='vote' value='Down-Vote'>
            <input type='hidden' name='ID' value=".$ID.">
            </form>";
    }
               
                   
               }echo "please Login to vote";
               
    if(isset($_SESSION['uid'])){   
           echo" <form action'' method='POST'>
            <input type='submit' name='Report' value='Report'>
            </form> <br> <br>";
    }
            
                   
    echo "</div>
          </div>
               
               <div class='comment-container'>

          

          <form class='main' action='../src/php/CommentParse.php?id={$_GET['id']}' method='POST'>
            <label>Make a Suggestion..</label>
            <textarea class='form-text' name='comment' id='comment'></textarea>
            <br />
            <p>Do you want the post to be anonymous<input type='checkbox' name='anonymous' value='yes'></p>
            <input type='submit' class='form-submit' name='new-comment' value='post'>
          </form>
        
        </div>";
               
          echo "<br><br><br>";   
               
         $sql = "SELECT * FROM Plebosoft_Comments INNER JOIN Plebosoft_Staff ON Plebosoft_Comments.userID = Plebosoft_Staff.staffID INNER JOIN Plebosoft_Users ON Plebosoft_Staff.staffID = Plebosoft_Users.userID WHERE Plebosoft_Comments.ideaID={$_GET['id']} ORDER BY Plebosoft_Comments.commentedDate DESC";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error());
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_assoc($res)){
           
            $txt = $row['description'];
            $usn = "";
            
            $dates = $row['commentedDate'];
               $image2 = $row['avatarPhoto'];
                $anon = $row['isAnnonymus'];
               if($anon == true){
                   $usn .="Annonymus";
               }else{
                   $usn .= $row['userName'];
               }
               
          echo "<div class='idea-text'>
            <p class='comment-text'>".$txt."</p><br>
            <div class='idea-info'>
            
              <div>
                <p class='user'>".$usn."<img src='{$image2}' alt='Avitar'></p>
              </div>
              <div>
                <p >".$dates."</p>
              </div>
            </div>"; 
            if(isset($_SESSION['uid'])){   
           echo" <form action'' method='POST'>
            <input type='submit' name='Report' value='Report'>
            </form> <br> <br>";
            }else{ echo "<br> <br><br> <br>";}
           }}
           }
            }
            ?> 
        </div>

        
      </div>

    </div>
  </body>
