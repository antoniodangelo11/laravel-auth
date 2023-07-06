<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel Boolfolio - Base</title>
     @vite('resources/js/app.js')
</head>
<body>
    @include('admin.includes.header')

    <div class="container-fluid">
        <main>
            @yield('contents')
        </main>
    </div>

    @include('admin.includes.footer')
</body>
</html>