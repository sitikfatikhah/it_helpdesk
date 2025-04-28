<?php

namespace User\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat instance Faker
        $faker = Faker::create();

        // Menambahkan 10 data departemen secara acak
        foreach (range(1, 10) as $index) {
            DB::table('user')->insert([
                'id' => $faker->word(),
                'nama_perusahaan' => $faker->word(),
                'nip' => $faker->word(),
                'name' => $faker->word(),
                'email' => $faker->word(),
                'level_user' => $faker->word(),
                'status' => $faker->word(),
                'email_verified_at' => $faker->word(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
