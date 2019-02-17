<?php

use Illuminate\Database\Seeder;

/* phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace */
class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Group::class, 2)->create()->each(function ($group) {
            $randomAmount = rand(1, 7);
            $users = App\User::inRandomOrder()->take($randomAmount)->get();
            $group->users()->saveMany($users);

            $owner = App\User::inRandomOrder()->first();
            $group->owner()->associate($owner)->save();
        });
    }
}
