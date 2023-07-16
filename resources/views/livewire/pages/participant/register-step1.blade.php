<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Memilih Skema')}}
            </h2>
            <p>{{ __('Memilih salah satu skema sertifikasi yang akan diujikan') }}</p>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg my-2">

                <div id="form-wizard" class="p-8">
                    @livewire('components.step-wizard', ['stepWizards' => $stepWizards, 'currentStep' => $currentStep])

                    @foreach ($schemes as $scheme)
                    <ul>
                        <li class="border-1 border-b border-gray-100 py-2">
                            <button wire:click="save({{ $scheme->id }})" class="hover:underline">
                                {{ $scheme->name }}
                            </button>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>