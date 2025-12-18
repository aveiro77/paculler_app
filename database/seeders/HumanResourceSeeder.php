<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class HumanResourceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();  // Initialize Faker

        // Seed Departments table
        DB::table('departments')->insert([
            ['name' => 'IT', 'description' => 'Information Technology', 'status' => 'active', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'HR', 'description' => 'Human Resources', 'status' => 'active', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Sales', 'description' => 'Sales and Marketing', 'status' => 'active', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Seed Roles table
        DB::table('roles')->insert([
            ['title' => 'Developer', 'description' => 'Handles software development', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Manager', 'description' => 'Handles team management', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Salesperson', 'description' => 'Handles sales and client communication', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        // Seed Employees table
        DB::table('employees')->insert([
            [
                'fullname' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'birth_date' => $faker->dateTimeBetween('-40 years', '-20 years'),
                'hire_date' => Carbon::now(),
                'department_id' => 1,  // IT
                'role_id' => 1,        // Developer
                'status' => 'active',
                'salary' => $faker->randomFloat(2, 3000, 6000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'fullname' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'birth_date' => $faker->dateTimeBetween('-35 years', '-25 years'),
                'hire_date' => Carbon::now(),
                'department_id' => 2,  // HR
                'role_id' => 2,        // Manager
                'status' => 'active',
                'salary' => $faker->randomFloat(2, 4000, 7000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
        ]);

        // seed item categories
        DB::table('item_categories')->insert([
            ['name' => 'Food', 'description' => 'Food items', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Wood', 'description' => 'Wood items', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Stone', 'description' => 'Stone stationery', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Gold', 'description' => 'Gold stationery', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);     
    }
}