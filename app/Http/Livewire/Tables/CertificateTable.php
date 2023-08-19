<?php

namespace App\Http\Livewire\Tables;

use App\Models\TestReport;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class CertificateTable extends PowerGridComponent
{
    use ActionButton;

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
     * @return Builder<\App\Models\TestReport>
     */
    public function datasource(): Builder
    {
        return TestReport::query()
            ->select(
                DB::raw('test_reports.*'),
                DB::raw('participant_users.name AS participant_name'),
                DB::raw('assessor_users.name AS assessor_name'),
                DB::raw('test_schedules.assessor_submitted_report_at'),
                DB::raw('test_schedules.chief_approved_report_at'),
            )
            ->join('test_schedules', 'test_schedules.id', '=', 'test_reports.test_schedule_id')
            ->join(DB::raw('users AS participant_users'), 'participant_users.id', '=', 'test_schedules.participant_user_id')
            ->join(DB::raw('users AS assessor_users'), 'assessor_users.id', '=', 'test_schedules.assessor_user_id')
            ->whereNotNull('bnsp_certificate');
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
            ->addColumn('name_lower', fn (TestReport $model) => strtolower(e($model->name)))
            ->addColumn('result', fn (TestReport $model) => $model->result === 'K' ? 'Kompeten' : 'Belum Kompeten')
            ->addColumn('bnsp_certificate_date', fn (TestReport $model) => Carbon::parse($model->bnsp_certificate_date)->translatedFormat('j F Y'))
            ->addColumn('bnsp_certificate_valid_thru', fn (TestReport $model) => Carbon::parse($model->bnsp_certificate_valid_thru)->translatedFormat('j F Y'))
            ->addColumn('bnsp_certificate_status', function (TestReport $model) {
                if (Carbon::now()->gt(Carbon::parse($model->bnsp_certificate_valid_thru))) {
                    return '<div class="bg-red-100 text-red-800 text-xs text-center font-medium mr-2 px-2.5 py-1.5 rounded-full dark:bg-red-900 dark:text-red-300">Kadaluarsa</div>';
                } else {
                    return '<div class="bg-green-100 text-green-800 text-xs text-center font-medium mr-2 px-2.5 py-1.5 rounded-full dark:bg-green-900 dark:text-green-300">Masih Berlaku</div>';
                }
            });
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
            Column::make('No. Sertifikat', 'bnsp_certificate_number')
                ->searchable()
                ->sortable(),

            Column::make('Status', 'bnsp_certificate_status')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'participant_name')
                ->searchable()
                ->bodyAttribute('uppercase')
                ->sortable(),

            Column::make('Kompetensi', 'result')
                ->searchable()
                ->bodyAttribute('font-bold uppercase')
                ->sortable(),

            Column::make('Tanggal Sertifikat', 'bnsp_certificate_date')
                ->bodyAttribute('w-1/7')
                ->searchable(),

            Column::make('Berlaku Sampai', 'bnsp_certificate_valid_thru')
                ->bodyAttribute('w-1/7')
                ->searchable()
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
     * PowerGrid TestReport Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('view', 'Detail')
                ->class('bg-red-500 hover:bg-red-700 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
                ->openModal('modals.view-certificate-modal', ['testReport' => 'id']),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid TestReport Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($test-report) => $test-report->id === 1)
                ->hide(),
        ];
    }
    */
}
