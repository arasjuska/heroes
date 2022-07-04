<?php

namespace App\Http\Controllers;

use App\Jobs\GetApiHeroJob;
use Illuminate\Http\Request;

class ApiHeroController extends Controller
{
    public function getHero(Request $request)
    {
        dispatch(new GetApiHeroJob());
    }
}
