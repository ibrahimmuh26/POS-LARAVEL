<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\AdvanceSalary;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'User',
            'username' => 'user',
            'email' => 'user@gmail.com',
        ]);

        // Employee::factory(5)->create();
        // // AdvanceSalary::factory(25)->create();

        // Customer::factory(25)->create();
        // Supplier::factory(10)->create();

        for ($i = 0; $i < 10; $i++) {
            Product::factory()->create([
                'product_code' => IdGenerator::generate([
                    'table' => 'products',
                    'field' => 'product_code',
                    'length' => 4,
                    'prefix' => 'PC'
                ])
            ]);
        }
        Category::factory(10)->create();

        // Permission::create(['name' => 'pos.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'employee.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'customer.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'supplier.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'salary.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'attendence.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'category.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'product.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'orders.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'stock.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'roles.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'user.menu', 'guard_name' => 'web']);
        // Permission::create(['name' => 'database.menu', 'guard_name' => 'web']);
        Supplier::factory(10)->create();
        Customer::factory(25)->create();
        Permission::create(['name' => 'pos.menu', 'group_name' => 'pos', 'guard_name' => 'web']);
        Permission::create(['name' => 'employee.menu', 'group_name' => 'employee', 'guard_name' => 'web']);
        Permission::create(['name' => 'customer.menu', 'group_name' => 'customer', 'guard_name' => 'web']);
        Permission::create(['name' => 'supplier.menu', 'group_name' => 'supplier', 'guard_name' => 'web']);
        Permission::create(['name' => 'salary.menu', 'group_name' => 'salary', 'guard_name' => 'web']);
        Permission::create(['name' => 'attendence.menu', 'group_name' => 'attendence', 'guard_name' => 'web']);
        Permission::create(['name' => 'category.menu', 'group_name' => 'category', 'guard_name' => 'web']);
        Permission::create(['name' => 'product.menu', 'group_name' => 'product', 'guard_name' => 'web']);
        Permission::create(['name' => 'orders.menu', 'group_name' => 'orders', 'guard_name' => 'web']);
        Permission::create(['name' => 'stock.menu', 'group_name' => 'stock', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.menu', 'group_name' => 'roles', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.menu', 'group_name' => 'user', 'guard_name' => 'web']);
        Permission::create(['name' => 'database.menu', 'group_name' => 'database', 'guard_name' => 'web']);

        Role::create(['name' => 'SuperAdmin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Admin'])->givePermissionTo(['customer.menu', 'user.menu', 'supplier.menu']);
        Role::create(['name' => 'Account'])->givePermissionTo(['customer.menu', 'user.menu', 'supplier.menu']);
        Role::create(['name' => 'Manager'])->givePermissionTo(['stock.menu', 'orders.menu', 'product.menu', 'salary.menu', 'employee.menu']);

        // $admin->assignRole('SuperAdmin');
        // $user->assignRole('Account');
    }
}
