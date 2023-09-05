<?php

//error_reporting(E_ERROR | E_PARSE); //skip del warning per ovviare al problema di quelli stampati prima dell'header che bloccavano la trasmissione.

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
$selctedActor = null;

var_dump($_POST);

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $id = $_GET['actor_id'];

    $result = $db->getData("SELECT * FROM actor WHERE actor_id = ?", [$id]);

    $selctedActor = $result->fetch();

    if(!$selctedActor){
        
        die("Actor not found");
    }

    
}

if($_SERVER['REQUEST_METHOD'] == "POST"){

  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $id = $_POST['actor_id'];
  
  $db->setData("UPDATE actor SET first_name = ?, last_name = ? WHERE actor_id = ?",[
    [$firstName, $lastName, $id]
  ]);

  /*$db->doWithTransaction([
    "INSERT INTO actor(first_name, last_name) VALUES('$firstName', '$lastName')",
    "INSERT INTO actor(first_name, last_name) VALUES('$firstName', '$lastName')",
  ]);*/

  header("Location: index.php");
}

echo "Hello Sakila MIT DB";


?>

<!DOCTYPE html>
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
        <div class="card-title">FORM:</div>
          <form action="" method="POST">
            <input type="hidden" name="actor_id"value="<?=$id?>">
            <input type="text" name="first_name" value="<?= !is_null($selctedActor) ? $selctedActor['first_name'] : ""?>">
            <input type="text" name="last_name" value="<?=!is_null($selctedActor) ? $selctedActor['first_name'] : ""?>">
            <input type="submit">
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>