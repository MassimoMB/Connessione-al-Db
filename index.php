<?php

use Massimo\Sakila2\DatabaseContract;
use Massimo\Sakila2\DatabaseFactory;
use Massimo\Sakila2\DBConfig;

require_once __DIR__ . '/vendor/autoload.php';

$dbConfig = new DBConfig(
    "localhost",
    "sakila",
    "3306",
    "root",
    "root"
);

$db = DatabaseFactory::Create($dbConfig, DatabaseContract::TYPE_PDO);


echo "Hello Sakila MIT DB";


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>

  <body>
    <h1>Actors:</h1>
    <ul class="list group">
    <?php  foreach ($db->getDataIterator("actor") as $actor): ?>
                <li class= "list-group-item"><?=$actor['first_name']?>,<?=$actor['last_name']?></li>
            <?php endforeach;?>
    </ul>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
