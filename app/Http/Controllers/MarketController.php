<?php

namespace App\Http\Controllers;

use App\Models\Market;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class MarketController extends ApiController
{
    public function index(): ApiResponse
    {
        $markets = Market::where('status', '=', 'active')->get();
        return $this->success(data: $markets);
    }
}
