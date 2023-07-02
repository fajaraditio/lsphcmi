<div id="step-wizard" class="mb-5 py-3 border-b border-gray-100">
    <ol class="flex justify-between items-center w-full">
        @foreach ($stepWizards as $step => $wizard)
        <li class="{{ $stepStyles[$step]['step_class'] }}">
            <span class="{{ $stepStyles[$step]['step_span_class'] }}">
                <small>{{ $wizard['label'] }}</small>
            </span>
        </li>
        @endforeach
    </ol>

    <ol class="flex justify-between items-center w-full text-sm text-center">
        @foreach ($stepWizards as $step => $wizard)
        <li class="{{ $stepStyles[$step]['wizard_class'] }}">
            <span>
                {{ $wizard['attr'] }}
            </span>
        </li>
        @endforeach
    </ol>
</div>