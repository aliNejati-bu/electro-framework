<?php

namespace Electro\Data\MySQLDataBaseService\Repositories;

use Electro\Data\Abstraction\DataBaseInterface;
use Electro\Data\Abstraction\Repositories\UserRepositoryInterface;
use Electro\Data\Entities\UserEntity;
use Electro\Data\Exceptions\BaseDataException;
use Electro\Data\Model\Param\User\CreateUserDataParam;
use Electro\Data\Model\Result\BaseDataResult;
use Electro\Data\MySQLDataBaseService\MySQLDatabase;
use MysqliDb;

class MySQLUserRepository implements UserRepositoryInterface
{

    /**
     * @var MysqliDb for store MysqliDb instance
     */
    public MysqliDb $mysqliDb;


    public function __construct(DataBaseInterface $dataBase)
    {
        $this->mysqliDb = $dataBase->mysqliDb;
    }

    /**
     * @inheritDoc
     */
    public function create(CreateUserDataParam $param): UserEntity
    {
        try {
            $this->mysqliDb->insert(MySQLDatabase::USERS_TABLE, [
                "email" => $param->email,
                "password" => $param->password,
                "created_at" => date('Y-m-d H:i:s'),
                "last_login" => date('Y-m-d H:i:s'),
            ]);
            $id = $this->mysqliDb->getInsertId();
            $user = $this->mysqliDb->where("id", $id)->getOne(MySQLDatabase::USERS_TABLE);
            return new UserEntity(
                $user["id"],
                $user["user_name"],
                $user["email"],
                $user["password"],
                $user["created_at"],
                $user["last_login"],
                [],
            );
        } catch (\Throwable $throwable) {
            throw new BaseDataException($throwable);
        }
    }

    public function isUserExists(int $userId): BaseDataResult
    {
        // TODO: Implement isUserExists() method.
    }
}