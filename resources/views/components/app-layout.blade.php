<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disaster Check-In</title>
    @vite('resources/css/app.css')
    {{ $head ?? null }}
</head>
<body class="bg-slate-100 font-sans antialiased">
<div class="p-6 lg:p-8">
    <main class="mx-auto max-w-6xl">
        {{ $slot }}
    </main>
</div>
</body>
</html>
