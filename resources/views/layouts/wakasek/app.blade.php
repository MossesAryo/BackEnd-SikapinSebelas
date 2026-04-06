    <!DOCTYPE html>

    @push('css')
        <style>
            .modal-open {
                overflow: hidden !important;
            }

            [z-[999999]] {
                z-index: 999999 !important;
            }
        </style>
    @endpush

    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- SEO Meta Tags -->
        <meta name="description"
            content="Sikapin adalah sistem skoring untuk manajemen penilaian, monitoring siswa, dan dashboard sekolah yang modern dan responsif.">
        <meta name="keywords"
            content="Sikapin, sistem skoring, dashboard sekolah, penilaian siswa, monitoring siswa, wakasek, sekolah">
        <meta name="author" content="Sikapin">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ url()->current() }}">

        <!-- Open Graph -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="Sikapin - Sistem Skoring">
        <meta property="og:description"
            content="Sistem skoring modern untuk monitoring dan manajemen penilaian siswa di sekolah.">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('images/logo.png') }}">
        <title>Sikapin - Sistem Skoring</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
            rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <link rel="stylesheet" href="{{ asset('css/wakasek/app.css') }}">
        @stack('css')
    </head>

    <body class="bg-gray-50">
        <!-- Dashboard Layout -->
        <div class="flex">
            @include('layouts.wakasek.sidebar')

            <!-- Main Content -->
            <div class="flex-1 ml-64">
                <!-- Top Navigation -->
                @include('layouts.wakasek.navbar')

                <!-- Dashboard Content -->
                <div class="p-6">
                    @yield('content')
                </div>
            </div>
        </div>


        @stack('js')
    </body>

    </html>
