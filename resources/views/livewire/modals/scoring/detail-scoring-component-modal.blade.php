<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Detail Komponen Penilaian') }}
        </h3>
    </div>

    <div class="bg-white text-sm sm:p-6">
        <div class="py-3">
            <table class="table-auto w-auto border-collapse border border-slate-400">
                <tbody>
                    <tr>
                        <th class="px-3 py-2 border border-slate-400">Judul Komponen Penilaian</th>
                        <td class="px-3 py-2 border border-slate-400" ƒ>{{ $scoringComponent->title }}</td>
                    </tr>
                    <tr>
                        <th class="px-3 py-2 border border-slate-400">Bobot Penilaian</th>
                        <td class="px-3 py-2 border border-slate-400">{{ $scoringComponent->weight }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr class="my-2">

        @livewire('components.alert')

        @livewire('tables.scoring.scoring-criteria-table', ['scoringComponent' => $scoringComponent])
    </div>
</div>