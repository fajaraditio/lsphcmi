<?php

namespace App\Http\Livewire\Tables\Test;

use App\Models\TestObservation;
use App\Models\TestSchedule;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TestObservationTable extends PowerGridComponent
{
    use ActionButton;

    public TestSchedule $testSchedule;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function header(): array
    {
        if (auth()->user()->role->slug === 'assessor') {
            if (empty($this->testSchedule->assessor_submitted_test_practice_at)) {
                return [
                    Button::add('create-question')
                        ->caption('Buat Pertanyaan')
                        ->class('block w-full bg-red-500 text-white border border-red-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-red-500 focus:text-red-500 dark:border-red-500 dark:bg-red-600 2xl:dark:placeholder-slate-300 dark:text-slate-200 dark:text-slate-300 sm:text-sm')
                        ->openModal('modals.test.create-test-observation-modal', ['testSchedule' => $this->testSchedule->id]),

                    Button::add('submit-test-observation')
                        ->caption('Submit Form Tugas Observasi')
                        ->class('block w-full bg-orange-500 text-white border border-orange-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-red-500 focus:text-red-500 dark:border-orange-500 dark:bg-orange-600 2xl:dark:placeholder-slate-300 dark:text-slate-200 dark:text-slate-300 sm:text-sm')
                        ->openModal('modals.test.submit-test-observation-modal', ['testSchedule' => $this->testSchedule->id]),
                ];
            } else if (empty($this->testSchedule->assessor_reviewed_test_observation_at) && !empty($this->testSchedule->participant_responded_test_observation_at)) {
                return [
                    Button::add('submit-review-practice')
                        ->caption('Submit Penilaian Tugas Observasi')
                        ->class('block w-full bg-purple-500 hover:bg-purple-700 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                        ->openModal('modals.test.submit-review-test-observation-modal', ['testSchedule' => $this->testSchedule->id]),
                ];
            }

            return [];
        } else if (auth()->user()->role->slug === 'participant') {
            if (empty($this->testSchedule->participant_responded_test_observation_at)) {
                return [
                    Button::add('submit-response-test-observation')
                        ->caption('Submit Jawaban Tugas Praktik')
                        ->class('block w-full bg-orange-500 text-white border border-orange-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-red-500 focus:text-red-500 dark:border-orange-500 dark:bg-orange-600 2xl:dark:placeholder-slate-300 dark:text-slate-200 dark:text-slate-300 sm:text-sm')
                        ->openModal('modals.test.submit-response-test-observation-modal', ['testSchedule' => $this->testSchedule->id]),
                ];
            }

            return [];
        }

        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\TestObservation>
     */
    public function datasource(): Builder
    {
        return TestObservation::query()
            ->select(
                DB::raw('test_observations.id'),
                DB::raw('competence_units.title AS competence_unit_title'),
                DB::raw('competence_elements.title AS competence_element_title'),
                DB::raw('competence_criterias.title AS competence_criteria_title'),
                DB::raw('test_observations.*'),
            )
            ->join('competence_criterias', 'competence_criterias.id', '=', 'test_observations.competence_criteria_id')
            ->join('competence_elements', 'competence_elements.id', '=', 'competence_criterias.competence_element_id')
            ->join('competence_units', 'competence_units.id', '=', 'competence_elements.competence_unit_id');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('name_lower', fn (TestObservation $model) => strtolower(e($model->name)))
            ->addColumn('response_status', fn (TestObservation $model) => !empty($model->response) ? '<span class="font-bold text-green-700">Y</span>' : '<span class="font-bold text-red-700">T</span>')
            ->addColumn('result', fn (TestObservation $model) => $model->result === 'BK' ? '<span class="font-bold uppercase text-red-500">Belum Kompeten</span>' : '<span class="font-bold uppercase text-green-500">Kompeten</span>')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (TestObservation $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

    /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        if (auth()->user()->role->slug === 'participant') {
            return [
                Column::make('ID', 'id')
                    ->searchable()
                    ->sortable(),

                Column::make('Kriteria untuk Kerja', 'competence_criteria_title')
                    ->bodyAttribute('w-1/6')
                    ->searchable()
                    ->sortable(),

                Column::make('Pertanyaan', 'question')
                    ->bodyAttribute('w-2/6')
                    ->searchable()
                    ->sortable(),

                Column::make('Sudah Menjawab (Y / T)', 'response_status')
                    ->bodyAttribute('w-1/6 text-center')
                    ->searchable()
                    ->sortable(),

                Column::make('Kompetensi', 'result')
                    ->bodyAttribute('w-1/6 text-center')
                    ->searchable()
                    ->sortable(),
            ];
        } else if (auth()->user()->role->slug === 'assessor') {
            return [
                Column::make('ID', 'id')
                    ->searchable()
                    ->sortable(),

                Column::make('Kriteria untuk Kerja', 'competence_criteria_title')
                    ->bodyAttribute('w-2/6')
                    ->searchable()
                    ->sortable(),

                Column::make('Pertanyaan', 'question')
                    ->bodyAttribute('w-2/6')
                    ->searchable()
                    ->sortable(),

                Column::make('Kompetensi', 'result')
                    ->bodyAttribute('w-1/6 text-center')
                    ->searchable()
                    ->sortable(),
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid TestObservation Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        if (auth()->user()->role->slug === 'assessor') {
            if (empty($this->testSchedule->assessor_submitted_test_practice_at)) {
                return [
                    Button::make('edit', 'Edit')
                        ->class('block w-full bg-green-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                        ->openModal('modals.test.edit-test-observation-modal', ['testObservation' => 'id']),

                    Button::make('destroy', 'Hapus')
                        ->class('block w-full bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                        ->openModal('modals.test.destroy-test-observation-modal', ['testObservation' => 'id'])
                ];
            } else if (empty($this->testSchedule->assessor_reviewed_test_observation_at) && !empty($this->testSchedule->participant_responded_test_observation_at)) {
                return [
                    Button::make('review', 'Beri Penilaian')
                        ->class('block w-full bg-orange-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                        ->openModal('modals.test.review-test-observation-modal', ['testObservation' => 'id'])
                ];
            }

            return [];
        } else if (auth()->user()->role->slug === 'participant') {
            if (empty($this->testSchedule->participant_responded_test_observation_at)) {
                return [
                    Button::make('response', 'Jawab')
                        ->class('block w-full bg-purple-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                        ->openModal('modals.test.respond-test-observation-modal', ['testObservation' => 'id']),
                ];
            }

            return [];
        }

        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid TestObservation Action Rules.
     *
     * @return array<int, RuleActions>
     */

    public function actionRules(): array
    {
        return [
            Rule::button('edit')
                ->when(fn ($testObservation) => $testObservation->status === 'locked')
                ->hide(),

            Rule::button('destroy')
                ->when(fn ($testObservation) => $testObservation->status === 'locked')
                ->hide(),
        ];
    }
}
