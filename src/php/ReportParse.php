<?php
ob_start();
include_once("DBConnect.php");
session_start();

if(isset($_GET['IdeaID']) || isset($_GET['commentID'])){
    $IdeaID = "";
    $staffID ="";
    $IdeasID = "";
    
    if($_GET['IdeaID'] > 0){
    $IdeaID.=$_GET['IdeaID'];
        
    $sql = "SELECT * FROM Plebosoft_Ideas WHERE ideaID='".$IdeaID."' LIMIT 1";
    $res = mysqli_query($dblink,$sql) or die(mysqli_error());
    if(mysqli_num_rows($res)==1){
    $row = mysqli_fetch_assoc($res);
        $IdeasID .= $row['ideaID'];
        $staffID .= $row['userID'];
    }
    }else if($_GET['commentID'] > 0){
        $IdeaID.=$_GET['commentID'];
         $sql = "SELECT * FROM Plebosoft_Comments WHERE commentID='".$IdeaID."' LIMIT 1";
         $res = mysqli_query($dblink,$sql) or die(mysqli_error());
         if(mysqli_num_rows($res)==1){
         $row = mysqli_fetch_assoc($res);
         $commentID = $row['commentID'];
         $staffID .= $row['userID'];
         $IdeasID .= $row['ideaID'];
    }
    }else{
        echo"report fail";
    }
        
    $sql2 = "SELECT * FROM Plebosoft_Staff WHERE staffID='".$staffID."' LIMIT 1";
    $res2 = mysqli_query($dblink,$sql2) or die(mysqli_error());
    if(mysqli_num_rows($res2)==1){
    $row2 = mysqli_fetch_assoc($res2);
        $dep = $row2['departmentID'];
        $names=$row2['firstName'];
    }
    $roleLVL = 1;
    $sql3 = "SELECT * FROM Plebosoft_Staff INNER JOIN Plebosoft_Users ON Plebosoft_Staff.staffID = Plebosoft_Users.userID WHERE Plebosoft_Staff.departmentID='".$dep."' AND roleID='".$roleLVL."' LIMIT 1";
    $res3 = mysqli_query($dblink,$sql3) or die(mysqli_error());
    if(mysqli_num_rows($res3)==1){
    $row3 = mysqli_fetch_assoc($res3);
        $QAID = $row3['userID'];
        $email = $row3['email'];
        $name = $row3['firstName']; 
    }

    $reasons = $_POST['Reason'];
    $Rstat = "New";
    $date = date('Y-m-d');
    $reporterID = $_SESSION['uid']
    
    if(isset($_GET['IdeaID'])){
        $sql4 = "INSER INTO Plebosoft_Reports (status, reportText, dateTime, administratorID, reportingUserID,ideaID) VALUES('".$Rstat."','".$reasons."','".$date."','".$QAID."','".$reporterID."','".$IdeaID."')";
         $res4 = mysqli_query($dblink, $sql4) or die('Error: '.mysqli_error($dblink));
        if(($res4)){
        
        $message = " <p> click the following link to be taken to the Idea being reported: <a href=\"http://stuweb.cms.gre.ac.uk/~wh6785w/webgroup/plebosoft-master/plebosoft-master/src/"needs page"   \">http://stuweb.cms.gre.ac.uk/~wh6785w/webgroup/plebosoft-master/plebosoft-master/src/"needs page"</a> </p>"
        
        mail("{$email}", "Reported Post/comment", "the Post by {$name}\n {$message}", "From: wh6785w@gre.ac.uk\r\n");
        }else{
            echo "Fail";
        }
    }
    else{
        $sql4 = "INSER INTO Plebosoft_Reports (status, reportText, dateTime, administratorID, reportingUserID,commentID) VALUES('".$Rstat."','".$reasons."','".$date."','".$QAID."','".$reporterID."','".$IdeaID."')";
           $res4 = mysqli_query($dblink, $sql4) or die('Error: '.mysqli_error($dblink));
        if(($res4)){
            $message = " <p> click the following link to be taken to the comment being reported: <a href=\"http://stuweb.cms.gre.ac.uk/~wh6785w/webgroup/plebosoft-master/plebosoft-master/src/"needs page"   \">http://stuweb.cms.gre.ac.uk/~wh6785w/webgroup/plebosoft-master/plebosoft-master/src/"needs page"</a> </p>"
        
            mail("{$email}", "Reported Post/comment", "the Post by {$name}\n {$message}", "From: wh6785w@gre.ac.uk\r\n");
    }else{
            echo"fail coment";
        }
}
    
    
    
}else{
    header("Location: ");
}



?>