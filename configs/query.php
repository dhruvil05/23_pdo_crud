<?php

  include './db_config.php';

  foreach($db->query("SELECT * FROM test") as $row) {
    echo $row['firstname'] . ' ' .$row['lastname']. ' working as '. $row['work'] .'<br>';
  }

?>