<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <style>
        .zeph-swal-popup {
            border-radius: 16px !important;
            padding: 2rem !important;
        }
        .zeph-swal-icon-success {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #16a34a, #22c55e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem auto;
        }
        .zeph-swal-icon-success i {
            color: #ffffff;
            font-size: 26px;
        }
        .zeph-swal-confirm {
            background-color: #2563eb !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
            padding: 0.6rem 2rem !important;
            box-shadow: none !important;
        }
    </style>

    @if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                html: `
                    <div class="zeph-swal-icon-success">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <h2 style="font-weight:700; color:#0f172a; font-size:1.15rem; margin-top:0.5rem;">
                        Berhasil!
                    </h2>
                    <p style="color:#64748b; font-size:0.9rem; margin-top:0.5rem;">
                        {{ session('success') }}
                    </p>
                `,
                confirmButtonText: 'OK',
                buttonsStyling: false,
                customClass: {
                    popup: 'zeph-swal-popup',
                    confirmButton: 'zeph-swal-confirm'
                }
            });
        });
    </script>
    @endif

    </body>
</html>
