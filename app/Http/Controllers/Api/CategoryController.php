<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        $category = categories::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'data' => $validator->errors()
            ], 422);
        }

        $category = categories::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $category->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Category updated successfully',
            'data' => $category
        ]);
    }

    public function delete($id)
    {
        $category = categories::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }

    public function show($id)
    {
        $category = categories::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Category retrieved successfully',
            'data' => $category
        ]);
    }

    public function index()
    {
        $categories = categories::all();
        return response()->json(['success' => true, 'message' => 'List data categories', 'data' => $categories]);
    }
}
