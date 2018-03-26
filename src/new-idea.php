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
          <div class="nav-home"><a href="home.php">Home</a></div>
          <!-- Need PHP here to get users name -->
          <div class="nav-user">Hello, <!--user-->. Not you? <a href="login.php">Sign Out</a></div>
        </div>
      </div>
      <div class="section">
        <div class="new-idea">
          <form action="NewIdea.php" method="POST">
            <div class="idea-form">
              <h3>Create an Idea:</h3>
              <div class="idea-title">
                <input id="idea-title" type="text" class="form-input" placeholder="Title" required>
              </div>
              <div class="idea-text">
                <textarea name="text" id="idea-text" cols="120" rows="15"></textarea>
              </div>
              <div class="idea-attachment">
                <input id="idea-file" type="file">
              </div>
              <div class="idea-submit">
                <input type="submit" value="Submit Idea">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
