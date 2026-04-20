@extends('layouts.beacon')

@section('title', 'Admin Submissions')

@section('content')
    <section class="space-y-5">
        <div class="rounded-3xl border border-cyan-100 bg-white p-6 shadow-sm">
            <h1 class="font-['Newsreader'] text-4xl text-cyan-950">Submissions</h1>
            <p class="mt-2 text-sm text-slate-600">All records in this dashboard are demo data and auto-delete on expiry.</p>
        </div>

        @if (session('status'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
                {{ session('status') }}</div>
        @endif

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="px-4 py-3 font-semibold">ID</th>
                            <th class="px-4 py-3 font-semibold">Message</th>
                            <th class="px-4 py-3 font-semibold">File</th>
                            <th class="px-4 py-3 font-semibold">Created</th>
                            <th class="px-4 py-3 font-semibold">Expiry</th>
                            <th class="px-4 py-3 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($submissions as $submission)
                            @php
                                $isExpired = $submission->expires_at->isPast();
                                $isExpiringSoon = !$isExpired && now()->diffInHours($submission->expires_at) < 6;
                            @endphp
                            <tr class="{{ $isExpired ? 'bg-slate-100/70 text-slate-500' : 'hover:bg-cyan-50/40' }}">
                                <td class="px-4 py-3 font-mono text-xs">
                                    <a href="{{ route('admin.submissions.show', $submission) }}"
                                        class="underline decoration-dotted underline-offset-4">
                                        {{ str($submission->id)->limit(8, '') }}
                                    </a>
                                </td>
                                <td class="max-w-sm px-4 py-3">{{ str($submission->message)->limit(65) }}</td>
                                <td class="px-4 py-3">{{ $submission->file_path ? 'Yes' : 'No' }}</td>
                                <td class="px-4 py-3">{{ $submission->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="rounded-full px-2 py-1 text-xs font-semibold {{ $isExpired ? 'bg-slate-300 text-slate-700' : ($isExpiringSoon ? 'bg-rose-100 text-rose-800' : 'bg-cyan-100 text-cyan-900') }}">
                                        {{ $submission->expires_at->format('M d, Y H:i') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.submissions.show', $submission) }}"
                                            class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-50">View</a>
                                        <form method="POST" action="{{ route('admin.submissions.destroy', $submission) }}"
                                            onsubmit="return confirm('This will permanently delete the submission. Continue?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-lg border border-rose-200 bg-rose-50 px-3 py-1.5 text-xs font-medium text-rose-800 hover:bg-rose-100">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-slate-500">No submissions yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-200 px-4 py-3">
                {{ $submissions->links() }}
            </div>
        </div>
    </section>
@endsection
