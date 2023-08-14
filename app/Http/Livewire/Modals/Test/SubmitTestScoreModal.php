<?php

namespace App\Http\Livewire\Modals\Test;

use App\Models\TestReport;
use App\Models\ScoringComponent;
use App\Models\ScoringCriteria;
use App\Models\TestSchedule;
use App\Models\TestScore;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class SubmitTestScoreModal extends ModalComponent
{
    public $maxScore = 16;
    public $minPercentage = 60;
    public $testSchedule;
    public $scoringComponents;
    public $testScore;
    public $note;

    protected $rules = [
        'testScore.*.scoring_criteria_id'   => 'required|exists:scoring_criterias,id',
        'testScore.*.score'                 => 'nullable',
        'testScore.*.weight'                => 'nullable',
        'note'                              => 'nullable',
    ];

    public function mount(TestSchedule $testSchedule)
    {
        $this->testSchedule = $testSchedule;
        $this->scoringComponents = ScoringComponent::all();
    }

    public function updatedTestScore($value, $key)
    {
        $key = explode('.', $key)[0];

        if (empty($value)) {
            $this->testScore[$key] = ['scoring_criteria_id' => $value, 'score' => 0, 'weight' => 0];
        } else {
            $scoringComponent   = ScoringComponent::find($key);
            $scoringCriteria    = ScoringCriteria::find($value);

            $this->testScore[$key] = [
                'scoring_criteria_id' => $scoringCriteria->id,
                'score' => $scoringCriteria->score,
                'weight' => $scoringComponent->weight,
            ];
        }
    }

    public function submit()
    {
        $validateData = [];
        $validateAttributes = [];

        foreach ($this->scoringComponents as $scoringComponent) {
            $validateData = array_merge(
                $validateData,
                [
                    'testScore.' . $scoringComponent->id => 'required',
                    'testScore.' . $scoringComponent->id . '.scoring_criteria_id' => 'required|exists:scoring_criterias,id',
                ],
            );

            $validateAttributes = array_merge($validateAttributes, [
                'testScore.' . $scoringComponent->id . '.scoring_criteria_id' => 'Kriteria Penilaian',
            ]);
        }

        $this->validate($validateData, [], $validateAttributes);

        if (!empty($this->testScore)) {
            $scorings = 0;

            foreach ($this->testScore as $key => $criteria) {
                $scoringComponent   = ScoringComponent::find($key);
                $scoringCriteria    = ScoringCriteria::find($criteria['scoring_criteria_id']);

                TestScore::updateOrCreate(
                    [
                        'test_schedule_id'      => $this->testSchedule->id,
                        'participant_user_id'   => $this->testSchedule->participant->id,
                        'assessor_user_id'      => $this->testSchedule->assessor->id,
                        'scoring_component_id'  => $scoringComponent->id,
                        'scoring_criteria_id'   => $scoringCriteria->id,
                    ],
                    [
                        'score'     => $criteria['score'],
                        'weight'    => $criteria['weight'],
                    ]
                );

                $scorings += (float) $criteria['score'] * (float) $criteria['weight'];
            }

            $scorings   = number_format($scorings / $this->maxScore * 100, 2);
            $result     = $scorings >= $this->maxScore ? 'K' : 'BK';

            TestReport::updateOrCreate(
                [
                    'test_schedule_id'      => $this->testSchedule->id,
                    'participant_user_id'   => $this->testSchedule->participant->id,
                    'assessor_user_id'      => $this->testSchedule->assessor->id,
                ],
                [
                    'score'     => $scorings,
                    'result'    => $result,
                    'note'      => $this->note,
                ]
            );
        }

        $this->testSchedule->assessor_submitted_report_at = Carbon::now();
        $this->testSchedule->save();

        return redirect()->route('assessor.test.report', ['testSchedule' => $this->testSchedule->id]);
    }

    public function render()
    {
        return view('livewire.modals.test.submit-test-score-modal');
    }
}
