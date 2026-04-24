<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Disaster Reporting System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }
        .font-light { font-weight: 300; }
        .font-medium { font-weight: 500; }
        .badge-pending { background-color: #fee2e2; color: #991b1b; }
        .badge-resolved { background-color: #dcfce7; color: #166534; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <nav class="bg-white border-b border-slate-200">
        <div class="max-w-6xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-light">Disaster Reporting System</h1>
                <div class="space-x-4">
                    <a href="{{ route('reports.index') }}" class="text-blue-600 hover:text-blue-700">Dashboard</a>
                    <a href="{{ route('reports.create') }}" class="text-blue-600 hover:text-blue-700">Submit Report</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-8">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 mt-12 py-6 text-center text-sm text-slate-600">
        <p>&copy; 2024 Disaster Reporting System. All rights reserved.</p>
    </footer>
</body>
</html>