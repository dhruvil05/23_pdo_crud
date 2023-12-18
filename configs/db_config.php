<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=23_pdo_crud', 'root', '');
    
  } catch (Exception $e) {
    echo 'localDB ERROR:'.$e->getMessage();
  }
  // var_dump($db);

?>