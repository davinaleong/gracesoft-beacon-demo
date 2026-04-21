<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GraceSoft Beacon Lite')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link rel="shortcut icon" href="{{ asset('logo.svg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=montserrat:400,500,600,700|playfair-display:500,600,700|source-code-pro:400,600"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="gs-app-bg min-h-screen font-sans antialiased">
    <div class="gs-top-banner">
        Demo Environment - Do NOT submit sensitive personal data.
    </div>

    <header class="gs-shell flex items-center justify-between py-5 lg:px-8">
        <a href="{{ route('landing') }}" class="inline-flex items-center" aria-label="GraceSoft Beacon Lite Home">
            <img src="{{ asset('wm.svg') }}" alt="GraceSoft Beacon Lite" class="h-10 w-auto" />
        </a>

        <nav class="flex items-center gap-3 text-sm">
            @auth
                <a href="{{ route('admin.submissions.index') }}" class="gs-btn-outline">
                    Admin Dashboard
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-md border border-rose-200 bg-rose-50 px-4 py-2 text-sm font-semibold text-rose-800 transition hover:bg-rose-100">
                        Logout
                    </button>
                </form>
            @else
                @if (request()->routeIs('admin.login'))
                    <a href="{{ route('landing') }}" class="gs-btn-outline">
                        Back
                    </a>
                @else
                    <a href="{{ route('landing') }}#demo-form" class="gs-btn-outline">
                        Demo Form
                    </a>
                    <a href="{{ route('admin.login') }}" class="gs-btn-outline">
                        Admin Login
                    </a>
                @endif
            @endauth
        </nav>
    </header>

    <main class="gs-shell pb-16 lg:px-8">
        @yield('content')
    </main>

    @include('partials.lighthouse-links')
</body>

</html>
