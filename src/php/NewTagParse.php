<?php
ob_start();
include_once("DBConnect.php");
session_start();


	if(isset($_SESSION['uid'])){
		if($_SESSION['roleID'] == 1 || $_SESSION['roleID'] == 2 || $_SESSION['roleID'] == 4){
		if(isset($_POST['TagText'])){
			
			$TagText="";
            $TagText .= $_POST['TagText'];
			$TagText = stripcslashes($TagText);
			$TagText = strip_tags($TagText);
			$TagText = mysqli_real_escape_string($dblink, $TagText);
			
			
		$sql = "INSERT INTO Plebosoft_Categories(name, QAManagerUserID) VALES('".$TagText."','".$_SESSION['uid']."')";
			$res = mysqli_query($dblink, $sql) or die('Error: '.mysqli_error($dblink));
            if(($res1)){
				header("Location: ");
			}else{
				header("location: ../home.php?databaseFailure");
				}
		}else{
			header("location: ../home.php?newTF");
		}
		
		}else{
			header('Location: ../home.php');
		}
		
	}else{
		header('Location: ../home.php');
	}
?>