<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ProductActionController extends Controller
{
    /**
     * Show the form for creating the resource.
     */


    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        $token = Cache::get('auth_token');
        dd($request, $token);
        $request->validate([
            'name' => 'required|unique:products|max:255',
            'description' => 'required',
            'price' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'qty_init' => 'nullable|integer',
            'qty_in' => 'nullable|integer',
            'qty_out' => 'nullable|integer',
        ]);
        $response = Http::post('https://api.escuelajs.co/api/v1/products', $request->all());


        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
        abort(404);
    }
}
