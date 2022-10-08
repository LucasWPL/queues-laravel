<?php

namespace App\Http\Controllers;

use App\Jobs\RandomImage;
use Illuminate\Http\Request;

class FileManager extends Controller
{
    public function savePhoto(Request $request)
    {
        RandomImage::dispatch($request->size)->delay(now()->addSecond(5));
    }
}
