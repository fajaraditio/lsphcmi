<div>
    @if ($type)
    <div class="flex items-center p-4 mb-4 text-sm text-{{ $color }}-800 rounded-lg bg-{{ $color }}-50 dark:bg-gray-800 dark:text-{{ $color }}-400"
        role="alert">
        <span class="mr-3">{{ $icon }}</span>
        <span class="sr-only">Icon</span>
        <div>
            <span class="font-medium">{{ $title }}</span> {{ $message }}
        </div>
    </div>
    @endif
</div>