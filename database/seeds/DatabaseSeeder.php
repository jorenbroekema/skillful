<?php

use Illuminate\Database\Seeder;

/* phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillsCategoriesTableSeeder::class);
        $this->call(SkillsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(WorkshopsTableSeeder::class);
    }
}
