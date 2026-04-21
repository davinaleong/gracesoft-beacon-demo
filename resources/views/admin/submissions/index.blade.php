@extends('layouts.gracesoft-admin')

@section('title', 'Admin Submissions')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Review demo submissions with privacy-first controls and security-first safeguards.')

@section('content')
    @php
        $visibleSubmissions = $submissions->getCollection();
        $expiredCount = $visibleSubmissions->filter(fn($submission) => $submission->expires_at->isPast())->count();
        $activeCount = $visibleSubmissions->filter(fn($submission) => !$submission->expires_at->isPast())->count();
        $withAttachmentCount = $visibleSubmissions->filter(fn($submission) => filled($submission->file_path))->count();
    @endphp

    @if (session('status'))
        <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
            {{ session('status') }}
        </div>
    @endif

    <section class="space-y-4">
        <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-md border border-slate-300 bg-white p-3.5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Visible Records</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">{{ $submissions->total() }}</p>
                <p class="mt-1 text-xs text-slate-500">Includes seeded demo records when seeder is run.</p>
            </article>

            <article class="rounded-md border border-emerald-200 bg-emerald-50 p-3.5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Active Retention Window</p>
                <p class="mt-1 text-3xl font-bold text-emerald-700">{{ $activeCount }}</p>
                <p class="mt-1 text-xs text-emerald-700">Submissions still before expiry.</p>
            </article>

            <article class="rounded-md border border-emerald-200 bg-emerald-50 p-3.5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Expired Records</p>
                <p class="mt-1 text-3xl font-bold text-amber-700">{{ $expiredCount }}</p>
                <p class="mt-1 text-xs text-amber-700">Eligible for cleanup by retention policy.</p>
            </article>

            <article class="rounded-md border border-emerald-200 bg-emerald-50 p-3.5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Attachments</p>
                <p class="mt-1 text-3xl font-bold text-indigo-700">{{ $withAttachmentCount }}</p>
                <p class="mt-1 text-xs text-indigo-700">Protected files in local private storage.</p>
            </article>
        </div>

        <div id="security-controls" class="rounded-md border border-slate-300 bg-white p-3.5">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Security-first Controls</p>
            <div class="mt-2 flex flex-wrap gap-2 text-xs font-semibold">
                <span class="rounded-full bg-indigo-100 px-2.5 py-1 text-indigo-700">Admin auth required</span>
                <span class="rounded-full bg-indigo-100 px-2.5 py-1 text-indigo-700">Throttled login and submission
                    routes</span>
                <span class="rounded-full bg-indigo-100 px-2.5 py-1 text-indigo-700">CSRF protection on all write
                    actions</span>
                <span class="rounded-full bg-indigo-100 px-2.5 py-1 text-indigo-700">Private local-disk file storage</span>
            </div>
        </div>

        <div class="grid gap-3 xl:grid-cols-[1fr_360px]">
            <div class="overflow-hidden rounded-md border border-slate-300 bg-white">
                <div class="border-b border-slate-200 px-3 py-2.5">
                    <h2 class="text-2xl font-bold text-[#352AA6]">Demo Submission Records</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-slate-100 text-[11px] font-semibold uppercase tracking-wide text-slate-600">
                            <tr>
                                <th class="px-3 py-2">Reference</th>
                                <th class="px-3 py-2">Name</th>
                                <th class="px-3 py-2">Email</th>
                                <th class="px-3 py-2">Message</th>
                                <th class="px-3 py-2">Created</th>
                                <th class="px-3 py-2">Status</th>
                                <th class="px-3 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($submissions as $submission)
                                @php
                                    $isExpired = $submission->expires_at->isPast();
                                @endphp
                                <tr class="{{ $isExpired ? 'bg-slate-50 text-slate-500' : 'hover:bg-slate-50' }}">
                                    <td class="px-3 py-2 font-mono text-xs">
                                        <a href="{{ route('admin.submissions.show', $submission) }}"
                                            class="underline decoration-dotted underline-offset-4">
                                            {{ str($submission->id)->limit(8, '') }}
                                        </a>
                                    </td>
                                    <td class="px-3 py-2">{{ $submission->name ?: 'Anonymous' }}</td>
                                    <td class="px-3 py-2">{{ $submission->email ?: 'Not provided' }}</td>
                                    <td class="max-w-70 truncate px-3 py-2">{{ $submission->message }}</td>
                                    <td class="px-3 py-2">{{ $submission->created_at->format('d M Y') }}</td>
                                    <td class="px-3 py-2">
                                        <span
                                            class="rounded-full px-2 py-1 text-xs font-semibold {{ $isExpired ? 'bg-slate-200 text-slate-700' : 'bg-emerald-100 text-emerald-700' }}">
                                            {{ $isExpired ? 'Expired' : 'Current' }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.submissions.show', $submission) }}"
                                                class="inline-flex items-center rounded-md border border-slate-300 bg-white px-2.5 py-1 text-xs font-semibold text-slate-700 transition hover:bg-slate-50">View</a>
                                            <form method="POST"
                                                action="{{ route('admin.submissions.destroy', $submission) }}"
                                                onsubmit="return confirm('This will permanently delete the submission. Continue?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="rounded border border-rose-200 bg-rose-50 px-2.5 py-1 text-xs font-medium text-rose-800 hover:bg-rose-100">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-slate-500">No records found. Run
                                        database seeding to show demo records.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-slate-200 px-3 py-2.5">
                    {{ $submissions->links() }}
                </div>
            </div>

            <aside id="privacy-controls" class="rounded-md border border-slate-300 bg-white p-3.5">
                <h3 class="text-3xl font-bold text-[#352AA6]">Privacy-first</h3>
                <ul class="mt-3 space-y-2 text-sm text-slate-700">
                    <li>Retention expiry configured through DEMO_RETENTION_MINUTES.</li>
                    <li>Anonymous submissions are fully supported.</li>
                    <li>Uploads stay in private storage and are not publicly listed.</li>
                    <li>Each record shows expiry status for transparent lifecycle control.</li>
                </ul>

                <p class="mt-4 rounded-md border border-indigo-100 bg-indigo-50 px-3 py-2 text-xs text-indigo-700">
                    Seeder visibility: default seeding creates one admin account and six sample submissions.
                </p>
            </aside>
        </div>
    </section>
@endsection
