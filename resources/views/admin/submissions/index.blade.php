@extends('layouts.gracesoft-admin')

@section('title', 'Admin Submissions')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Welcome back. Here is a snapshot of operations, billing, and finance health today.')

@section('content')
    @php
        $visibleSubmissions = $submissions->getCollection();
        $overdueCount = $visibleSubmissions->filter(fn($submission) => $submission->expires_at->isPast())->count();
        $pendingCount = $visibleSubmissions->filter(fn($submission) => !$submission->expires_at->isPast())->count();
    @endphp

    @if (session('status'))
        <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-900">
            {{ session('status') }}
        </div>
    @endif

    <section class="space-y-4">
        <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-4">
            <article class="rounded-md border border-slate-300 bg-white p-3.5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Outstanding Exposure</p>
                <p class="mt-1 text-3xl font-bold text-slate-900">$0.00</p>
                <p class="mt-1 text-xs text-slate-500">Total receivables currently at risk.</p>
            </article>

            <article class="rounded-md border border-emerald-200 bg-emerald-50 p-3.5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Overdue Invoices</p>
                <p class="mt-1 text-3xl font-bold text-emerald-700">{{ $overdueCount }}</p>
                <p class="mt-1 text-xs text-emerald-700">No overdue invoices</p>
            </article>

            <article class="rounded-md border border-emerald-200 bg-emerald-50 p-3.5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Pending Approvals</p>
                <p class="mt-1 text-3xl font-bold text-emerald-700">{{ $pendingCount }}</p>
                <p class="mt-1 text-xs text-emerald-700">Approval queue is clear</p>
            </article>

            <article class="rounded-md border border-emerald-200 bg-emerald-50 p-3.5">
                <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Unread Notifications</p>
                <p class="mt-1 text-3xl font-bold text-emerald-700">0</p>
                <p class="mt-1 text-xs text-emerald-700">Inbox is clear</p>
            </article>
        </div>

        <div class="rounded-md border border-slate-300 bg-white p-3.5">
            <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Focus Signals</p>
            <div class="mt-2 flex flex-wrap gap-2 text-xs font-semibold">
                <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-emerald-700">Healthy: No overdue invoices</span>
                <span class="rounded-full bg-sky-100 px-2.5 py-1 text-sky-700">Ops inbox: 0 unread</span>
            </div>
        </div>

        <div class="grid gap-3 xl:grid-cols-[1fr_360px]">
            <div class="overflow-hidden rounded-md border border-slate-300 bg-white">
                <div class="border-b border-slate-200 px-3 py-2.5">
                    <h2 class="text-2xl font-bold text-[#352AA6]">Recent Invoices</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="bg-slate-100 text-[11px] font-semibold uppercase tracking-wide text-slate-600">
                            <tr>
                                <th class="px-3 py-2">Invoice</th>
                                <th class="px-3 py-2">Due Date</th>
                                <th class="px-3 py-2">Total</th>
                                <th class="px-3 py-2">Balance Due</th>
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
                                    <td class="px-3 py-2">{{ $submission->expires_at->format('M d, Y') }}</td>
                                    <td class="px-3 py-2">$0.00</td>
                                    <td class="px-3 py-2">$0.00</td>
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
                                    <td colspan="6" class="px-4 py-8 text-center text-slate-500">No records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-slate-200 px-3 py-2.5">
                    {{ $submissions->links() }}
                </div>
            </div>

            <aside class="rounded-md border border-slate-300 bg-white p-3.5">
                <h3 class="text-3xl font-bold text-[#352AA6]">Quick Links</h3>
                <ul class="mt-3 space-y-2 text-sm font-semibold text-[#352AA6]">
                    <li><a href="#" class="hover:underline">Open Clients</a></li>
                    <li><a href="#" class="hover:underline">Open Orders</a></li>
                    <li><a href="#" class="hover:underline">Finance Dashboard</a></li>
                    <li><a href="#" class="hover:underline">Currency Rates</a></li>
                    <li><a href="#" class="hover:underline">Reminders</a></li>
                    <li><a href="#" class="hover:underline">Notifications</a></li>
                </ul>
            </aside>
        </div>
    </section>
@endsection
