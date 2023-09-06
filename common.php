<?php

require_once __DIR__ . '/vendor/autoload.php';

use Massimo\Sakila2\DatabaseContract;
use Massimo\Sakila2\DatabaseFactory;


$db = DatabaseFactory::Create(DatabaseContract::TYPE_PDO);
$db2 = DatabaseFactory::Create(DatabaseContract::TYPE_MySQLi);