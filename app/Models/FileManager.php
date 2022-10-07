<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileManager extends Model
{
    public function __construct(private Client $cliente)
    {
    }
    public function saveRandomPhoto()
    {
        $response = $this->client->request('GET', 'https://picsum.photos/4000');
        Storage::disk('public')->put(uniqid() . '.jpg', $response->getBody());
    }
}
