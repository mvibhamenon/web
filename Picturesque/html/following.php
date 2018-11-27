<?php
session_start();

if(!isset($_SESSION['myusername']))
{
  $_SESSION['message'] = "Logged out!";

        header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../packages/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../packages/bootstrap/js/bootstrap.min.js"></script>
    <!-- Main CSS files -->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/home.css">
    <link rel="stylesheet" href="../css/user_profile.css">
    <link rel="stylesheet" href="../css/search_resuts.css">


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
              <a class="navbar-brand" href="home.php"><img src="../images/logo3.png" /></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <!-- Left Side of navbar -->
                 <ul class="nav navbar-nav">
                  <li><a href="other_user_profile.php">Back</a></li>
              </ul>
              <!-- <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>  -->
            <!-- Right side of navbar -->
            <!-- add drop down list for profile picture -->
              <ul class="nav navbar-nav navbar-right">
                <li><a href="explore.php"><span class="fa fa-compass"></span></a></li>
                <!-- <li><a href="notifications.php"><span class="fa fa-heart"></span></a></li> -->
                <!-- <li><a href="notifications.php"><span class="fa fa-plus-circle"></span></a></li> -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" >
                    <span class="fa fa-user-circle"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="user_profile.php">Go to Profile</a></li>
                      <!-- <li><a href="settings.php">Settings</a></li> -->
                      <li><a href="logout.php">Logout</a></li>

                    </ul>
                  </li>
            </ul>
            </div>
          </div>
        </nav>
        <div class="container content">
            <div class="row">
                <div class="col-md-3 col_content ">
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "picturesque");
                    $user_id=$_SESSION['user_id'];
                    $query2="Select * from following where user_id=$user_id";
                    $result2=mysqli_query($conn,$query2);
                    echo "<table class='table table-borderless' ";
                    while($row2 = mysqli_fetch_assoc($result2))
                    {
                        $artist_id=$row2['artist_id'];
                        $query1="Select * from users where id=$artist_id";
                        $result=mysqli_query($conn,$query1);
                        while($row=mysqli_fetch_array($result))
                        {
                            $image = $row['profile_picture'];
                            if($image == "")
                            {
                              $image = "";
                            }
                            else{
                              $image = "../artwork/".$image;
                            }
                                echo "<tr>";
                                echo  '<td>
                                <div class="profiles">
                                                  <img id="profile_picture"  src="'.$image.'" class="img" />
                                                  </td></div></tr>';
                                              }
                        }
                        echo "</table>";
                    ?>

                </div>
                <div class="col-md-9 col_content ">

                    <?php
                    $query2="Select artist_id from following where user_id=$user_id";
                    $result2=mysqli_query($conn,$query2);
                    echo "<table class='table table-borderless' ";
                    while($row2 = mysqli_fetch_assoc($result2))
                    {
                        $artist_id=$row2['artist_id'];
                        $query1="Select * from users where id=$artist_id";
                        $result=mysqli_query($conn,$query1);
                        while($row=mysqli_fetch_array($result))
                        {
                                echo '<tr>';
                                echo  '<td>
                            <div class="profiles1"> <h2>'.$row['full_name'].'</h2><h3>'.$row['username'].'</h3>
                                              </td><td>
                                             <form action="other_user_profile.php" method="post">
                                              <input type="submit"  class="btn btn-primary follow_btn" value="Go to Profile" />
                                              <input type="text" style="height:0px; visibility:hidden;" name="user_id" value= "'.$user_id.'" />
                                              <input type="text" style="height:0px; visibility:hidden;" class="btn btn-primary follow_btn" name="artist_id" value= "'.$artist_id.'" />
                                              </form></td></div></tr>';
                    }
                }
                    echo "</table>";
                ?>

                </div>
                </div>
            </div>
        </div>
    </body>
</html>
