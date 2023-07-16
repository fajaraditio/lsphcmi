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
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-6 text-sm text-gray-900">

                    @livewire('components.alert')
                </div>
            </div>
        </div>
    </div>
</div>