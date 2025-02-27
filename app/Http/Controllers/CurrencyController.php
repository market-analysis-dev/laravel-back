<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Responses\ApiResponse;
use App\Enums\Currency;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CurrencyController extends ApiController implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:currencies.index', only: ['index']),
        ];
    }

    public function index() :ApiResponse
    {
        return $this->success(data: Currency::array());
    }
}
