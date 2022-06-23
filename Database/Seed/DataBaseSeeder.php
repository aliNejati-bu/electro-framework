<?php

namespace RemoteConfig\Database\Seed;

use RemoteConfig\App\Model\Role;

class DataBaseSeeder
{
    public function seeders(): void
    {
        PermissionSeeder::Seed();
        RoleSeeder::Seed();
        UserSeeder::Seed();
    }
}