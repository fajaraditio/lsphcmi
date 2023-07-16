<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Payment List') }}
            </h2>
            <p>{{ __('Daftar pembayaran asesmen (FORM APL-01)') }}</p>
        </div>
    </header>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white text-sm overflow-hidden shadow-sm sm:rounded-lg my-2">
                <div class="p-8">
                    @livewire('components.alert')

                    @livewire('tables.apl.payment-table')
                </div>
            </div>
        </div>
    </div>
</div>