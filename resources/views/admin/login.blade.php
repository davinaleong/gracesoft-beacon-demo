@extends('layouts.beacon')

@section('title', 'Admin Login')

@section('content')
    <section class="mx-auto max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Admin Access</p>
        <h1 class="mt-2 font-['Newsreader'] text-4xl text-slate-900">Sign In</h1>
        <p class="mt-2 text-sm text-slate-600">Use the seeded demo admin account to access submissions.</p>

        @if ($errors->any())
            <div class="mt-5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                Invalid login details.
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}" class="mt-6 space-y-4">
            @csrf
            <div class="space-y-1">
                <label for="email" class="text-sm font-medium text-slate-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100" />
            </div>

            <div class="space-y-1">
                <label for="password" class="text-sm font-medium text-slate-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100" />
            </div>

            <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-5 py-3 font-semibold text-white transition hover:bg-slate-800">
                Login
            </button>

            <p class="text-xs text-slate-500">Demo credential: admin@beacon-demo.test / password</p>
        </form>
    </section>
@endsection
