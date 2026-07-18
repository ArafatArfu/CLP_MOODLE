<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            PermissionSeeder::class,
        ]);
        $superAdminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        // $patientRole = Role::create(['name' => 'patient', 'guard_name' => 'sanctum', 'priority' => 6]);

        //for super admin
        $superadmin = \App\Models\User::factory()->create([
            'name' => 'superadmin',
            // 'role_id' => 1,
            'email' => 'superadmin@mail.com',
            'password' => bcrypt('password')
        ]);
        $superadmin->assignRole('superadmin');

        //for super admin
        $superadmin = \App\Models\User::factory()->create([
            'name' => 'admin',
            // 'role_id' => 1,
            'email' => 'admin@mail.com',
            'password' => bcrypt('password')
        ]);
        $superadmin->assignRole('admin');

        // Give all permission to superadmin
        $permissions = Permission::all();
        $permissions->each(function ($permission, $key) use ($superAdminRole){
            // $superAdminRole->givePermissionTo($permission->name);
            $permission->assignRole($superAdminRole);
        });
    }
}
