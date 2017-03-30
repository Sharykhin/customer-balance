<?php

namespace App\Http\Controllers\Api;

/**
 * Class CustomerController
 * @package App\Http\Controllers\Api
 */
class CustomerController
{
    public function index()
    {
        return response()->success(['user'=>1]);
    }
}
