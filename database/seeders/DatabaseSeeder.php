<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'utente1',
            'last_name' => 'cognome',
            'phone_number' => '3210987654',
            'email' => 'utente1@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'utente2',
            'last_name' => 'cognome2',
            'phone_number' => '3210987655',
            'email' => 'utente2@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'utente3',
            'last_name' => 'cognome3',
            'phone_number' => '3210987656',
            'email' => 'utente3@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
    }
}
