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
            $owner = App\User::inRandomOrder()->first();
            $group->owner()->associate($owner)->save();

            $randomAmount = rand(1, 7);
            $members = App\User::inRandomOrder()->take($randomAmount)->get();
            if (!$members->contains($owner)) {
                $members->concat($owner);
            }
            $group->members()->saveMany($members);
        });
    }
}
