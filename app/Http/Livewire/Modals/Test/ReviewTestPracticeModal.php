<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Models\TestPractice;
use App\Http\Livewire\Tables\Test\TestPracticeTable;
use LivewireUI\Modal\ModalComponent;

class ReviewTestPracticeModal extends ModalComponent
{
    public TestPractice $testPractice;
    public $review;

    protected $rules = [
        'review' => 'required|in:K,BK',
    ];

    protected $validationAttributes = [
        'review' => 'Penilaian',
    ];

    public function mount()
    {
        if (!empty($this->testPractice->result)) $this->review = $this->testPractice->result;
    }

    public function save()
    {
        $this->validate();

        $this->testPractice->result = $this->review;
        $this->testPractice->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Penilaian berhasil diberikan!',
            $message = 'Penilaian untuk asesmen #' . $this->testPractice->id . ' berhasil disimpan.',
            $type = 'success'
        );

        $this->emitTo(TestPracticeTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.review-test-practice-modal');
    }
}
