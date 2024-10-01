@props([
    'head',
])

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Share and check the status of your loved ones | Disaster Check-In</title>
    <meta name="description" content="Text (828) 888-0440 if you are safe. Search for your loved one’s latest status using their phone number.">
    <meta property="og:site_name" content="Disaster Check-In">
    <meta property="og:url" content="https://disastercheckin.com/">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://disastercheckin.com/social-share.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:image" content="https://disastercheckin.com/social-share.png">
    <meta name="twitter:card" content="summary_large_image">
    @vite('resources/css/app.css')
    {{ $head ?? null }}
</head>
<body class="bg-slate-100 font-sans antialiased m-6 lg:m-8">

<div class="mx-auto max-w-xl bg-white py-6 lg:p-8 p-6 flex-1 shadow-sm border border-slate-300 rounded-md">
    <header>
        <x-logo/>
    </header>
    <main class="max-w-lg min-w-full">
        {{ $slot }}
    </main>
</div>

<footer class="mt-8 max-w-xl mx-auto text-right flex justify-center">
    <ul class="text-slate-600 flex gap-4 text-sm">
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
