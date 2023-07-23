<?php

namespace App\Http\Livewire\Modals\Test;

use App\Models\TestPractice;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class RespondTestPracticeCaseModal extends ModalComponent
{
    use WithFileUploads;

    public TestPractice $testPractice;
    public $responseFile;

    protected $rules = [
        'responseFile' => 'required|mimes:pdf,doc,docx',
    ];

    protected $validationAttributes = [
        'responseFile' => 'Berkas Jawaban',
    ];

    public function save()
    {
        if (empty($this->testPractice->response_file)) $this->validate();

        $midfix = date('Ymd_Gis') . '_id_' . $this->testPractice->id;

        if ($this->responseFile) {
            $responseFilename  = 'practice_' . $midfix . '.' . $this->responseFile->getClientOriginalExtension();
            $responseFileUploaded  = $this->responseFile->storeAs('public/tests', $responseFilename);
            $this->testPractice->response_file = str_replace('public/', '', $responseFileUploaded);

            $this->testPractice->save();
        }

        return redirect()->route('participant.test.practice', ['testSchedule' => $this->testPractice->test_schedule->id]);
    }

    public function render()
    {
        return view('livewire.modals.test.respond-test-practice-case-modal');
    }
}
