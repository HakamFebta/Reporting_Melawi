<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
            'username' => "HAKAM",
            'password' => Hash::make("HAKAM"),
            'jenis' => "1",
            'rules' => "1",
            'status' => "1",
            'tambah' => "1",
            'hapus' => "1",
            'edit' => "1",
        ]);
    }
}
