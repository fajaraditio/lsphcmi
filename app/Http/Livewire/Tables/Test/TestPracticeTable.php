<?php

namespace App\Http\Livewire\Tables\Test;

use App\Models\TestPractice;
use App\Models\TestSchedule;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TestPracticeTable extends PowerGridComponent
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
                    Button::add('create-case')
                        ->caption('Buat Kasus')
                        ->class('block w-full bg-red-500 text-white border border-red-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-red-500 focus:text-red-500 dark:border-red-500 dark:bg-red-600 2xl:dark:placeholder-slate-300 dark:text-slate-200 dark:text-slate-300 sm:text-sm')
                        ->openModal('modals.test.create-test-practice-case-modal', ['testSchedule' => $this->testSchedule->id]),

                    Button::add('submit-test-practice')
                        ->caption('Submit Form Tugas Praktik')
                        ->class('block w-full bg-orange-500 text-white border border-orange-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-red-500 focus:text-red-500 dark:border-orange-500 dark:bg-orange-600 2xl:dark:placeholder-slate-300 dark:text-slate-200 dark:text-slate-300 sm:text-sm')
                        ->openModal('modals.test.submit-test-practice-modal', ['testSchedule' => $this->testSchedule->id]),
                ];
            }

            return [];
        } else if (auth()->user()->role->slug === 'participant') {
            if (empty($this->testSchedule->participant_responded_test_practice_at)) {
                return [
                    Button::add('submit-response-test-practice')
                        ->caption('Submit Jawaban Tugas Praktik')
                        ->class('block w-full bg-orange-500 text-white border border-orange-200 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-red-500 focus:text-red-500 dark:border-orange-500 dark:bg-orange-600 2xl:dark:placeholder-slate-300 dark:text-slate-200 dark:text-slate-300 sm:text-sm')
                        ->openModal('modals.test.submit-response-test-practice-modal', ['testSchedule' => $this->testSchedule->id]),
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
     * @return Builder<\App\Models\TestPractice>
     */
    public function datasource(): Builder
    {
        return TestPractice::query()
            ->select(
                DB::raw('test_practices.id'),
                DB::raw('competence_units.title AS competence_unit_title'),
                DB::raw('competence_elements.title AS competence_element_title'),
                DB::raw('competence_criterias.title AS competence_criteria_title'),
                DB::raw('test_practices.*'),
            )
            ->join('competence_criterias', 'competence_criterias.id', '=', 'test_practices.competence_criteria_id')
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
            ->addColumn('name_lower', fn (TestPractice $model) => strtolower(e($model->name)))
            ->addColumn('response_file', function (TestPractice $model) {
                if (!empty($model->response_file)) {
                    return '<a href="' . url('storage/' . $model->response_file) . '" class="text-blue-500 hover:underline" target="_blank">[Lihat Berkas Jawaban]</a>';
                } else {
                    return '-';
                }
            })
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (TestPractice $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Kriteria untuk Kerja', 'competence_criteria_title')
                ->bodyAttribute('w-2/5')
                ->searchable()
                ->sortable(),

            Column::make('Kasus', 'case')
                ->bodyAttribute('w-2/5')
                ->searchable()
                ->sortable(),

            Column::make('Berkas Jawaban', 'response_file')
                ->bodyAttribute('w-1/5')
                ->searchable()
                ->sortable(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid TestPractice Action Buttons.
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
                        ->openModal('modals.test.edit-test-practice-case-modal', ['testPractice' => 'id']),

                    Button::make('destroy', 'Hapus')
                        ->class('block w-full bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                        ->openModal('modals.test.destroy-test-practice-case-modal', ['testPractice' => 'id'])
                ];
            }
        } else if (auth()->user()->role->slug === 'participant') {
            return [
                Button::make('response', 'Jawab')
                    ->class('block w-full bg-purple-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                    ->openModal('modals.test.respond-test-practice-case-modal', ['testPractice' => 'id']),
            ];
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid TestPractice Action Rules.
     *
     * @return array<int, RuleActions>
     */


    public function actionRules(): array
    {
        return [
            Rule::button('edit')
                ->when(fn ($testPractice) => $testPractice->status === 'locked')
                ->hide(),

            Rule::button('response')
                ->when(fn ($testPractice) => !empty($testPractice->test_schedule->participant_responded_test_practice_at))
                ->hide(),

            Rule::button('destroy')
                ->when(fn ($testPractice) => $testPractice->status === 'locked')
                ->hide(),
        ];
    }
}
