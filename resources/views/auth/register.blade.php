@extends('layouts.app')

@section('title', 'Sign Up - StudentPortfolio')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <h1>Create Your Account</h1>
        <p class="auth-sub">Sign up to build and save your portfolios.</p>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="auth-field">
                <label for="name">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       pattern="[\p{L}\p{M} ]+" title="Letters and spaces only" required autofocus>
                @error('name') <small class="field-error">{{ $message }}</small> @enderror
            </div>

            <div class="auth-field">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <small class="field-error">{{ $message }}</small> @enderror
            </div>

            <div class="auth-field">
                <label for="password">Password (at least 8 characters)</label>
                <input id="password" type="password" name="password" required>
                @error('password') <small class="field-error">{{ $message }}</small> @enderror
            </div>

            <div class="auth-field">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
            </div>

            <button type="submit" class="auth-btn">Sign Up</button>
        </form>

        <p class="auth-switch">
            Already have an account? <a href="{{ route('login') }}">Log In</a>
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const nameInput = document.getElementById('name');
    if (nameInput) {
        nameInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^\p{L}\p{M} ]/gu, '');
        });
    }
</script>
@endpush