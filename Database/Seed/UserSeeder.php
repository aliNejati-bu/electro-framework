<?php

namespace Electro\Database\Seed;

use Electro\App\Model\User;

class UserSeeder
{
    public static function Seed()
    {
        $users = [
            [
                "phone" => "09123456789",
                "name" => "رضا محاجرانی",
                "password" => '101020203030',
                "shipping_address" => "ایران تهران خیابان انقلاب",
                "user_type" => 1,
            ],
            [
                "phone" => "09010544998",
                "name" => "محمد رضا جعفری پور",
                "password" => '101020203030',
                "shipping_address" => "همه جای ایران",
                "user_type" => 0,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}