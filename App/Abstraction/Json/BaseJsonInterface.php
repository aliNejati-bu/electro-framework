<?php

namespace Electro\App\Abstraction\Json;

use Electro\Data\Abstraction\DataBaseInterface;

interface BaseJsonInterface
{
    public function __construct(DataBaseInterface $dataBase);
}