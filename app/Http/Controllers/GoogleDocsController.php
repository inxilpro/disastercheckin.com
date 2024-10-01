<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleDocsService;

class GoogleDocsController extends Controller
{
    public function __invoke(?string $format)
    {
        $format = match ($format) {
            'txt' => 'text/plain',
            'rtf' => 'application/rtf',
            'md' => 'text/markdown',
            'html' => 'text/html',
            default => 'text/html',
        };

        $pre = match($format) {
            'md' => true,
            default => false
        };

        $doc = GoogleDocsService::get(env('GOOGLE_DOCS_ID'), $format);

        return view('docs', [
            'doc' => $doc,
            'pre' => $pre
        ]);
    }
}
