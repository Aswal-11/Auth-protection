<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'Create', 'slug' => 'create']);
        Permission::create(['name' => 'Edit', 'slug' => 'edit']);
        Permission::create(['name' => 'Delete', 'slug' => 'delete']);
        Permission::create(['name' => 'View', 'slug' => 'view']);
    }
}
