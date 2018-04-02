<html>
  <head>
    <title>QA - Greenwich Commenting</title>
    <link rel="stylesheet" href="style/qa.css">
  </head>
  <body>
    <div class="page">
      <div class="title">
        <h1>QA Dashboard</h1>
      </div>
        <div class="content">
        <!-- Reported Ideas and Comments -->
        <div class="reported">
          <!-- Reported Ideas -->
          <div class="ideas">
            <div>
              <h3>Reported Ideas</h3>
              <?php
               // include "php/ReportQAParseIDEA.php";
              ?>
            </div>
          </div>
          <!-- Reported Comments -->
          <div class="comments">
            <div>
              <h3>Reported Comments</h3>
              <?php
              //  include "php/ReportQAParsecomemnt.php";
              ?>
            </div>
          </div>
        </div>

        <!-- Statistics -->
        <div class="statistics">
          <div>
            <h3>Number of Posts per Department</h3>
            <?php
            //  include "Stat_test.php";
            ?>
          </div>
          <div>
            <h3>Number of Comments per Department</h3>
            <?php
            //  include "Stat_test2.php";
            ?>
          </div>
          <div>
            <h3>Top 5 Ideas</h3>
            <?php
           //   include "Stat_test3.php";
            ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
