<?php
session_start();
if (isset($_SESSION['message']))
 {
echo '<script type="text/javascript">alert("'.$_SESSION['message'].'");</script>';
unset($_SESSION['message']);
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Picturesque | Login</title>
    <link rel="stylesheet" href="../packages/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../packages/bootstrap/js/bootstrap.min.js"></script>
    <!-- Main CSS files -->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/login.css">
  </head>
    <body>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="login.php"><img src="../images/logo3.png" /></a>
            </div>
          </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3">
                    <h1>Login</h1>
                    <hr />
                    <form name="login" method="post" action="check_login.php">
                    <div class="form-group">
                      <input type="text" name="uname" placeholder="Username" class="form-control" required autocomplete="off">
                    </div>
                    <br>
                    <div class="form-group">
                      <input type="password" name="password" placeholder="Password" class="form-control" required autocomplete="off">
                    </div>
                    <br>
                    <a href="signup.php">New user? Click here</a>
                    <br>
                    <br>
                  <input type="submit" class="button btn btn-danger center-block" name="login" value="Login" class="form-control"/>
              </form>
                </div>
            </div>
        </div>
    </body>
</html>
