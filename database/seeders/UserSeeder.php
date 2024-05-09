<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'member']);

        $permissions = [
           'favoriteBook-index',
           'favoriteBook-store',
           'favoriteBook-delete',

           'review-index',
           'review-store',
           'review-update',
           'review-delete',
        ];

        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
        }
    }
}
