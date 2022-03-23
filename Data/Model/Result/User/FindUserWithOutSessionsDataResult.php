<?php

namespace Electro\Data\Model\Result\User;

use Electro\Data\Model\Result\BaseDataResult;
use JetBrains\PhpStorm\Pure;

class FindUserWithOutSessionsDataResult extends BaseDataResult
{
    #[Pure] public function __construct(bool           $status,
                                        public ?int    $id = null,
                                        public ?string $user_name = null,
                                        public ?string $email = null,
                                        public ?string    $password = null,
                                        public ?string    $created_at = null,
                                        public ?string    $last_login = null,
    )
    {
        parent::__construct($status);
    }
}