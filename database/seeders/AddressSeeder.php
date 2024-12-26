<?php

namespace Database\Seeders;

use App\Models\user\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            'address' => 'Rua dos testes',
            'country' => 'Portugal',
            'city' => 'Palmela',
            'zip_code' => '1234-567',
        ]);
        Address::factory(20)->create();
    }
}
