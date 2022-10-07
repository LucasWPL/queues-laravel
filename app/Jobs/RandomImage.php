<?php

namespace App\Jobs;

use App\Models\FileManager;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RandomImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private FileManager $fileManager;

    public function __construct()
    {
        $client = new Client();
        $this->fileManager = new FileManager($client);
    }

    public function handle()
    {
        $this->fileManager->saveRandomPhoto();
    }
}
