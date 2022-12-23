<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;

class Createadmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            [
                'name' => 'Admin Pusat',
                'email' => 'adminPusat@admin.com',
                'level' => 'adminPusat',
                'password' =>bcrypt('12345678'),
            ],
            [
                'name' => 'Admin Cabang1',
                'email' => 'adminCabang1@gmail.com',
                'level' => 'adminCabang',
                'password' =>bcrypt('12345678'),
            ],
            [
                'name' => 'Admin Cabang2',
                'email' => 'adminCabang2@gmail.com',
                'level' => 'adminCabang',
                'password' =>bcrypt('12345678'),
            ],
            [
                'name' => 'Admin Cabang3',
                'email' => 'adminCabang3@gmail.com',
                'level' => 'adminCabang',
                'password' =>bcrypt('12345678'),
            ],
            [
                'name' => 'Admin Gudang',
                'email' => 'adminGudang@gmail.com',
                'level' => 'adminGudang',
                'password' =>bcrypt('12345678'),
            ],
        ];
            \DB::table('users')->insert($users);

    }
}
?>