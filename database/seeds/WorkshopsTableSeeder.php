<?php

use Illuminate\Database\Seeder;

/* phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace */
class WorkshopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Workshop::class, 10)->create()->each(function ($workshop) {
            $randomAmount = rand(0, 5);
            $users = App\User::inRandomOrder()->take($randomAmount)->get();
            $workshop->users()->saveMany($users);
        });
    }
}
