@props(['step' => 1, 'totalSteps' => 3, 'label' => ''])

<div class="wizard-progress-header">
    <div class="wizard-progress-track">
        @for ($i = 1; $i <= $totalSteps; $i++)
            <div class="wizard-progress-segment {{ $i <= $step ? 'wizard-progress-segment-filled' : '' }}"></div>
        @endfor
    </div>
    <span class="wizard-progress-count">{{ $step }} / {{ $totalSteps }}</span>
</div>

<span class="wizard-step-tag">Step {{ $step }} of {{ $totalSteps }}{{ $label ? ' — ' . $label : '' }}</span>