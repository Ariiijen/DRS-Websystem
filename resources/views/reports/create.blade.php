@extends('layouts.app')

@section('title', 'Submit Disaster Report')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-3xl font-light mb-6">Report a Disaster</h2>

    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-8">
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-sm font-medium text-red-900 mb-2">Please fix the following errors:</p>
                <ul class="list-disc list-inside space-y-1 text-sm text-red-800">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('reports.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 mb-2">
                    Disaster Title <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    placeholder="e.g., Heavy Flooding in San Pedro"
                    value="{{ old('title') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <div>
                <label for="incident_type" class="block text-sm font-medium text-slate-700 mb-2">
                    Incident Type <span class="text-red-500">*</span>
                </label>
                <select 
                    id="incident_type" 
                    name="incident_type"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
                    <option value="">Select incident type</option>
                    @foreach (App\Models\Report::INCIDENT_TYPES as $value => $label)
                        <option value="{{ $value }}" {{ old('incident_type') === $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-slate-700 mb-2">
                    Location <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="location" 
                    name="location" 
                    placeholder="e.g., Barangay San Pedro, Cagayan de Oro"
                    value="{{ old('location') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 mb-2">
                    Description <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="5"
                    placeholder="Describe what happened, affected areas, etc."
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                    required>{{ old('description') }}</textarea>
                <p class="text-xs text-slate-600 mt-2">Minimum 10 characters, maximum 1000</p>
            </div>

            <div>
                <label for="reporter_name" class="block text-sm font-medium text-slate-700 mb-2">
                    Your Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="reporter_name" 
                    name="reporter_name" 
                    placeholder="Your full name"
                    value="{{ old('reporter_name') }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <div class="flex gap-4 pt-4">
                <button 
                    type="submit"
                    class="flex-1 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
                    Submit Report
                </button>
                <a 
                    href="{{ route('reports.index') }}"
                    class="flex-1 px-6 py-3 border border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection