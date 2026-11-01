<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run()
    {
        // Skills - Based on CV. Keyed by name + category so re-running updates instead of duplicating
        $skills = [
            // Backend
            ['name' => 'ASP.NET MVC', 'category' => 'backend', 'proficiency' => 90, 'order' => 1, 'icon' => 'fab fa-microsoft'],
            ['name' => 'PHP (Laravel)', 'category' => 'backend', 'proficiency' => 85, 'order' => 2, 'icon' => 'fab fa-laravel'],
            ['name' => 'C#', 'category' => 'backend', 'proficiency' => 88, 'order' => 3, 'icon' => 'fas fa-hashtag'],
            ['name' => 'REST APIs', 'category' => 'backend', 'proficiency' => 85, 'order' => 4, 'icon' => 'fas fa-plug'],
            ['name' => 'Python', 'category' => 'backend', 'proficiency' => 75, 'order' => 5, 'icon' => 'fab fa-python'],
            ['name' => 'C++', 'category' => 'backend', 'proficiency' => 70, 'order' => 6, 'icon' => 'fas fa-code'],

            // Frontend
            ['name' => 'HTML5', 'category' => 'frontend', 'proficiency' => 95, 'order' => 1, 'icon' => 'fab fa-html5'],
            ['name' => 'CSS', 'category' => 'frontend', 'proficiency' => 90, 'order' => 2, 'icon' => 'fab fa-css3-alt'],
            ['name' => 'JavaScript', 'category' => 'frontend', 'proficiency' => 88, 'order' => 3, 'icon' => 'fab fa-js'],
            ['name' => 'jQuery', 'category' => 'frontend', 'proficiency' => 85, 'order' => 4, 'icon' => 'fas fa-code'],
            ['name' => 'Bootstrap', 'category' => 'frontend', 'proficiency' => 90, 'order' => 5, 'icon' => 'fab fa-bootstrap'],
            ['name' => 'Ajax', 'category' => 'frontend', 'proficiency' => 80, 'order' => 6, 'icon' => 'fas fa-arrows-rotate'],

            // Mobile
            ['name' => 'Flutter', 'category' => 'mobile', 'proficiency' => 85, 'order' => 1, 'icon' => 'fas fa-mobile-screen-button'],
            ['name' => 'Kotlin (Android)', 'category' => 'mobile', 'proficiency' => 75, 'order' => 2, 'icon' => 'fab fa-android'],

            // Database
            ['name' => 'MySQL', 'category' => 'database', 'proficiency' => 90, 'order' => 1, 'icon' => 'fas fa-database'],
            ['name' => 'SQL Server', 'category' => 'database', 'proficiency' => 88, 'order' => 2, 'icon' => 'fas fa-server'],

            // Tools
            ['name' => 'Visual Studio Code', 'category' => 'tools', 'proficiency' => 95, 'order' => 1, 'icon' => 'fas fa-code'],
            ['name' => 'Visual Studio', 'category' => 'tools', 'proficiency' => 90, 'order' => 2, 'icon' => 'fab fa-windows'],
            ['name' => 'phpMyAdmin', 'category' => 'tools', 'proficiency' => 85, 'order' => 3, 'icon' => 'fas fa-table'],
            ['name' => 'Figma', 'category' => 'tools', 'proficiency' => 80, 'order' => 4, 'icon' => 'fab fa-figma'],
            ['name' => 'Git', 'category' => 'tools', 'proficiency' => 85, 'order' => 5, 'icon' => 'fab fa-git-alt'],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name'], 'category' => $skill['category']],
                $skill
            );
        }
    }
}
