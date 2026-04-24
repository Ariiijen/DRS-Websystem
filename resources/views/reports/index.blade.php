@extends('layouts.app')

@section('title', 'Disaster Dashboard')

@section('content')
<div>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-light">Disaster Dashboard</h2>
            <p class="text-slate-600 text-sm mt-1">Total Reports: {{ count($reports) }}</p>
        </div>
        <a href="{{ route('reports.create') }}" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700">
            + New Report
        </a>
    </div>

    @if ($reports->isEmpty())
        <div class="bg-white rounded-lg border border-slate-200 p-12 text-center">
            <p class="text-slate-600 text-lg">No disaster reports yet.</p>
            <a href="{{ route('reports.create') }}" class="text-blue-600 hover:text-blue-700 mt-4 inline-block">Submit the first report</a>
        </div>
    @else
        <div class="bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Reporter</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Submitted</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach ($reports as $report)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-sm text-slate-900">#{{ $report->id }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $report->title }}</td>
                                <td class="px-6 py-4 text-sm text-slate-900">{{ $report->location }}</td>
                                <td class="px-6 py-4 text-sm text-slate-900">{{ ucfirst($report->incident_type) }}</td>
                                <td class="px-6 py-4 text-sm text-slate-900">{{ $report->reporter_name }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold badge-{{ $report->status }}">
                                        {{ ucfirst($report->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ $report->created_at->format('M d, Y H:i') }}</td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    @if ($report->status === 'pending')
                                        <form action="{{ route('reports.update', $report) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="resolved">
                                            <button type="submit" class="text-blue-600 hover:text-blue-700 font-medium">
                                                Resolve
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('reports.update', $report) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="pending">
                                            <button type="submit" class="text-amber-600 hover:text-amber-700 font-medium">
                                                Reopen
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection