<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex h-screen flex-col justify-center px-6 py-12 lg:px-8 mx-auto">
        @yield('content')
    </div>
</body>

</html>
