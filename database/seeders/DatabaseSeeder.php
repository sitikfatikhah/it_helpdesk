<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat satu perusahaan
        $company = Company::firstOrCreate([
            'company' => 'CSA',
        ]);

        // Buat beberapa department
        $departments = collect(['IT', 'FAT', 'HRGA', 'MARKETING'])->mapWithKeys(function ($name) {
            $dept = Department::firstOrCreate(['name' => $name]);
            return [$name => $dept->id];
        });

        // Buat role
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $adminRole      = Role::firstOrCreate(['name' => 'administrator']);
        $memberRole     = Role::firstOrCreate(['name' => 'member']);

        // Assign semua permission hanya ke superadmin
        $superadminRole->syncPermissions(Permission::all());

        // Buat user-user dan assign role
        $users = [
            [
                'nip' => '001',
                'name' => 'Superadmin',
                'email' => 'superadmin@csa.tes',
                'role' => $superadminRole,
                'department' => 'IT',
            ],
            [
                'nip' => '002',
                'name' => 'Administrator',
                'email' => 'administrator@csa.tes',
                'role' => $adminRole,
                'department' => 'FAT',
            ],
            [
                'nip' => '003',
                'name' => 'Operator',
                'email' => 'operator@csa.tes',
                'role' => $memberRole,
                'department' => 'HRGA',
            ],
            [
                'nip' => '004',
                'name' => 'Manager IT',
                'email' => 'manager@csa.tes',
                'role' => $memberRole,
                'department' => 'IT',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']], // prevent duplication
                [
                    'company_id'     => $company->id,
                    'department_id' => $departments[$userData['department']],
                    'nip'            => $userData['nip'],
                    'name'           => $userData['name'],
                    'status'         => 'active',
                    'password'       => Hash::make('123456789'),
                ]
            );
            $user->assignRole($userData['role']);
        }
    }
}
