<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah Sakit - Antrian Online')</title>

    @vite('resources/css/app.css')

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-KNw+JBTjFZqNnoQEGqT2W8cbiKZrP7fDy07n+74ZXqYMY2bQpuoxKPkMWuX8dlvDJzA2pGdWb9bUjZfajW0gYg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>

<body class="antialiased bg-green-950 text-white">
    @yield('content')
</body>
</html>
