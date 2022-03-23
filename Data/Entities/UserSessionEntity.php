<?php

namespace Electro\Data\Entities;

class UserSessionEntity
{
    public int $id;

    public string $refreshToken;

    public string $created_at;

    public string $lastActive;

    public int $user_id;
}