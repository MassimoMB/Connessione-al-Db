<?php

namespace Massimo\Sakila2;


use Massimo\Sakila2\DatabaseContract;
use Exception;
use PDO;
use PDOException;

class DatabaseFactory{
    public static function Create(DBConfig $dbConfig, string $type = DatabaseContract::TYPE_PDO): DatabaseContract | null{

        if($type == DatabaseContract::TYPE_PDO)
        return self::CreateWithPDO($dbConfig);
        if($type == DatabaseContract::TYPE_MySQLi)
        return self::CreateWithMySQLi($dbConfig);
        
        throw new Exception("Not Implemented");

    }

    private static function CreateWithPDO(DBConfig $dbConfig){
    try{
        $pdo = new MyPDO($dbConfig);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;

    } catch(PDOException $e){

        throw new Exception("Database connection failed with error: {$e->getMessage()}");
    }
}
    
    private static function CreateWithMySQLi(DbConfig $dbConfig): MySQLi{

        try{
            $mysqli = new MySQLi($dbConfig);
                
            return $mysqli;
    
        } catch(Exception $e){
    
            throw new Exception("Database connection failed with error: {$e->getMessage()}");
        }

    }
}
