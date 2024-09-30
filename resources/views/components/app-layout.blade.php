<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Disaster Check-In</title>
    @vite('resources/css/app.css')
    {{ $head ?? null }}
</head>
<body class="bg-slate-100 font-sans antialiased m-6 lg:m-8">

<div class="mx-auto max-w-xl bg-white py-6 lg:p-8 p-6 flex-1 shadow-sm border border-slate-300 rounded-md">
    <header>
        <h1 class="text-3xl font-bold mb-8 w-full">
            <a class="flex items-center gap-2 no-underline text-slate-600 tracking-tight" href="/">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="size-10 fill-red-500">
                    <path
                        d="M224 432c61.8 0 116.1-31.8 147.5-80l54.9 0c-36 75.7-113.1 128-202.4 128C100.3 480 0 379.7 0 256S100.3 32 224 32c118.3 0 215.2 91.8 223.4 208l-48.2 0C391.2 150.3 315.8 80 224 80C126.8 80 48 158.8 48 256s78.8 176 176 176zm0-304c13.3 0 24 10.7 24 24l0 112c0 13.3-10.7 24-24 24s-24-10.7-24-24l0-112c0-13.3 10.7-24 24-24zM192 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM478 224c-2.1-16.5-5.7-32.6-10.8-48l76.7 0c26.5 0 48-21.5 48-48s-21.5-48-48-48l-40 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l40 0c53 0 96 43 96 96s-43 96-96 96l-66 0zm-6 256c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0c30.9 0 56-25.1 56-56s-25.1-56-56-56l-192 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l192 0c57.4 0 104 46.6 104 104s-46.6 104-104 104l-64 0z"/>
                </svg>
                Disaster Check-In
            </a>
        </h1>
    </header>
    <main class="max-w-lg min-w-full">
        {{ $slot }}
    </main>
</div>

<footer class="mt-8 max-w-xl mx-auto text-right flex justify-center">
    <ul class="text-slate-600 hover:opacity-70 text-sm">
        <li>
            <!-- TODO: Hook up these social links -->
            <a href="#" class="flex gap-1.5">
                Spread the word on <strong>X</strong>
            </a>
        </li>
    </ul>
</footer>
</body>
</html>
