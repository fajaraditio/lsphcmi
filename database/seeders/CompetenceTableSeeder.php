<?php

namespace Database\Seeders;

use App\Models\CompetenceCriteria;
use App\Models\CompetenceElement;
use App\Models\CompetenceUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $competencies = json_decode(file_get_contents(storage_path('db-json/competencies.json')), true);

        foreach ($competencies as $competenceUnit) {
            $createdCompetenceUnit = CompetenceUnit::firstOrCreate(
                [
                    'code' => $competenceUnit['code'],
                ],
                [
                    'title' => $competenceUnit['title'],
                ]
            );

            foreach ($competenceUnit['elements'] as $competenceElement) {
                $createdCompetenceElement = CompetenceElement::firstOrCreate(
                    [
                        'competence_unit_id' => $createdCompetenceUnit->id,
                        'no' => $competenceElement['no'],
                    ],
                    [
                        'title' => $competenceElement['title']
                    ]
                );

                foreach ($competenceElement['criterias'] as $competenceCriteria) {
                    $createdCompetenceCriteria = CompetenceCriteria::firstOrCreate(
                        [
                            'competence_element_id' => $createdCompetenceElement->id,
                            'no' => $competenceCriteria['no'],
                        ],
                        [
                            'title' => $competenceCriteria['title'],
                        ]
                    );
                }
            }
        }
    }
}
