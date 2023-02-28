<?php
require ("credentials.php");

//------------------------CRIA DATABASE-----------------------------------------//

  $conn = mysqli_connect($servername, $username, $password);
  
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

    if (!mysqli_query($conn, $sql)) {
      echo "Error creating database: " . mysqli_error($conn) . "<br>";
    } 

  mysqli_close($conn);


function connect_db(){
  global $servername, $username, $password, $dbname;
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }

  return($conn);
}

function disconnect_db($conn){
  mysqli_close($conn);
}

?>

