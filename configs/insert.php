<?php

  include './db_config.php';

    $stmt = $db->prepare("INSERT INTO test (firstname, lastname, work) VALUES (?, ?, ?)");

    $stmt-> bindValue(1, 'user5');
    $stmt-> bindValue(2, 'test5');
    $stmt-> bindValue(3, 'Bussiness');

    $stmt->execute();


?>