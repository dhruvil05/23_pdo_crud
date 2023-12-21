<?php

  defined('DS') ? null : define("DS", DIRECTORY_SEPARATOR);
  defined("SITE_ROOT") ? null : define("SITE_ROOT", DS.'xampp'.DS .'htdocs'.DS. 'pdo_crud');

  // /xampp/htdocs/pdo_crud/includes
  defined("INC_PATH") ? null : define("INC_PATH", SITE_ROOT.DS.'includes');
  defined("CORE_PATH") ? null : define("CORE_PATH", SITE_ROOT.DS.'core');
  defined("CONF_PATH") ? null : define("CONF_PATH", SITE_ROOT.DS.'configs');
  // load the config file first
  require_once(INC_PATH.DS.'config.php');
  require_once(CONF_PATH.DS.'db_config.php');

  // core classes
  require_once(CORE_PATH.DS.'post.php');
  require_once(CORE_PATH.DS.'category.php');


?>