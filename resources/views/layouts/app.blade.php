<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Build and showcase your personal portfolio with FolioForge.">
    <title>@yield('title', 'StudentPortfolio - Portfolio Builder')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <header class="site-header">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark">◈</span>
                <span>StudentPortfolio</span>
            </a>

            <button class="menu-toggle" id="menuToggle"
                    aria-label="Toggle navigation" aria-expanded="false">
                ☰
            </button>

            <nav class="main-nav" id="mainNav">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('home') }}#templates">Templates</a>
                <a href="{{ route('home') }}#how-it-works">How It Works</a>
                <a href="{{ route('portfolio.manage') }}">My Portfolios</a>
                <a href="{{ route('portfolio.create') }}" class="nav-cta">Get Started</a>
            </nav>
        </div>
    </header>

    @if(session('success'))
        <div class="flash-message success-message">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="flash-message error-message">
            Please check the form and correct the highlighted errors.
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="footer-inner">
            <a href="{{ route('home') }}" class="brand footer-brand">
                <span class="brand-mark">◈</span>
                <span>StudentPortfolio</span>
            </a>

            <div class="footer-links">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('home') }}#templates">Templates</a>
                <a href="{{ route('home') }}#about">About</a>
            </div>

            <p>© {{ date('Y') }} StudentPortfolio. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const mainNav = document.getElementById('mainNav');

        if (menuToggle && mainNav) {
            menuToggle.addEventListener('click', function () {
                const isOpen = mainNav.classList.toggle('nav-open');
                menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
