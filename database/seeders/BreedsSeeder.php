<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BreedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('breeds')->insert([
            [
                'name' => 'Angus'
            ],
            [
                'name' => 'Azul Belga'
            ],
            [
                'name' => 'Bosmara'
            ],
            [
                'name' => 'Braford'
            ],
            [
                'name' => 'Brahma'
            ],
            [
                'name' => 'Red Angus'
            ],
            [
                'name' => 'Senepol'
            ],
            [
                'name' => 'Sindi'
            ],
        ]);
    }
}
