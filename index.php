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

var_dump($_POST);

if($_SERVER['REQUEST_METHOD'] == "POST"){

  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  
  //$db->setData("INSERT INTO actor(first_name, last_name) VALUES(?,?)",[
  //  [$firstName, $lastName]
  //]);

  $db->doWithTransaction([
    "INSERT INTO actor(first_name, last_name) VALUES('$firstName', '$lastName')",
    "INSERT INTO actor(first_name, last_name) VALUES('$firstName', '$lastName')",
  ]);

  header("Location: index.php");
}

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
    <div class="container">
      <div class="card">
        <div class="card-body">
        <div class="card-title">Actors SQL query #1:</div>
          <ul class="list group">
            <?php $result = $db->getData("SELECT * FROM actor where first_name LIKE :param1", ["param1" => '%pen%']);?>
            <!--
            <?php /*// foreach ($result->fetchAll()): ?>
                      <li class= "list-group-item"><?=$actor['first_name']?>,<?=$actor['last_name']?></li>
            <?php // endforeach;*/?>
            -->
            
            <?php while ( $actor = $result->fetch()):?>
            <li class= "list-group-item"><?=$actor['first_name']?>,<?=$actor['last_name']?></li>
            <?php endwhile;?>
          </ul>
        </div>
      </div>
      
      <hr>

      <div class="card">
        <div class="card-body">
        <div class="card-title">Actors SQL query #2:</div>
          <ul class="list group">
            <?php $result = $db->getData("SELECT * FROM actor where first_name LIKE ?", ['%alb%']);?>
            <?php while ( $actor = $result->fetch()):?>
            <li class= "list-group-item"><?=$actor['first_name']?>,<?=$actor['last_name']?></li>
            <?php endwhile;?>
          </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
        <div class="card-title">Actors SQL query #3:</div>
          <ul class="list group">
            <?php $result = $db->getData("SELECT * FROM actor order by actor_id desc limit 5", []);?>
            <?php while ( $actor = $result->fetch()):?>
            <li class= "list-group-item"><?=$actor['first_name']?>,<?=$actor['last_name']?></li>
            <?php endwhile;?>
          </ul>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
        <div class="card-title">FORM:</div>
          <form action="" method="POST">
            <input type="text" name="first_name">
            <input type="text" name="last_name">
            <input type="submit">
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>
