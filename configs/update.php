<?php

  include './db_config.php';

    $stmt = $db->prepare("UPDATE test SET work = :work WHERE firstname = :firstname");

    $stmt-> bindValue(':work', 'Hotel manager');
    $stmt-> bindValue(':firstname', 'user5');
    // $stmt-> bindValue(3, 'Bussiness');

    $stmt->execute();


?>