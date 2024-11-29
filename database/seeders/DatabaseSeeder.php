<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!Role::query()->where('slug', 'admin')->first()) {
            Role::query()->create([
                'name' => 'Администратор',
                'slug' => 'admin'
            ]);
        }

        if (!Role::query()->where('slug', 'spammer')->first()) {
            Role::query()->create([
                'name' => 'Спамер',
                'slug' => 'spammer'
            ]);
        }

        if (!User::query()->where('name', 'admin')->first()) {
            User::query()->create([
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'role_id' => Role::query()->where('slug', 'admin')->value('id')
            ]);
        }
    }
}
