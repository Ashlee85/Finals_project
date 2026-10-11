
@extends('layouts.app')

@section('title', 'Portfolio Preview')

@section('content')
<section class="page-section wide">
    <div class="preview-toolbar">
        <div>
            <span class="eyebrow">PORTFOLIO PREVIEW</span>
            <h1>Your portfolio is ready!</h1>
            <p>Review your information before sharing your portfolio.</p>
        </div>

        <div class="hero-actions">
            <a href="{{ route('portfolio.edit', $portfolio) }}"
               class="btn btn-outline">Edit Information</a>

            <button type="button" class="btn btn-primary"
                    onclick="window.print()">Print / Save PDF</button>
        </div>
    </div>

    <article class="generated-portfolio template-{{ $portfolio->selected_template }}">
        <header class="portfolio-header">
            @if($portfolio->profile_picture)
                <img class="portfolio-avatar"
                     src="{{ asset('storage/'.$portfolio->profile_picture) }}"
                     alt="Profile picture">
            @else
                <div class="portfolio-avatar avatar-fallback">
                    {{ strtoupper(substr($portfolio->full_name, 0, 1)) }}
                </div>
            @endif

            <div>
                <span class="eyebrow">
                    @switch($portfolio->selected_template)
                        @case(1) SIMPLE PORTFOLIO @break
                        @case(2) MODERN PORTFOLIO @break
                        @case(3) CREATIVE PORTFOLIO @break
                    @endswitch
                </span>

                <h2>{{ $portfolio->full_name }}</h2>
                <p>{{ $portfolio->email }}</p>
                <p>{{ $portfolio->contact_number }} · {{ $portfolio->address }}</p>
            </div>
        </header>

        <div class="portfolio-content">
            <section class="portfolio-section">
                <h3>About Me</h3>
                <p class="preserve-lines">{{ $portfolio->about_me }}</p>
            </section>

            <section class="portfolio-section">
                <h3>Education</h3>
                <p class="preserve-lines">{{ $portfolio->education }}</p>
            </section>

            <section class="portfolio-section">
                <h3>Skills</h3>
                <p class="preserve-lines">{{ $portfolio->skills }}</p>
            </section>

            @if($portfolio->projects)
                <section class="portfolio-section">
                    <h3>Projects</h3>
                    <p class="preserve-lines">{{ $portfolio->projects }}</p>
                </section>
            @endif

            @if($portfolio->work_experience)
                <section class="portfolio-section">
                    <h3>Work Experience</h3>
                    <p class="preserve-lines">{{ $portfolio->work_experience }}</p>
                </section>
            @endif

            @if($portfolio->social_links)
                <section class="portfolio-section">
                    <h3>Social Media / Website Links</h3>
                    <p class="preserve-lines">{{ $portfolio->social_links }}</p>
                </section>
            @endif
        </div>
    </article>

    <div class="form-actions no-print">
        <a href="{{ route('portfolio.templates', $portfolio) }}"
           class="btn btn-outline">Change Template</a>

        <a href="{{ route('portfolio.manage') }}"
           class="btn btn-primary">Manage Portfolios</a>
    </div>
</section>
@endsection