<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'product_code' => 'required|unique:products|max:255',
            'product_garage' => 'nullable|integer',
            'product_store' => 'nullable|integer',
            'buying_date' => 'required|date',
            'expire_date' => 'required|date',
            'buying_price' => 'required|integer',
            'selling_price' => 'required|integer',
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

        $product = Product::create($requestData);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|unique:products,product_name,' . $id . ',id|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'product_code' => 'required|unique:products,product_code,' . $id . ',id|max:255',
            'product_garage' => 'nullable|integer',
            'product_store' => 'nullable|integer',
            'buying_date' => 'required|date',
            'expire_date' => 'required|date',
            'buying_price' => 'required|integer',
            'selling_price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 401);
        }

        $product = Product::find($id);

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
        $product = Product::find($id);

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
        $product = Product::find($id);

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
        $products = Product::all();

        return response()->json([
            'success' => true, 'message' => 'List data products', 'data' => $products
        ]);
    }
}
