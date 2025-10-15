<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('roles')->upsert([
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'user', 'guard_name' => 'web'],
        ], ['name'], ['guard_name']);

        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        $adminRoleId = DB::table('roles')->where('name', 'admin')->value('id');
        DB::table('role_user')->updateOrInsert([
            'user_id' => $user->id,
            'role_id' => $adminRoleId,
        ], []);

        $this->call([
            CategorySeeder::class,
        ]);
    }
}
