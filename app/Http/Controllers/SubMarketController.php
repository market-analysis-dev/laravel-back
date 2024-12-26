<?php

namespace App\Http\Controllers;

use App\Models\SubMarket;
use Illuminate\Http\Request;
use App\Responses\ApiResponse;

class SubMarketController extends ApiController
{
    public function index(): ApiResponse
    {
        $sub_markets = SubMarket::where('status', '=', 'active')->get();
        return $this->success(data: $sub_markets);
    }
}
