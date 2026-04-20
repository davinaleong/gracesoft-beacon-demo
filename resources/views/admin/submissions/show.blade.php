@extends('layouts.beacon')

@section('title', 'Submission Details')

@section('content')
    <section class="space-y-5">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.submissions.index') }}"
                class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                Back to submissions
            </a>

            <form method="POST" action="{{ route('admin.submissions.destroy', $submission) }}"
                onsubmit="return confirm('This will permanently delete the submission. Continue?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="rounded-lg border border-rose-200 bg-rose-50 px-4 py-2 text-sm font-medium text-rose-800 hover:bg-rose-100">
                    Delete
                </button>
            </form>
        </div>

        <article class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
            <h1 class="font-['Newsreader'] text-4xl text-slate-900">Submission {{ str($submission->id)->limit(8, '') }}</h1>
            <p class="mt-2 text-sm text-slate-600">This record will be deleted at:
                {{ $submission->expires_at->format('M d, Y H:i') }}</p>

            <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Name</dt>
                    <dd class="mt-1 text-sm text-slate-900">{{ $submission->name ?: 'Anonymous' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Email</dt>
                    <dd class="mt-1 text-sm text-slate-900">{{ $submission->email ?: 'Not provided' }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Created At</dt>
                    <dd class="mt-1 text-sm text-slate-900">{{ $submission->created_at->format('M d, Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">Expiry Time</dt>
                    <dd class="mt-1 text-sm text-slate-900">{{ $submission->expires_at->format('M d, Y H:i') }}</dd>
                </div>
            </dl>

            <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Message</p>
                <p class="mt-2 whitespace-pre-wrap text-sm leading-6 text-slate-900">{{ $submission->message }}</p>
            </div>

            @if ($submission->file_path)
                <div class="mt-6">
                    <a href="{{ route('admin.files.download', $submission) }}"
                        class="inline-flex rounded-lg border border-cyan-200 bg-cyan-50 px-4 py-2 text-sm font-semibold text-cyan-900 hover:bg-cyan-100">
                        Download Attachment
                    </a>
                </div>
            @endif
        </article>
    </section>
@endsection
