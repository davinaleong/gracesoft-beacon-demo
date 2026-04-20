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

<body class="min-h-screen bg-slate-100 font-sans text-slate-900 antialiased">
    <div class="flex min-h-screen">
        <aside class="hidden w-64 shrink-0 bg-[#352AA6] text-indigo-100 lg:block">
            <div class="border-b border-white/10 p-5">
                <img src="{{ asset('wm-w.svg') }}" alt="GraceSoft HQ" class="h-10 w-auto" />
            </div>

            <nav class="space-y-5 p-4 text-sm">
                <div>
                    <p class="px-2 text-[11px] font-semibold uppercase tracking-[0.12em] text-indigo-300">Dashboard</p>
                    <a href="{{ route('admin.submissions.index') }}"
                        class="mt-2 block rounded-md px-2.5 py-2 font-medium transition {{ request()->routeIs('admin.submissions.*') ? 'bg-indigo-400/40 text-white' : 'hover:bg-indigo-400/20' }}">
                        Dashboard
                    </a>
                </div>

                <div class="space-y-2">
                    <p class="px-2 text-[11px] font-semibold uppercase tracking-[0.12em] text-indigo-300">Identity &
                        Security</p>
                    <a href="#"
                        class="block rounded-md px-2.5 py-1.5 transition hover:bg-indigo-400/20">Notifications</a>
                    <a href="#" class="block rounded-md px-2.5 py-1.5 transition hover:bg-indigo-400/20">Recent
                        Activity</a>
                    <a href="#"
                        class="block rounded-md px-2.5 py-1.5 transition hover:bg-indigo-400/20">Analytics</a>
                    <a href="#"
                        class="block rounded-md px-2.5 py-1.5 transition hover:bg-indigo-400/20">Insights</a>
                </div>

                <div class="space-y-2">
                    <p class="px-2 text-[11px] font-semibold uppercase tracking-[0.12em] text-indigo-300">CRM</p>
                    <a href="#"
                        class="block rounded-md px-2.5 py-1.5 transition hover:bg-indigo-400/20">Clients</a>
                    <a href="#"
                        class="block rounded-md px-2.5 py-1.5 transition hover:bg-indigo-400/20">Enquiries</a>
                    <a href="#" class="block rounded-md px-2.5 py-1.5 transition hover:bg-indigo-400/20">Notes</a>
                </div>

                <div class="space-y-2">
                    <p class="px-2 text-[11px] font-semibold uppercase tracking-[0.12em] text-indigo-300">Billing</p>
                    <a href="#"
                        class="block rounded-md px-2.5 py-1.5 transition hover:bg-indigo-400/20">Orders</a>
                    <a href="#"
                        class="block rounded-md px-2.5 py-1.5 transition hover:bg-indigo-400/20">Invoices</a>
                    <a href="#"
                        class="block rounded-md px-2.5 py-1.5 transition hover:bg-indigo-400/20">Payments</a>
                </div>
            </nav>

            <div class="px-4 pb-5">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full rounded-md border border-indigo-300/40 px-3 py-2 text-sm font-semibold text-white transition hover:bg-indigo-400/20">
                        Sign out
                    </button>
                </form>
            </div>
        </aside>

        <main class="min-w-0 flex-1">
            <div class="border-b border-slate-300 bg-slate-100 px-4 py-4 sm:px-6">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <h1 class="text-4xl font-bold tracking-tight text-slate-900">@yield('page_title', 'Dashboard')</h1>
                        <p class="mt-1 text-sm text-slate-600">@yield('page_subtitle', 'Welcome back. Here is a snapshot of operations today.')</p>
                    </div>

                    <div class="flex items-center gap-3 rounded-xl bg-white p-2 shadow-sm ring-1 ring-slate-200">
                        <div
                            class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-[#352AA6] text-sm font-bold text-white">
                            GA</div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">GraceSoft Admin</p>
                            <p class="text-xs text-slate-500">admin@gracesoft.dev</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-4 py-4 sm:px-6">
                <div
                    class="mb-4 inline-flex rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">
                    Reporting month: {{ now()->format('Y-m') }}
                </div>

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
