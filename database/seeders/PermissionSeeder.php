<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::upsert([
            ['slug' => 'view_all_user'],
            ['slug' => 'view_all_client'],
            ['slug' => 'view_all_invoice'],
            ['slug' => 'view_all_issue'],
            ['slug' => 'view_all_project'],
            ['slug' => 'view_all_role'],
            ['slug' => 'view_all_task'],
            ['slug' => 'create_user'],
            ['slug' => 'create_client'],
            ['slug' => 'create_invoice'],
            ['slug' => 'create_issue'],
            ['slug' => 'create_project'],
            ['slug' => 'create_role'],
            ['slug' => 'create_task'],
            ['slug' => 'update_user'],
            ['slug' => 'update_client'],
            ['slug' => 'update_invoice'],
            ['slug' => 'update_issue'],
            ['slug' => 'update_project'],
            ['slug' => 'update_role'],
            ['slug' => 'update_task'],
            ['slug' => 'delete_user'],
            ['slug' => 'delete_client'],
            ['slug' => 'delete_invoice'],
            ['slug' => 'delete_issue'],
            ['slug' => 'delete_project'],
            ['slug' => 'delete_role'],
            ['slug' => 'delete_task'],
        ], 'id');
    }
}
