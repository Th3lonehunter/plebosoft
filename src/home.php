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
          <div class="nav-home"><a href="#">Home</a></div>
          <!-- Need PHP here to get users name -->
          <div class="nav-user">Hello, <!--user-->. Not you? <a href="login.php">Sign Out</a></div>
        </div>
      </div>

      <div class="main-body">
        <h3>Please select a Subject from the table below to view all ideas for each:</h3>
        <div class="table-container">
          <div class="table">
            <!-- You can recursively generate new rows by retrieving the subjects from the database -->
            <div class="idea-row">
              <a href="subject.html">Computing</a>
              <p>The computing department, follow this to see all computing Ideas.</p>
            </div>
            <div class="idea-row">
              <a href="subject.html">Art and Design</a>
              <p>The Art and Design department, follow this to see all Art and Design Ideas.</p>
            </div>
          </div>
        </div>
      </div>


      </div>

      </div>
    </div>
  </body>
</html>
