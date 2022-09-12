<?php

require_once "./lib/dotEnv/loadEnv.php";

/*************************
 ** SQL DATABASE **
 *************************/


$SQL = true;	
$SQL_MASTER = 'MySQLDatabase';
define('SQL_SERVER', getenv('SQL_SERVER'));
define('DB_NAME', getenv('DB_NAME'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));