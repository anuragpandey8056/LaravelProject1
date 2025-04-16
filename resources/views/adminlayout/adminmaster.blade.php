<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Layout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">


    @include('Layouts.navigation')

    <div class="d-flex">
       
        <div class="bg-dark text-white" style="width: 260px; min-height: 100vh;">
            @include('adminlayout.adminheader')
        </div>

       
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

  
    @include('adminlayout.adminfooter')

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
