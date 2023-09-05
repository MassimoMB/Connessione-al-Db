<?php

namespace Massimo\Sakila2;

class MySQLi extends \mysqli implements DatabaseContract{

    public function __construct(DbConfig $Db_config){
        parent::__construct($Db_config->host, $Db_config->user, $Db_config->password, $Db_config->dbName, $Db_config->port);
    }

    public function getData(string $query, array $params = []): DatabaseQueryResultContract{
        $result = $this->query($query);

        return new MySQLiQueryResult($result);
    }

    public function setData(string $command, array $items): void{
        throw new \Exception('not implemented');
    }

    public function doWithTransaction(array $operations): void{
        throw new \Exception('not implemented');
    }

    public function __destruct(){

        $this->close();
    }

}