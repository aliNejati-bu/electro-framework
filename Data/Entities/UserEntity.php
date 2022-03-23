<?php

namespace Electro\Data\Entities;

class UserEntity
{
    public int $id;

    public ?string $user_name;

    public string $email;

    public string $password;

    public string $created_at;

    public string $last_login;

    /**
     * @var UserSessionEntity[]
     */
    public array $sessions;

    /**
     * @param int $id
     * @param ?string $user_name
     * @param string $email
     * @param string $password
     * @param string $created_at
     * @param string $last_login
     * @param UserSessionEntity[] $sessions
     */
    public function __construct(int $id, ?string $user_name, string $email, string $password, string $created_at, string $last_login, array $sessions)
    {
        $this->id = $id;
        $this->user_name = $user_name;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
        $this->last_login = $last_login;
        $this->sessions = $sessions;
    }


}