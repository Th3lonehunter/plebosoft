<?php
ob_start();
include_once("DBConnect.php");
session_start();

  $coment="";
  $UID =$_SESSION['uid'];
  $coment .= $_POST['comment'];
  $IdeaID = $_GET['id'];

  
  $coment = stripcslashes($coment);
  $coment = strip_tags($coment);
  $coment = mysqli_real_escape_string($dblink, $coment);
    
    $UID = $_SESSION['uid'];
        if(isset($UID)){
            
            $sql2 = "SELECT comments From Plebosoft_ClosureDates WHERE year= 2019 LIMIT 1";
            $res2 = mysqli_query($dblink,$sql2) or die(mysqli_error());
               if(mysqli_num_rows($res2)  > 0){
                   while($row2 = mysqli_fetch_assoc($res2)){
                       
                   $closed = $row2['comments'];
                   }
                   
                   if(date('Y-m,-d') < $closed){
            
            
            
        if(isset($_POST['anonymous']) && $_POST['anonymous'] == "yes"){
            $anon = 1;
        }else {
            $anon = 0;
        }
    $boolean = false;
    
    $sql1 = " INSERT INTO Plebosoft_Comments (ideaID, IsAuthorEmailSent, description, userID, isAnnonymus, commentedDate, deleted) VALUES('".$IdeaID."', 1,'".$coment."','".$UID."','".$anon."','".date('Y-m-d')."','".$boolean."')";
        $res1 = mysqli_query($dblink, $sql1) or die('Error: '.mysqli_error($dblink));
        if(($res1)){
            
            $sql = "SELECT * FROM Plebosoft_Ideas INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID WHERE Plebosoft_Ideas.ideaID={$_GET['id']}";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error());
           if(mysqli_num_rows($res) >0){
               while($row = mysqli_fetch_assoc($res)){
        
            $email = $row['email'];
               }
               
               $message = " <p> New Comment has been made has been made: <a\">http://http://stuweb.cms.gre.ac.uk/~wh6785w/webgroup/plebosoft-master/plebosoft-master/src/idea.php?id={$_GET['id']}</a> </p>";
        
                    mail("{$email}", "NEWPOST", "the Post by {$_SESSION['username']}\n {$message}", "From: wh6785w@gre.ac.uk\r\n");
               
           
            header("Location: ../idea.php?id={$_GET['id']}");
        }else{
            echo " There was a problem with the creation of you user Post plase try again or contact suport staff";
            }
   header("Location: ../idea.php?id={$_GET['id']}");
}else{
            
        }
                   }else{echo"comments have closed";}  //put here
                   }
        }else{//HERE 
            
        }

?>