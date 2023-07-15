<x-mail::message>
    # {{ __('Congratulations! You are registered as participant')}}

    Dear, {{ $user->name }}
    Terima kasih telah membuat akun sebagai asesi di LSP HCMI. Silakan login menggunakan username dan password yang
    sudah dibuat.

    <x-mail::button :url="$url">
        Login Sekarang
    </x-mail::button>

    {{ __('Thanks,') }}
    {{ config('app.name') }}
</x-mail::message>