<?php
session_start();
  ob_start();
include_once("../src/php/DBConnect.php");

?>
<!DOCTYPE html>

<?php

        $sql = "SELECT * FROM Plebosoft_Departments";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error());
?>
<form action="" method="POST">
  

<select name="Select-tag">
  <?php while($row = mysqli_fetch_array($res)):;  ?>
  <option value="<?php echo $row['departmentID'];?>"><?phpecho $row['name']; ?></option> 
  <?php endwhile;  ?>
  <input type='submit' name='tagssub' value='Add Tag'>
  <input type='submit' name='tagssub' value='Add Tag and go to Home'>
</select>
  </form>