<?php

namespace Database\Seeders;

use App\Models\user\Address;
use App\Models\user\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Passw0rd!'),
            'birthdate' => '2002-08-13',
        ]);

        User::all()->first()->addresses()->attach(Address::all()->first()->id);

        User::factory(14)->create();

        User::find(2)->addresses()->attach(Address::first()->id);

        foreach (User::all() as $user) {
            if ($user->id == 1) {
                $user->assignRole('admin');
            }
            else{
                $user->assignRole('client');
            }
        }

    }
}
