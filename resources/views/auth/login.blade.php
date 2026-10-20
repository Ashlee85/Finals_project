@extends('layouts.app')

@section('title', 'Log In - StudentPortfolio')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <h1>Log In</h1>
        <p class="auth-sub">Welcome back. Log in to manage your portfolios.</p>

        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <div class="auth-field">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email') <small class="field-error">{{ $message }}</small> @enderror
            </div>

            <div class="auth-field">
                <label for="password">Password</label>
                <div class="password-wrapper" style="position:relative;display:block;width:100%;">
                    <input id="password" type="password" name="password" required
                           style="display:block;width:100%;box-sizing:border-box;padding-right:48px;">
                    <button type="button" class="toggle-password" aria-label="Show password"
                            style="display:none;position:absolute;top:50%;right:12px;transform:translateY(-50%);background:none;border:none;padding:4px;margin:0;cursor:pointer;color:#6b7280;align-items:center;">
                        <svg class="icon-eye" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        <svg class="icon-eye-off" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            style="display:none">
                            <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                            <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"/>
                            <line x1="1" y1="1" x2="23" y2="23"/>
                        </svg>
                    </button>
                </div>
                @error('password') <small class="field-error">{{ $message }}</small> @enderror
            </div>

            <label class="auth-remember">
                <input type="checkbox" name="remember" value="1"> Remember me
            </label>

            <button type="submit" class="auth-btn">Log In</button>
        </form>

        <p class="auth-switch">
            No account yet? <a href="{{ route('register') }}">Sign Up</a>
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.password-wrapper').forEach(function (wrapper) {
        const input = wrapper.querySelector('input');
        const btn = wrapper.querySelector('.toggle-password');
        const eye = btn.querySelector('.icon-eye');
        const eyeOff = btn.querySelector('.icon-eye-off');

        function setVisible(show) {
            input.type = show ? 'text' : 'password';
            eye.style.display = show ? 'none' : 'block';
            eyeOff.style.display = show ? 'block' : 'none';
            btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
        }

        function sync() {
            const hasValue = input.value.length > 0;
            btn.style.display = hasValue ? 'flex' : 'none';
            if (!hasValue) setVisible(false);
        }

        input.addEventListener('input', sync);
        sync();

        btn.addEventListener('click', function () {
            setVisible(input.type === 'password');
        });
    });
</script>
@endpush