<?php

namespace Database\Seeders;

use App\Models\Company;
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
        Role::create(['name' => 'stopped']);

        $company = Company::create(['name'=>'Geoptimise']);
        $company->users()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ])->assignRole('admin');

        if (App::environment() !== 'production') {
            Company::all()->each(function ($company){
                User::factory()->count(2)->for($company)->create()->each(function ($user) {
                    $user->assignRole('user');
                });
            });
        }
    }
}
