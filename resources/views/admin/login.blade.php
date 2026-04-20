@extends('layouts.gracesoft-auth')

@section('title', 'Admin Login')

@section('content')
    <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
        Secure access
        <p class="mt-1 text-emerald-700">Enter your admin credentials to continue.</p>
    </div>

    <h2 class="mt-4 text-4xl font-bold tracking-tight text-slate-900">Admin sign in</h2>
    <p class="mt-1 text-sm text-slate-600">Use the seeded demo admin account to access submissions.</p>

    @if ($errors->any())
        <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
            Invalid login details.
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.store') }}" class="mt-6 space-y-4">
        @csrf
        <div class="space-y-1">
            <label for="email" class="text-sm font-semibold text-slate-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="gs-control" />
        </div>

        <div class="space-y-1">
            <label for="password" class="text-sm font-semibold text-slate-700">Password</label>
            <input id="password" type="password" name="password" required class="gs-control" />
        </div>

        <button type="submit" class="gs-btn-primary w-full">
            Sign in
        </button>

        <p class="rounded-lg border border-slate-200 px-4 py-2 text-center text-xs text-slate-500">
            Demo credential: admin@beacon-demo.test / password
        </p>
    </form>

    <p class="mt-5 border-t border-slate-200 pt-4 text-xs text-slate-500">&copy; {{ now()->year }} GraceSoft HQ. All
        rights reserved.</p>
@endsection
