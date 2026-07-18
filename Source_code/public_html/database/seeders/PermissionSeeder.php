<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // user
        Permission::create(['name' => 'add-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'manage-user-status']);
        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'view-users']);

        // Settings
        Permission::create(['name' => 'add-setting']);
        Permission::create(['name' => 'delete-setting']);
        Permission::create(['name' => 'edit-setting']);
        Permission::create(['name' => 'manage-setting-status']);
        Permission::create(['name' => 'view-setting']);
        Permission::create(['name' => 'view-settings']);

        // Permission
        Permission::create(['name' => 'add-permission']);
        Permission::create(['name' => 'delete-permission']);
        Permission::create(['name' => 'edit-permission']);
        Permission::create(['name' => 'manage-permission-status']);
        Permission::create(['name' => 'view-permission']);
        Permission::create(['name' => 'view-permissions']);
        Permission::create(['name' => 'give-permission']);
        Permission::create(['name' => 'revoke-permission']);

        // Role
        Permission::create(['name' => 'add-role']);
        Permission::create(['name' => 'delete-role']);
        Permission::create(['name' => 'edit-role']);
        Permission::create(['name' => 'manage-role-status']);
        Permission::create(['name' => 'view-role']);
        Permission::create(['name' => 'view-roles']);
        Permission::create(['name' => 'assign-role']);
        Permission::create(['name' => 'remove-role']);
    }
}
