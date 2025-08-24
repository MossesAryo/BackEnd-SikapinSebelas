<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikapin - Sistem Skoring</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/gurubk/app.css') }}">
    @stack('css')
</head>

<body class="bg-gray-50">
    <!-- Dashboard Layout -->
    <div class="flex">
        @include('layouts.gurubk.sidebar')

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top Navigation -->
            @include('layouts.gurubk.navbar')

            <!-- Dashboard Content -->
            <div class="p-6">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/gurubk/app.js') }}"></script>
    @stack('js')
</body>
</html>
