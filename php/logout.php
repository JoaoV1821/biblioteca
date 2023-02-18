<?php
  session_start();
  session_unset();
  session_destroy();
  header("Location: " . dirname($_SERVER['SCRIPT_NAME']) . "/index.php");
?>