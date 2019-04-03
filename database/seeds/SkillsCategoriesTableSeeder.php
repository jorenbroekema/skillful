<?php

use Illuminate\Database\Seeder;

/* phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace */
class SkillsCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Programming',
            'Presentation',
            'Music',
            'Business',
            'Design',
        ];

        foreach ($categories as $category) {
            $this->insertIntoDB($category);
        }
    }

    /**
     * Insert a new record into the database
     *
     * @return void
     */
    private function insertIntoDB($name)
    {
        $skill = new App\SkillsCategory([
            'name' => $name,
        ]);

        $skill->save();
    }
}
