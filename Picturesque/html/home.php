<?php

session_start();

if(!isset($_SESSION['myusername']))
{
  $_SESSION['message'] = "Logged out!";

        header("location: login.php");
}
$conn = mysqli_connect("localhost", "root", "", "picturesque");

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
              <!-- <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul>  -->
            <!-- Right side of navbar -->
            <!-- add drop down list for profile picture -->
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="navbar-form navbar-right" action="search_results.php" method="post">
                <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="search">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                </input>
                </div>
                </div>
                </form></li>

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
        <div class="container content profile_content2">
            <div class="row user_feed">
                <div class="col-md-12 col_content user_feed_col">
                    <?php
                    $user_id=$_SESSION['user_id'];
                    $query2="Select * from following where user_id=$user_id";
                    $result2=mysqli_query($conn,$query2);
                    $count=mysqli_num_rows($result2);
                    if($count==0)
                        echo '<center>
                        <h1>No posts</h1>
                        </center>';
                    while($row=mysqli_fetch_array($result2))
                    {
                        $artist_id=$row['artist_id'];
                        $query3="SELECT artwork,description from gallery where artist_id=$artist_id";
                        $result3 = mysqli_query($conn, $query3);
                        $rowcount=mysqli_num_rows($result3);
                        echo '<table class="table bordered"><tr>';
                        while($row3 = mysqli_fetch_array($result3))
                        {
                          $image = $row3['artwork'];
                          $q="select full_name from users where id=$artist_id";
                          $res=mysqli_query($conn,$q);
                          while($r=mysqli_fetch_array($res))
                          {
                            $full_name=$r['full_name'];
                              if($image == "")
                              {
                                $image = "";
                              }
                              else{
                                $image = "../artwork/".$image;
                              }


                              echo  '<td><div class="thumbnail-rectangle text-center" >
                                              <img src="'.$image.'" class="img feedimg" class="img-thumnail" />
                                             </div>';
                                             echo '
                                             <form action="other_user_profile.php" method="post">
                                              <center>
                                              <input type="submit"  class="btn btn-primary post_btn" value="'.$full_name.'" /></center>
                                              <input type="text" style="height:0px; visibility:hidden;" name="user_id" value= "'.$user_id.'" />
                                              <input type="text" style="height:0px; visibility:hidden;" class="btn btn-primary post_btn" name="artist_id" value= "'.$artist_id.'" />
                                              </form></div>';
                              echo '<br>';
                              echo '<p>'  . '<div class="caption text-center">' . "Description: " . $row3['description'] . '</p>' .  '</div>' . '</td>';
                                   echo '</tr><tr>';
                          }
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
