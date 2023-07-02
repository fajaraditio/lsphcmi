@props(['disabled' => false, 'options' => []])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-red-500
    focus:ring-red-500 rounded-md shadow-sm']) !!}>
    @foreach ($options as $option)
    <option :value="$option['value']">{{ $option['attr'] }}</option>
    @endforeach
</select>