<?php

namespace RemoteConfig\Database\Seed;

use RemoteConfig\App\Model\Role;

class RoleSeeder
{
    public static function Seed()
    {
        $roles = [
            ["role_name" => "userManager",
            "permissions" => [1]],
        ];
        foreach ($roles as $role){
            $r = Role::create(["role_name"=>$role["role_name"]]);
            $r->permissions()->attach($role["permissions"]);
        }
    }
}