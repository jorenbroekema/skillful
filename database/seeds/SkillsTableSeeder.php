<?php

use Illuminate\Database\Seeder;

/* phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace */
class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = [
            'JavaScript' => 'Programming',
            'Pitching' => 'Presentation',
            'Guitar' => 'Music',
            'Piano' => 'Music',
            'Platforms & Ecosystems thinking' => 'Business',
            'Design Thinking' => 'Business',
            'Photoshop' => 'Design',
            'Illustrator' => 'Design',
            'Calligraphy' => 'Design',
        ];

        foreach ($skills as $skill => $category) {
            $this->insertIntoDB($skill, $category);
        }
    }

    /**
     * Insert a new record into the database
     *
     * @return void
     */
    private function insertIntoDB($name, $categoryName)
    {
        $skill = new App\Skill([
            'name' => $name,
        ]);

        $category = App\SkillsCategory::where('name', $categoryName)->first();
        $skill->skillsCategory()->associate($category);

        $skill->save();
    }
}
