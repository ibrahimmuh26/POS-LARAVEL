<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerActionController extends Controller
{
    //
    public function show()
    {
        $customers = Customer::all();

        return response()->json(
            ['success' => true, 'data' => $customers]
        );
    }
}
