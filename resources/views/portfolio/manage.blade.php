@extends('layouts.app')

@section('title', 'My Portfolios - StudentPortfolio')

@section('content')
<div class="manage-page">
    <div class="manage-container">

        <div class="manage-heading">
            <div>
                <p class="manage-eyebrow">YOUR WORKSPACE</p>
                <h1>My Portfolios</h1>
                <p class="manage-subtitle">
                    View, edit, and manage all your portfolios.
                </p>
            </div>

            <a href="{{ route('portfolio.create') }}" class="manage-add-button">
                + Create Portfolio
            </a>
        </div>

        @if($portfolios->isEmpty())
            <div class="manage-empty">
                <div class="manage-empty-icon">+</div>
                <h2>No portfolios yet</h2>
                <p>Create your first portfolio to see it listed here.</p>
                <a href="{{ route('portfolio.create') }}" class="manage-add-button">
                    Create Your First Portfolio
                </a>
            </div>
        @else
            <div class="manage-summary">
                <span>{{ $portfolios->count() }} portfolio(s)</span>
            </div>

            <div class="manage-grid">
                @foreach($portfolios as $portfolio)
                    @php
                        $slug = match ((int) $portfolio->selected_template) {
                            1 => 'simple',
                            2 => 'modern',
                            3 => 'creative',
                            default => 'simple',
                        };
                        $isSaved = $portfolio->status === 'saved';
                    @endphp

                    <article class="manage-card">

                        <div class="manage-card-top">
                            @if($portfolio->profile_picture)
                                <img
                                    src="{{ asset('storage/' . $portfolio->profile_picture) }}"
                                    alt="Profile picture"
                                    class="manage-avatar"
                                >
                            @else
                                <div class="manage-avatar-placeholder">
                                    {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                                </div>
                            @endif

                            <span class="manage-template-badge">
                                {{ ucfirst($slug) }}
                            </span>
                        </div>

                        <h2>{{ $portfolio->full_name }}</h2>
                        <p class="manage-email">{{ $portfolio->email }}</p>

                        <p>
                            <span class="pf-status pf-status-{{ $portfolio->status }}">
                                {{ $isSaved ? 'Saved' : 'Draft' }}
                            </span>
                        </p>

                        <p class="manage-about">
                            {{ \Illuminate\Support\Str::limit($portfolio->about_me, 110) }}
                        </p>

                        <p class="manage-date">
                            {{ $isSaved ? 'Saved' : 'Draft started' }}
                            {{ $portfolio->updated_at->format('M d, Y') }}
                        </p>

                        <div class="manage-actions">
                            @if($isSaved)
                                <a href="{{ route('portfolio.preview', ['portfolio' => $portfolio->id, 'template' => $slug]) }}"
                                   class="manage-action manage-view">View</a>
                            @else
                                <a href="{{ route('portfolio.templates', $portfolio->id) }}"
                                   class="manage-action manage-view">Continue</a>
                            @endif

                            <a href="{{ route('portfolio.edit', $portfolio->id) }}"
                               class="manage-action manage-edit">Edit</a>

                            <form
                                action="{{ route('portfolio.destroy', $portfolio->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this portfolio? This cannot be undone.');"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="manage-action manage-delete">
                                    Delete
                                </button>
                            </form>
                        </div>

                    </article>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/manage.css') }}">
@endpush