<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Education;
use Carbon\Carbon;

class PortfolioSeeder extends Seeder
{
    public function run()
    {
        // Skills - Based on CV
        $skills = [
            // Backend
            ['name' => 'ASP.NET MVC', 'category' => 'backend', 'proficiency' => 90, 'order' => 1],
            ['name' => 'PHP (Laravel)', 'category' => 'backend', 'proficiency' => 85, 'order' => 2],
            ['name' => 'C#', 'category' => 'backend', 'proficiency' => 88, 'order' => 3],
            ['name' => 'Python', 'category' => 'backend', 'proficiency' => 75, 'order' => 4],
            ['name' => 'C++', 'category' => 'backend', 'proficiency' => 70, 'order' => 5],
            
            // Frontend
            ['name' => 'HTML5', 'category' => 'frontend', 'proficiency' => 95, 'order' => 1],
            ['name' => 'CSS', 'category' => 'frontend', 'proficiency' => 90, 'order' => 2],
            ['name' => 'JavaScript', 'category' => 'frontend', 'proficiency' => 88, 'order' => 3],
            ['name' => 'jQuery', 'category' => 'frontend', 'proficiency' => 85, 'order' => 4],
            ['name' => 'Bootstrap', 'category' => 'frontend', 'proficiency' => 90, 'order' => 5],
            ['name' => 'Ajax', 'category' => 'frontend', 'proficiency' => 80, 'order' => 6],
            
            // Mobile
            ['name' => 'Flutter', 'category' => 'mobile', 'proficiency' => 85, 'order' => 1],
            ['name' => 'Kotlin (Android)', 'category' => 'mobile', 'proficiency' => 75, 'order' => 2],
            
            // Database
            ['name' => 'MySQL', 'category' => 'database', 'proficiency' => 90, 'order' => 1],
            ['name' => 'SQL Server', 'category' => 'database', 'proficiency' => 88, 'order' => 2],
            
            // Tools
            ['name' => 'Visual Studio Code', 'category' => 'tools', 'proficiency' => 95, 'order' => 1],
            ['name' => 'Visual Studio', 'category' => 'tools', 'proficiency' => 90, 'order' => 2],
            ['name' => 'phpMyAdmin', 'category' => 'tools', 'proficiency' => 85, 'order' => 3],
            ['name' => 'Figma', 'category' => 'tools', 'proficiency' => 80, 'order' => 4],
            ['name' => 'Git', 'category' => 'tools', 'proficiency' => 85, 'order' => 5],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Experiences - Based on CV
        $experiences = [
            [
                'position' => 'Software Engineer - Technical Consultant',
                'company' => 'PT. Afifah Gerbang Indah',
                'description' => 'Design, developed, and maintained web and mobile applications using ASP.NET MVC, PHP (Laravel), Flutter, and Kotlin. Built and optimized RESTful APIs for seamless integration. Developed and maintained relational databases using MySQL and SQL Server. Implemented modular architectures (MVC & MVVM) and reusable components. Created automated data reports and business dashboards.',
                'start_date' => Carbon::parse('2025-06-01'),
                'end_date' => null,
                'current' => true,
                'order' => 1,
            ],
            [
                'position' => 'Net Developer - Software Dev / Tech Consultant',
                'company' => 'PT. Invelli Solusindo',
                'description' => 'Developing the software and Website of the Company Product. Maintaining the Website (Asp.Net). Full Stack Web Developer. Responsible for maintaining the database using Microsoft SQL Server as Database Platform and SSMS. Have Responsible for Website deploying. Supporting the Mobile Developer for connecting with the Website Application of the product.',
                'start_date' => Carbon::parse('2024-03-01'),
                'end_date' => Carbon::parse('2025-06-30'),
                'current' => false,
                'order' => 2,
            ],
            [
                'position' => 'Product Development Software Engineer Intern',
                'company' => 'PT. Mattel Indonesia',
                'description' => 'Developing the software and Website of the ProdDev Department in Asp.Net MVC. Maintaining the Website (Asp.Net). Full Stack Web Developer. Digitalize all the data of the department. Responsible for making and maintaining the database using Microsoft SQL Server. Responsible for Website publishing and deploying. Migrating and transforming the authentication of the website using SSO and JWT.',
                'start_date' => Carbon::parse('2023-07-01'),
                'end_date' => Carbon::parse('2024-04-30'),
                'current' => false,
                'order' => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::create($exp);
        }

        // Educations
        $educations = [
            [
                'degree' => 'Bachelor of Computer Science',
                'institution' => 'Gunadarma University',
                'description' => 'Focus on Software Engineering and Information Systems.',
                'start_date' => Carbon::parse('2019-09-01'),
                'end_date' => Carbon::parse('2024-06-30'),
                'current' => false,
                'order' => 1,
            ],
        ];

        foreach ($educations as $edu) {
            Education::create($edu);
        }

        // Projects - Based on actual project experience from CV
        $projects = [
            [
                'title' => 'Point of Sale (POS) System for Café Operations',
                'slug' => 'pos-system-cafe',
                'company' => 'PT. Afifah Gerbang Indah',
                'role' => 'Software Engineer / Technical Consultant',
                'description' => 'Developed a Point of Sale (POS) system for company-owned café operations, handling transaction processing, order management, and sales reporting.',
                'content' => "Developed a comprehensive POS system for café operations:\n\n• Transaction processing and order management\n• Sales reporting and daily operational workflows\n• Ensured system reliability for business use\n• Real-time inventory tracking\n• Customer management features",
                'image' => 'pos-cafe.jpg',
                'url' => null,
                'github_url' => null,
                'technologies' => json_encode(['ASP.NET MVC', 'SQL Server', 'MySQL']),
                'project_date' => Carbon::parse('2025-01-15'),
                'order' => 1,
                'featured' => true,
            ],
            [
                'title' => 'Online Ordering Mobile Application',
                'slug' => 'online-ordering-mobile-app',
                'company' => 'PT. Afifah Gerbang Indah',
                'role' => 'Software Engineer / Technical Consultant',
                'description' => 'Developed an online ordering mobile application similar to popular café ordering platforms, allowing customers to place orders digitally.',
                'content' => "Created a mobile ordering application for café services:\n\n• Digital ordering platform for customers\n• Integrated with back-end services for real-time order processing\n• Similar to popular café ordering platforms\n• User-friendly interface\n• Order tracking and notifications",
                'image' => 'online-ordering.jpg',
                'url' => null,
                'github_url' => null,
                'technologies' => json_encode(['Flutter', 'ASP.NET', 'C#', 'REST API']),
                'project_date' => Carbon::parse('2025-02-10'),
                'order' => 2,
                'featured' => true,
            ],
            [
                'title' => 'Back-Office Web Application',
                'slug' => 'back-office-web-app',
                'company' => 'PT. Afifah Gerbang Indah',
                'role' => 'Software Engineer / Technical Consultant',
                'description' => 'Developed a back-office web application to support operational management, reporting, and administrative workflows.',
                'content' => "Built comprehensive back-office management system:\n\n• Operational management and reporting\n• Administrative workflows automation\n• Role-based access control\n• Data management features\n• Integration with other systems",
                'image' => 'back-office.jpg',
                'url' => null,
                'github_url' => null,
                'technologies' => json_encode(['Laravel', 'PHP', 'MySQL']),
                'project_date' => Carbon::parse('2025-03-05'),
                'order' => 3,
                'featured' => true,
            ],
            [
                'title' => 'Employee Mobile Application',
                'slug' => 'employee-mobile-app',
                'company' => 'PT. Afifah Gerbang Indah',
                'role' => 'Software Engineer / Technical Consultant',
                'description' => 'Developed an employee mobile application to support internal operational activities, including task handling and operational updates.',
                'content' => "Created internal employee management mobile app:\n\n• Task handling and assignment\n• Operational updates and notifications\n• Smooth integration with back-end systems\n• Employee attendance tracking\n• Performance monitoring",
                'image' => 'employee-app.jpg',
                'url' => null,
                'github_url' => null,
                'technologies' => json_encode(['Flutter', 'Laravel', 'PHP', 'REST API']),
                'project_date' => Carbon::parse('2025-04-20'),
                'order' => 4,
                'featured' => true,
            ],
            [
                'title' => 'Core Banking Web Implementation (Multi-Branch Pilot Project)',
                'slug' => 'core-banking-implementation',
                'company' => 'PT. Invelli Solusindo',
                'role' => '.NET Developer / Software Engineer',
                'description' => 'Contributed to the implementation of a web-based Core Banking application (Microsys) as a pilot project for multi-branch banks and cooperatives.',
                'content' => "Pilot implementation of Core Banking system:\n\n• Web-based banking application (Microsys)\n• Multi-branch support for banks and cooperatives\n• System adaptation and feature enhancement\n• Deployment readiness preparation\n• Integration with existing banking infrastructure",
                'image' => 'core-banking.jpg',
                'url' => null,
                'github_url' => null,
                'technologies' => json_encode(['ASP.NET', 'C#', 'SQL Server']),
                'project_date' => Carbon::parse('2024-06-15'),
                'order' => 5,
                'featured' => true,
            ],
            [
                'title' => 'Finance Module Development & System Maintenance',
                'slug' => 'finance-module-development',
                'company' => 'PT. Invelli Solusindo',
                'role' => '.NET Developer / Software Engineer',
                'description' => 'Performed maintenance and feature development for financial modules within the Core Banking web application.',
                'content' => "Financial module enhancement and maintenance:\n\n• Savings, loan, and financial reporting modules\n• Improved existing functionalities\n• Fixed issues and bugs\n• Database structure management\n• Data accuracy support for operations",
                'image' => 'finance-module.jpg',
                'url' => null,
                'github_url' => null,
                'technologies' => json_encode(['ASP.NET', 'C#', 'SQL Server']),
                'project_date' => Carbon::parse('2024-09-20'),
                'order' => 6,
                'featured' => true,
            ],
            [
                'title' => 'Company Website (Profile & Product Catalog)',
                'slug' => 'company-website-catalog',
                'company' => 'PT. Sohoukikaku',
                'role' => 'Web Developer',
                'description' => 'Developed and maintained a company profile and product catalog website using a CMS-based Laravel framework.',
                'content' => "Company website with CMS functionality:\n\n• Company profile presentation\n• Product catalog management\n• CMS-based content management\n• Responsive design\n• SEO optimization",
                'image' => 'company-website.jpg',
                'url' => null,
                'github_url' => null,
                'technologies' => json_encode(['Laravel', 'PHP', 'HTML5', 'CSS3', 'JavaScript']),
                'project_date' => Carbon::parse('2024-02-10'),
                'order' => 7,
                'featured' => false,
            ],
            [
                'title' => 'Subcon Issue Submission System',
                'slug' => 'subcon-issue-submission',
                'company' => 'PT. Mattel Indonesia',
                'role' => 'Product Development Fullstack Developer .NET Intern',
                'description' => 'Developed a quality control web application to manage subcontractor issue submissions.',
                'content' => "Quality control and issue management system:\n\n• Subcontractor issue submission workflow\n• Quality control monitoring\n• Issue tracking and resolution\n• Reporting and analytics\n• Integration with existing systems",
                'image' => 'subcon-issue.jpg',
                'url' => null,
                'github_url' => null,
                'technologies' => json_encode(['ASP.NET MVC', 'C#', 'SQL Server']),
                'project_date' => Carbon::parse('2023-08-15'),
                'order' => 8,
                'featured' => false,
            ],
            [
                'title' => 'Subcon Buy-Off System Integration',
                'slug' => 'subcon-buyoff-integration',
                'company' => 'PT. Mattel Indonesia',
                'role' => 'Software Developer',
                'description' => 'Integrated the Product Development web application with the Subcon Buy-Off system from another department.',
                'content' => "System integration project:\n\n• Integration between departments\n• Product Development and Subcon Buy-Off systems\n• Data synchronization\n• Workflow automation\n• API development and integration",
                'image' => 'subcon-buyoff.jpg',
                'url' => null,
                'github_url' => null,
                'technologies' => json_encode(['ASP.NET MVC', 'C#', 'SQL Server']),
                'project_date' => Carbon::parse('2023-09-20'),
                'order' => 9,
                'featured' => false,
            ],
            [
                'title' => 'Project Milestone Tracking System',
                'slug' => 'project-milestone-tracking',
                'company' => 'PT. Mattel Indonesia',
                'role' => 'Product Development Fullstack Developer .NET Intern',
                'description' => 'Developed a milestone tracking web application for internal project monitoring.',
                'content' => "Project management and tracking system:\n\n• Milestone tracking and monitoring\n• Project progress visualization\n• Team collaboration features\n• Reporting and analytics\n• Quality control integration",
                'image' => 'milestone-tracking.jpg',
                'url' => null,
                'github_url' => null,
                'technologies' => json_encode(['ASP.NET MVC', 'C#', 'SQL Server']),
                'project_date' => Carbon::parse('2023-10-25'),
                'order' => 10,
                'featured' => false,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}