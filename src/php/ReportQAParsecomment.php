<?php
ob_start();
include_once("DBConnect.php");
session_start();


if(isset($_POST['Submit'])){
    
    $RID= $_POST['reportID'];
    $sql ="SELECT * FROM Plebosoft_Reports WHERE='".$RID."' LIMIT 1";
    $res = mysqli_query($dblink,$sql) or die(mysqli_error());
    if(mysqli_num_rows($res)==1){
    $row = mysqli_fetch_assoc($res);
        $ID = row['commentID'];
        if(isset($_POST['Submit'])){
            
            $sql5="SELECT * FROM Plebosoft_Comments WHERE commentID='".$ID."'";
            $res5 = mysqli_query($dblink,$sql5) or die(mysqli_error());
           if(mysqli_num_rows($res5)==1){
            $row5 = mysqli_fetch_assoc($res5);
            $userID= row5['userID'];
               
            if($_POST['Submit'] == "Delete"){
                $del = true;
                $sql2 = mysqli_query($dblink,"UPDATE Plebosoft_Comments SET deleted='".$del."' WHERE commentID='".$ID."'");
                    if($sql2){
                        $del= "comment removed";
                        $sql3 = mysqli_query($dblink,"UPDATE Plebosoft_Reports SET status='".$del."' WHERE reportID='".$RID."'");
                        if($sql3){
                            
                        }
                    }
                
             }else if($_POST['Submit'] == "Ban"){
                $ban = true;
                $sql2 = mysqli_query($dblink,"UPDATE Plebosoft_Users SET isBanned='".$ban."' WHERE userID='".$userID."'");
                    if($sql2)
                    $ban = "author banned";
                  $sql3 = mysqli_query($dblink,"UPDATE Plebosoft_Reports SET status='".$ban."' WHERE reportID='".$RID."'");
                        if($sql3){
                            
                        }
            }
                
             }else if($_POST['Submit'] == "approved"){
            $stat= "report ignored";
                $sql2 = mysqli_query($dblink,"UPDATE Plebosoft_Reports SET status='".$stat."' WHERE reportID='".$RID."'");
                    if($sql2){
                    
                    }
            }
        }
        }
  }



?>