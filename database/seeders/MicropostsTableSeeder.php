<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MicropostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        
        for($i = 1;$i<=100;$i++){
            DB::table('microposts')->insert([
                'user_id'=>$i,
                'content'=>'sample data' . $i . 'by seeder'
            ]);
        }
    }
}
