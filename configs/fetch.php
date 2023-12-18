<?php

  include './db_config.php';

  $stmt = $db->query("SELECT * FROM test");
  
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // echo $row['firstname'] . ' ' .$row['lastname']. ' working as '. $row['work'] .'<br>';
    echo var_dump($row).'<br>';
  }

?>