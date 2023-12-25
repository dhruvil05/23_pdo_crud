<?php

  $db_host = "localhost";
  $db_user = "root";
  $db_password = "";
  $db_name = "23_pdo_crud";

  try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=UTF8";
    $dbc = new PDO($dsn, $db_user, $db_password);    
  } catch (Exception $e) {
    echo 'localDB ERROR:'.$e->getMessage();
  }

?>