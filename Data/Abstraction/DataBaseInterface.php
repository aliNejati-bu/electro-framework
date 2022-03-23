<?php

namespace Electro\Data\Abstraction;


use Electro\Data\Abstraction\Repositories\UserRepositoryInterface;

interface DataBaseInterface
{

    /**
     * for connect to data and create database instance.
     */
    public function connect(string $dataBaseServer,string $databaseUserName,string $dataBasePassword,string $dataBase):void;
}