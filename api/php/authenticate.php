<?php 
session_start();

if (isset($_SESSION["email"])) {
  $login = true;
  $user_email = $_SESSION["email"];
}
else{
  $login = false;
} 
?>