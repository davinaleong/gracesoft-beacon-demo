@extends('layouts.beacon')

@section('title', 'GraceSoft Beacon Demo')

@section('content')
    <section
        class="relative overflow-hidden rounded-2xl border border-cyan-100 bg-linear-to-br from-cyan-50 via-white to-indigo-50 p-8 sm:p-10">
        <div class="pointer-events-none absolute -left-16 -top-16 h-52 w-52 rounded-full bg-cyan-300/20 blur-2xl"></div>
        <div class="pointer-events-none absolute -right-20 bottom-0 h-64 w-64 rounded-full bg-indigo-300/20 blur-2xl"></div>

        <div class="relative grid gap-8 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-700">Prospect Demo Experience</p>
                <h1 class="mt-3 font-serif text-4xl leading-tight text-cyan-950 sm:text-5xl">
                    Showcase secure intake with visible privacy and security controls.
                </h1>
                <p class="mt-4 max-w-2xl text-base text-slate-700">
                    This landing page mirrors a polished client-facing journey while still exposing the exact demo form and
                    admin safeguards your prospects care about.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="#demo-form" class="gs-btn-primary">Try the demo form</a>
                    <a href="{{ route('admin.login') }}" class="gs-btn-outline">Open admin panel</a>
                </div>
            </div>

            <div class="gs-card p-5">
                <h2 class="text-lg font-bold text-[#352AA6]">What this demo proves</h2>
                <ul class="mt-3 space-y-2 text-sm text-slate-700">
                    <li>Security-first: authenticated admin access and route throttling.</li>
                    <li>Security-first: CSRF protection and private file handling.</li>
                    <li>Privacy-first: optional identity fields and anonymous submissions.</li>
                    <li>Privacy-first: automatic deletion after {{ $retentionLabel }}.</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="mt-5 grid gap-4 md:grid-cols-2">
        <article class="gs-card p-6">
            <h2 class="text-xl font-bold text-[#352AA6]">Security-first controls</h2>
            <ul class="mt-3 space-y-2 text-sm text-slate-700">
                <li>Admin panel protected by authentication.</li>
                <li>Submission and login endpoints are throttled.</li>
                <li>File uploads are validated and stored in private paths.</li>
                <li>Download links require authenticated access.</li>
            </ul>
        </article>

        <article class="gs-card p-6">
            <h2 class="text-xl font-bold text-[#352AA6]">Privacy-first controls</h2>
            <ul class="mt-3 space-y-2 text-sm text-slate-700">
                <li>Anonymous submissions are supported.</li>
                <li>No public exposure of uploaded files.</li>
                <li>Retention policy is configurable and enforced.</li>
                <li>Demo disclaimer prevents real sensitive-data usage.</li>
            </ul>
        </article>
    </section>

    <section id="demo-form" class="mt-5 grid gap-4 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="gs-card p-8">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-700">Embedded Demo Form</p>
            <h2 class="mt-2 font-serif text-4xl leading-tight text-cyan-950">Hands-on intake experience</h2>
            <p class="mt-4 max-w-2xl text-base text-slate-600">
                Prospects can test the exact form journey from this page. Submitted records immediately appear in admin
                with lifecycle status and security context.
            </p>

            <div class="mt-6 grid gap-3 rounded-md border border-emerald-200 bg-emerald-50/80 p-5 text-sm text-emerald-900">
                <p class="font-semibold">Demo trust notice</p>
                <p>✓ Records auto-expire after {{ $retentionLabel }}</p>
                <p>✓ Anonymous mode is available</p>
                <p>✓ Do not submit real sensitive personal data</p>
            </div>
        </div>

        @include('submit._form-panel')
    </section>
@endsection
