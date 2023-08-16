<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-6 text-sm text-gray-900">
                    <span>Halo, {{ auth()->user()->name }} 👋</span>
                </div>

                @if ($role === 'chief')
                <div
                    class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-4 dark:text-white sm:p-8">
                    <div class="shadow shadow-gray-400/100 flex flex-col items-center justify-center rounded p-5">
                        <div class="mb-2 text-5xl font-extrabold text-red-500">{{ $participantCount }}</div>
                        <div class="text-gray-500 dark:text-gray-400">Asesi</div>
                    </div>
                    <div class="shadow shadow-gray-400/100 flex flex-col items-center justify-center rounded p-5">
                        <div class="mb-2 text-5xl font-extrabold text-red-500">{{ $assessorCount }}</div>
                        <div class="text-gray-500 dark:text-gray-400">Asesor</div>
                    </div>
                    <div class="shadow shadow-gray-400/100 flex flex-col items-center justify-center rounded p-5">
                        <div class="mb-2 text-5xl font-extrabold text-red-500">{{ $scheduledParticipantCount }}</div>
                        <div class="text-gray-500 dark:text-gray-400">Jadwal Uji Kompetensi</div>
                    </div>
                    <div class="shadow shadow-gray-400/100 flex flex-col items-center justify-center rounded p-5">
                        <div class="mb-2 text-5xl font-extrabold text-red-500">{{ $certifiedParticipantCount }}</div>
                        <div class="text-gray-500 dark:text-gray-400">Asesi Tersertifikasi</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>