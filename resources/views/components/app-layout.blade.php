<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <title>Share and check the status of your loved ones | Disaster Check-In</title>
    <meta name="description"
          content="Text (828) 888-0440 if you are safe. Search for your loved one’s latest status using their phone number.">
    <meta property="og:site_name" content="Disaster Check-In">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('social-share.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    @vite('resources/css/app.css')
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

<footer class="flex justify-center max-w-xl mx-auto mt-8">
    <ul class="flex gap-4 text-sm text-slate-600">
        <li>
            <a href="https://twitter.com/intent/tweet?text=Text%20this%20number%20if%20you%20are%20safe%20%28828%29%20888-0440"
               class="flex gap-1.5 hover:opacity-70">
                <div class="flex gap-2">
                    <img src="{{ asset('/icons/twitter.svg') }}" alt="Spread the word on Twitter" width="24"/>
                    Spread the word
                </div>
            </a>
        </li>
        <li>
            <a target="_blank" href="https://app.cartamaps.com/share/21920abf-7a5a-4691-a03a-56a6c52198ac"
               class="flex gap-1.5 hover:opacity-70">
                <div class="flex gap-2">
                    <img src="{{ asset('/icons/road-icon.svg') }}" alt="Check road closures" width="24"/>
                    Check Road Closures
                </div>
            </a>
        </li>
    </ul>
</footer>

@vite('resources/js/app.js')

</body>
</html>
