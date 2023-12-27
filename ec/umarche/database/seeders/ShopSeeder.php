<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shops')->insert([
                'owner_id'=>1,
                'name'=>'店名',
                'information'=>'ここにお店の情報が入りますここにお店の情報が入りますここにお店の情報が入りますここにお店の情報が入ります',
                'filename'=>'',
                'is_selling'=>true    
        ]);
    }
}
