<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Models\TestObservation;
use App\Http\Livewire\Tables\Test\TestObservationTable;
use App\Models\CompetenceCriteria;
use App\Models\CompetenceElement;
use App\Models\CompetenceUnit;
use App\Models\TestSchedule;
use LivewireUI\Modal\ModalComponent;

class CreateTestObservationModal extends ModalComponent
{
    public TestSchedule $testSchedule;
    public $competenceUnitId;
    public $competenceElementId;
    public $competenceCriteriaId;
    public $competenceUnits;
    public $competenceElements;
    public $competenceCriterias;
    public $question;

    protected $rules = [
        'competenceCriteriaId'  => 'required',
        'competenceElementId'   => 'required',
        'competenceUnitId'      => 'required',
        'question'              => 'required',
    ];

    protected $validationAttributes = [
        'competenceCriteriaId'  => 'Kriteria untuk Kerja',
        'competenceElementId'   => 'Elemen',
        'competenceUnit'        => 'Unit Kompetensi',
        'question'              => 'Pertanyaan',
    ];

    public function mount()
    {
        $this->competenceUnits      = CompetenceUnit::all();
        $this->competenceElements   = [];
        $this->competenceCriterias  = [];
    }

    public function updatedCompetenceUnitId()
    {
        $this->competenceElementId  = '';
        $this->competenceCriteriaId = '';
        $this->competenceCriterias  = [];
        $this->competenceElements   = CompetenceElement::where('competence_unit_id', $this->competenceUnitId)->get();
    }

    public function updatedCompetenceElementId()
    {
        $this->competenceCriteriaId = '';
        $this->competenceCriterias  = CompetenceCriteria::where('competence_element_id', $this->competenceElementId)->get();
    }

    public function save()
    {
        $this->validate();

        $testPractice = TestObservation::create([
            'participant_user_id'   => $this->testSchedule->participant_user_id,
            'assessor_user_id'      => $this->testSchedule->assessor_user_id,
            'test_schedule_id'      => $this->testSchedule->id,
            'competence_criteria_id' => $this->competenceCriteriaId,
            'question'              => $this->question,
        ]);

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Pertanyaan berhasil dibuat!',
            $message = 'Pertanyaan Tugas Observasi dengan ID ' . $testPractice->id . ' berhasil ditambahkan',
            $type = 'success'
        );

        $this->emitTo(TestObservationTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.modals.test.create-test-observation-modal');
    }
}
