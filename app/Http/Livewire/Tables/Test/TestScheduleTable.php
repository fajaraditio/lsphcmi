<?php

namespace App\Http\Livewire\Tables\Test;

use App\Models\TestSchedule;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class TestScheduleTable extends PowerGridComponent
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
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
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
     * @return Builder<\App\Models\TestSchedule>
     */
    public function datasource(): Builder
    {
        $testSchedule = TestSchedule::query()
            ->select(
                DB::raw('test_schedules.id'),
                DB::raw('test_schedules.scheduled_at'),
                DB::raw('participants.name AS participant_name'),
                DB::raw('participants.identity_number AS participant_identity_number'),
                DB::raw('assessor_users.name AS assessor_name'),
                DB::raw('test_sessions.name AS test_session_name'),
                DB::raw('test_sessions.started_at AS test_session_started_at'),
                DB::raw('test_sessions.ended_at AS test_session_ended_at')
            )
            ->join(DB::raw('users AS participant_users'), 'participant_users.id', '=', 'test_schedules.participant_user_id')
            ->join(DB::raw('users AS assessor_users'), 'assessor_users.id', '=', 'test_schedules.assessor_user_id')
            ->join('participants', 'participants.user_id', '=', 'participant_users.id')
            ->leftJoin('test_sessions', 'test_sessions.id', '=', 'test_schedules.test_session_id');

        if (auth()->user()->role->slug === 'assessor') $testSchedule->where('assessor_users.id', auth()->user()->id);

        return $testSchedule;
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
            ->addColumn('test_scheduled_at')
            ->addColumn('test_scheduled_at_formatted', fn ($model) => empty($model->scheduled_at) ? '-' : Carbon::parse($model->scheduled_at)->translatedFormat('l, j F Y'))
            ->addColumn('test_session', fn ($model) => empty($model->test_session_name) ? '-' : $model->test_session_name . ' (' . Carbon::parse($model->test_session_started_at)->format('H:i') . ' - ' . Carbon::parse($model->test_session_ended_at)->format('H:i') . ')');
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

            Column::make('Nama Asesi', 'participant_name')
                ->searchable()
                ->sortable(),

            Column::make('NIK / Paspor / Identitas Lainnya', 'participant_identity_number')
                ->sortable(),

            Column::make('Tanggal Asesmen', 'test_scheduled_at_formatted')
                ->sortable(),

            Column::make('Sesi Asesmen', 'test_session')
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
     * PowerGrid TestSchedule Action Buttons.
     *
     * @return array<int, Button>
     */

    public function actions(): array
    {
        return [
            Button::make('lookupTestSchedule', 'Lihat Detail')
                ->caption('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                    </svg>              
                ')
                ->tooltip('Lihat Detail')
                ->class('inline-block bg-yellow-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('assessor.test.schedule.detail', ['testSchedule' => 'id'])
                ->target('_self'),

            Button::make('edit', 'Edit Jadwal')
                ->caption('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>                         
                ')
                ->tooltip('Edit Jadwal')
                ->class('inline-block bg-green-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->openModal('modals.test.edit-test-schedule', ['testSchedule' => 'id']),
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
     * PowerGrid TestSchedule Action Rules.
     *
     * @return array<int, RuleActions>
     */

    public function actionRules(): array
    {
        return [
            Rule::button('lookupTestSchedule')
                ->when(fn () => auth()->user()->role->slug !== 'assessor')
                ->hide(),

            Rule::button('edit')->when(function ($model) {
                if (auth()->user()->role->slug !== 'manager') {
                    return true;
                } else {
                    if (!empty($model->scheduled_at) && Carbon::parse($model->scheduled_at)->lte(Carbon::now())) {
                        return true;
                    }
                }

                return false;
            })
                ->hide(),
        ];
    }
}
