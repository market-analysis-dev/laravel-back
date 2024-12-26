<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use App\Enums\Currency;

class CurrencyController extends ApiController
{
    public function index() :ApiResponse
    {
        return $this->success(data: Currency::array());
    }
}
