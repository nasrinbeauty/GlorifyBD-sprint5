<?php


ob_start();

session_start();
   // session_destroy();


defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR); //If DS if not defined then it should be defined as Derectory_Separator

//__DIR__ is the Root
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__. DS . "templates/front");

defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__. DS . "templates/back");

defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY", __DIR__. DS . "uploads");
defined("UPLOAD_USER_DIRECTORY") ? null : define("UPLOAD_USER_DIRECTORY", __DIR__. DS . "user_uploads");
defined("UPLOAD_SLIDER_DIRECTORY") ? null : define("UPLOAD_SLIDER_DIRECTORY", __DIR__. DS ."uploads/slider");

//Database
defined("DB_HOST") ? null : define("DB_HOST", "localhost");
defined("DB_USER") ? null : define("DB_USER", "root");
defined("DB_PASS") ? null : define("DB_PASS", "");
defined("DB_NAME") ? null : define("DB_NAME", "ecommerce");


 $con= mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

 require_once("functions.php");
 require_once("cart.php");











?>
