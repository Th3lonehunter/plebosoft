<?php
#code for establishing the conection to the Plebosoft Database
$host = "mysql.cms.gre.ac.uk";
$username="st5679d";
$password= "Plebosoft";
$db = "mdb_st5679d";
$dblink = mysqli_connect($host,$username,$password,$db) or die(mysqli_error());
?>