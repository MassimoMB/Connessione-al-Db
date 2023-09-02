<?php

namespace Massimo\Sakila2;

class MyPDO extends \PDO{

    public function __construct(DBConfig $dBConfig){

        $dsn = $this->getDsn($dBConfig->host, $dBConfig->port, $dBConfig->dbName);
        $username = $dBConfig->user;
        $password = $dBConfig->password;
        $options= [];

        parent::__construct($dsn, $username, $password, $options);

    }

    private function getDsn(string $host, string $port, string $dbName){
        return "mysql:" .
        "host={$host};" .
        "port={$port};" .
        "dbname={$dbName}";
    }

}