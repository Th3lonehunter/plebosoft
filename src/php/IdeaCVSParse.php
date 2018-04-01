<?php
#http://stumyadmin.cms.gre.ac.uk
ob_start();
include_once("DBConnect.php");
session_start();




$sql = $dblink->query("SELECT * FROM Plebosoft_Ideas ORDER BY ideaID ASC");

if($sql->num_rows > 0){
    $coma = ",";
    $filename = "Ideas" . date('Y-m-d') . ".csv";
    
   
    $f = fopen('php://memory', 'w');
    
    
    $fields = array('ideaID', 'title', 'ideaText', 'categoryID', 'userID', 'isAnnonymus','IsQAEmailSent','submitedDate','deleted','viewCount');
    fputcsv($f, $fields, $coma);
    
    
    while($row = $sql->fetch_assoc()){
        $annon = ($row['isAnnonymus'] == '1')?'Annonymus':'visable';
        $Esent = ($row['IsQAEmailSent'] == '1')?'Yes':'No';
        $del = ($row['deleted'] == '1')?'Yes':'No';
        $RowData = array($row['ideaID'], $row['title'], $row['ideaText'], $row['categoryID'], $row['userID'], $annon,$Esent,$row['submitedDate'], $del, $row['viewCount']);
        fputcsv($f, $RowData, $coma);
    }
    
    
    fseek($f, 0);
    
   
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
  
    fpassthru($f);
}
exit;




?>