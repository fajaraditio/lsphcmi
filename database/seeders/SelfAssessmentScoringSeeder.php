<?php

namespace Database\Seeders;

use App\Models\SelfAssessmentScoreComponent;
use App\Models\SelfAssessmentScoreCriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SelfAssessmentScoringSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $selfAssessmentScorings = json_decode(file_get_contents(storage_path('db-json/self_assessment_scoring.json')), true);

        foreach ($selfAssessmentScorings as $component) {
            $selfAssessmentComponent = SelfAssessmentScoreComponent::firstOrCreate(
                [
                    'title'     => $component['title'],
                ],
                [
                    'weight'    => $component['weight'],
                ]
            );

            foreach ($component['criterias'] as $criteria) {
                SelfAssessmentScoreCriteria::firstOrCreate(
                    [
                        'self_assessment_score_component_id' => $selfAssessmentComponent->id,
                        'title'     => $criteria['title'],
                        'score'     => $criteria['score'],
                    ]
                );
            }
        }
    }
}
