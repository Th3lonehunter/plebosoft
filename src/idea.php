<!DOCTYPE html>

  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style/main.css">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    <title>Greenwich University Commenting</title>
  </head>

  <body>
    <div class="page">
      <!-- Header -->
      <div class="section header">
        <div class="nav">
          <div class="nav-home"><a href="home.html">Home</a></div>
          <!-- Need PHP here to get users name -->
          <div class="nav-user">Hello, <!--user-->. Not you? <a href="login.php">Sign Out</a></div>
        </div>
      </div>

      <div class="section">
        <div class="main-body">
          <h3>Idea Title - Retrieves the title from Database</h3>
          <div class="idea-text">
            <p>The Idea text here.</p>
            <div class="idea-info">
              <div>
                <p>By Tim</p>
              </div>
              <div>
                <p>Date/Time</p>
              </div>
            </div>
          </div>
        </div>

        <div class="comment-container">

          <!-- Need to get the total comments
          <?php
            get_total();
            require_once 'php/CheckComment.php';
           ?>
         -->

          <form class="main" action="" method="post">
            <label>Make a Suggestion..</label>
            <textarea class="form-text" name="comment" id="comment"></textarea>
            <br />
            <input type="submit" class="form-submit" name="new-comment" value="post">
          </form>
          <!-- Load the existing comments, use Functions.php
          <?php get_comments(); ?>
        -->
        </div>
      </div>

    </div>
  </body>
</html>
