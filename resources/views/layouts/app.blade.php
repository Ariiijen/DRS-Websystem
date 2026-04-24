<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — Disaster Reporting System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-resolved {
            background-color: #dcfce7;
            color: #166534;
        }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            background-color: #0ea5e9;
            color: #ffffff;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s ease, transform 0.2s ease;
            box-shadow: 0 12px 30px -18px rgba(14, 165, 233, 0.85);
        }
        .btn-primary:hover {
            background-color: #0284c7;
            transform: translateY(-1px);
        }
        .btn-border {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            border: 1px solid #e2e8f0;
            background-color: #ffffff;
            color: #0f172a;
            padding: 0.75rem 1.25rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }
        .btn-border:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-900 antialiased">
    <nav class="bg-white/90 backdrop-blur border-b border-slate-200 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 py-5">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.22em] text-slate-500 mb-1">Disaster Reporting System</p>
                    <h1 class="text-3xl md:text-4xl font-semibold tracking-tight text-slate-900">Command Center</h1>
                </div>
                <div class="flex flex-wrap justify-start gap-3">
                    <a href="{{ route('reports.index') }}" class="btn-border">Dashboard</a>
                    <a href="{{ route('reports.create') }}" class="btn-primary">Submit Report</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-6 py-10">
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