<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Submit Penilaian') }}
        </h3>
    </div>

    <div class="bg-white text-sm sm:p-6">
        @foreach ($scoringComponents as $scoringComponent)
        <div class="w-full mb-3">
            <x-input-label for="testScore_{{ $scoringComponent->id }}" :value="__($scoringComponent->title)">
            </x-input-label>
            <select id="testScore_{{ $scoringComponent->id }}"
                wire:model="testScore.{{ $scoringComponent->id }}.scoring_criteria_id"
                class="w-1/2 block mt-2 text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm @error('testScore.' . $scoringComponent->id . '.scoring_criteria_id') border-red-500 @enderror">
                <option value="">-- Pilih Kriteria --</option>
                @foreach ($scoringComponent->scoring_criterias as $scoringCriteria)
                <option value="{{ $scoringCriteria->id }}">{{ $scoringCriteria->title }} (Skor: {{
                    $scoringCriteria->score }})</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('testScore.' . $scoringComponent->id . '.scoring_criteria_id')"
                class="mt-2" />
        </div>
        @endforeach

        <hr class="my-3">

        <div class="w-full mb-3">
            <h3 class="font-medium">Hasil Perhitungan Nilai</h3>
            <table class="table-auto border border-collapse border-slate-400">
                <thead>
                    <tr>
                        <th class="border border-slate-400 py-3 px-2">Komponen</th>
                        <th class="border border-slate-400 py-3 px-2">Skor</th>
                        <th class="border border-slate-400 py-3 px-2">Bobot</th>
                        <th class="border border-slate-400 py-3 px-2">Skor x Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $scorings = 0;
                    @endphp
                    @foreach ($scoringComponents as $scoringComponent)
                    @php
                    $score = empty($testScore[$scoringComponent->id]) ? 0 : $testScore[$scoringComponent->id]['score'];
                    $weight = empty($testScore[$scoringComponent->id]) ? 0 :
                    $testScore[$scoringComponent->id]['weight'];
                    $scoreXweight = empty($testScore[$scoringComponent->id]) ? 0 : ((float) $score * (float) $weight);
                    $scorings += $scoreXweight;
                    @endphp
                    <tr>
                        <td class="border border-slate-400 py-3 px-2">{{ $scoringComponent->title }}</td>
                        <td class="border border-slate-400 py-3 px-2">
                            {{ $score }}
                        </td>
                        <td class="border border-slate-400 py-3 px-2">
                            {{ $weight }}
                        </td>
                        <td class="border border-slate-400 py-3 px-2">
                            {{ $scoreXweight }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="font-bold border border-slate-400 py-3 px-2">Maksimal Skor: {{ $maxScore
                            }}</td>
                        <td class="border border-slate-400 py-3 px-2">Total Skor</td>
                        <td class="font-bold border border-slate-400 py-3 px-2">{{ $scorings }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="border border-slate-400 py-3 px-2">Persentase</td>
                        <td class="font-bold border border-slate-400 py-3 px-2">{{ number_format($scorings / $maxScore *
                            100, 2)
                            }}%</td>
                    </tr>
                    <tr>
                        <td colspan="3" class=" border border-slate-400 py-3 px-2">Rekomendasi</td>
                        <td class="font-bold border border-slate-400 py-3 px-2">{{ number_format($scorings / $maxScore *
                            100, 2) >= $minPercentage ? 'Kompeten' : 'Belum Kompeten'
                            }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <hr class="my-3">

        <div class="w-full mb-3">
            <x-input-label for="note" :value="__('Catatan')">
            </x-input-label>
            <textarea id="note" wire:model="note"
                class="w-full h-20 text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm @error('note') border-red-500 @enderror"></textarea>
        </div>
    </div>

    <div class="bg-gray-50 p-3 sm:flex justify-end">
        <button
            class="px-3 py-2 bg-red-500 hover:bg-red-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="submit()">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                {{ __('Submit Penilaian') }}
            </span>
        </button>
    </div>
</div>