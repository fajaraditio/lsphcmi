<?php

namespace Database\Seeders;

use App\Models\Scheme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchemesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schemesName = [
            '01. Skema Perencanaan Human Capital',
            '02. Skema Pengembangan Human Capital',
            '03. Skema Pengelolaan Hubungan Industrial',
            '04. Skema Staf Administrasi dan Sumber Daya',
            '05. Skema Perencanaan SDM',
            '06. Skema Staf Rekrutmen dan Seleksi SDM',
            '07. Skema Staf Manajemen Talenta',
            '08. Skema Staf Pelatihan dan Pengembangan',
            '09. Skema Staf Hubungan Industrial',
            '10. Skema Staf Pengembangan Organisasi',
            '11. Skema Staf Compensation and Benefits',
            '12. Skema Supervisor SDM',
            '13. Skema Supervisor dan Rekrutmen SDM',
            '14. Skema Supervisor dan Manajemen Talenta',
            '15. Skema Supervisor Pengembangan Organisasi',
            '16. Skema Supervisor Hubungan Industrial',
            '17. Skema Supervisor Compensation and Benefits',
            '18. Skema Kepala Bagian HR Business Partner',
            '19. Skema Kepala Bagian Rekrutmen dan Seleksi SDM',
            '20. Skema Kepala Bagian Compensation and Benefits',
            '21. Skema Kepala Bagian Manajemen Talenta',
            '22. Skema Manager SDM',
            '23. Skema Manager Manajemen Talenta',
            '24. Skema General Manager (GM) SDM',
            '25. Skema Direktur SDM',
        ];

        foreach ($schemesName as $scheme) {
            Scheme::updateOrCreate(
                [
                    'slug' => Str::slug($scheme)
                ],
                [
                    'name' => $scheme,
                ]
            );
        }
    }
}
