@php
    $pending = $hasPendingChange ?? false;
    $tpl = $templateNumber ?? (int) $portfolio->selected_template;
@endphp

@if($portfolio->status === 'saved' && ! $pending)
    <span class="pf-btn pf-btn-saved">✓ Saved</span>
@else
    <form method="POST" action="{{ route('portfolio.save', $portfolio->id) }}" class="pf-save-form">
        @csrf
        <input type="hidden" name="template" value="{{ $tpl }}">
        <button type="submit" class="pf-btn pf-btn-outline pf-save-btn">
            {{ $portfolio->status === 'saved' ? 'Save Changes' : 'Save Portfolio' }}
        </button>
    </form>
@endif