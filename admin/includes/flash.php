<?php
 if (isset($_SESSION['success'])) {
   echo "<div class='alert alert-success' role='alert'>";
   echo($_SESSION["success"]);
   unset($_SESSION["success"]);
   echo "</div>";
 }
 if (isset($_SESSION['error'])) {
   echo "<div class='alert alert-danger' role='alert'>";
   echo($_SESSION["error"]);
   unset($_SESSION["error"]);
   echo "</div>";
 }
 ?>
