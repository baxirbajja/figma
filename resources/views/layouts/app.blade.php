<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
<style>
        body{
            font-family: 'Poppins', sans-serif;
        }
        .nav li .active {
            color:#D22254 !important;
            border-bottom: 3px solid #D22254;
        }
        .nav-link{
            color:#5E5E5E ;
        }
        .nav-link:hover{
            color:#D22254!important;
        }
        .nav{
            margin-top:40px;
            border-bottom: 2px solid #E2E8F0;
        }
        .table-item{
border: 1px solid #E2E8F0;
margin-bottom: 1rem;
        }
        thead th {
            color:#5F5F5F;
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            padding: 1rem;
            background-color: #FFF !important;
        }

        tbody {
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            color:#5F5F5F;
        }
        .plate-image{
            width: 50px;
            height: 50px;
            object-fit: cover;
            
            border-radius: 40%;
        }
        tbody svg{
            width: 20px !important;
            height: 20px !important;
            margin: 0px 5px !important;
        }
        input{
            border:none !important;
            border-radius: 4px;box-shadow: inset 0px 2px 5px rgba(0, 0, 0, 0.1);border: none;
        }
        
        

    </style>
    <div class="min-h-screen">
        @auth   
            @include('layouts.sidebar')
            @include('layouts.header', ['notifications_count' => 1])
            
            <main class="content-wrapper">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                {{ $slot }}
            </main>
        @else
            {{ $slot }}
        @endauth
    </div>

    @stack('modals')
    @stack('scripts')
</body>
</html>
