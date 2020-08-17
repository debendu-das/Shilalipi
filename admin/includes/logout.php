<?php
if(isset($_GET['logout'])){
  unset($_SESSION["user_id"]);
  unset($_SESSION["user_name"]);
  $_SESSION["success"] = "You are logged out";
  header( 'Location: ../index.php');
  return;
}
?>
