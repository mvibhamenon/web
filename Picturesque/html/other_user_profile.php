<?php
session_start();

if(!isset($_SESSION['myusername']))
{
  $_SESSION['message'] = "Logged out!";

        header("location: login.php");
}
 $connect = mysqli_connect("localhost", "root", "", "picturesque");
 $user_id=$_SESSION['user_id'];
 $artist_id=$_SESSION['artist_id'];
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
                <ul class="nav navbar-nav">
                  <li><a href="home.php">Back</a></li>
              </ul>
                <!-- Left Side of navbar -->
                <!-- <li><a href="#">Home</a></li> -->
                <!-- <ul class="nav navbar-nav"> -->
                <!-- <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li> -->
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
        <div class="container content profile_content">
            <div class="row ">
                <div class="col-md-3 col_content ">
                    <?php
                    if(isset($_POST['user_id']))
                    {
                        $user_id=$_POST['user_id'];
                        $artist_id=$_POST['artist_id'];
                        $_SESSION['artist_id']=$artist_id;
                    }
                    $query = "SELECT profile_picture FROM users where id='$artist_id'";
                    $result = mysqli_query($connect, $query);
                    $rowcount=mysqli_num_rows($result);
                    $i=0;
                    while($row = mysqli_fetch_array($result))
                    {
                      $image = $row['profile_picture'];
                      if($image == "")
                      {
                        $image = "";
                      }
                      else{
                        $image = "../artwork/".$image;
                      }
                      echo  '<div >
                                        <img id="profile_picture"  src="'.$image.'" class="img" />
                                        </div>';
                                    }
                                        ?>

                </div>
                <div class="col-md-8 col_content user_details">
                    <h1>
                        <?php
                        $query = "SELECT * FROM users where id='$artist_id'";
                        $result = mysqli_query($connect, $query);
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '<h1>'.$row['full_name'].' ( '.$row['username'].' )</h1>';

                        }

                        $query2="SELECT count(artwork) FROM gallery where artist_id=$artist_id";
                        $result1 = mysqli_query($connect, $query);
                        $row1 = mysqli_fetch_array($result1);
                        $query = "select count(user_id) FROM following where user_id=$artist_id";
                        $result = mysqli_query($connect, $query);
                        $row = mysqli_fetch_array($result);
                        $query = "select count(artist_id) FROM following where artist_id=$artist_id";
                        $result = mysqli_query($connect, $query);
                        $row2= mysqli_fetch_array($result);

                        echo '<a>Posts '.$row1[0],' </a><a href="following.php">Following '.$row[0].'</a><a href="followers.php">Followers '.$row2[0].'</a>
                        <br />
                        <form action="update_follow.php" method="post">';
                        $query="SELECT * from following where user_id=$user_id and artist_id=$artist_id";
                        $result=mysqli_query($connect, $query);
                        $count=mysqli_num_rows($result);
                        if($count>=1)
                            {
                                echo '<input type="submit" class="btn btn-primary" value="Following" disabled />';
                            }
                            elseif($count==0) {
                                echo '<input type="submit" class="btn btn-primary" value="Follow">';

                        }
                        echo '</form>';

                        ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="container content profile_content">
            <div class="row user_feed">
                <div class="col-md-12 col_content user_feed_col">

                    <div class="tab">
                      <button class="tablinks" onclick="openTab(event, 'three_col_view')"><img class="icons" src="../images/three_col_view.png" /></button>
                      <button class="tablinks" onclick="openTab(event, 'one_col_view')"><img  class="icons" src="../images/one_col_view.png"</button>
                    </div>

                    <div id="three_col_view" class="tabcontent">
                      <table class="table">
                          <?php
                                $query3="SELECT artwork,description from gallery where artist_id=$artist_id";
                                $result3 = mysqli_query($connect, $query3);
                                $rowcount=mysqli_num_rows($result3);
                                $i=0;
                                echo '<table class="table bordered"><tr>';
                                while($row3 = mysqli_fetch_array($result3))
                                {
                                    $i++;
                                  $image = $row3['artwork'];
                                  if($image == "")
                                  {
                                    $image = "";
                                  }
                                  else{
                                    $image = "../artwork/".$image;
                                  }
                                  echo '<td>' . '<div class="thumbnail-rectangle text-center" >
                                                  <img src="'.$image.'" class="img feed_img" class="img-thumnail" />
                                                 </div>';
                                  echo '<br>';
                                  echo '<p>'  . '<div class="caption text-center">' . "Description: " . $row3['description'] . '</p>' .  '</div>' . '</td>';
                                  if (($i%3)==0)
                                       echo '</tr><tr>';
                                }
                           ?>
                      </table>
                    </div>

                    <div id="one_col_view" class="tabcontent">
                        <?php
                        $query3="SELECT artwork,description from gallery where artist_id=$artist_id";
                        $result3 = mysqli_query($connect, $query3);
                        $rowcount=mysqli_num_rows($result3);

                        echo '<table class="table bordered"><tr>';
                        while($row3 = mysqli_fetch_array($result3))
                        {
                            $i++;
                          $image = $row3['artwork'];
                          if($image == "")
                          {
                            $image = "";
                          }
                          else{
                            $image = "../artwork/".$image;
                          }
                          echo '<td>' . '<div class="thumbnail-rectangle text-center" >
                                          <img src="'.$image.'" class="img " class="img-thumnail" />
                                         </div>';
                          echo '<br>';
                          echo '<p>'  . '<div class="caption text-center">' . "Description: " . $row3['description'] . '</p>' .  '</div>' . '</td>';
                               echo '</tr><tr>';
                        }?>
                    </div>

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
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#fileInput").change(function() {
  readURL(this);
});
function openTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
// function update_followbtn(event)
// {
//     var follow_btn=document.getElementById('follow_btn_update');
//     follow_btn.value='Following';
//     follow_btn.style.backgroundColor="grey";
// }
</script>
