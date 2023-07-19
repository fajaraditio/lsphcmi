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
        return TestSchedule::query()
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
            ->join('test_sessions', 'test_sessions.id', '=', 'test_schedules.test_session_id')
            ->where('assessor_users.id', auth()->user()->id);
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
            ->addColumn('test_scheduled_at_formatted', fn ($model) => Carbon::parse($model->scheduled_at)->translatedFormat('l, j F Y'))
            ->addColumn('test_session', fn ($model) => $model->test_session_name . ' (' . Carbon::parse($model->test_session_started_at)->format('H:i') . ' - ' . Carbon::parse($model->test_session_ended_at)->format('H:i') . ')');
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
            Button::make('testAgreement', 'Buka')
                ->caption('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                <path d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                </svg>')
                ->class('inline-block bg-green-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
                ->route('assessor.test.agreement', ['testSchedule' => 'id'])
                ->target('_self')
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

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($test-schedule) => $test-schedule->id === 1)
                ->hide(),
        ];
    }
    */
}
