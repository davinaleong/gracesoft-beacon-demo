@extends('layouts.gracesoft-admin')

@section('title', 'Submission Details')
@section('page_title', 'Submission Details')
@section('page_subtitle', 'Review full submission data, file metadata, and lifecycle timing.')

@section('content')
    <section class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route('admin.submissions.index') }}" class="gs-btn-outline">
                Back to Dashboard
            </a>

            <form method="POST" action="{{ route('admin.submissions.destroy', $submission) }}"
                onsubmit="return confirm('This will permanently delete the submission. Continue?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="rounded-md border border-rose-200 bg-rose-50 px-4 py-2 text-sm font-semibold text-rose-800 transition hover:bg-rose-100">
                    Delete
                </button>
            </form>
        </div>

        <article class="rounded-md border border-slate-300 bg-white p-5">
            <h2 class="text-3xl font-bold text-[#352AA6]">Submission {{ str($submission->id)->limit(8, '') }}</h2>
            <p class="mt-1 text-sm text-slate-600">This record will be deleted at:
                {{ $submission->expires_at->format('M d, Y H:i') }}</p>

            <dl class="mt-5 grid gap-4 sm:grid-cols-2">
                <div class="rounded-md border border-slate-200 bg-slate-50 p-3">
                    <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Name</dt>
                    <dd class="mt-1 text-sm font-medium text-slate-900">{{ $submission->name ?: 'Anonymous' }}</dd>
                </div>
                <div class="rounded-md border border-slate-200 bg-slate-50 p-3">
                    <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Email</dt>
                    <dd class="mt-1 text-sm font-medium text-slate-900">{{ $submission->email ?: 'Not provided' }}</dd>
                </div>
                <div class="rounded-md border border-slate-200 bg-slate-50 p-3">
                    <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Created At</dt>
                    <dd class="mt-1 text-sm font-medium text-slate-900">{{ $submission->created_at->format('M d, Y H:i') }}
                    </dd>
                </div>
                <div class="rounded-md border border-slate-200 bg-slate-50 p-3">
                    <dt class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Expiry Time</dt>
                    <dd class="mt-1 text-sm font-medium text-slate-900">{{ $submission->expires_at->format('M d, Y H:i') }}
                    </dd>
                </div>
            </dl>

            <div class="mt-5 rounded-md border border-slate-200 bg-white p-4">
                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-500">Message</p>
                <p class="mt-2 whitespace-pre-wrap text-sm leading-6 text-slate-900">{{ $submission->message }}</p>
            </div>

            @if ($submission->file_path)
                <div class="mt-5">
                    <a href="{{ route('admin.files.download', $submission) }}" class="gs-btn-outline-brand">
                        Download Attachment
                    </a>
                </div>
            @endif
        </article>
    </section>
@endsection
