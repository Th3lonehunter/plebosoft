<?php
session_start();
  ob_start();
include_once("../src/php/DBConnect.php");


?>
<!DOCTYPE html>

  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <title>Greenwich University Commenting</title>
  </head>

  <body>
    <div class="page">

      <div class="section header">
        <div class="nav">
          <div class="nav-home"><a href="home.php">Home</a></div>

          <?php if (isset($_SESSION['uid'])){
echo "<div class=.nav-user'><img src='{$_SESSION['Image']}' alt='Avitar'> Hello:".$_SESSION['NickName']." &bull; <a href='../src/php/Logout.php'>Logout</a></div>";
 }
else {
 echo"<div class=.nav-user'>&bull;<a href='login.php'>Login</a></div>";
}
    ?>
        </div>
      </div>
<?php


        $ideaL = 5;

        $sqlP = "SELECT count(ideaID) FROM Plebosoft_Ideas";
        $ret= mysqli_query($dblink,$sqlP);
        if(! $ret){
            die("Error could not get data : ".mysqli_error());
        }
        $rows = mysqli_fetch_array($ret, MYSQLI_NUM);
        $ideaC = $rows[0];
        if(isset($_GET{'page'})){
            $page = $_GET{'page'} +1 ;
            $offset = $ideaL * $page;
        }else{
            $page=0;
            $offset=0;
        }
        $left_idea = $ideaC - ($page * $ideaL);


        if(isset($_POST['viewoption'])){
            $filter=$_POST['viewoption'];
        }else{
            $filter="";
        }



     echo" <div class='main-body'>
     <form method='POST'>
     <p>Display by:<a href='subject.php?id={$_GET['id']}&&page=-1&&view=newest'>[Newest]</a>-
     <a href='subject.php?id={$_GET['id']}&&page=-1&&view=Upvotes'>[Most Upvotes]</a>-  <a href='subject.php?id={$_GET['id']}&&page=-1&&view=MostDownVotes'>[Most DownVotes]</a>-
     <a href='subject.php?id={$_GET['id']}&&page=-1&&view=mostviewed'>[most viewed]</a>-
     <a href='subject.php?id={$_GET['id']}&&page=-1&&view=Latestcomments'>[Latest comments]</a></p>



        <h3>Select an Idea to view:</h3>
        <p>Alternatively, you can create a new idea <a href='new-idea.php'>here.</a>  ";
        if(isset($_GET['view'])){
            if($_GET['view'] !=""){
        if($_GET['view']=='newest'){

           echo " view by newest </p>
        <div class='table-container'>
           <div class='table'>";

              $sql = "SELECT * FROM Plebosoft_Ideas INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID  WHERE Plebosoft_Staff.departmentID={$_GET['id']} ORDER BY Plebosoft_Ideas.submitedDate DESC LIMIT $offset,$ideaL";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error($dblink));
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            $T= $row['title'];
            $tx = $row['ideaText'];
            $un="";
            $ID = $row['ideaID'];
            $anon = $row['isAnnonymus'];
               if($anon == true){
                   $un .="Annonymus";
               }else{
                   $un .= $row['userName'];
               }
           echo" <div class='idea-row'>
              <h3><a href='idea.php?id={$ID}'>".$T."</a></h3>
              <p>".$tx."</p>
              <div class='idea-user'>
                ".$un."
              </div>
            </div>";
                }

               }
            $View =  $_GET['view'];
           if($page > 0){
                   $last = $page-2;


                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a> |";
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $page == 0 ) {
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $left_rec < $rec_limit ) {
                    $last = $page - 2;
                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a>";
         }

        echo"  </div>
        </div>
      </div>";


        }else if($_GET['view']=='Upvotes'){

            echo " view by Upvotes </p>
        <div class='table-container'>
           <div class='table'>";
              $UPV = 1;
            $sql ="SELECT *, COUNT(Plebosoft_Votes.ideaID) as count FROM Plebosoft_Votes INNER JOIN Plebosoft_Ideas ON Plebosoft_Votes.ideaID = Plebosoft_Ideas.ideaID INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID WHERE Plebosoft_Staff.departmentID={$_GET['id']} and Plebosoft_Votes.direction={$UPV} GROUP BY Plebosoft_Votes.ideaID ORDER BY count DESC  LIMIT $offset,$ideaL";

            $res = mysqli_query($dblink,$sql) or die(mysqli_error($dblink));

           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            $T= $row['title'];
            $tx = $row['ideaText'];
            $un="";
            $ID = $row['ideaID'];
            $anon = $row['isAnnonymus'];
                  $counted = $row['count'];
               if($anon == true){
                   $un .="Annonymus";
               }else{
                   $un .= $row['userName'];
               }
           echo" <div class='idea-row'>
              <h3><a href='idea.php?id={$ID}'>".$T."</a></h3>
              <p>".$tx."</p>
              <p>".$counted."</p>
              <div class='idea-user'>
                ".$un."
              </div>
            </div>";
                }

               }
           $View =  $_GET['view'];
           if($page > 0){
                   $last = $page-2;


                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a> |";
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $page == 0 ) {
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $left_rec < $rec_limit ) {
                    $last = $page - 2;
                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a>";
         }
        echo"  </div>
        </div>
      </div>";

        }else if($_GET['view']=='MostDownVotes'){

            echo " view by Most Down Votes </p>
        <div class='table-container'>
           <div class='table'>";
              $UPV = 0;
              $sql ="SELECT *, COUNT(Plebosoft_Votes.ideaID) as count FROM Plebosoft_Votes INNER JOIN Plebosoft_Ideas ON Plebosoft_Votes.ideaID = Plebosoft_Ideas.ideaID INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID WHERE Plebosoft_Staff.departmentID={$_GET['id']} and Plebosoft_Votes.direction={$UPV} GROUP BY Plebosoft_Votes.ideaID ORDER BY count DESC  LIMIT $offset,$ideaL";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error($dblink));
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            $T= $row['title'];
            $tx = $row['ideaText'];
            $un="";
            $ID = $row['ideaID'];
            $anon = $row['isAnnonymus'];
            $counted = $row['count'];
               if($anon == true){
                   $un .="Annonymus";
               }else{
                   $un .= $row['userName'];
               }
           echo" <div class='idea-row'>
              <h3><a href='idea.php?id={$ID}'>".$T."</a></h3>
              <p>".$tx."</p>
              <p>".$counted."</p>
              <div class='idea-user'>
                ".$un."
              </div>
            </div>";
                }

               }
           $View =  $_GET['view'];
           if($page > 0){
                   $last = $page-2;


                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a> |";
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $page == 0 ) {
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $left_rec < $rec_limit ) {
                    $last = $page - 2;
                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a>";
         }

        echo"  </div>
        </div>
      </div>";


        }else if($_GET['view']=='mostviewed'){

             echo " view by most viewed </p>
        <div class='table-container'>
           <div class='table'>";

              $sql = "SELECT * FROM Plebosoft_Ideas INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID WHERE Plebosoft_Staff.departmentID={$_GET['id']} ORDER BY Plebosoft_Ideas.viewCount DESC LIMIT $offset,$ideaL";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error($dblink));
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            $T= $row['title'];
            $tx = $row['ideaText'];
            $un="";
            $ID = $row['ideaID'];
               $vc = $row['viewCount'];
            $anon = $row['isAnnonymus'];
               if($anon == true){
                   $un .="Annonymus";
               }else{
                   $un .= $row['userName'];
               }
           echo" <div class='idea-row'>
              <h3><a href='idea.php?id={$ID}'>".$T."</a></h3>
              <p>".$tx."</p>
              <p>".$vc."</p>
              <div class='idea-user'>
                ".$un."
              </div>
            </div>";
                }

               }
           $View =  $_GET['view'];
           if($page > 0){
                   $last = $page-2;


                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a> |";
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $page == 0 ) {
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $left_rec < $rec_limit ) {
                    $last = $page - 2;
                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a>";
         }

        echo"  </div>
        </div>
      </div>";

        }else if($_GET['view']=='Latestcomments'){


            echo " view by Latest comments </p>
        <div class='table-container'>
           <div class='table'>";

              $sql = "SELECT * FROM Plebosoft_Ideas INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID INNER JOIN Plebosoft_Comments ON Plebosoft_Ideas.ideaID = Plebosoft_Comments.ideaID WHERE Plebosoft_Staff.departmentID={$_GET['id']} ORDER BY Plebosoft_Comments.commentedDate DESC LIMIT $offset,$ideaL";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error($dblink));
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            $T= $row['title'];
            $tx = $row['ideaText'];
            $un="";
            $ID = $row['ideaID'];
            $anon = $row['isAnnonymus'];
               $COMDATE = $row['commentedDate'];
               if($anon == true){
                   $un .="Annonymus";
               }else{
                   $un .= $row['userName'];
               }
           echo" <div class='idea-row'>
              <h3><a href='idea.php?id={$ID}'>".$T."</a></h3>
              <p>".$tx."</p>
              <p>".$COMDATE."</p>
              <div class='idea-user'>
                ".$un."
              </div>
            </div>";
                }

               }
           $View =  $_GET['view'];
           if($page > 0){
                   $last = $page-2;


                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a> |";
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $page == 0 ) {
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $left_rec < $rec_limit ) {
                    $last = $page - 2;
                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a>";
         }

        echo"  </div>
        </div>
      </div>";

        }}else{


        echo "</p>
        <div class='table-container'>
          <div class='table'>";

              $sql = "SELECT * FROM Plebosoft_Ideas INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID WHERE Plebosoft_Staff.departmentID={$_GET['id']} LIMIT $offset,$ideaL";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error($dblink));
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            $T= $row['title'];
            $tx = $row['ideaText'];
            $un="";
            $ID = $row['ideaID'];
            $anon = $row['isAnnonymus'];
               if($anon == true){
                   $un .="Annonymus";
               }else{
                   $un .= $row['userName'];
               }
           echo" <div class='idea-row'>
              <h3><a href='idea.php?id={$ID}'>".$T."</a></h3>
              <p>".$tx."</p>
              <div class='idea-user'>
                ".$un."
              </div>
            </div>";
                }

               }
           $View =  $_GET['view'];
           if($page > 0){
                   $last = $page-2;


                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a> |";
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $page == 0 ) {
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=$View\">Next 5 Records</a>";
                    }else if( $left_rec < $rec_limit ) {
                    $last = $page - 2;
                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=$View\">Last 5 Records</a>";
         }

        echo"  </div>
        </div>
      </div>";
        }
        }else{


        echo "</p>
        <div class='table-container'>
          <div class='table'>";

              $sql = "SELECT * FROM Plebosoft_Ideas INNER JOIN Plebosoft_Staff ON Plebosoft_Ideas.userID = Plebosoft_Staff.staffID WHERE Plebosoft_Staff.departmentID={$_GET['id']} LIMIT $offset,$ideaL";
            $res = mysqli_query($dblink,$sql) or die(mysqli_error($dblink));
           if(mysqli_num_rows($res) > 0){
           while($row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
            $T= $row['title'];
            $tx = $row['ideaText'];
            $un="";
            $ID = $row['ideaID'];
            $anon = $row['isAnnonymus'];
               if($anon == true){
                   $un .="Annonymus";
               }else{
                   $un .= $row['userName'];
               }
           echo" <div class='idea-row'>
              <h3><a href='idea.php?id={$ID}'>".$T."</a></h3>
              <p>".$tx."</p>
              <div class='idea-user'>
                ".$un."
              </div>
            </div>";
                }

               }

           if($page > 0){
                   $last = $page-2;


                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=\">Last 5 Records</a> |";
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=\">Next 5 Records</a>";
                    }else if( $page == 0 ) {
                   echo "<a href = \"subject.php?id={$_GET['id']}&&page=$page&&view=\">Next 5 Records</a>";
                    }else if( $left_rec < $rec_limit ) {
                    $last = $page - 2;
                    echo "<a href = \"subject.php?id={$_GET['id']}&&page=$last&&view=\">Last 5 Records</a>";
         }

        echo"  </div>
        </div>
      </div>";
        }
          ?>
      </div>
  </body>
