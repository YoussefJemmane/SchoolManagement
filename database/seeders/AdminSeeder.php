<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Youssef Jemmane',
            'email' => 'yous.jemm@gmail.com',
            'phone' => '0655555555',
            'image' => '300.jpg',
            'role' => 'Admin',
            'password' => Hash::make('password'),
        ]);
        \App\Models\Admin::create([
            'user_id' => 1,
            'role' => 'Direcreur de l\'école',
        ]);
    }
}
