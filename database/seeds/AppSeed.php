<?php

use Illuminate\Database\Seeder;

class AppSeed extends Seeder
{
    public function run()
    {
        $users = factory(\App\User::class, 20)->create();

        foreach ($users as $user) {
            factory(\App\Picture::class, rand(1, 10))->create([
                'user_id' => $user->id

            ]);
        }
    }
}
