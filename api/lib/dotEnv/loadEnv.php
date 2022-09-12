<?php
include_once "lib/dotEnv/DotEnv.php";

$dotEnv = new DotEnv(getcwd() . '/.env');
$dotEnv->load();
