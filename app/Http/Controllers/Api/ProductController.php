<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:255',
            'description' => 'required',
            'price' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'qty_init' => 'nullable|integer',
            'qty_in' => 'nullable|integer',
            'qty_out' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 401);
        }

        $requestData = $validator->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->storeAs('products', $fileName, 'public');
            $requestData['image'] = $filePath;
        }

        $product = products::create($requestData);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name,' . $id . ',id|max:255',
            'description' => 'required',
            'price' => 'required|integer',
            'category_id' => 'required|integer|exists:categories,id',
            'qty_init' => 'nullable|integer',
            'qty_in' => 'nullable|integer',
            'qty_out' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 401);
        }

        $product = products::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $requestData = $validator->validated();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = $image->storeAs('products', $fileName, 'public');
            $requestData['image'] = $filePath;
        }

        $product->update($requestData);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ]);
    }

    public function delete($id)
    {
        $product = products::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    public function show($id)
    {
        $product = products::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail data product',
            'data' => $product
        ]);
    }

    public function index()
    {
        $products = products::all();

        return response()->json([
            'success' => true, 'message' => 'List data products', 'data' => $products
        ]);
    }
}
