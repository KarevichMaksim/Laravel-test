<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        $user = User::create([
            'name' => 'username',
            'email' => 'email@example.com',
            'password' => 'password',
        ]);
        $user->assignRole('admin');
    }
}
