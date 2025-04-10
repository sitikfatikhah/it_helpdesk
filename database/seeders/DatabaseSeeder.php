<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // You can uncomment this line if you want to create 10 users using the factory
        User::factory(300)->create();

        // Create a superadmin user
         User::factory()->create([
             'nama_perusahaan' => 'CSA',
             'nip' => '001', // It's a string because NIK could have leading zeros
             'name' => 'Superadmin',
             'jabatan' => 'IT',
             'email' => 'superadmin@csa.tes',
             'level_user' => 'superadmin',
             'status' => 'active',
             'email_verified_at' => Carbon::now(),
             'password' => Hash::make('123456789'),
         ]);
        User::factory()->create([
            'nama_perusahaan' => 'CSA',
            'nip' => '002', // It's a string because NIK could have leading zeros
            'name' => 'Administrator',
            'jabatan' => 'IT',
            'email' => 'administrator@csa.tes',
            'level_user' => 'administrator',
            'status' => 'active',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123456789'),
        ]);
        User::factory()->create([
            'nama_perusahaan' => 'CSA',
            'nip' => '003', // It's a string because NIK could have leading zeros
            'name' => 'Operator',
            'jabatan' => 'IT',
            'email' => 'operator@csa.tes',
            'level_user' => 'opertor',
            'status' => 'active',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123456789'),
        ]);
    }
}
