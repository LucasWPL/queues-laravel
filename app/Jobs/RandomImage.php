<?php

namespace App\Jobs;

use App\Models\FileManager;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RandomImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private int $size)
    {
    }

    public function handle(FileManager $fileManager)
    {
        $fileManager->saveRandomPhoto($this->size);
    }
}
