<div>
    <div class="bg-white p-4 sm:px-6 sm:py-4 border-b border-gray-150">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ __('Isi Hasil Laporan Kompetensi') }}
        </h3>
    </div>

    <div class="bg-white text-sm sm:p-6">
        <p>Saya yang menyatakan di bawah ini:</p>

        <br>
        <table class="table w-full">
            <tbody>
                <tr>
                    <th class="p-1 w-1/5">Nama</th>
                    <td class="p-1 w-4/5">: {{ $testSchedule->assessor->name }}</td>
                </tr>
                <tr>
                    <th class="p-1 w-1/5">Email</th>
                    <td class="p-1 w-4/5">: {{ $testSchedule->assessor->email }}</td>
                </tr>
            </tbody>
        </table>
        <br>

        <p>Adalah benar seorang asesor dan menyatakan dengan ini bahwa asesi atas nama:</p>

        <br>
        <table class="table w-full">
            <tbody>
                <tr>
                    <th class="p-1 w-1/5 align-top">Nama</th>
                    <td class="p-1 w-4/5 align-top">: {{ $testSchedule->participant->name }}</td>
                </tr>
                <tr>
                    <th class="p-1 w-1/5 align-top">Email</th>
                    <td class="p-1 w-4/5 align-top">: {{ $testSchedule->participant->email }}</td>
                </tr>
                <tr>
                    <th class="p-1 w-1/5 align-top">Skema Sertifikasi</th>
                    <td class="p-1 w-4/5 align-top">: {{ $participant->scheme->name }}</td>
                </tr>
            </tbody>
        </table>
        <br>

        <p>Telah menjalankan seluruh rangkaian dan tahapan asesmen dan dengan ini pula merekomendasikan:</p>

        <br>
        <select id="result" wire:model="result"
            class="block text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm @error('result') border-red-500 @enderror">
            <option value="">-- Pilih Rekomendasi --</option>
            <option value="K">Kompeten</option>
            <option value="BK">Belum Kompeten</option>
        </select>
        <br>

        <p>Dengan catatan (opsional):</p>

        <br>
        <textarea id="note" wire:model="note"
            class="w-full h-20 text-sm border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm @error('note') border-red-500 @enderror"></textarea>
        <br><br>

        <p>Demikianlah, laporan hasil kompetensi ini untuk selanjutnya diverifikasi dan disahkan oleh yang berwenang.
        </p>
    </div>

    <div class="bg-gray-50 p-3 sm:flex justify-end">
        <button
            class="px-3 py-2 bg-purple-500 hover:bg-purple-600 border rounded text-white text-sm font-bold inline-flex items-center"
            wire:click="submit()">
            <span class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd" />
                </svg>
            </span>
            <span>
                {{ __('Submit Laporan') }}
            </span>
        </button>
    </div>
</div>