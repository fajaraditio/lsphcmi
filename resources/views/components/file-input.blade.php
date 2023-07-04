@props(['disabled' => false, 'error' => false, 'allowedExts' => []])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'p-2 block w-full text-sm text-gray-900 border
border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-red-400 focus:outline-none dark:bg-gray-700
dark:border-gray-600 dark:placeholder-gray-400 ' . ($error ? 'border-red-500' : '')]) !!}
aria-describedby="file_input_help" id="file_input" type="file">
<p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">{{ implode(', ', $allowedExts) }}</p>