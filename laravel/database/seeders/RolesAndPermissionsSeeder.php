<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    // Buat Role Admin
    $adminRole = Role::create(['name' => 'admin']);
    
    // Tambahkan permission jika diperlukan
    Permission::create(['name' => 'manage products']);
    
    // Assign permission ke role admin
    $adminRole->givePermissionTo('manage products');
}
}