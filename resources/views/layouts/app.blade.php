<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | GearVenture</title>
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">            
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">        
    @stack('style')
</head>
<body class="bg-gray-100">
    {{-- HEADER --}}
    @include('components.header')
    {{-- HEADER --}}

    {{-- CONTENT --}}
    @yield('content')
    {{-- CONTENT --}}

    {{-- FOOTER --}}
    @include('components.footer')
    {{-- FOOTER --}}
    @stack('script')
</body>
</html>