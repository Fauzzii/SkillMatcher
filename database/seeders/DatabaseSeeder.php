<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roleAdmin    = Role::firstOrCreate(['name' => 'admin']);
        $roleEmployer = Role::firstOrCreate(['name' => 'employer']);
        $roleSeeker   = Role::firstOrCreate(['name' => 'job_seeker']);

        $admin = User::firstOrCreate(
        ['email' => 'admin@gmail.com'],
        [
            'id'          => Str::uuid(),
            'full_name'   => 'Super Administrator',
            'password'    => Hash::make('password123'),
            'is_verified' => DB::raw('true'),
            'bio'         => 'Administrator utama sistem.',
            'address'   => '',
            'region'   => '',

        ]
    );

    $admin->syncRoles([$roleAdmin]);

    $employer = User::firstOrCreate(
        ['email' => 'owner@gmail.com'],
        [
            'id'          => Str::uuid(),
            'full_name'   => 'Budi Owner',
            'password'    => Hash::make('password123'),
            'is_verified' => DB::raw('true'),
            'bio'         => 'Pemilik Tech Company.',
            'address'   => 'Bandung',
            'region'   => 'Indonesia',


        ]
    );

    $employer->syncRoles([$roleEmployer]);

     $seeker = User::firstOrCreate(
        ['email' => 'pelamar@gmail.com'],
        [
            'id'          => Str::uuid(),
            'full_name'   => 'Andi Pelamar',
            'password'    => Hash::make('password123'),
            'is_verified' => DB::raw('true'),
            'bio'         => 'Fresh graduate siap kerja.',
            'address'   => 'Cimahi',
            'region'   => 'Indonesia',
        ]
    );

    $seeker->syncRoles([$roleSeeker]);
    }
}
