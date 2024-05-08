<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        
        DB::table('companies')->insert([
            'name' => 'TOP ALUMINIUM & GLASS',
            'registration_no' => '202403053709 (PG0552872-V)',
            'email' => 'yukiyfyf@gmail.com',
            'contact_number' => '011-10791586',
            'pic_name' => 'Yuki Leong',
            'address_1' => '138 (Ground Floor), Lebuh Bercham Timur',
            'address_2' => 'Bercham Sinar (East Edan),',
            'address_3' => '31400 Ipoh, Perak.',
            'bank' => 'Maybank',
            'bank_name' => 'TOP ALUMINIUM & GLASS',
            'bank_account_no' => '569972113136',
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
