<?php

namespace Electro\Data\Abstraction\Repositories;

use Electro\App\Abstraction\Json\BaseJsonInterface;
use Electro\Data\Entities\UserEntity;
use Electro\Data\Exceptions\BaseDataException;
use Electro\Data\Model\Param\User\CreateUserDataParam;
use Electro\Data\Model\Result\BaseDataResult;

interface UserRepositoryInterface extends BaseJsonInterface
{
    /**
     * create new user
     * @param CreateUserDataParam $param
     * @return UserEntity
     * @throws BaseDataException
     */
    public function create(CreateUserDataParam $param): UserEntity;

    public function isUserExists(int $userId): BaseDataResult;
}