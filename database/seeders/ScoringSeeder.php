<?php

namespace Database\Seeders;

use App\Models\ScoringComponent;
use App\Models\ScoringCriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scorings = json_decode(file_get_contents(storage_path('db-json/scoring.json')), true);

        foreach ($scorings as $component) {
            $scoringComponent = ScoringComponent::firstOrCreate(
                [
                    'title'     => $component['title'],
                ],
                [
                    'weight'    => $component['weight'],
                ]
            );

            foreach ($component['criterias'] as $criteria) {
                ScoringCriteria::firstOrCreate(
                    [
                        'scoring_component_id' => $scoringComponent->id,
                        'title'     => $criteria['title'],
                        'score'     => $criteria['score'],
                    ]
                );
            }
        }
    }
}
