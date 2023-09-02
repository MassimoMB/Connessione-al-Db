<?php

use Massimo\Sakila2\DBConfig;
use Massimo\Sakila2\MyPDO;

require_once __DIR__ . '/composer/autoload_real.php';

$dbConfig = new DBConfig(
    "localhost",
    "sakila",
    "83",
    "root",
    "root"
);

$pdo = new MyPDO($dbConfig);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "Hello Sakila MIT DB";