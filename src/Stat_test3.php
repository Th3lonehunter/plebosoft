<?php
#http://stumyadmin.cms.gre.ac.uk
ob_start();
include_once("../src/php/DBConnect.php");
session_start();
$sql = "SELECT COUNT(ideaID) as ANNON FROM Plebosoft_Ideas WHERE isAnnonymus = 1";
$res = mysqli_query($dblink, $sql);  

?>
<!DOCTYPE html>
<head>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Deparment', 'Num'],
      <?php
      if($res->num_rows > 0){
          while($row = $res->fetch_assoc()){
            echo "['".$row['name']."', ".$row['NUM']."],";
          }
      }
      ?>
    ]);
    
    var options = {
        title: 'Posts Per Deparment',
        width: 900,
        height: 500,
        is3D: true,
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
}
</script>
</head>
<body>
    <!-- Display the pie chart -->
    <div id="piechart"></div>
</body>
</html>