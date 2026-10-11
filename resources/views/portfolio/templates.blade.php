
@extends('layouts.app')

@section('content')
<div class="template-page">
    <div class="template-container">

        <div class="template-heading">
            <p class="template-eyebrow">MAKE IT YOUR OWN</p>
            <h1>Choose Your Portfolio Style</h1>
            <p>Select a design for {{ $portfolio->full_name }}.</p>
        </div>

        @if($errors->any())
            <div class="template-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('portfolio.select-template', $portfolio->id) }}"
              method="POST"
              id="templateForm">
            @csrf

            <div class="template-grid">

                <label class="template-option">
                    <input type="radio" name="template" value="1"
                        {{ (int) $portfolio->selected_template === 1 ? 'checked' : '' }}>

                    <div class="template-card simple-card">
                        <div class="template-preview simple-preview">
                            <div class="preview-simple-top">PORTFOLIO.</div>
                            <div class="preview-simple-body">
                                <div>
                                    <span>PERSONAL PORTFOLIO</span>
                                    <div class="preview-simple-title">Your Name</div>
                                    <div class="preview-lines"></div>
                                    <div class="preview-lines short"></div>
                                    <div class="preview-simple-button"></div>
                                </div>
                                <div class="preview-simple-photo"></div>
                            </div>
                            <div class="preview-simple-bottom"></div>
                        </div>

                        <div class="template-info">
                            <div>
                                <h2>01. Simple</h2>
                                <p>Clean, minimal, and professional.</p>
                            </div>
                            <span class="template-radio-mark"></span>
                        </div>
                    </div>
                </label>

                <label class="template-option">
                    <input type="radio" name="template" value="2"
                        {{ (int) $portfolio->selected_template === 2 ? 'checked' : '' }}>

                    <div class="template-card modern-card">
                        <div class="template-preview modern-preview">
                            <div class="preview-modern-top">MY<span>PROFILE</span></div>
                            <div class="preview-modern-body">
                                <div class="preview-modern-title">YOUR<br>NAME<span>.</span></div>
                                <div class="preview-modern-photo"></div>
                            </div>
                            <div class="preview-modern-cards">
                                <div></div><div></div>
                            </div>
                            <div class="preview-modern-bottom"></div>
                        </div>

                        <div class="template-info">
                            <div>
                                <h2>02. Modern</h2>
                                <p>Bold typography, dark colors, and cards.</p>
                            </div>
                            <span class="template-radio-mark"></span>
                        </div>
                    </div>
                </label>

                <label class="template-option">
                    <input type="radio" name="template" value="3"
                        {{ (int) $portfolio->selected_template === 3 ? 'checked' : '' }}>

                    <div class="template-card creative-card">
                        <div class="template-preview creative-preview">
                            <div class="preview-creative-top">THE<br>PORTFOLIO®</div>
                            <div class="preview-creative-title">CREATING<br><span>MY OWN</span><br>PATH<span class="orange">.</span></div>
                            <div class="preview-creative-bottom">
                                <div></div>
                                <div class="preview-creative-lines">
                                    <i></i><i></i><i></i>
                                </div>
                            </div>
                        </div>

                        <div class="template-info">
                            <div>
                                <h2>03. Creative</h2>
                                <p>Distinctive layout with artistic details.</p>
                            </div>
                            <span class="template-radio-mark"></span>
                        </div>
                    </div>
                </label>

            </div>

            <div class="template-footer">
                <a href="{{ route('portfolio.edit', $portfolio->id) }}"
                   class="template-back">← Edit Information</a>

                <button type="submit" class="template-continue">
                    Use Selected Template →
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/templates.css') }}">
@endpush
