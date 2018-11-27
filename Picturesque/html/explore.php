<?php
 session_start();
 $connect = mysqli_connect("localhost", "root", "", "picturesque");

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
     <link rel="stylesheet" href="../css/search_resuts.css">
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
                <ul class="nav navbar-nav">
                 <li><a href="home.php">Back</a></li>
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

               <li><a href="explore.php"><span class="icon fa fa-compass"></span></a></li>
               <!-- <li><a href="notifications.php"><span class="icon fa fa-heart"></span></a></li> -->
               <!-- <li><a href="notifications.php"><span class="icon fa fa-plus-circle"></span></a></li> -->
               <li class="dropdown">
                   <a class="dropdown-toggle" data-toggle="dropdown" href="#" >
                   <span class="icon fa fa-user-circle"></span></a>
                   <ul class="dropdown-menu">
                     <li><a href="user_profile.php">Go to Profile</a></li>
                     <li><a href="logout.php">Logout</a></li>
                   </ul>
                 </li>
           </ul>
             </div>
           </div>
         </nav>
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
                                 $query3="SELECT * from gallery";
                                 $result3 = mysqli_query($connect, $query3);
                                 $rowcount=mysqli_num_rows($result3);
                                 $i=0;
                                 echo '<table class="table bordered"><tr>';
                                 while($row3 = mysqli_fetch_array($result3))
                                 {
                                   $image = $row3['artwork'];
                                   $artist_id=$row3['artist_id'];
                                   if($image == "")
                                   {
                                     $image = "";
                                   }
                                   else{
                                     $image = "../artwork/".$image;
                                   }
                                   $user_id=$_SESSION['user_id'];
                                   $q="select full_name from users where id=$artist_id";
                                   $res=mysqli_query($connect,$q);
                                   while($r=mysqli_fetch_array($res))
                                   {
                                       $i++;

                                            $full_name=$r['full_name'];
                                       echo '<td>' . '<div class="thumbnail-rectangle text-center" >
                                                       <img src="'.$image.'" class="img feed_img" class="img-thumnail" />
                                                      </div>';
                                        echo '<form action="other_user_profile.php" method="post">
                                                       <center>
                                                       <input type="submit"  class="btn btn-primary post_btn" value="'.$full_name.'" /></center>
                                                       <input type="text" style="height:0px; visibility:hidden;" name="user_id" value= "'.$user_id.'" />
                                                       <input type="text" style="height:0px; visibility:hidden;" class="btn btn-primary post_btn" name="artist_id" value= "'.$artist_id.'" />
                                                       </form></div></td>';
                                       if (($i%3)==0)
                                            echo '</tr><tr>';

                                   }
                                 }
                            ?>
                       </table>
                     </div>

                     <div id="one_col_view" class="tabcontent">
                         <?php
                         $query3="SELECT artwork from gallery";
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

                           $user_id=$_SESSION['user_id'];
                           $q="select full_name from users where id=$artist_id";
                           $res=mysqli_query($connect,$q);
                           while($r=mysqli_fetch_array($res))
                           {
                                    $full_name=$r['full_name'];
                               echo '<td>' . '<div class="thumbnail-rectangle text-center" >
                                               <img src="'.$image.'" class="img feedimg" class="img-thumnail" />
                                              </div>';
                                echo '<form action="other_user_profile.php" method="post">
                                               <center>
                                               <input type="submit"  class="btn btn-primary post_btn" value="'.$full_name.'" /></center>
                                               <input type="text" style="height:0px; visibility:hidden;" name="user_id" value= "'.$user_id.'" />
                                               <input type="text" style="height:0px; visibility:hidden;" class="btn btn-primary post_btn" name="artist_id" value= "'.$artist_id.'" />
                                               </form></div></td>';
                                    echo '</tr><tr>';

                           }
                       }?>
                     </div>

                 </div>
             </div>
         </div>
          </body>
 </html>
<script>
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
</script>
