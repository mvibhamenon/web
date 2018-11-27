<?php
session_start();
$servername="localhost";
$username="root";
$password="";
$dbname="picturesque";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$select_db=mysqli_select_db($conn,$dbname)or die(mysqli_error($conn));
$user_id=$_POST['user_id'];
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
        $description=$_POST['img_description'];
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

          $sql = "INSERT INTO gallery(artist_id,description,artwork) VALUES($user_id,'$description','$final_file')";
          if(mysqli_query($conn, $sql))
          {
               $_POST = array();
               header('location:user_profile.php');
          }
          else {
             $_SESSION['message'] = "error in creation ";

          }
       }
}
$conn->close();
?>
