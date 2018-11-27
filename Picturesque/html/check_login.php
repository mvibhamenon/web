<?php

session_start();
$_SESSION["myusername"]=$_POST['myusername'];

$host="localhost"; // Host name
$username="root"; // Mysql username
$password=""; // Mysql password
$db_name="picturesque"; // Database name
$tbl_name="users"; // Table name

// Connect to server and select databse.
$con=mysqli_connect("$host", "$username", "$password");
$select_db=mysqli_select_db($con,$db_name)or die("cannot select DB");
// Define $myusername and $mypassword
$myusername=$_POST['uname'];
$mypassword=$_POST['password'];

$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";

$result=mysqli_query($con,$sql);
$user_id=mysqli_fetch_array($result);


// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);
if($count==1){
    $_SESSION['myusername']=$myusername;
  $_SESSION['username']=$myusername;
  $_SESSION['user_id']=$user_id['id'];
  $_SESSION['message'] = "Welcome user!";

  header('location:home.php');


}
else {
  $_SESSION['message'] = "Wrong username or password";

  header('location:login.php');
}

ob_end_flush();
?>
