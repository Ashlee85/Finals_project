@php
    $steps = [1 => 'Your Information', 2 => 'Choose Template', 3 => 'Review & Save'];
@endphp

<div class="pf-progress" aria-label="Portfolio creation progress">
    @foreach($steps as $number => $label)
        <div class="pf-step {{ $number < $step ? 'done' : ($number === $step ? 'active' : '') }}">
            <span>{{ $number < $step ? '✓' : $number }}</span>
            <small>{{ $label }}</small>
        </div>
        @if(! $loop->last)
            <div class="pf-step-line {{ $number < $step ? 'done' : '' }}"></div>
        @endif
    @endforeach
</div>