<?php

namespace Massimo\Sakila2;

interface DatabaseQueryResultContract{

    public function fetch();

    public function fetchAll();

}