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
                    <h1>Sign Up</h1>
                    <hr />
                    <form name="create" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group" style="height:0px; overflow:hidden;">
                          <input type="file" id="fileInput" name="fileInput">
                        </div>
                        <button type="button" onclick="chooseFile();" id="images"></button>

                        <br />
                        <br />
                    <div class="form-group">
                      <input type="text" name="username" placeholder="Username" class="form-control" required autocomplete="off">
                    </div>
                    <br>
                    <div class="form-group">
                      <input type="text" name="full_name" placeholder="Full name" class="form-control" required autocomplete="off">
                    </div>
                    <br>
                    <div class="form-group">
                      <input type="password" name="password" placeholder="Password" class="form-control" required autocomplete="off">
                    </div>
                    <br>
                    <div class="form-group">
                      <input type="email" name="email_id" placeholder="Email-id" class="form-control" required autocomplete="off">
                    </div>
                    <br>
                  <input type="submit" id="insert" class="button btn btn-danger center-block" name="login" value="Sign up" class="form-control"/>
              </form>
                </div>
            </div>
        </div>
    </body>
</html>



<?php

$servername="localhost";
$username="root";
$password="";
$dbname="picturesque";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$select_db=mysqli_select_db($conn,$dbname)or die(mysqli_error($conn));

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

  $full_name=$_POST['full_name'];
	$username=$_POST['username'];
  $email_id=$_POST['email_id'];
	$password=$_POST['password'];
       $file = rand(1000,100000)."-".$_FILES['fileInput']['name'];
      $file_loc = $_FILES['fileInput']['tmp_name'];
    	$file_size = $_FILES['fileInput']['size'];
    	$file_type = $_FILES['fileInput']['type'];
    	$folder="../artwork/";
    	$new_size = $file_size/2048;
    	$new_file_name = strtolower($file);
    	$final_file=str_replace(' ','-',$new_file_name);
    	if(move_uploaded_file($file_loc,$folder.$final_file))
    	{
        //  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
          $sql = "INSERT INTO users(full_name,username,email_id,password,profile_picture) VALUES('$full_name','$username','$email_id','$password','$final_file')";
          if(mysqli_query($conn, $sql))
          {
               $_POST = array();
               $_SESSION['message'] = "New user account created!";
               header("location:login.php");
          }
          else {
             echo '<script type="text/javascript">alert("Not successful");</script>';

          }
       }
  //$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
//$sql = "INSERT INTO new_user(name,uname,link,password,dp) VALUES('$name','$uname','$link','$password','$file')";
//    if ($conn->query($sql) === TRUE)
//{
  //    header("Location: login.php");
//  }
// else
  // {
    //echo "Error: " . $sql . "<br>" . $conn->error;
      //}
}

$conn->close();

?>
<script>

function chooseFile() {
     document.getElementById("fileInput").click();
  }

$(document).ready(function(){
     $('#insert').click(function(){
          var image_name = $('#fileInput').val();
          if(image_name == '')
          {
               alert("Please Select Image");
               return false;
          }
          else
          {
               var extension = $('#fileInput').val().split('.').pop().toLowerCase();
               if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
               {
                    alert('Invalid Image File');
                    $('#fileInput').val('');
                    return false;
               }
          }
     });
});
</script>
