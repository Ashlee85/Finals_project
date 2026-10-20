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
                <input id="password" type="password" name="password" required>
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