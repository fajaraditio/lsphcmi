<?php

namespace App\Http\Livewire\Pages\Participant;

use App\Models\FeedbackComponent;
use App\Models\TestFeedback as TestFeedbackModel;
use App\Models\TestSchedule;
use Carbon\Carbon;
use Livewire\Component;

class TestFeedback extends Component
{
    public $testSchedule;
    public $testFeedback;

    protected $validationAttributes = [
        'testFeedback.*'        => 'Umpan Balik',
        'testFeedback.*.result' => 'Hasil',
        'testFeedback.*.note'   => 'Catatan atau Komentar',
    ];

    public function mount()
    {
        $feedbackComponents = FeedbackComponent::all();

        foreach ($feedbackComponents as $component) {
            $testFeedback = TestFeedbackModel::where('feedback_component_id', $component->id)->first();

            $this->testFeedback[$component->id]['result'] = null;
            $this->testFeedback[$component->id]['note']   = null;

            if (!empty($testFeedback)) {
                $this->testFeedback[$component->id]['result'] = $testFeedback->result;
                $this->testFeedback[$component->id]['note']   = $testFeedback->note;
            }
        }

        $this->testSchedule = TestSchedule::where('participant_user_id', auth()->user()->id)->first();
    }

    public function submit()
    {
        $feedbackComponents = FeedbackComponent::all();

        $validateData = [];
        foreach ($feedbackComponents as $component) {
            $validateData = array_merge(
                $validateData,
                [
                    'testFeedback.' . $component->id            => 'required',
                    'testFeedback.' . $component->id . '.result' => 'required|in:Y,T',
                    'testFeedback.' . $component->id . '.note'  => 'nullable',
                ]
            );
        }

        $this->validate($validateData);

        foreach ($this->testFeedback as $id => $testFeedback) {
            $feedbackComponent = FeedbackComponent::where('id', $id)->first();

            TestFeedbackModel::updateOrCreate(
                [
                    'feedback_component_id' => $feedbackComponent->id,
                    'test_schedule_id'      => $this->testSchedule->id,
                    'participant_user_id'   => $this->testSchedule->participant->id,
                    'assessor_user_id'      => $this->testSchedule->assessor->id,
                ],
                [
                    'component' => $feedbackComponent->component,
                    'result'    => $testFeedback['result'],
                    'note'      => empty($testFeedback['note']) ? '-' : $testFeedback['note'],
                ]
            );
        }

        $this->testSchedule->participant_status = 'get_result';
        $this->testSchedule->participant_responded_feedback_at = Carbon::now();
        $this->testSchedule->save();

        return redirect()->route('participant.test.feedback');
    }

    public function back()
    {
        return redirect()->route('participant.test.observation');
    }

    public function render()
    {
        $feedbackComponents = FeedbackComponent::all();

        return view('livewire.pages.participant.test-feedback', compact('feedbackComponents'));
    }
}
