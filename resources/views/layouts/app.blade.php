<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Build and showcase your personal portfolio with FolioForge.">
    <title>@yield('title', 'StudentPortfolio - Portfolio Builder')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/enhancements.css') }}">
    @stack('styles')
</head>
<body>
    @php
        $onTemplates = request()->routeIs('portfolio.templates', 'portfolio.select-template');
    @endphp

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
                <a href="{{ route('home') }}"
                   data-section="home"
                   class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('home') }}#templates"
                   data-section="templates"
                   class="{{ $onTemplates ? 'active' : '' }}">Templates</a>
                <a href="{{ route('home') }}#how-it-works"
                   data-section="how">How It Works</a>

                @auth
                    <a href="{{ route('portfolio.manage') }}"
                       class="{{ request()->routeIs('portfolio.manage') ? 'active' : '' }}">My Portfolios</a>

                    @unless(request()->routeIs('portfolio.manage', 'portfolio.create', 'portfolio.store', 'portfolio.edit', 'portfolio.templates', 'portfolio.preview'))
                        <a href="{{ route('portfolio.create') }}"
                           class="nav-cta">Create Portfolio</a>
                    @endunless

                    <form method="POST" action="{{ route('logout') }}" class="nav-logout">
                        @csrf
                        <button type="submit" class="nav-link-button">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="{{ request()->routeIs('login') ? 'active' : '' }}">Log In</a>
                    <a href="{{ route('register') }}"
                       class="{{ request()->routeIs('register') ? 'active' : '' }}">Sign Up</a>
                @endauth
            </nav>
        </div>
    </header>

    @if(session('success'))
        <div class="flash-message success-message">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="flash-message error-message">
            {{ session('error') }}
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

            // Close the mobile menu after a link is tapped
            mainNav.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    mainNav.classList.remove('nav-open');
                    menuToggle.setAttribute('aria-expanded', 'false');
                });
            });
        }

        // Homepage only: highlight the section the visitor is looking at
        (function () {
            if (!document.querySelector('.home-hero')) return;

            const links = document.querySelectorAll('.main-nav a[data-section]');
            const sections = [
                { key: 'home',      el: document.querySelector('.home-hero') },
                { key: 'templates', el: document.getElementById('templates') },
                { key: 'how',       el: document.getElementById('how-it-works') },
                { key: 'how',       el: document.getElementById('about') }, // About stays under "How It Works"
            ];

            function updateActive() {
                const line = window.innerHeight * 0.4; // 40% down the screen
                let current = 'home';

                sections.forEach(function (s) {
                    if (s.el && s.el.getBoundingClientRect().top <= line) {
                        current = s.key;
                    }
                });

                links.forEach(function (a) {
                    a.classList.toggle('active', a.dataset.section === current);
                });
            }

            window.addEventListener('scroll', updateActive, { passive: true });
            window.addEventListener('resize', updateActive);
            updateActive();
        })();
    </script>

    @stack('scripts')
</body>
</html>