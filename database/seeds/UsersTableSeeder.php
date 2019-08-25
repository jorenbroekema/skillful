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
        $adminUser = App\User::create([
            'name' => env('APP_ADMIN_USER'),
            'password' => Hash::make(env('APP_ADMIN_PW')),
            'email' => env('APP_ADMIN_EMAIL'),
        ]);

        $this->setRandomSkills($adminUser);
        $this->setRandomWantedSkills($adminUser);

        factory(App\User::class, 10)->create()->each(function ($user) {
            $this->setRandomSkills($user);
            $this->setRandomWantedSkills($user);
        });
    }

    private function setRandomSkills ($user)
    {
        $randomAmount = rand(1, 7);
        $skills = App\Skill::inRandomOrder()->take($randomAmount)->get();
        $user->skills()->saveMany($skills);
    }

    private function setRandomWantedSkills ($user)
    {
        $randomAmount = rand(1, 7);
        $wantedSkills = App\Skill::inRandomOrder()->take($randomAmount)->get();
        $wantedSkills->filter(function ($skill) use ($user) {
            return !($user->skills->contains($skill));
        });
        $user->wantedSkills()->saveMany($wantedSkills);
    }
}
