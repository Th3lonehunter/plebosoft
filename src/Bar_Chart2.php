<?php
session_start();
  ob_start();
include_once("../src/php/DBConnect.php");

?>
<html>
  <head>
      
      <?php     
      
      $sql1 ="SELECT COUNT(Plebosoft_Ideas.ideaID) as ideas, Plebosoft_Ideas.title FROM Plebosoft_Ideas LEFT JOIN Plebosoft_Comments ON Plebosoft_Ideas.ideaID=Plebosoft_Comments.ideaID WHERE ISNULL(Plebosoft_Comments.commentID) ORDER BY Plebosoft_Ideas.ideaID";
      $res1 = mysqli_query($dblink,$sql1) or die(mysqli_error($dblink));
      if(mysqli_num_rows($res1) > 0){
           while($row1 = mysqli_fetch_assoc($res1)){
      
      
   $nocoms = $row1['ideas'];
      
           }
      }
      $sql1 ="SELECT COUNT(Plebosoft_Ideas.ideaID) as ideas, Plebosoft_Ideas.title FROM Plebosoft_Ideas LEFT JOIN Plebosoft_Comments ON Plebosoft_Ideas.ideaID=Plebosoft_Comments.ideaID WHERE Plebosoft_Comments.commentID ORDER BY Plebosoft_Ideas.ideaID";
      $res1 = mysqli_query($dblink,$sql1) or die(mysqli_error($dblink));
      if(mysqli_num_rows($res1) > 0){
           while($row1 = mysqli_fetch_assoc($res1)){
      
      
   $coms = $row1['ideas'];
      
           }
      }
    
    
      ?>
      
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['', 'Ideas Comment Count',{ role: "style" }],
            ['Ideas with no comments','<?php echo $nocoms; ?>','silver'],
            ['Ideas with comments','<?php echo $coms; ?>','silver']
          
        ]);

         
          
        var options = {
         width: 600,
        height: 400,
          legend: { position: 'none' },
          chart: {
            title: 'Count of Anonymous Ideas and Comments',
            subtitle: 'For the greenwich Idea System' },
          axes: {
            x: {
              0: { side: 'top', label: 'Ideas without comments'} 
            }
          },
          bar: { groupWidth: "95%" }
        };

        var chart = new google.charts.Bar(document.getElementById('ANNON'));
        
        chart.draw(data, options);
      };
    </script>
  </head>
  <body>
    <div id="ANNON" style="width: 900px; height: 300px;"></div>
      <br>
      <br>
      <br><br><br><br>
      <h4>List of all posts with no comments</h4>
      <?php
      $sql3 ="SELECT Plebosoft_Ideas.ideaID, Plebosoft_Ideas.title FROM Plebosoft_Ideas LEFT JOIN Plebosoft_Comments ON Plebosoft_Ideas.ideaID=Plebosoft_Comments.ideaID WHERE ISNULL(Plebosoft_Comments.commentID) ORDER BY Plebosoft_Ideas.ideaID";
      $res3 = mysqli_query($dblink,$sql3) or die(mysqli_error($dblink));
      if(mysqli_num_rows($res3) > 0){
           while($row3 = mysqli_fetch_assoc($res3)){
      
      
   echo "idea ID: ".$row3['ideaID']." Idea Title: ".$row3['title']."<br>";
      
           }
      }
      ?>
  </body>
</html>