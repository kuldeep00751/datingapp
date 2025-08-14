<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use Database\Factories\UserFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(20)->create();
    }
}
