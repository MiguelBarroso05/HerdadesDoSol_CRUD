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
            'country' => 'Portugal',
            'state' => 'Porto',
            'city' => 'Porto',
            'street' => 'Rua dos testes',
            'lot' => '1234-A',
            'zipcode' => '1234-567',
        ]);
    }
}
