@props(['disabled' => false, 'options' => [], 'error' => false])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-red-500
    focus:ring-red-500 rounded-md shadow-sm ' . ($error ? 'border-red-500' : '')]) !!}>
    @foreach ($options as $option)
    <option :value="$option['value']">{{ $option['attr'] }}</option>
    @endforeach
</select>