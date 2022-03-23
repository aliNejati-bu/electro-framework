<?php

namespace Electro\Data\MySQLDataBaseService;

class MySQLDatabase implements \Electro\Data\Abstraction\DataBaseInterface
{

    const USERS_TABLE = "users";

    public \MysqliDb $mysqliDb;


    /**
     * @inheritDoc
     */
    public function connect(string $dataBaseServer, string $databaseUserName, string $dataBasePassword, string $dataBase): void
    {
        $this->mysqliDb = new \MysqliDb(
            $dataBaseServer,
            $databaseUserName,
            $dataBasePassword,
            $dataBase
        );
    }
}