<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHL SmartSolutions</title>
    <link rel="icon" href="{{ asset('/images/logo.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
</head>

<body>
    <!-- Main Content -->
    {{ $slot }}

</body>

</html>