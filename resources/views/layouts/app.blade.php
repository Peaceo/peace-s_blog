<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
     {{-- @vite('resources/css/app.css') --}}
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="/dist/output.css" rel="stylesheet">
        <link rel="stylesheet" href="mystyle.css">
        <link rel="stylesheet" href="/public/css/app.css">
        <link rel="stylesheet" href="/resources/css/app.css">


        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <!-- JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

    </head>

    
    <body class="font-sans antialiased">
        @include('sweetalert::alert')
        <div class="min-h-screen bg-gray-100">
            @include('sweetalert::alert')

            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{-- {{ $header }} --}}
                </div>
            </header>

            <!-- Page Content -->
            <div>
                 @yield('content') 
            </div>
        </div>
        {{-- toastr js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;
            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif(Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @endif
        });

    </script>
    </body>
</html>
