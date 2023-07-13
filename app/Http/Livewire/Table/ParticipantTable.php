<?php

namespace App\Http\Livewire\Table;

use App\Models\Participant;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ParticipantTable extends PowerGridComponent
{
    use ActionButton;

    public $index = 0;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

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
     * @return Builder<\App\Models\Participant>
     */
    public function datasource(): Builder
    {
        return Participant::query()
            ->select('participants.*', DB::raw('schemes.name scheme_name'))
            ->join('schemes', 'schemes.id', '=', 'participants.scheme_id');
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
        $this->index = $this->page > 1 ? ($this->page - 1) * $this->perPage : 0;

        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('no', fn () => ++$this->index)
            ->addColumn('name')
            ->addColumn('name_lower', fn (Participant $model) => strtolower(e($model->name)))
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Participant $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
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
            Column::make('No. Peserta', 'bib_number')
                ->searchable()
                ->sortable(),

            Column::make('Nama', 'name')
                ->searchable()
                ->sortable(),

            Column::make('NIK / Paspor / KTP', 'identity_number')
                ->searchable()
                ->sortable(),

            Column::make('Email', 'email')
                ->searchable()
                ->sortable(),

            Column::make('Skema Pilihan', 'scheme_name'),

            Column::make('Tujuan Asesmen', 'assessment_purpose')
                ->searchable()
                ->sortable(),

            Column::make('Dibuat pada', 'created_at_formatted', 'created_at')
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
     * PowerGrid Participant Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('participant.edit', ['participant' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('participant.destroy', ['participant' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Participant Action Rules.
     *
     * @return array<int, RuleActions>
     */

    public function actionRules(): array
    {
        return [

            //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn ($participant) => $participant->id === 1)
                ->hide(),
        ];
    }
}
