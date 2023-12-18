<?php

  include './db_config.php';

    $stmt = $db->prepare("DELETE FROM test WHERE firstname = :firstname");

    $stmt-> bindValue(':firstname', 'user5');
    // $stmt-> bindValue(2, 'test5');
    // $stmt-> bindValue(3, 'Bussiness');

    $stmt->execute();


?>