<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Admin::create([
            'name' => 'Kankai Admin',
            'email' => 'kankai@gmail.com',
            'password' => 'kankai@123',
        ]);
    }
}
