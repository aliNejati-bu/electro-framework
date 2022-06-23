<?php

namespace Electro\Database\Seed;

use Electro\App\Model\Role;

class DataBaseSeeder
{
    public function seeders(): void
    {
        PermissionSeeder::Seed();
        RoleSeeder::Seed();
        UserSeeder::Seed();
    }
}