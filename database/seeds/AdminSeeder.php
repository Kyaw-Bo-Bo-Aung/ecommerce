<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'Men', 'email' => 'admin@gmail.com',
            'phone' => '09123124213' , 'password' => bcrypt('password'), 'type' => 'Super admin',
            'status' => 1],
        ];
        Admin::insert($data);
    }
}
