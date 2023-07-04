@props(['disabled' => false, 'options' => [], 'error' => false, 'value' => null])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-red-500
    focus:ring-red-500 rounded-md shadow-sm ' . ($error ? 'border-red-500' : '')]) !!}>
    @foreach ($options as $option)
    <option value="{{ $option['value'] }}" @if($value===$option['value']) selected @endif>{{ $option['attr'] }}</option>
    @endforeach
</select>