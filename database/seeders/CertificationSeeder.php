<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certification;
use Carbon\Carbon;

class CertificationSeeder extends Seeder
{
    public function run()
    {
        $certifications = [
            [
                'name' => 'Microsoft Certified: Azure Fundamentals',
                'issuer' => 'Microsoft',
                'url' => 'https://www.credly.com/badges/your-badge-id',
                'issued_date' => Carbon::parse('2024-01-15'),
                'order' => 1,
            ],
            [
                'name' => 'Bootcamp: The Complete Web Developer Course 3.0',
                'issuer' => 'Udemy',
                'url' => 'https://www.udemy.com/certificate/your-certificate',
                'issued_date' => Carbon::parse('2023-06-20'),
                'order' => 2,
            ],
            [
                'name' => 'Belajar Web Development Menggunakan Bahasa Pemrograman PHP',
                'issuer' => 'Udemy',
                'url' => 'https://www.udemy.com/certificate/your-certificate',
                'issued_date' => Carbon::parse('2023-05-10'),
                'order' => 3,
            ],
            [
                'name' => 'Fundamental Jaringan Komputer',
                'issuer' => 'CodingStudio',
                'url' => 'https://codingstudio.id/certificate/your-certificate',
                'issued_date' => Carbon::parse('2023-03-15'),
                'order' => 4,
            ],
            [
                'name' => 'Algorithm Fundamental',
                'issuer' => 'CodingStudio',
                'url' => 'https://codingstudio.id/certificate/your-certificate',
                'issued_date' => Carbon::parse('2023-02-20'),
                'order' => 5,
            ],
        ];

        foreach ($certifications as $cert) {
            Certification::create($cert);
        }
    }
}