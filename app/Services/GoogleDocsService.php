<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;


class GoogleDocsService {
    protected $service;
    protected $drive;

    public function __construct()
    {
        $client = new Client();
        $client->setApplicationName("Laravel Google Docs");
        $client->setDeveloperKey(env('GOOGLE_API_KEY'));

        $this->drive = new Drive($client);
    }

    public function getContents($documentId, string $mime)
    {
        $response = $this->drive->files->export(
            $documentId,
            $mime,
            ['alt' => 'media'],
        );

        return $response->getBody()->getContents();
    }

    public static function get($id, string $mime)
    {
        return (new static())->getContents($id, $mime);
    }
}