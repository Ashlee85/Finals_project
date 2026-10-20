@php
    $pending = $hasPendingChange ?? false;
    $isSaved = $portfolio->status === 'saved';
@endphp

<div class="pf-save-bar">
    @if($isSaved && ! $pending)
        <p class="pf-save-note">✓ This portfolio is saved.</p>

        <a href="{{ route('portfolio.manage') }}" class="pf-btn pf-btn-outline">
            Go to My Portfolios
        </a>
    @else
        <p class="pf-save-note">
            {{ $isSaved
                ? 'You changed the template. Click Save Changes to keep it.'
                : 'This portfolio is still a draft. Click Save to keep it.' }}
        </p>

        @include('partials.save-button')
    @endif
</div>