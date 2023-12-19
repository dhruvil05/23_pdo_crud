<?php

  $db_host = "localhost";
  $db_user = "root";
  $db_password = "";
  $db_name = "23_php_rest";

  $db = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8', $db_user, $db_password);

  // set db attributes
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  define('APP_NAME', 'PHP REST API TUTORIAL');

?>