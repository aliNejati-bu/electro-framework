<?php

namespace RemoteConfig\Database\Seed;

use RemoteConfig\App\Model\User;

class UserSeeder
{
    public static function Seed()
    {
        $users = [
            [
                "user_email" => "electrocellco@gmail.com",
                "password" => "13811381my",
                "user_type" => 3,
                "is_email_verified" => true,
                "is_super_admin" => true,
                "is_admin" => true,
                "roles" => [],
                "name" => "علی نجاتی"
            ],[
                "user_email" => "test@gmail.com",
                "password" => "13811381my",
                "user_type" => 3,
                "is_email_verified" => true,
                "is_super_admin" => false,
                "is_admin" => true,
                "name" => "کاربر تست",
                "roles" => [1]
            ],
        ];

        foreach ($users as $user){
            $u = User::create($user);
            $u->roles()->attach($user["roles"]);
        }
    }
}