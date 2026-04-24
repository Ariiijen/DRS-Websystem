<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Show all reports (dashboard)
    public function index()
    {
        $reports = Report::latest()->get();
        return view('reports.index', compact('reports'));
    }

    // Show report form
    public function create()
    {
        return view('reports.create');
    }

    // Store new report
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string|min:10|max:1000',
            'location' => 'required|string|max:255',
            'incident_type' => 'required|in:earthquake,flood,typhoon,fire,landslide',
            'reporter_name' => 'required|string|max:255',
        ]);

        Report::create($validated);

        return redirect()->route('reports.index')->with('success', 'Report submitted successfully!');
    }

    // Update report status
    public function update(Report $report, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,resolved',
        ]);

        $report->update($validated);

        return redirect()->route('reports.index')->with('success', 'Report status updated!');
    }
}