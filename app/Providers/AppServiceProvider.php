<?php

namespace App\Providers;

use App\Models\FileManager;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->when(FileManager::class)
            ->needs(Client::class)
            ->give(function () {
                return new Client([
                    'base_uri' => 'https://picsum.photos'
                ]);
            });
    }

    public function boot(): void
    {
        //
    }
}
