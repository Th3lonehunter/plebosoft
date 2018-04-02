<?php
session_start();
  ob_start();
include_once("../src/php/DBConnect.php");

?>
<html>
  <head>
      
      <?php     
      
      $sql1 ="SELECT COUNT(ideaID) as annonIdea FROM Plebosoft_Ideas WHERE isAnnonymus = 1";
      $res1 = mysqli_query($dblink,$sql1) or die(mysqli_error());
      $row1 = mysqli_fetch_assoc($res1);
      $annonIdea = $row1['annonIdea'];
   
      
      $sql2 ="SELECT COUNT(commentID) as annoncom1 FROM Plebosoft_Comments WHERE isAnnonymus = 1";
      $res2 = mysqli_query($dblink,$sql2) or die(mysqli_error());
      $row2 = mysqli_fetch_assoc($res2);
      $annonIdea2 = $row2['annoncom1'];
     
      
      $sql3 ="SELECT COUNT(ideaID) as annonIdea2 FROM Plebosoft_Ideas WHERE isAnnonymus = 0";
      $res3 = mysqli_query($dblink,$sql3) or die(mysqli_error());
      $row3 = mysqli_fetch_assoc($res3);
      $annonIdea3 = $row3['annonIdea2'];

      
      $sql4 ="SELECT COUNT(commentID) as annoncom2 FROM Plebosoft_Comments WHERE isAnnonymus = 0";
      $res4 = mysqli_query($dblink,$sql4) or die(mysqli_error());
      $row4 = mysqli_fetch_assoc($res4);
      $annonIdea4 = $row4['annoncom2'];
    
      ?>
      
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawS);

      function drawS() {
        var data = new google.visualization.arrayToDataTable([
          ['', 'Number of Anonymous',{ role: "style" }],
            ['Annonymus Ideas','<?php echo $annonIdea; ?>','silver'],
            ['Visable Ideas','<?php echo $annonIdea3; ?>','silver'],
            ['Annonymus Comments','<?php echo $annonIdea2; ?>','silver'],
            ['Visable Comments','<?php echo $annonIdea4; ?>','silver']
          
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
              0: { side: 'top', label: 'Anonymous'} 
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
      <br>
      <br>
      <br>
     
      
      <h3>All Anonymous Posts</h3>
      <?php
      
      $sql5 ="SELECT ideaID, title FROM Plebosoft_Ideas WHERE isAnnonymus = 1 ORDER BY ideaID ASC";
      $res5 = mysqli_query($dblink,$sql5) or die(mysqli_error());
      
      if(mysqli_num_rows($res5) > 0){
           while($row5 = mysqli_fetch_assoc($res5)){
      echo " Anonymous Idea ID: ".$row5['ideaID']."  Anonymous Post Title: ". $row5['title']."<br>";
               
           }
      }
      
      
      ?>
      <br><br>
      <h3> Anonymous Coments</h3>
      <?php
      
      $sql6 ="SELECT commentID FROM Plebosoft_Comments WHERE isAnnonymus = 1 ORDER BY commentID ASC";
      $res6 = mysqli_query($dblink,$sql6) or die(mysqli_error());
      
      if(mysqli_num_rows($res6) > 0){
           while($row6 = mysqli_fetch_assoc($res6)){
      echo " Anonymous Comment ID: ".$row6['commentID']."<br>";
               
           }
      }
      
      
      ?>
  </body>
</html>