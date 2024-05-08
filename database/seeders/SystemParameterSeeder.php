<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('system_parameters')->insert([
            'param_category' => 'APP',
            'param_key' => 'tax_rate',
            'param_value' => '8',
        ]);

        DB::table('system_parameters')->insert([
            'param_category' => 'APP',
            'param_key' => 'ref_no_counter',
            'param_value' => '1',
        ]);

        DB::table('system_parameters')->insert([
            'param_category' => 'APP',
            'param_key' => 'currency_code',
            'param_value' => 'MYR',
        ]);
    }
}
