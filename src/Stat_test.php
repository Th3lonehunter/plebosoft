<?php
#http://stumyadmin.cms.gre.ac.uk
ob_start();
include_once("../src/php/DBConnect.php");
session_start();
if(isset($_GET['id'])){
    if($_GET['id'] == 1){
$sql = "SELECT Plebosoft_Departments.name, COUNT(Plebosoft_Staff.staffID) as NUM FROM Plebosoft_Departments INNER JOIN Plebosoft_Staff ON Plebosoft_Departments.departmentID = Plebosoft_Staff.departmentID WHERE Plebosoft_Staff.departmentID = Plebosoft_Departments.departmentID GROUP BY Plebosoft_Departments.departmentID";
    }else{
        $sql = "SELECT Plebosoft_Departments.name, COUNT(Plebosoft_Ideas.ideaID) as NUM FROM Plebosoft_Departments INNER JOIN Plebosoft_Staff ON Plebosoft_Departments.departmentID = Plebosoft_Staff.departmentID INNER JOIN Plebosoft_Ideas on Plebosoft_Ideas.userID = Plebosoft_Staff.staffID WHERE Plebosoft_Staff.departmentID = Plebosoft_Departments.departmentID AND Plebosoft_Ideas.userID = Plebosoft_Staff.staffID GROUP BY Plebosoft_Departments.departmentID";
    }
    
    

$res = mysqli_query($dblink, $sql);  
}
?>
<!DOCTYPE html>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(Pie);

function Pie() {

    var mysqlData = google.visualization.arrayToDataTable([
      ['Deparment', 'Num'],
      <?php
      if($res->num_rows > 0){
          while($row = $res->fetch_assoc()){
            echo "['".$row['name']."', ".$row['NUM']."],";
          }
      }
        $char1 = 'Deparments Chart';
        $char2 = 'Posts Per Deparment';
      ?>
    ]);
    
    var PieSetting = {
        
        width: 900,
        height: 500,
        is3D: true,
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(mysqlData, PieSetting);
    
    
}
</script>
   
</head>
<body>
   <h1> <?php if(isset($_GET['id'])){
                if($_GET['id'] == 1){
                    echo $char1;
                }else{
                    echo $char2;
                }
}
       
       ?>   </h1>
     <div id="piechart"></div>
    
</body>
</html>