<?php

ini_set('display_errors', 1);


define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("ROOT_LOCAL", "http://" . $_SERVER['SERVER_NAME'] . "/");
require_once "database.php";
require_once "routes.php";
require_once "controllers/AppController.php";
include_once 'libs/phpseclib/Net/SSH2.php';

