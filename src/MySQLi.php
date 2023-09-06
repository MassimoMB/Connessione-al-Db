<?php

namespace Massimo\Sakila2;

use Exception;

class MySQLi extends \mysqli implements DatabaseContract{

    public function __construct(DbConfig $Db_config){
        parent::__construct($Db_config->host, $Db_config->user, $Db_config->password, $Db_config->dbName, $Db_config->port);
    }

    public function getData(string $query, array $params = []): DatabaseQueryResultContract{
        
        $statement = $this->prepare($query);

        $statement->execute($params)>

        $result = $statement->get_result(); //ci ritorna un mysqli result ed è compatibile con la firma del costruttore della nostra classe.

        return new MySQLiQueryResult($result);
    }

    public function setData(string $command, array $items): void{
        
        $statement = $this->prepare($command);
        
        foreach($items as $item){
            
             $statement->execute($item);
        }
    }

    public function doWithTransaction(array $operations): void{
        try{
            $this->begin_transaction();

            foreach($operations as $operation){

                $this->query($operation);
            }

            $this->commit();
        }catch(Exception $e){

            $this->rollBack();

            throw new Exception("Transiction aborted: " . $e->getMessage());
        }
    }

    public function __destruct(){

        $this->close();
    }

}