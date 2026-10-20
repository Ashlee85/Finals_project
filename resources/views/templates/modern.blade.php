
@extends('layouts.app')

@section('content')


@include('partials.preview-actions')

<div class="modern-portfolio">

<div class="modern-portfolio">
    <header class="modern-header">
        <a href="{{ route('home') }}" class="modern-logo">MY<span>PROFILE</span></a>
        <a href="#modern-contact" class="modern-nav-link">LET'S CONNECT ↗</a>
    </header>

    <main class="modern-main">
        <section class="modern-hero">
            <div class="modern-hero-text">
                <p class="modern-eyebrow">HELLO, I'M</p>
                <h1>{{ $portfolio->full_name }}<span>.</span></h1>
                <p>{{ $portfolio->about_me }}</p>
                <a href="#modern-projects" class="modern-button">Explore My Work ↘</a>
            </div>

            @if($portfolio->profile_picture)
                <img class="modern-photo"
                     src="{{ asset('storage/' . $portfolio->profile_picture) }}"
                     alt="Profile picture">
            @else
                <div class="modern-photo-placeholder">
                    {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                </div>
            @endif
        </section>

        <section class="modern-grid">
            <article class="modern-card">
                <span class="modern-number">01 /</span>
                <h2>Education</h2>
                <div>{!! nl2br(e($portfolio->education)) !!}</div>
            </article>

            <article class="modern-card">
                <span class="modern-number">02 /</span>
                <h2>Skills</h2>
                <div>{!! nl2br(e($portfolio->skills)) !!}</div>
            </article>

            <article class="modern-card modern-project-card" id="modern-projects">
                <span class="modern-number">03 /</span>
                <h2>Projects</h2>
                <div>{!! nl2br(e($portfolio->projects ?: 'No projects added yet.')) !!}</div>
            </article>

            <article class="modern-card">
                <span class="modern-number">04 /</span>
                <h2>Experience</h2>
                <div>{!! nl2br(e($portfolio->work_experience ?: 'No work experience added yet.')) !!}</div>
            </article>
        </section>

        <section class="modern-contact" id="modern-contact">
            <p class="modern-eyebrow">HAVE A PROJECT IN MIND?</p>
            <h2>Let's talk<span>.</span></h2>
            <p>{{ $portfolio->email }}</p>
            <p>{{ $portfolio->contact_number }}</p>
            <p>{{ $portfolio->address }}</p>
            <div>{!! nl2br(e($portfolio->social_links ?: 'No social links added.')) !!}</div>
        </section>
    </main>

    <footer class="modern-footer">
        © {{ date('Y') }} {{ $portfolio->full_name }} <span>— BUILT WITH PURPOSE.</span>
    </footer>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/templates/modern.css') }}">
    
@endpush
