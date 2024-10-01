<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleDocsService;
use Illuminate\Support\Facades\Cache;

class GoogleDocsController extends Controller
{
    public function __invoke(?string $format)
    {
        $doc = Cache::remember(
            "doc-$format",
            600,
            fn() => $this->doc($format)
        );

        return view('docs', [
            'doc' => $doc,
        ]);
    }

    protected function doc($format)
    {
        $format = match ($format) {
            'txt' => 'text/plain',
            'rtf' => 'application/rtf',
            'md' => 'text/markdown',
            'html' => 'text/html',
            default => 'text/html',
        };

        return GoogleDocsService::get(
            env('GOOGLE_DOCS_ID', '154hYrmMKWNKWIwcTkUP8GhcAn4z4LXnFr2AKMgv3Qik'),
            $format
        );
    }
}
