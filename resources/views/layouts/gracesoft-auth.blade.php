<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GraceSoft HQ')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link rel="shortcut icon" href="{{ asset('logo.svg') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=montserrat:400,500,600,700|playfair-display:500,600,700|source-code-pro:400,600"
        rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-[#352AA6] font-sans text-white antialiased">
    <div class="mx-auto flex min-h-screen w-full max-w-7xl items-center px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid w-full items-center gap-10 lg:grid-cols-[1fr_430px]">
            <section class="mx-auto max-w-xl">
                <img src="{{ asset('wm-w.svg') }}" alt="GraceSoft HQ" class="h-14 w-auto" />
                <h1 class="mt-8 font-serif text-5xl leading-tight text-white md:text-6xl">
                    Operations visibility, billing control, and customer workflows in one place.
                </h1>
                <p class="mt-5 text-lg leading-8 text-indigo-100">
                    GraceSoft HQ keeps teams aligned across CRM, work management, billing, and finance with streamlined
                    daily actions.
                </p>
            </section>

            <section>
                <div class="gs-card p-6 text-slate-900 shadow-2xl ring-1 ring-black/10 sm:p-7">
                    <div class="mb-5 flex items-start justify-between gap-3">
                        <img src="{{ asset('wm.svg') }}" alt="GraceSoft HQ" class="h-10 w-auto" />
                        <a href="{{ route('landing') }}#demo-form"
                            class="gs-btn-outline-brand px-3 py-1 text-xs uppercase tracking-wide">
                            Back
                        </a>
                    </div>

                    @yield('content')
                </div>
            </section>
        </div>
    </div>

    @include('partials.lighthouse-links')
</body>

</html>
