<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/* phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => env('APP_ADMIN_USER'),
            'password' => Hash::make(env('APP_ADMIN_PW')),
            'email' => env('APP_ADMIN_EMAIL'),
        ]);
        factory(App\User::class, 10)->create();
    }
}
