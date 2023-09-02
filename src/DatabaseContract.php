<?php

namespace Massimo\Sakila2;

interface DatabaseContract{

    const TYPE_PDO = "pdo";

    const TYPE_MySQLi = "mysqli";

    public function getDataIterator(string $tableName, array $params = []): mixed;
}