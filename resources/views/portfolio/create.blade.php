@extends('layouts.app')

@section('title', isset($portfolio) ? 'Edit Portfolio - StudentPortfolio' : 'Create Portfolio - StudentPortfolio')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endpush

@section('content')
<div class="create-page">
    <div class="create-heading">
        <span class="create-eyebrow">LET'S BUILD YOUR FUTURE</span>
        <h1>{{ isset($portfolio) ? 'Edit Your Portfolio' : 'Create Your Portfolio' }}</h1>
        <p>Add your information below to build your personal portfolio.</p>
    </div>

    <div class="create-progress">
        <div class="progress-step active"><span>1</span><small>Your Information</small></div>
        <div class="progress-line"></div>
        <div class="progress-step"><span>2</span><small>Choose Template</small></div>
        <div class="progress-line"></div>
        <div class="progress-step"><span>3</span><small>Preview</small></div>
    </div>

    <form
        action="{{ isset($portfolio) ? route('portfolio.update', $portfolio->id) : route('portfolio.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="portfolio-form"
    >
        @csrf
        @if(isset($portfolio))
            @method('PUT')
        @endif

        <section class="form-card">
            <div class="form-card-heading">
                <span class="form-icon">01</span>
                <div>
                    <h2>Personal Information</h2>
                    <p>Introduce yourself and provide your contact details.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-field full-width">
                    <label for="full_name">Full Name <span>*</span></label>
                    <input id="full_name" name="full_name" type="text"
                        value="{{ old('full_name', $portfolio->full_name ?? '') }}"
                        placeholder="Enter your full name" required>
                    @error('full_name') <small class="field-error">{{ $message }}</small> @enderror
                </div>

                <div class="form-field">
                    <label for="email">Email Address <span>*</span></label>
                    <input id="email" name="email" type="email"
                        value="{{ old('email', $portfolio->email ?? '') }}"
                        placeholder="you@example.com" required>
                    @error('email') <small class="field-error">{{ $message }}</small> @enderror
                </div>

                <div class="form-field">
                    <label for="contact_number">Contact Number <span>*</span></label>
                    <input id="contact_number" name="contact_number" type="tel"
                        value="{{ old('contact_number', $portfolio->contact_number ?? '') }}"
                        placeholder="Enter contact number" required>
                    @error('contact_number') <small class="field-error">{{ $message }}</small> @enderror
                </div>

                <div class="form-field full-width">
                    <label for="address">Address <span>*</span></label>
                    <input id="address" name="address" type="text"
                        value="{{ old('address', $portfolio->address ?? '') }}"
                        placeholder="City, Province" required>
                    @error('address') <small class="field-error">{{ $message }}</small> @enderror
                </div>

                <div class="form-field full-width">
                    <label for="profile_picture">Profile Picture</label>
                    @if(isset($portfolio) && $portfolio->profile_picture)
                        <div class="current-photo">
                            <img src="{{ asset('storage/' . $portfolio->profile_picture) }}" alt="Current profile picture">
                            <span>Current profile picture</span>
                        </div>
                    @endif
                    <input id="profile_picture" name="profile_picture" type="file" accept=".jpg,.jpeg,.png,.webp">
                    <small class="field-hint">Optional. JPG, PNG, or WebP. Maximum 2 MB. Images are only used for your profile picture.</small>
                    @error('profile_picture') <small class="field-error">{{ $message }}</small> @enderror
                </div>

                <div class="form-field full-width">
                    <label for="about_me">About Me <span>*</span></label>
                    <textarea id="about_me" name="about_me" rows="5"
                        placeholder="Write a short introduction about yourself..." required>{{ old('about_me', $portfolio->about_me ?? '') }}</textarea>
                    @error('about_me') <small class="field-error">{{ $message }}</small> @enderror
                </div>
            </div>
        </section>

        <section class="form-card">
            <div class="form-card-heading">
                <span class="form-icon">02</span>
                <div>
                    <h2>Education and Skills</h2>
                    <p>Share what you have learned and what you can do.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-field full-width">
                    <label for="education">Educational Background <span>*</span></label>
                    <textarea id="education" name="education" rows="4"
                        placeholder="School, course, year level, or graduation year..." required>{{ old('education', $portfolio->education ?? '') }}</textarea>
                    @error('education') <small class="field-error">{{ $message }}</small> @enderror
                </div>

                <div class="form-field full-width">
                    <label for="skills">Skills <span>*</span></label>
                    <textarea id="skills" name="skills" rows="4"
                        placeholder="List your skills, separated by commas or on separate lines..." required>{{ old('skills', $portfolio->skills ?? '') }}</textarea>
                    @error('skills') <small class="field-error">{{ $message }}</small> @enderror
                </div>
            </div>
        </section>

        <section class="form-card">
            <div class="form-card-heading">
                <span class="form-icon">03</span>
                <div>
                    <h2>Experience and Projects</h2>
                    <p>Show your work, achievements, and experience.</p>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-field full-width">
                    <label for="projects">Projects</label>
                    <textarea id="projects" name="projects" rows="5"
                        placeholder="Project name and description. No project images needed.">{{ old('projects', $portfolio->projects ?? '') }}</textarea>
                    @error('projects') <small class="field-error">{{ $message }}</small> @enderror
                </div>

                <div class="form-field full-width">
                    <label for="work_experience">Work Experience</label>
                    <textarea id="work_experience" name="work_experience" rows="4"
                        placeholder="Job title, organization, responsibilities, or internship experience...">{{ old('work_experience', $portfolio->work_experience ?? '') }}</textarea>
                    @error('work_experience') <small class="field-error">{{ $message }}</small> @enderror
                </div>

                <div class="form-field full-width">
                    <label for="social_links">Social Media / Website Links</label>
                    <textarea id="social_links" name="social_links" rows="3"
                        placeholder="LinkedIn, GitHub, personal website, or other links...">{{ old('social_links', $portfolio->social_links ?? '') }}</textarea>
                    @error('social_links') <small class="field-error">{{ $message }}</small> @enderror
                </div>
            </div>
        </section>

        <div class="form-actions">
            <a href="{{ route('portfolio.manage') }}" class="cancel-button">Cancel</a>
            <button type="submit" class="save-button">
                {{ isset($portfolio) ? 'Update Portfolio' : 'Save & Choose Template' }} <span>→</span>
            </button>
        </div>
    </form>
</div>
@endsection
