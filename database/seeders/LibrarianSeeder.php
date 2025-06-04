<?php

namespace Database\Seeders;

use App\Models\Librarian;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class LibrarianSeeder extends Seeder
{
    public function run()
    {
        Librarian::create([
            'name' => 'Galih',
            'password' => Hash::make('password123'),
        ]);
    }
}
