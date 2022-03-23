<?php

namespace Electro\Data\Model\Result;

class BaseDataResult
{
    public function __construct(
        public bool $status
    )
    {
    }
}