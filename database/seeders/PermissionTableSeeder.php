<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           'mainCategory-list',
           'mainCategory-create',
           'mainCategory-edit',
           'mainCategory-delete',  
           'find_MainCategory',

           'subCategory-list',
           'subCategory-create',
           'subCategory-edit',
           'subCategory-delete',
           'find_SubCategory',

           'book-list',
           'book-create',
           'book-edit',
           'book-delete',
           'book-find_Book',
           'book-all_books',
           'book-search',

           'favoriteBook-index',
           'favoriteBook-store',
           'favoriteBook-edit',

           'review-index',
           'review-store',
           'review-update',
           'review-delete',
           
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}