<?php
if (!isset($_SESSION['user_id'])) {
  $_SESSION['redirectURL'] = $_SERVER['REQUEST_URI'];
}
 ?>
