<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileManager extends Model
{
    public function __construct(private Client $client)
    {
    }

    public function saveRandomPhoto(int $size)
    {
        $response = $this->client->request('GET', "/{$size}");
        Storage::disk('public')->put(uniqid() . '.jpg', $response->getBody());
    }
}
