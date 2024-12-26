<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use App\Enums\Currency;

class CurrencyController extends ApiController
{
    public function index()
    {

    }

    public function listCurrencies() :ApiResponse
    {
        return $this->success(data: Currency::array());
    }
}
