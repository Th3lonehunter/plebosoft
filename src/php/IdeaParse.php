<?php
#http://stumyadmin.cms.gre.ac.uk
ob_start();
include_once("DBConnect.php");
session_start();

  
if(isset($_SESSION['uid'])){
$sql2 = "SELECT ideas From Plebosoft_ClosureDates WHERE year= 2019 LIMIT 1";
$res2 = mysqli_query($dblink,$sql2) or die(mysqli_error());
               if(mysqli_num_rows($res2)  > 0){
                   while($row2 = mysqli_fetch_assoc($res2)){
                       
                   $closed = $row2['ideas'];
                   }
                   
if(date('Y-m,-d') > $closed){
    
if (isset($_POST['idea-title'])){
  $IdeaT ="";
  $Idea="";
  $UID =$_SESSION['uid'];
  $IdeaT .= $_POST['idea-title'];
  $Idea .= $_POST['text'];

  $IdeaT = stripcslashes($IdeaT);
  $IdeaT = strip_tags($IdeaT);
  $IdeaT = mysqli_real_escape_string($dblink, $IdeaT);
  $Idea = stripcslashes($Idea);
  $Idea = strip_tags($Idea);
  $Idea = mysqli_real_escape_string($dblink, $Idea);
    
   
    
        if(isset($_POST['anonymous'])){
           $anon = true;
        }else {
            $anon = false;
     }
    $boolean = false;

    $sql3 = " SELECT * FROM Plebosoft_Ideas WHERE title='".$IdeaT."'";
    $res3 = mysqli_query($dblink,$sql3);
    if(mysqli_num_rows($res3)>0){
        echo " post alreay exists";
    }else{
     
    $sql1 = " INSERT INTO Plebosoft_Ideas (title, ideaText, userID, isAnnonymus, submitedDate, deleted) VALUES ('".$IdeaT."','".$Idea."','".$UID."','".$anon."','".date('Y-m-d')."','".$boolean."')";
        $res1 = mysqli_query($dblink, $sql1) or die('Error: '.mysqli_error($dblink));
        if(($res1)){
            
            $sql3 = " SELECT * FROM Plebosoft_Ideas WHERE title='".$IdeaT."'";
             $res3 = mysqli_query($dblink,$sql3) or die(mysqli_error());
                if(mysqli_num_rows($res3)==1){
                $row3 = mysqli_fetch_assoc($res3);
              $ID = $row3['ideaID'];
                
            }else{
            }
            
            $filename = $_FILES['idea-file']['name'];
            $target = "Files/";
            $fileTarget = $target.$filename;
            $tempfilename = $_FILES['idea-file']["tmp_name"];
            $result = move_uploaded_file($tempfilename,$fileTarget);
            if($result){
                
                $sql4 = "INSERT INTO Plebosoft_Documents(fileName, extension, uploadedDate, ideaID) VALUES('".$fileTarget."','".$filename."','".date('Y-m-d')."','".$ID."')"; 
                $dblink->query($sql4) or die("error : ".mysqli_error($dblink));
                $roleLVL = 1;
    
                $sql3 = "SELECT * FROM Plebosoft_Staff INNER JOIN Plebosoft_Users ON Plebosoft_Staff.staffID = Plebosoft_Users.userID WHERE Plebosoft_Staff.departmentID='".$_SESSION['departmentID']."' AND roleID='".$roleLVL."' LIMIT 1";
    
                $res3 = mysqli_query($dblink,$sql3) or die(mysqli_error());
   
                if(mysqli_num_rows($res3)==1){
   
                    $row3 = mysqli_fetch_assoc($res3);
       
                    $QAID = $row3['userID'];
       
                    $email = $row3['email'];
        
                    $name = $row3['firstName']; 
                    
                    
    }

 
            }
            $message = " <p> New Post has been made: <a\">http://http://stuweb.cms.gre.ac.uk/~wh6785w/webgroup/plebosoft-master/plebosoft-master/src/idea.php?id={$ID}</a> </p>";
        
            mail("{$email}", "NEWPOST", "the Post by {$_SESSION['username']}\n {$message}", "From: wh6785w@gre.ac.uk\r\n");
        
           header("Location: ../subject.php?id={$_SESSION['departmentID']}");
        }else{
            echo " There was a problem with the creation of you user Post plase try again or contact suport staff";
            }
 
    }
              
}else{
    echo"fail";
}
               }else{
                   echo "No more Posts";
               }
               }else{echo "db Failed";}
}else{
    echo "post failed"; 
}