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
        $counter = 0;
        factory(App\Workshop::class, 10)->create()->each(function ($workshop) use ($counter) {
            $randomAmount = rand(0, 5);
            $users = App\User::inRandomOrder()->take($randomAmount)->get();
            $workshop->users()->saveMany($users);

            // Select a random user as the owner
            $owner = App\User::inRandomOrder()->first();
            $workshop->owner()->associate($owner);

            // 6 out of 10 workshops will belong to a group of the owner, if owner has a group
            if ($counter < 6) {
                $group = $owner->groups->shuffle()->first();
                if ($group) {
                    $workshop->group()->associate($group);
                }
            }

            // Make workshops without a group public, make a FEW workshops with a group public as well
            if ($workshop->group()->first()) {
                if ($randomAmount > 1) {
                    $workshop->public = true;
                }
            } else {
                $workshop->public = true;
            }

            $workshop->save();
        });
    }
}
