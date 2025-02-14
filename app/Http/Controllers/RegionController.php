<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Responses\ApiResponse;

class RegionController extends ApiController
{
    public function index(): ApiResponse
    {
        return $this->success(data: Region::all());
    }
}
