<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Test\TestPracticeTable;
use App\Models\TestPractice;
use LivewireUI\Modal\ModalComponent;

class DestroyTestPracticeCaseModal extends ModalComponent
{
    public TestPractice $testPractice;

    public function destroy()
    {
        $this->testPractice->delete();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Kasus berhasil dihapus!',
            $message = 'Kasus Tugas Praktik dengan ID ' . $this->testPractice->title . ' berhasil dihapus',
            $type = 'success'
        );

        $this->emitTo(TestPracticeTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.destroy-test-practice-case-modal');
    }
}
