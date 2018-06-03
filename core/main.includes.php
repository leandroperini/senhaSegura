<?php

ini_set('display_errors', 0);


define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("ROOT_LOCAL", "http://" . $_SERVER['SERVER_NAME'] . "/");
require_once "database.php";
require_once "routes.php";
require_once "controllers/AppController.php";

