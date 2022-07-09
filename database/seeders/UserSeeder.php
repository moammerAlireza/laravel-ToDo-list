<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::create([
            'email'=>'test@gmail.com',
            'password'=>Hash::make('password'),
            'first_name'=> 'mathieu',
            'last_name'=>'delaro',
            'bio'=>'programming lover'
        ]);

        User::factory()->count(10)->create();
    }
}
