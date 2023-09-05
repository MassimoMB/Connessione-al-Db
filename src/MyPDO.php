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

    public function getData(string $query, array $params = []): DatabaseQueryResultContract{

        $statement = $this->prepare($query);
        $statement->execute($params);

        return new MyPDOQueryResult($statement);
    }

    public function setData(string $command, array $items): void{

        $statement = $this->prepare($command);

        foreach($items as $item){
            $statement->execute($item);
        }

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