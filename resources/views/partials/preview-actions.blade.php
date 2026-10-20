@unless($isPublic ?? false)
    @php
        $pending = $hasPendingChange ?? false;
        $isSaved = $portfolio->status === 'saved';
    @endphp

    <div class="pf-actions-wrap">
        @include('partials.progress', ['step' => ($isSaved && ! $pending) ? 4 : 3])

        <div class="pf-actions">
            @if($isSaved && ! $pending)
                <span class="pf-status pf-status-saved">Saved</span>
            @elseif($isSaved)
                <span class="pf-status pf-status-draft">Changes not saved yet</span>
            @else
                <span class="pf-status pf-status-draft">Draft (not saved yet)</span>
            @endif

            <a href="{{ route('portfolio.templates', $portfolio->id) }}" class="pf-btn pf-btn-primary">
                ← Change Template
            </a>
            <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="pf-btn pf-btn-accent">
                Edit Portfolio
            </a>

            @include('partials.save-button')
        </div>
    </div>
@endunless