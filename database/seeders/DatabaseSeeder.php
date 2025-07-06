<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder // Ganti dengan nama seeder kamu
{
    public function run(): void
    {
        // Buat satu perusahaan
        $com = Company::create([
            'company' => 'CSA',
        ]);
        $dept = Department::create([
            'name' => 'CSA',
            'user_id'=>null
        ]);

        // Buat user Superadmin
        User::create([
            'company_id' => $com->id,
            'nip' => '001',
            'name' => 'Superadmin',
            'email' => 'superadmin@csa.tes',
            'status' => 'active',
            'password' => Hash::make('123456789'),
            'department'=>$dept->id
        ]);

        // Buat user Administrator
        User::create([
            'company_id' => $com->id,
            'nip' => '002',
            'name' => 'Administrator',
            'email' => 'administrator@csa.tes',
            'status' => 'active',
            'password' => Hash::make('123456789'),
            'department'=>$dept->id
        ]);

        // Buat user Operator
        User::create([
            'company_id' => $com->id,
            'nip' => '003',
            'name' => 'Operator',
            'email' => 'operator@csa.tes',
            'status' => 'active',
            'password' => Hash::make('123456789'),
            'department'=>$dept->id
        ]);
    }
}
