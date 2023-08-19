<?php

namespace App\Http\Livewire\Tables\Test;

use App\Models\TestReport;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TestReportTable extends PowerGridComponent
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
        $testReport = TestReport::query()
            ->select(
                DB::raw('test_reports.*'),
                DB::raw('participant_users.name AS participant_name'),
                DB::raw('assessor_users.name AS assessor_name'),
                DB::raw('test_schedules.assessor_submitted_report_at'),
                DB::raw('test_schedules.chief_approved_report_at'),
            )
            ->join('test_schedules', 'test_schedules.id', '=', 'test_reports.test_schedule_id')
            ->join(DB::raw('users AS participant_users'), 'participant_users.id', '=', 'test_schedules.participant_user_id')
            ->join(DB::raw('users AS assessor_users'), 'assessor_users.id', '=', 'test_schedules.assessor_user_id');

        if (auth()->user()->role->slug === 'certification') {
            $testReport = $testReport->whereNotNull('test_schedules.chief_approved_report_at');
        }

        return $testReport;
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
            ->addColumn('participant_name')
            ->addColumn('assessor_name')
            ->addColumn('assessor_submitted_report_at', fn (TestReport $model) => Carbon::parse($model->created_at)->translatedFormat('l, j F Y'))
            ->addColumn('chief_approval_status', function (TestReport $model) {
                if (!empty($model->chief_approved_report_at)) {
                    return '<div class="bg-blue-100 text-blue-800 text-xs text-center font-medium mr-2 px-2.5 py-1.5 rounded-full dark:bg-blue-900 dark:text-blue-300">Terverifikasi</div>';
                } else {
                    return '<div class="bg-yellow-100 text-yellow-800 text-xs text-center font-medium mr-2 px-2.5 py-1.5 rounded-full dark:bg-yellow-900 dark:text-yellow-300">Belum Diverifikasi</div>';
                }
            })
            ->addColumn('bnsp_certificate', function (TestReport $model) {
                if (empty($model->bnsp_certificate)) {
                    return '-';
                } else {
                    $url = url('storage/' . $model->bnsp_certificate);
                    return '<a href="' . $url . '" class="text-blue-500 hover:text-blue-700 hover:underline capitalize">[' . ($model->bnsp_certificate_number ?? 'Lihat Sertifikat') . ']</a>';
                }
            })
            ->addColumn('result', fn (TestReport $model) => $model->result === 'K' ? 'Kompeten' : 'Belum Kompeten')
            ->addColumn('created_at_formatted', fn (TestReport $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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

            Column::make('Tanggal Laporan', 'assessor_submitted_report_at')
                ->bodyAttribute('w-1/6')
                ->searchable()
                ->sortable(),

            Column::make('Status Verifikasi', 'chief_approval_status')
                ->bodyAttribute('w-1/6')
                ->searchable()
                ->sortable(),

            Column::make('Asesi', 'participant_name')
                ->bodyAttribute('w-1/6')
                ->searchable()
                ->sortable(),

            Column::make('Asesor', 'assessor_name')
                ->bodyAttribute('w-1/6')
                ->searchable()
                ->sortable(),

            Column::make('Rekomendasi', 'result')
                ->bodyAttribute('w-1/6 font-bold uppercase')
                ->searchable()
                ->sortable(),

            Column::make('Sertifikat BNSP', 'bnsp_certificate')
                ->bodyAttribute('w-1/6 font-bold uppercase')
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
     * PowerGrid TestReport Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('detail', 'Lihat Detail')
                ->caption('
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                    </svg>              
                    ')
                ->class('inline-block bg-teal-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->target('_self')
                ->route('chief.test.report', ['testReport' => 'id']),

            Button::make('file', 'Berkas Hasil Laporan')
                ->caption('
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>                              
                ')
                ->class('inline-block bg-blue-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->openModal('modals.test.view-test-report-pdf-modal', ['testReport' => 'id']),

            Button::make('upload-bnsp', 'Unggah Sertifikat')
                ->caption('
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15" />
              </svg>
                                        
                ')
                ->class('inline-block bg-yellow-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->openModal('modals.test.submit-bnsp-certificate-modal', ['testReport' => 'id'])
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

    public function actionRules(): array
    {
        return [
            Rule::button('detail')
                ->when(function ($testReport) {
                    if (auth()->user()->role->slug !== 'chief') {
                        return true;
                    }

                    return false;
                })
                ->hide(),

            Rule::button('file')
                ->when(function ($testReport) {
                    if (auth()->user()->role->slug !== 'certification') {
                        return true;
                    }

                    return false;
                })
                ->hide(),

            Rule::button('upload-bnsp')
                ->when(function ($testReport) {
                    if (auth()->user()->role->slug !== 'certification') {
                        return true;
                    }

                    return false;
                })
                ->hide(),
        ];
    }
}
