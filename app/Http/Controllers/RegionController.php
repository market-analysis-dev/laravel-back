<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Responses\ApiResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RegionController extends ApiController implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:regions.index', only: ['index']),
        ];
    }

    public function index(): ApiResponse
    {
        return $this->success(data: Region::all());
    }
}
