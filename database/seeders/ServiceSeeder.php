<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        // Keyed by title so re-running on production updates rows instead of duplicating them
        $services = [
            [
                'title' => 'Web applications',
                'description' => 'Back-office systems, quality control tools, and line-of-business web applications built with Laravel and ASP.NET MVC.',
                'icon' => 'fa-layer-group',
                'features' => [
                    'Back-office and admin systems',
                    'Operational workflows and approvals',
                    'Role-based access',
                    'Laravel and ASP.NET MVC',
                ],
                'order' => 1,
                'active' => true,
            ],
            [
                'title' => 'Mobile applications',
                'description' => 'Flutter and Kotlin apps for customer ordering and employee operations, connected to the same backend as the web system.',
                'icon' => 'fa-mobile-screen-button',
                'features' => [
                    'Customer ordering apps',
                    'Employee and task apps',
                    'Flutter (iOS & Android) and Kotlin',
                    'Backend-connected via REST APIs',
                ],
                'order' => 2,
                'active' => true,
            ],
            [
                'title' => 'API and system integration',
                'description' => 'RESTful APIs and integrations that let separate business systems share data instead of relying on manual re-entry.',
                'icon' => 'fa-plug',
                'features' => [
                    'RESTful API design and development',
                    'Integration between departmental systems',
                    'Web and mobile sharing one backend',
                    'Data sync and validation',
                ],
                'order' => 3,
                'active' => true,
            ],
            [
                'title' => 'Point of sale and ordering',
                'description' => 'POS and ordering systems for cafe and retail operations: transactions, order management, and sales reporting.',
                'icon' => 'fa-cash-register',
                'features' => [
                    'Transaction processing',
                    'Order management',
                    'Online ordering',
                    'Sales reporting',
                ],
                'order' => 4,
                'active' => true,
            ],
            [
                'title' => 'Banking and finance modules',
                'description' => 'Feature development and maintenance for core banking and cooperative systems, including savings, loans, and financial reporting.',
                'icon' => 'fa-building-columns',
                'features' => [
                    'Core banking web implementation',
                    'Savings and loan modules',
                    'Financial reporting',
                    'Multi-branch rollout support',
                ],
                'order' => 5,
                'active' => true,
            ],
            [
                'title' => 'Dashboards and internal tools',
                'description' => 'Reporting dashboards and tracking tools that digitalize spreadsheets and give teams one place to monitor work.',
                'icon' => 'fa-chart-line',
                'features' => [
                    'Operational and sales dashboards',
                    'Project and milestone tracking',
                    'Digitalizing manual records',
                    'Exportable reports',
                ],
                'order' => 6,
                'active' => true,
            ],
            [
                'title' => 'Company websites and CMS',
                'description' => 'Company profile and product catalog websites on a Laravel CMS, so content can be updated without a developer.',
                'icon' => 'fa-globe',
                'features' => [
                    'Company profile pages',
                    'Product catalog management',
                    'CMS-based content editing',
                    'Responsive layout and basic SEO',
                ],
                'order' => 7,
                'active' => true,
            ],
            [
                'title' => 'Database design and maintenance',
                'description' => 'Schema design, query tuning, and ongoing maintenance for SQL Server, MySQL, and PostgreSQL databases behind business systems.',
                'icon' => 'fa-database',
                'features' => [
                    'Schema and data model design',
                    'SQL Server, MySQL, PostgreSQL',
                    'Reporting queries and stored procedures',
                    'Data accuracy and maintenance',
                ],
                'order' => 8,
                'active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }
    }
}
