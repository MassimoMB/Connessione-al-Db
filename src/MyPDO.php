<?php

namespace Massimo\Sakila2;

/**
 * Summary of_construct
 * @param \Massimo\Sakila2\DBConfig $dbConfig
 */

class MyPDO extends \PDO implements DatabaseContract{

    public function __construct(DBConfig $dBConfig){

        $dsn = $this->getDsn($dBConfig->host, $dBConfig->port, $dBConfig->dbName);
        $username = $dBConfig->user;
        $password = $dBConfig->password;
        $options= [];

        parent::__construct($dsn, $username, $password, $options);

    }

    public function getDataIterator(string $tableName, array $params = []): mixed{

        $query = "SELECT * FROM" . $tableName;

        $statement = $this->prepare($query);
        $statement->execute(); 

        return $statement->fetchAll();
    }


    /**
     * Summary of getDsn
     * @param string $host
     * @param string $port
     * @param string $dbName
     * @return string
     */


    private function getDsn(string $host, string $port, string $dbName){
        return "mysql:" .
        "host={$host};" .
        "port={$port};" .
        "dbname={$dbName}";
    }

}