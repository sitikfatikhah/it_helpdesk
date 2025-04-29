<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat instance Faker
        $faker = Faker::create();

        // Menambahkan 10 data departemen secara acak
        foreach (range(1, 10) as $index) {
            DB::table('departments')->insert([
                'name' => $faker->word(), // Menghasilkan kata acak untuk nama departemen (misal: HR, IT, Finance)
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

