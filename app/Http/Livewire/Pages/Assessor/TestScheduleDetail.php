<?php

namespace App\Http\Livewire\Pages\Assessor;

use App\Models\TestSchedule;
use Livewire\Component;

class TestScheduleDetail extends Component
{
    public TestSchedule $testSchedule;

    public function back()
    {
        return redirect()->route('assessor.test.list');
    }

    public function render()
    {
        $forms = [];

        if ($this->testSchedule->participant_signed_agreement_at && $this->testSchedule->assessor_signed_agreement_at) {
            $forms['test_agreement']['status'] = 'done';
            $forms['test_agreement']['color'] = 'green';
        } else {
            $forms['test_agreement']['status'] = 'waiting_assessor_agreement';
            $forms['test_agreement']['color'] = 'yellow';
        }

        if ($this->testSchedule->assessor_submitted_test_practice_at) {
            if ($this->testSchedule->participant_responded_test_practice_at) {
                if ($this->testSchedule->assessor_reviewed_test_practice_at) {
                    $forms['test_practice']['status'] = 'done';
                    $forms['test_practice']['color'] = 'green';
                } else {
                    $forms['test_practice']['status'] = 'waiting_assessor_review';
                    $forms['test_practice']['color'] = 'yellow';
                }
            } else {
                $forms['test_practice']['status'] = 'waiting_participant_respond';
                $forms['test_practice']['color'] = 'indigo';
            }
        } else {
            $forms['test_practice']['status'] = 'waiting_assessor_submit';
            $forms['test_practice']['color'] = 'yellow';
        }

        if ($this->testSchedule->assessor_submitted_test_observation_at) {
            if ($this->testSchedule->participant_responded_test_observation_at) {
                if ($this->testSchedule->assessor_reviewed_test_observation_at) {
                    $forms['test_observation']['status'] = 'done';
                    $forms['test_observation']['color'] = 'green';
                } else {
                    $forms['test_observation']['status'] = 'waiting_assessor_review';
                    $forms['test_observation']['color'] = 'yellow';
                }
            } else {
                $forms['test_observation']['status'] = 'waiting_participant_respond';
                $forms['test_observation']['color'] = 'indigo';
            }
        } else {
            $forms['test_observation']['status'] = 'waiting_assessor_submit';
            $forms['test_observation']['color'] = 'yellow';
        }

        if ($this->testSchedule->participant_responded_feedback_at) {
            $forms['feedback']['status'] = 'done';
            $forms['feedback']['color'] = 'green';
        } else {
            $forms['feedback']['status'] = 'waiting_participant_respond';
            $forms['feedback']['color'] = 'indigo';
        }

        if ($this->testSchedule->assessor_submitted_report_at) {
            $forms['report']['status'] = 'done';
            $forms['report']['color'] = 'green';
        } else {
            $forms['report']['status'] = 'waiting_assessor_submit';
            $forms['report']['color'] = 'yellow';
        }

        return view('livewire.pages.assessor.test-schedule-detail', compact('forms'));
    }
}
