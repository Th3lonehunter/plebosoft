<?php
//http://stuweb.cms.gre.ac.uk/~wh6785w/webgroup/plebosoft-master/plebosoft-master/src/QAReportView.php
session_start();
  ob_start();
include_once("../src/php/DBConnect.php");

?>
<!DOCTYPE html>
<head></head>
<?php

        $sql = "SELECT * FROM Plebosoft_Reports WHERE status = 4 ORDER BY reportID ASC";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error($dblink));

echo "<form action='' method='POST'>";
  
?>

<select name="RepID">
  <?php while($row = mysqli_fetch_array($res)):;  ?>
  <option value="<?php echo $row['reportID'];?>"><?php echo "Report ID: ".$row['reportID']; ?></option> 
  <?php endwhile;  ?>
  
  <input type='submit' name='tagssub' value='Add Tag and go to Home'>
</select>
  </form>

<?php
if(isset($_POST['RepID'])){
    echo $_POST['RepID'];
$sql2 = "SELECT * FROM Plebosoft_Reports WHERE reportID={$_POST['RepID']}";
 $res2 = mysqli_query($dblink,$sql2) or die(mysqli_error());
           if(mysqli_num_rows($res2) > 0){
           while($row2 = mysqli_fetch_assoc($res2)){
               
               echo "<body>
               <p>{$row2['reportText']}</p>
               </body>";
               $ideaID=$row2['ideaID'];
               $commentID=$row2['commentID'];
               
           }
               if($ideaID>0){
               $sql3 = "SELECT * FROM Plebosoft_Ideas INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID INNER JOIN Plebosoft_Users ON Plebosoft_Staff.staffID = Plebosoft_Users.userID WHERE Plebosoft_Ideas.ideaID={$ideaID}";
            $res3 = mysqli_query($dblink,$sql3) or die(mysqli_error());
           if(mysqli_num_rows($res3) > 0){
           while($row3 = mysqli_fetch_assoc($res3)){
            $T= $row3['title'];
            $tx = $row3['ideaText'];
            $un= $row3['userName'];
            $ID = $row3['ideaID'];
            $VC = $row3['viewCount'];
            $image = $row3['avatarPhoto'];
            
            $datep = $row3['submitedDate'];
           }
               echo "<body>
               <p>{$T}</p>
               <p>{$tx}</p>
               <p>{$un}</p>
               <p>{$VC}</p>
               </body>"; 
           }
               } else if($commentID > 0){
                    $sql3 = "SELECT * FROM Plebosoft_Comments INNER JOIN Plebosoft_Staff ON Plebosoft_Comments.userID = Plebosoft_Staff.staffID INNER JOIN Plebosoft_Users ON Plebosoft_Staff.staffID = Plebosoft_Users.userID WHERE Plebosoft_Comments.ideaID={$commentID} ORDER BY Plebosoft_Comments.commentedDate DESC";
            $res3 = mysqli_query($dblink,$sql3) or die(mysqli_error());
           if(mysqli_num_rows($res3) > 0){
           while($row3 = mysqli_fetch_assoc($res3)){
           
            $txt = $row3['description'];
            
            $dates = $row3['commentedDate'];
               $image2 = $row3['avatarPhoto'];
               
               
                   $usn = $row3['userName'];
               }
               echo "<body>
               <p>{$txt}</p>
               <p>{$dates}</p>
               <p>{$usn}</p>
               
               </body>"; 
               }            
               }
           }
               
               
           
    
}else{
    echo"fail";
}
?>