
@extends('layouts.app')

@section('content')

<div class="preview-actions">
    <a href="{{ route('portfolio.templates', $portfolio->id) }}"
       class="change-template-btn">
        ← Change Template
    </a>

    <a href="{{ route('portfolio.edit', $portfolio->id) }}"
       class="edit-portfolio-btn">
        Edit Portfolio
    </a>

    <a href="{{ route('portfolio.manage') }}"
       class="back-manage-btn">
        Manage Portfolios
    </a>
</div>

<div class="creative-portfolio">
    <header class="creative-header">
        <a href="{{ route('home') }}" class="creative-logo">THE<br>PORTFOLIO<span>®</span></a>
        <a href="#creative-contact" class="creative-menu">GET IN TOUCH ↗</a>
    </header>

    <main class="creative-main">
        <section class="creative-hero">
            <div class="creative-index">PORTFOLIO / {{ date('Y') }}</div>

            <h1>
                CREATING<br>
                <span>MY OWN</span><br>
                PATH<span class="creative-dot">.</span>
            </h1>

            <div class="creative-intro">
                @if($portfolio->profile_picture)
                    <img src="{{ asset('storage/' . $portfolio->profile_picture) }}"
                         alt="Profile picture" class="creative-photo">
                @else
                    <div class="creative-photo-placeholder">
                        {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <p class="creative-small-label">INTRODUCING</p>
                    <h2>{{ $portfolio->full_name }}</h2>
                    <p>{{ $portfolio->about_me }}</p>
                </div>
            </div>
        </section>

        <section class="creative-section">
            <div class="creative-section-label">01 — BACKGROUND</div>
            <div class="creative-section-body">
                <h2>Education<span>.</span></h2>
                <div>{!! nl2br(e($portfolio->education)) !!}</div>
            </div>
        </section>

        <section class="creative-section">
            <div class="creative-section-label">02 — WHAT I DO</div>
            <div class="creative-section-body">
                <h2>My Skills<span>.</span></h2>
                <div>{!! nl2br(e($portfolio->skills)) !!}</div>
            </div>
        </section>

        <section class="creative-section">
            <div class="creative-section-label">03 — SELECTED WORK</div>
            <div class="creative-section-body">
                <h2>Projects<span>.</span></h2>
                <div>{!! nl2br(e($portfolio->projects ?: 'No projects added yet.')) !!}</div>
            </div>
        </section>

        <section class="creative-section">
            <div class="creative-section-label">04 — EXPERIENCE</div>
            <div class="creative-section-body">
                <h2>My Journey<span>.</span></h2>
                <div>{!! nl2br(e($portfolio->work_experience ?: 'No work experience added yet.')) !!}</div>
            </div>
        </section>

        <section class="creative-contact" id="creative-contact">
            <p class="creative-small-label">HAVE SOMETHING IN MIND?</p>
            <h2>LET'S MAKE<br>SOMETHING <span>GREAT.</span></h2>
            <p>{{ $portfolio->email }}</p>
            <p>{{ $portfolio->contact_number }}</p>
            <p>{{ $portfolio->address }}</p>
            <div>{!! nl2br(e($portfolio->social_links ?: 'No social links added.')) !!}</div>
        </section>
    </main>

    <footer class="creative-footer">
        {{ $portfolio->full_name }} <span>— PERSONAL PORTFOLIO</span>
    </footer>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/templates/creative.css') }}">
@endpush
