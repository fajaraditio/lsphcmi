<?php

namespace App\Http\Livewire\Modals\Test;

use App\Http\Livewire\Components\Alert;
use App\Http\Livewire\Tables\Test\TestPracticeTable;
use App\Models\CompetenceCriteria;
use App\Models\CompetenceElement;
use App\Models\CompetenceUnit;
use App\Models\TestPractice;
use LivewireUI\Modal\ModalComponent;

class EditTestPracticeCaseModal extends ModalComponent
{
    public TestPractice $testPractice;
    public $testSchedule;
    public $competenceUnitId;
    public $competenceElementId;
    public $competenceCriteriaId;
    public $competenceUnits;
    public $competenceElements;
    public $competenceCriterias;
    public $case;

    protected $rules = [
        'competenceCriteriaId'  => 'required',
        'competenceElementId'   => 'required',
        'competenceUnitId'      => 'required',
        'case'                  => 'required',
    ];

    protected $validationAttributes = [
        'competenceCriteriaId'  => 'Kriteria untuk Kerja',
        'competenceElementId'   => 'Elemen',
        'competenceUnit'        => 'Unit Kompetensi',
        'case'                  => 'Kasus',
    ];

    public function mount()
    {
        $this->testSchedule         = $this->testPractice->test_schedule;
        $this->competenceUnits      = CompetenceUnit::all();
        $this->competenceUnitId     = $this->testPractice->competence_criteria->competence_element->competence_unit_id;
        $this->competenceCriterias  = CompetenceCriteria::where('competence_element_id', $this->testPractice->competence_criteria->competence_element_id)->get();
        $this->competenceCriteriaId = $this->testPractice->competence_criteria_id;
        $this->competenceElements   = CompetenceElement::where('competence_unit_id', $this->testPractice->competence_criteria->competence_element->competence_unit_id)->get();
        $this->competenceElementId  = $this->testPractice->competence_criteria->competence_element_id;
        $this->case = $this->testPractice->case;
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

        TestPractice::where('id', $this->testPractice->id)
            ->update([
                'participant_user_id'   => $this->testSchedule->participant_user_id,
                'assessor_user_id'      => $this->testSchedule->assessor_user_id,
                'test_schedule_id'      => $this->testSchedule->id,
                'competence_criteria_id' => $this->competenceCriteriaId,
                'case'                  => $this->case,
            ]);

        $this->emitTo(
            Alert::class,
            'sendAlert',
            $title = 'Kasus berhasil diedit!',
            $message = 'Kasus Tugas Praktik dengan ID ' . $this->testPractice->id . ' berhasil diedit',
            $type = 'success'
        );

        $this->emitTo(TestPracticeTable::class, 'pg:eventRefresh-default');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public function render()
    {
        return view('livewire.modals.test.edit-test-practice-case-modal');
    }
}
