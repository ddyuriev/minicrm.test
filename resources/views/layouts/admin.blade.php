<!DOCTYPE html>
<html lang="ru" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>minicrm</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

@yield('content')

</body>
</html>
