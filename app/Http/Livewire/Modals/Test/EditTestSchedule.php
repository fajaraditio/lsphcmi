<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Test\TestScheduleTable;
use App\Models\TestSchedule;
use App\Models\TestSession;
use Carbon\Carbon;
use LivewireUI\Modal\ModalComponent;

class EditTestSchedule extends ModalComponent
{
    public TestSchedule $testSchedule;
    public $testSessions;
    public $testSessionId;
    public $date;

    protected $rules = [
        'date'          => 'required|date:d-m-Y',
        'testSessionId' => 'required',
    ];

    protected $validationAttributes = [
        'date'          => 'Tanggal Uji Kompetensi',
        'testSessionId' => 'Sesi Ujian',
    ];

    public function mount()
    {
        $this->testSessions = TestSession::all();
        $this->date         = !empty($this->testSchedule->scheduled_at) ? Carbon::parse($this->testSchedule->scheduled_at)->format('Y-m-d') : null;
        $this->testSessionId = !empty($this->testSchedule->test_session_id) ? $this->testSchedule->test_session_id : null;
    }

    public function save()
    {
        $this->validate();

        $this->testSchedule->scheduled_at       = $this->date;
        $this->testSchedule->test_session_id    = $this->testSessionId;
        $this->testSchedule->save();

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Jadwal untuk asesi ' . $this->testSchedule->name . ' berhasil diedit!',
            $message = 'Jadwal pelaksanaan asesmen sudah diedit dan disesuaikan',
            $type = 'success'
        );

        $this->emitTo(TestScheduleTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modals.test.edit-test-schedule');
    }
}
