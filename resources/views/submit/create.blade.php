@extends('layouts.beacon')

@section('title', 'Submit Secure Message')

@section('content')
    <section class="grid gap-4 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="gs-card p-8">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-700">Secure Intake</p>
            <h1 class="mt-3 font-serif text-4xl leading-tight text-cyan-950 sm:text-5xl">Secure. Private. No
                Tracking.</h1>
            <p class="mt-4 max-w-2xl text-base text-slate-600">
                Submit a message for demo purposes only. Anonymous submissions are allowed and all stored records
                auto-delete within {{ $retentionLabel }}.
            </p>

            <div class="mt-8 grid gap-3 rounded-md border border-emerald-200 bg-emerald-50/80 p-5 text-sm text-emerald-900">
                <p class="font-semibold">Trust Notice</p>
                <p>✓ We do NOT track you</p>
                <p>✓ Data auto-deletes based on demo setting (currently {{ $retentionLabel }})</p>
                <p>✓ Anonymous submission allowed</p>
                <p>✓ Do NOT submit sensitive personal data (Demo Only)</p>
            </div>

            <p class="mt-6 rounded-md border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                This demo stores data temporarily and is intended for showcasing workflow only. Avoid submitting real
                sensitive information.
            </p>
        </div>

        @include('submit._form-panel')
    </section>
@endsection
