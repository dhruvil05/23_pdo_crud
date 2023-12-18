<?php

  include './db_config.php';

  $stmt = $db->prepare("SELECT * FROM test WHERE firstname = ?");

  $names = array('user', 'user2', 'user3');

  foreach($names as $name) {

    $stmt->bindValue(1, $name);
    
    $stmt->execute();
    
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      
      $firstname = htmlentities($row['firstname']);
      $lastname = htmlentities($row['lastname']);
      $work = htmlentities($row['work']);
      echo $firstname . ' ' .$lastname. ' working as '. $work .'<br>';
      // echo var_dump($row).'<br>';
    }
  }

?>