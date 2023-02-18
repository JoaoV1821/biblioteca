<?php
  require ("authenticate.php");

  if(!$login){
    die("Você não tem permissão para acessar essa página.");
  }

?>