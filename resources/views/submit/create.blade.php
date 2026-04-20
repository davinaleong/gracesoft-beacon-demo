@extends('layouts.beacon')

@section('title', 'Submit Secure Message')

@section('content')
    @php
        $retentionMinutes = (int) config('beacon.retention_minutes', 24 * 60);
        $retentionHours = intdiv($retentionMinutes, 60);
        $retentionLabel =
            $retentionMinutes < 60
                ? $retentionMinutes . ' minute' . ($retentionMinutes === 1 ? '' : 's')
                : ($retentionMinutes % 60 === 0
                    ? $retentionHours . ' hour' . ($retentionHours === 1 ? '' : 's')
                    : $retentionMinutes . ' minutes');
    @endphp

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

        <div class="gs-card p-6">
            @if (session('submission_created'))
                <div class="mb-5 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
                    <p class="font-semibold">Submission received</p>
                    <p class="mt-1">Reference: {{ session('submission_created.id') }}</p>
                    <p class="mt-1">Expires at: {{ session('submission_created.expires_at') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-md border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    Please review the highlighted fields and try again.
                </div>
            @endif

            <form id="submission-form" method="POST" action="{{ route('submit.store') }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

                <div class="space-y-1">
                    <label for="name" class="text-sm font-medium text-slate-700">Name (optional)</label>
                    <input id="name" name="name" value="{{ old('name') }}" class="gs-control" />
                    @error('name')
                        <p class="text-xs text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="email" class="text-sm font-medium text-slate-700">Email (optional)</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="gs-control" />
                    @error('email')
                        <p class="text-xs text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="message" class="text-sm font-medium text-slate-700">Message</label>
                    <textarea id="message" name="message" rows="6" required class="gs-control">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-xs text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="attachment" class="text-sm font-medium text-slate-700">File upload (optional, PDF/JPG/PNG,
                        max 2MB)</label>
                    <input id="attachment" type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png"
                        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-indigo-100 file:px-4 file:py-1.5 file:font-medium file:text-indigo-700" />
                    @error('attachment')
                        <p class="text-xs text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <button id="submit-button" type="submit" class="gs-btn-primary w-full">
                    Submit
                </button>
            </form>

            <script>
                const form = document.getElementById('submission-form');
                const button = document.getElementById('submit-button');

                form?.addEventListener('submit', () => {
                    button.disabled = true;
                    button.textContent = 'Submitting...';
                });
            </script>
        </div>
    </section>
@endsection
