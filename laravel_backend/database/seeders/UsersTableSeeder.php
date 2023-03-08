<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin=User::Create([
          'name'=>'Admin',
          'email'=>'a@a.com',
          'password'=> bcrypt('a'),
        ]);
        User::factory()->count(5)->create();
    }
}
