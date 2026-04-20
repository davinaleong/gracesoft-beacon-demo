@extends('layouts.beacon')

@section('title', 'Submit Secure Message')

@section('content')
    <section class="grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="rounded-3xl border border-cyan-100 bg-white/85 p-8 shadow-sm backdrop-blur">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-cyan-700">Secure Intake</p>
            <h1 class="mt-3 font-['Newsreader'] text-4xl leading-tight text-cyan-950 sm:text-5xl">Secure. Private. No
                Tracking.</h1>
            <p class="mt-4 max-w-2xl text-base text-slate-600">
                Submit a message for demo purposes only. Anonymous submissions are allowed and all stored records
                auto-delete within 24 hours.
            </p>

            <div class="mt-8 grid gap-3 rounded-2xl border border-emerald-200 bg-emerald-50/80 p-5 text-sm text-emerald-900">
                <p class="font-semibold">Trust Notice</p>
                <p>✓ We do NOT track you</p>
                <p>✓ Data auto-deletes within 24-48 hours (configured at 24 hours)</p>
                <p>✓ Anonymous submission allowed</p>
                <p>✓ Do NOT submit sensitive personal data (Demo Only)</p>
            </div>

            <p class="mt-6 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                This demo stores data temporarily and is intended for showcasing workflow only. Avoid submitting real
                sensitive information.
            </p>
        </div>

        <div class="rounded-3xl border border-cyan-100 bg-white p-8 shadow-sm">
            @if (session('submission_created'))
                <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
                    <p class="font-semibold">Submission received</p>
                    <p class="mt-1">Reference: {{ session('submission_created.id') }}</p>
                    <p class="mt-1">Expires at: {{ session('submission_created.expires_at') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                    Please review the highlighted fields and try again.
                </div>
            @endif

            <form id="submission-form" method="POST" action="{{ route('submit.store') }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">

                <div class="space-y-1">
                    <label for="name" class="text-sm font-medium text-slate-700">Name (optional)</label>
                    <input id="name" name="name" value="{{ old('name') }}"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100" />
                    @error('name')
                        <p class="text-xs text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="email" class="text-sm font-medium text-slate-700">Email (optional)</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100" />
                    @error('email')
                        <p class="text-xs text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="message" class="text-sm font-medium text-slate-700">Message</label>
                    <textarea id="message" name="message" rows="6" required
                        class="w-full rounded-xl border border-slate-200 px-3 py-2.5 outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-100">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-xs text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-1">
                    <label for="attachment" class="text-sm font-medium text-slate-700">File upload (optional, PDF/JPG/PNG,
                        max 2MB)</label>
                    <input id="attachment" type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png"
                        class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm file:mr-4 file:rounded-full file:border-0 file:bg-cyan-100 file:px-4 file:py-2 file:text-cyan-900" />
                    @error('attachment')
                        <p class="text-xs text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <button id="submit-button" type="submit"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-cyan-900 px-5 py-3 font-semibold text-cyan-50 transition hover:bg-cyan-800 disabled:cursor-not-allowed disabled:bg-cyan-600">
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
