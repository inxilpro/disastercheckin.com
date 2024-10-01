<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disaster Check-In</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    {{ $head ?? null }}
</head>
<body class="m-6 font-sans antialiased bg-slate-100 lg:m-8">

<div class="flex-1 max-w-xl p-6 py-6 mx-auto bg-white border rounded-md shadow-sm lg:p-8 border-slate-300">
    <header>
        <x-logo/>
    </header>
    <main class="max-w-lg min-w-full">
        {{ $slot }}
    </main>
</div>

<footer class="flex justify-center max-w-xl mx-auto mt-8 text-right">
    <ul class="flex gap-4 text-sm text-slate-600">
        <li>
            <a href="https://twitter.com/intent/tweet?text=Text%20this%20number%20if%20you%20are%20safe%20%28828%29%20888-0440"
               class="flex gap-1.5 hover:opacity-70">
                Spread the word on Twitter
            </a>
        </li>
        <li>
            <a href="https://app.cartamaps.com/share/21920abf-7a5a-4691-a03a-56a6c52198ac"
               class="flex gap-1.5 hover:opacity-70">
                Check Road Closures
            </a>
        </li>
    </ul>
</footer>
</body>
</html>
