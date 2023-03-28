<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        //roles permissions
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'view role']);



        // product permissions
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'update product']);
        Permission::create(['name' => 'delete product']);
        Permission::create(['name' => 'view product']);


        //user permissions
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'show user']);
        Permission::create(['name' => 'show users']);





        // category permissions
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'update category']);
        Permission::create(['name' => 'delete category']);
        Permission::create(['name' => 'view category']);


        // create permissions
        Permission::create(['name' => 'update my profile']);
        Permission::create(['name' => 'delete my profile']);
        Permission::create(['name' => 'view my profile']);

        // Role Permissions
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'edit roles']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'grant and revoke permission']);
        Permission::create(['name' => 'assign role']);

        // Permission Permissions
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'edit permissions']);
        Permission::create(['name' => 'delete permissions']);




        // admin role
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());
        // seller role
        $role = Role::create(['name' => 'seller']);
        $role->givePermissionTo(['create product', 'update product', 'delete product', 'view product', 'view my profile', 'update my profile', 'delete my profile']);
        // user role
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(['view my profile', 'update my profile', 'delete my profile']);
    }
}