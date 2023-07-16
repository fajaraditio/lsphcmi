<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $stepWizards[$currentStep - 1]['attr'] }}
            </h2>
            <p>{{ $stepWizards[$currentStep - 1]['desc'] }}</p>
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
                            <button wire:click="save({{ $scheme->id }})"
                                class="hover:underline @if (!empty($participant) && $participant->scheme->id == $scheme->id) font-bold text-red-500 @endif">
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