
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/templates/simple.css') }}">
@endpush

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

<div class="simple-portfolio">

    <header class="simple-header">
        <a href="{{ route('home') }}" class="simple-logo">
            PORTFOLIO<span>.</span>
        </a>

        <a href="#contact" class="simple-contact-link">
            Contact
        </a>
    </header>

    <main class="simple-main">

        {{-- Hero Section --}}
        <section class="simple-hero">

            <div class="simple-intro">
                <p class="simple-label">PERSONAL PORTFOLIO</p>

                <h1>{{ $portfolio->full_name }}</h1>

                <p class="simple-description">
                    {{ $portfolio->about_me }}
                </p>

                <a href="#about" class="simple-button">
                    Discover My Work
                </a>
            </div>

            @if ($portfolio->profile_picture)
                <img
                    class="simple-photo"
                    src="{{ asset('storage/' . $portfolio->profile_picture) }}"
                    alt="Profile picture of {{ $portfolio->full_name }}"
                >
            @else
                <div class="simple-photo-placeholder">
                    {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                </div>
            @endif

        </section>

        {{-- Education Section --}}
        <section class="simple-section" id="about">
            <h2>Education</h2>

            <div class="simple-content">
                {!! nl2br(e($portfolio->education)) !!}
            </div>
        </section>

        {{-- Skills Section --}}
        <section class="simple-section">
            <h2>Skills</h2>

            <div class="simple-content">
                {!! nl2br(e($portfolio->skills)) !!}
            </div>
        </section>

        {{-- Projects Section --}}
        <section class="simple-section">
            <h2>Projects</h2>

            <div class="simple-content">
                {!! nl2br(e($portfolio->projects ?: 'No projects added yet.')) !!}
            </div>
        </section>

        {{-- Work Experience Section --}}
        <section class="simple-section">
            <h2>Work Experience</h2>

            <div class="simple-content">
                {!! nl2br(e($portfolio->work_experience ?: 'No work experience added yet.')) !!}
            </div>
        </section>

        {{-- Contact Section --}}
        <section class="simple-section" id="contact">
            <h2>Get in Touch</h2>

            <p>
                <strong>Email:</strong>
                {{ $portfolio->email }}
            </p>

            <p>
                <strong>Phone:</strong>
                {{ $portfolio->contact_number }}
            </p>

            <p>
                <strong>Address:</strong>
                {{ $portfolio->address }}
            </p>

            <p><strong>Social Links:</strong></p>

            <div class="simple-content">
                {!! nl2br(e($portfolio->social_links ?: 'No social links added.')) !!}
            </div>
        </section>

    </main>

    <footer class="simple-footer">
        © {{ date('Y') }} {{ $portfolio->full_name }}. All rights reserved.
    </footer>

</div>

@endsection
