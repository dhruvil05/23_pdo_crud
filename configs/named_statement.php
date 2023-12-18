<?php

  include './db_config.php';

  $stmt = $db->prepare("SELECT * FROM test WHERE firstname = :firstname");


  $stmt->bindValue(':firstname', 'user', PDO::PARAM_STR);
  
  $stmt->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    
    $firstname = htmlentities($row['firstname']);
    $lastname = htmlentities($row['lastname']);
    $work = htmlentities($row['work']);
    echo $firstname . ' ' .$lastname. ' working as '. $work .'<br>';
    // echo var_dump($row).'<br>';
  }


?>