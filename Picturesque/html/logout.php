<?php
session_start();
unset($_SESSION['myusername']);
unset($_SESSION['username']);


if(!isset($_SESSION['myusername']))
{
  $_SESSION['message'] = "Logged out!";

        header("location: login.php");
}
?>
