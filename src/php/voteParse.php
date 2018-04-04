<?php 
ob_start();
include_once("DBConnect.php");
session_start();




if(isset($_POST['vote'])){
     $vote = "";
    if($_POST['vote'] == "UP-Vote"){
    $vote.=true;     
        $sql = "Insert into Plebosoft_Votes(ideaID,userID,direction) values ('".$_POST['ID']."', '".$_SESSION['uid']."', '".$vote."')";
        $res = mysqli_query($dblink, $sql) or die('Error: '.mysqli_error($dblink));
        if(($res)){
            header("Location: ../idea.php?id={$_POST['ID']}");
        }else{
            header("Location: ../idea.php?id={$_POST['ID']}&&VoteFail");
            }
    }else if($_POST['vote'] == "Down-Vote"){
    $vote.=false;   
        $sql = "Insert into Plebosoft_Votes(ideaID,userID,direction) values ('".$_POST['ID']."', '".$_SESSION['uid']."', '".$vote."')";
        $res = mysqli_query($dblink, $sql) or die('Error: '.mysqli_error($dblink));
        if(($res)){
            header("Location: ../idea.php?id={$_POST['ID']}");
        }else{
            header("Location: ../idea.php?id={$_POST['ID']}&&VoteFail");
            }
    }
}

?>