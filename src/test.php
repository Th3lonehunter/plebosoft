<?php
session_start();
  ob_start();
include_once("../src/php/DBConnect.php");

$sql = "SELECT ideaID, COUNT(ideaID) as value FROM Plebosoft_Votes WHERE direction = 0 GROUP BY ideaID";
$result = mysqli_query($dblink,$sql);
$counts = array();
while ($row = mysqli_fetch_assoc($result)) {
   echo  $row['ideaID']." ".$row['value']."<br>";
}
?>