<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Test\TestPracticeTable;
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

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Berkas jawaban berhasil disimpan!',
            $message = 'Berkas jawaban sudah disimpan. Silakan lanjut mengunggah berkas jawaban soal lain yang tersisa.',
            $type = 'success'
        );

        $this->emitTo(TestPracticeTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.respond-test-practice-case-modal');
    }
}
