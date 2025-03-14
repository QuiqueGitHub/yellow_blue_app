<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Enums\PermissionsEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::create(['name' => RolesEnum::User->value]);
        $employeeRole = Role::create(['name' => RolesEnum::Employee->value]);
        $adminRole = Role::create(['name' => RolesEnum::Admin->value]);

        $approveEmployees = Permission::create([
            'name' => PermissionsEnum::ApproveEmployees->value
        ]);
        $contactUsers = Permission::create([
            'name' => PermissionsEnum::ContactUsers->value
        ]);
        $buyProducts = Permission::create([
            'name' => PermissionsEnum::BuyProducts->value
        ]);

        //Todos los permisos de usuario
        $userRole->syncPermissions([
            $buyProducts
        ]);
        //Todos los permisos de admin
        $adminRole->syncPermissions([
            $approveEmployees,
            $buyProducts
        ]);
        //Todos los permisos de admin
        $employeeRole->syncPermissions([
            $contactUsers,
            $buyProducts
        ]);
    }
}
