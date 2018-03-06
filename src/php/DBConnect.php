<?php
#code for establishing the conection to the Plebosoft Database
$host = "";
$username="";
$password= "";
$db = "";
$dblink = mysqli_connect($host,$username,$password,$db) or die(mysqli_error());
?>