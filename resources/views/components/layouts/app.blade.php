<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/favicon.ico">
        <title>Asheville Water Barrel Board</title>
        <meta property="og:site_name" content="Disaster Check-In">
        <meta property="og:url" content="{{ config('app.url') }}">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ asset('social-share.png') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta name="twitter:card" content="summary_large_image">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        @vite('resources/css/app.css')
        @fluxStyles()
        {{ $head ?? null }}

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="g-white dark:bg-zinc-900 antialiased min-h-screen">
        {{$slot}}
        @fluxScripts()
    </body>
</html>
