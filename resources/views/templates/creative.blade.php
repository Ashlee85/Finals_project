
@extends('layouts.app')

@section('content')

{{-- PREVIEW ACTIONS --}}
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

    {{-- PROFILE HEADER --}}
    <header class="creative-profile-header">

        <div class="creative-profile-picture">
            @if($portfolio->profile_picture)
                <img
                    src="{{ asset('storage/' . $portfolio->profile_picture) }}"
                    alt="{{ $portfolio->full_name }}'s profile picture"
                >
            @else
                <div class="creative-photo-placeholder">
                    {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                </div>
            @endif
        </div>

        <div class="creative-profile-details">
            <p class="creative-eyebrow">PERSONAL PORTFOLIO</p>

            <h1>{{ $portfolio->full_name }}</h1>

            <p class="creative-profile-subtitle">
                Portfolio / Personal Profile
            </p>

            <div class="creative-contact-details">
                <span>{{ $portfolio->email }}</span>
                <span>{{ $portfolio->contact_number }}</span>
                <span>{{ $portfolio->address }}</span>
            </div>
        </div>

    </header>

    <main class="creative-main">

        {{-- EDUCATION, SKILLS AND LINKS --}}
        <section class="creative-overview">

            <div class="creative-overview-item">
                <span class="creative-number">01</span>
                <h2>Education<span>.</span></h2>

                <div class="creative-content">
                    {!! nl2br(e($portfolio->education)) !!}
                </div>
            </div>

            <div class="creative-overview-item">
                <span class="creative-number">02</span>
                <h2>Skills<span>.</span></h2>

                <div class="creative-content">
                    {!! nl2br(e($portfolio->skills)) !!}
                </div>
            </div>

            <div class="creative-overview-item">
                <span class="creative-number">03</span>
                <h2>Links<span>.</span></h2>

                <div class="creative-content">
                    @if($portfolio->social_links)
                        {!! nl2br(e($portfolio->social_links)) !!}
                    @else
                        No social links added.
                    @endif
                </div>
            </div>

        </section>

        {{-- ABOUT ME --}}
        <section class="creative-about-section">
            <div class="creative-section-label">
                ABOUT / WHO I AM
            </div>

            <h2>About Me<span>.</span></h2>

            <div class="creative-content">
                {!! nl2br(e($portfolio->about_me)) !!}
            </div>
        </section>

        <div class="creative-divider"></div>

        {{-- PROJECTS AND WORK EXPERIENCE --}}
        <section class="creative-work-grid">

            <div class="creative-work-item">
                <div class="creative-section-label">
                    04 / SELECTED WORK
                </div>

                <h2>Projects<span>.</span></h2>

                <div class="creative-content">
                    {!! nl2br(e($portfolio->projects ?: 'No projects added yet.')) !!}
                </div>
            </div>

            <div class="creative-work-item">
                <div class="creative-section-label">
                    05 / PROFESSIONAL JOURNEY
                </div>

                <h2>Work Experience<span>.</span></h2>

                <div class="creative-content">
                    {!! nl2br(e($portfolio->work_experience ?: 'No work experience added yet.')) !!}
                </div>
            </div>

        </section>

        {{-- FOOTER --}}
        <footer class="creative-footer">
            <span>{{ $portfolio->full_name }}</span>
            <span>PERSONAL PORTFOLIO / {{ date('Y') }}</span>
        </footer>

    </main>
</div>

@endsection

@push('styles')
    <link rel="stylesheet"
          href="{{ asset('css/templates/creative.css') }}">
@endpush
