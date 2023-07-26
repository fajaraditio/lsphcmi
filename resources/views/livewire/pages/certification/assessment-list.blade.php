<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Arsip Hasil Laporan Asesmen') }}
            </h2>
            <p>Rekap laporan hasil asesmen yang sudah diverifikasi</p>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-sm overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-8">

                    @if (session()->has('message'))
                    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-gray-800 dark:text-green-400"
                        role="alert">
                        <span class="mr-3">✅</span>
                        <span class="sr-only">Icon</span>
                        <div>
                            {{ session('message') }}
                        </div>
                    </div>
                    @endif

                    @livewire('tables.test.test-report-table')
                </div>
            </div>
        </div>
    </div>
</div>