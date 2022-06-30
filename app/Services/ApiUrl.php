<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ApiUrl
{
    public function get($endpoint): Response
    {
        return Http::get('https://cdn.jsdelivr.net/gh/akabab/superhero-api@0.3.0/api' . $endpoint);
    }
}
