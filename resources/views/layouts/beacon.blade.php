<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GraceSoft Beacon Lite')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=sora:400,500,600,700|newsreader:500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="min-h-screen bg-[radial-gradient(circle_at_top,_#e6f4ff_0%,_#f8f9ff_40%,_#f8fcfb_100%)] text-slate-900 antialiased">
    <div class="bg-cyan-900 px-4 py-2 text-center text-xs font-semibold tracking-wide text-cyan-50">
        Demo Environment - Do NOT submit sensitive personal data.
    </div>

    <header class="mx-auto flex w-full max-w-6xl items-center justify-between px-4 py-5 sm:px-6 lg:px-8">
        <a href="{{ route('submit.create') }}" class="font-['Newsreader'] text-2xl font-semibold text-cyan-950">
            GraceSoft Beacon Lite
        </a>

        <nav class="flex items-center gap-3 text-sm">
            @auth
                <a href="{{ route('admin.submissions.index') }}"
                    class="rounded-full border border-cyan-200 bg-white/80 px-4 py-2 font-medium text-cyan-900 transition hover:border-cyan-400 hover:bg-white">
                    Admin Dashboard
                </a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="rounded-full border border-rose-200 bg-rose-50 px-4 py-2 font-medium text-rose-800 transition hover:bg-rose-100">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('admin.login') }}"
                    class="rounded-full border border-cyan-200 bg-white/80 px-4 py-2 font-medium text-cyan-900 transition hover:border-cyan-400 hover:bg-white">
                    Admin Login
                </a>
            @endauth
        </nav>
    </header>

    <main class="mx-auto w-full max-w-6xl px-4 pb-16 sm:px-6 lg:px-8">
        @yield('content')
    </main>
</body>

</html>
