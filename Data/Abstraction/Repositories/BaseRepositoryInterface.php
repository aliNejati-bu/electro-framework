<?php

namespace Electro\Data\Abstraction\Repositories;

use Electro\Data\Abstraction\DataBaseInterface;

interface BaseRepositoryInterface
{
    /**
     * @param DataBaseInterface $dataBase for get database instance in all the dataBase Repositories
     */
    public function __construct(DataBaseInterface $dataBase);
}