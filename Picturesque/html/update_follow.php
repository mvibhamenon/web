<?php
session_start();
$user_id=$_SESSION['user_id'];
$artist_id=$_SESSION['artist_id'];
$conn = mysqli_connect("localhost", "root", "", "picturesque");

// $query="INSERT into following(user_id,artist_id) values($user_id,$artist_id)";
$sql = "INSERT INTO following(user_id,artist_id) VALUES($user_id,$artist_id)";

if(mysqli_query($conn,$sql))
{
    $_SESSION['artist_id']=$artist_id;
    $_SESSION['user_id']=$user_id;
    header("location:other_user_profile.php");
    echo '<script type="text/javascript">alert("Successful");</script>';

}
else {
    echo '<script type="text/javascript">alert("Not successful");</script>';

}

?>
