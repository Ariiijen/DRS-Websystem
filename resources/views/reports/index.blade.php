@extends('layouts.app')

@section('title', 'Disaster Dashboard')

@section('content')
@php
    $pending = $reports->where('status', 'pending')->count();
    $resolved = $reports->where('status', 'resolved')->count();
@endphp

<div class="space-y-10">
    <section class="rounded-[2rem] border border-slate-200 bg-white/80 p-8 shadow-[0_25px_60px_-30px_rgba(15,23,42,0.35)] backdrop-blur">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Overview</p>
                <h2 class="mt-3 text-4xl font-semibold tracking-tight text-slate-900">Disaster Dashboard</h2>
                <p class="mt-4 max-w-xl text-slate-600 text-base leading-7">Track incoming reports, review incident details, and update statuses quickly with a calm, clear workspace.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('reports.create') }}" class="btn-primary">Submit New Report</a>
            </div>
        </div>

        <div class="mt-10 grid gap-4 sm:grid-cols-3">
            <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-6">
                <p class="text-sm text-slate-500 uppercase tracking-[0.24em]">Total reports</p>
                <p class="mt-4 text-4xl font-semibold text-slate-900">{{ count($reports) }}</p>
            </div>
            <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-6">
                <p class="text-sm text-slate-500 uppercase tracking-[0.24em]">Pending</p>
                <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $pending }}</p>
            </div>
            <div class="rounded-[1.5rem] border border-slate-200 bg-slate-50 p-6">
                <p class="text-sm text-slate-500 uppercase tracking-[0.24em]">Resolved</p>
                <p class="mt-4 text-4xl font-semibold text-slate-900">{{ $resolved }}</p>
            </div>
        </div>
    </section>

    @if ($reports->isEmpty())
        <section class="rounded-[2rem] border border-slate-200 bg-white p-12 text-center shadow-sm">
            <p class="text-xl font-semibold text-slate-900">No disaster reports yet.</p>
            <p class="mt-3 text-slate-600">Once a report is submitted, it will appear here with the latest status and details.</p>
            <a href="{{ route('reports.create') }}" class="mt-6 inline-flex rounded-full bg-sky-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-sky-700">Submit the first report</a>
        </section>
    @else
        <section class="rounded-[2rem] border border-slate-200 bg-white overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Title</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Location</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Type</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Reporter</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Submitted</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-[0.2em] text-slate-500">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($reports as $report)
                            <tr class="transition hover:bg-slate-50/80">
                                <td class="px-6 py-4 text-sm font-medium text-slate-800">#{{ $report->id }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-slate-900">{{ $report->title }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $report->location }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ ucfirst($report->incident_type) }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $report->reporter_name }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $report->status === 'pending' ? 'badge-pending' : 'badge-resolved' }}">
                                        {{ ucfirst($report->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $report->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    @if ($report->status === 'pending')
                                        <form action="{{ route('reports.update', $report) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="resolved">
                                            <button type="submit" class="text-sky-600 font-semibold hover:text-sky-700">Resolve</button>
                                        </form>
                                    @else
                                        <form action="{{ route('reports.update', $report) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="text-amber-600 font-semibold hover:text-amber-700">Reopen</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif
</div>
@endsection
