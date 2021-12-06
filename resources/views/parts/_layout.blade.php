<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CORRE</title>
    <link rel="stylesheet" href="{{ asset('site/estilo.css') }}">
    <!-- foundation-float.min.css: Compressed CSS with legacy Float Grid -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.4/dist/css/foundation-float.min.css" crossorigin="anonymous">
    <!-- foundation-prototype.min.css: Compressed CSS with prototyping classes -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.4/dist/css/foundation-prototype.min.css" crossorigin="anonymous">
    <!-- foundation-rtl.min.css: Compressed CSS with right-to-left reading direction -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.4/dist/css/foundation-rtl.min.css" crossorigin="anonymous">
    <!-- Compressed CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.4/dist/css/foundation.min.css" crossorigin="anonymous">
    <!-- Compressed JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.4/dist/js/foundation.min.js" crossorigin="anonymous"></script>
</head>
<body>
    @yield('content')
</body>
</html>