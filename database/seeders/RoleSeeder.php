<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create([
            'name' => 'Admin',
            'description' => 'Administrator role with full access'
        ]);
        $admin->permissions()->attach(Permission::all());

        $user = Role::create([
            'name' => 'User',
            'description' => 'Regular user role'
        ]);
        $user->permissions()->attach(Permission::whereIn('slug', ['view-reports'])->get());

        Role::create([
            'name' => 'Moderator',
            'description' => 'Moderator role with limited admin access'
        ]);
    }
}
