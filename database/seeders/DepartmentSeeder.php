<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks agar truncate tidak error jika ada relasi
        Schema::disableForeignKeyConstraints();

        // Kosongkan tabel departments
        DB::table('name')->truncate();

        // Aktifkan kembali foreign key checks
        Schema::enableForeignKeyConstraints();

        // Membuat instance Faker
        $faker = Faker::create();

        // Menambahkan 10 data departemen secara acak
        foreach (range(1, 10) as $index) {
            DB::table('departments')->insert([
                'name' => $faker->word(), // Menghasilkan kata acak untuk nama departemen (misal: HR, IT, Finance)
                'manager' => $faker->name(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

