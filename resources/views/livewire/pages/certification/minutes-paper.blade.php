<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Minutes Paper') }}
            </h2>
            <p>{{ __('Berita Acara Pada Tanggal :value', ['value' => Carbon\Carbon::parse($date)->translatedFormat('l, j
                F Y')]) }}</p>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-sm overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-8">
                    <div class="mb-3">
                        <x-input-label for="select_date">Pilih Tanggal Berita Acara</x-input-label>
                        <x-text-input type="date" class="text-sm" id="select_date" wire:model="date"></x-text-input>
                    </div>

                    <hr>

                    <div class="my-3">
                        <button
                            class="px-3 py-2 bg-blue-500 hover:bg-blue-600 border rounded text-white text-sm font-bold inline-flex items-center"
                            id="printPageBtn">
                            <span class="mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                </svg>
                            </span>
                            <span>
                                {{ __('Cetak Berita Acara') }}
                            </span>
                        </button>
                    </div>

                    <iframe src="{{ route('minutes-paper.pdf', ['date' => $date]) }}" name="viewReportPdf"
                        frameborder="0" class="border border-slate-200 w-full h-96"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let printPageBtn = document.getElementById('printPageBtn')

    printPageBtn.addEventListener('click', function () {
        window.frames['viewReportPdf'].focus()
        window.frames['viewReportPdf'].print()
    })
</script>