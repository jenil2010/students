<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class countryseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('country')->insert([
            [
              'name' => 'India',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'Africa',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'UK',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'USA',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'Australia',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'Oman',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'Seychelles',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
            [
              'name' => 'Other',
              'created_at' => Carbon::now(),
              'updated_at' => Carbon::now(),
            ],
          ]);
    }
}
