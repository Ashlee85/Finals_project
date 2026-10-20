
@extends('layouts.app')

@section('title', 'StudentPorfolio - Build Your Portfolio')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

<section class="home-hero">
    <div class="hero-inner">
        <div class="hero-content">
            <span class="hero-label">YOUR FUTURE STARTS HERE</span>

            <h1>
                Your Story.<br>
                Your Skills.<br>
                <span>Your Portfolio.</span>
            </h1>

            <p>
                Build a portfolio that shows your creativity, achievements,
                and potential. Choose a design, add your information, and
                create a professional portfolio.
            </p>

            <div class="hero-actions">
                <a href="{{ route('portfolio.create') }}" class="button-orange">
                    Create My Portfolio
                </a>
                <a href="#templates" class="button-outline">
                    Explore Templates
                </a>
            </div>
        </div>

        <div class="hero-art" aria-label="Portfolio design preview">
            <div class="art-glow"></div>

            <div class="art-window">
                <div class="art-window-top">
                    <span></span><span></span><span></span>
                    <small>MY PORTFOLIO</small>
                </div>

                <div class="art-window-content">
                    <div class="art-mini-label">PERSONAL PORTFOLIO</div>
                    <div class="art-mini-title">Build your<br>next chapter.</div>
                    <div class="art-mini-line"></div>
                    <div class="art-mini-line short"></div>
                    <div class="art-mini-button">Explore My Work ↗</div>
                    <div class="art-mini-bottom">
                        <span>ABOUT</span>
                        <span>SKILLS</span>
                        <span>PROJECTS</span>
                    </div>
                </div>
            </div>

            <div class="art-caption">
                <span class="caption-dot"></span>
                YOUR SKILLS. YOUR STORY.
            </div>
        </div>
    </div>
</section>

<section class="home-templates section-wrap" id="templates">
    <div class="section-heading">
        <div>
            <span class="section-eyebrow">FIND YOUR STYLE</span>
            <h2>Choose Your Template</h2>
            <p>Three distinct designs. One portfolio that represents you.</p>
        </div>
    </div>

    <div class="template-card-grid">
        <article class="home-template-card">
            <div class="template-art preview-simple">
                <div class="preview-top">
                    <span>StudentPortfolio</span>
                    <span>Portfolio</span>
                </div>
                <div class="preview-simple-hero">
                    <div class="preview-circle"></div>
                    <div>
                        <i></i><i></i><i class="small-line"></i>
                    </div>
                </div>
                <div class="preview-simple-sections">
                    <span></span><span></span><span></span>
                </div>
            </div>
            <div class="template-card-content">
                <h3>Simple</h3>
                <p>Clean, minimal, and professional. Ideal for a straightforward portfolio.</p>
                <a href="{{ route('portfolio.create') }}" class="template-button">
                    Choose Template
                </a>
            </div>
        </article>

        <article class="home-template-card">
            <div class="template-art preview-modern">
                <div class="preview-dark-title">YOUR<br><b>STORY.</b></div>
                <div class="preview-orange-shape"></div>
                <div class="preview-dark-lines"><i></i><i></i><i></i></div>
                <div class="preview-dark-footer">SKILLS · WORK · EXPERIENCE</div>
            </div>
            <div class="template-card-content">
                <h3>Modern</h3>
                <p>Bold, structured, and elegant with dark tones and orange accents.</p>
                <a href="{{ route('portfolio.create') }}" class="template-button">
                    Choose Template
                </a>
            </div>
        </article>

        <article class="home-template-card">
            <div class="template-art preview-creative">
                <div class="creative-decoration"></div>
                <div class="creative-preview-copy">
                    <small>MAKE YOUR MARK</small>
                    <strong>CREATE.<br>BUILD.<br>GROW.</strong>
                </div>
                <div class="creative-preview-circle"></div>
                <div class="creative-preview-footer">PORTFOLIO / 2026</div>
            </div>
            <div class="template-card-content">
                <h3>Creative</h3>
                <p>Expressive layouts and striking details for a distinctive portfolio.</p>
                <a href="{{ route('portfolio.create') }}" class="template-button">
                    Choose Template
                </a>
            </div>
        </article>
    </div>
</section>

<section class="how-section" id="how-it-works">
    <div class="section-wrap">
        <div class="section-heading centered-heading">
            <span class="section-eyebrow">SIMPLE PROCESS</span>
            <h2>How It Works</h2>
            <p>Create your portfolio in three easy steps.</p>
        </div>

        <div class="steps-grid">
            <article class="step-card">
                <div class="step-number">01</div>
                <h3>Enter Your Information</h3>
                <p>Add your personal details, education, skills, and experience.</p>
            </article>

            <article class="step-card">
                <div class="step-number">02</div>
                <h3>Choose Your Template</h3>
                <p>Select Simple, Modern, or Creative to match your style.</p>
            </article>

            <article class="step-card">
                <div class="step-number">03</div>
                <h3>Generate Your Portfolio</h3>
                <p>Preview your portfolio and manage your saved versions anytime.</p>
            </article>
        </div>
    </div>
</section>

<section class="about-section" id="about">
    <div class="about-inner">
        <div>
            <span class="section-eyebrow">ABOUT StudentPortfolio</span>
            <h2>Your skills deserve to be seen.</h2>
        </div>
        <div>
            <p>
                StudentPortfolio helps students and aspiring professionals create
                and manage personal portfolios easily, with ready-made
                templates that present their information clearly.
            </p>
            <a href="{{ route('portfolio.create') }}" class="about-link">
                Start Building <span>→</span>
            </a>
        </div>
    </div>
</section>

@endsection