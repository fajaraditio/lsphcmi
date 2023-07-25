<?php

namespace App\Http\Livewire\Pages\Assessor;

use App\Models\TestSchedule;
use App\Models\FeedbackComponent;
use App\Models\TestFeedback as TestFeedbackModel;
use Carbon\Carbon;
use Livewire\Component;

class TestFeedback extends Component
{
    public TestSchedule $testSchedule;
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
    }

    public function back()
    {
        return redirect()->route('assessor.test.observation', ['testSchedule' => $this->testSchedule->id]);
    }

    public function next()
    {
        return redirect()->route('assessor.test.report', ['testSchedule' => $this->testSchedule->id]);
    }

    
    public function render()
    {
        $feedbackComponents = FeedbackComponent::all();

        return view('livewire.pages.assessor.test-feedback', compact('feedbackComponents'));
    }
}
