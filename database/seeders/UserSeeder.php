<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
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
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ])->assignRole('admin');

        if (App::environment() !== 'production') {
            User::factory()->count(15)->create()->each(function ($user) {
                $user->assignRole('user');
            });
        }
    }
}
