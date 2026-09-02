<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Doutores CMS - Sistema de gerenciamento de conteúdo.">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title')</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <div class="relative min-h-screen bg-gray-100 dark:bg-gray-900 p-5">@yield('content')</div>
</body>
</html>