<?php

  include './db_config.php';

  $stmt = $db->query("SELECT * FROM test");
  $result = $stmt->fetchAll();

  foreach($result as $row){

    $firstname = htmlentities($row['firstname']);
    $lastname = htmlentities($row['lastname']);
    $work = htmlentities($row['work']);
    echo $firstname . ' ' .$lastname. ' working as '. $work .'<br>';
    // echo var_dump($row).'<br>';
  }

?>