<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BrandController extends Controller
{
    public function index()
    {
        try {
            $brands = Brand::all()->map(function ($brand) {
                return [
                    'id' => $brand->id,
                    'name' => $brand->name,
                    'average_price' => $brand->averagePrice(),
                ];
            });

            return response()->json($brands, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:brands,name'
            ]);

            $brand = Brand::create([
                'name' => $request->name
            ]);

            return response()->json($brand, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function models($id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'message' => 'The brand ID must be a valid number.'
                ], 400);
            }

            $brand = Brand::findOrFail($id);

            $models = CarModel::where('brand_id', $id)->get();

            return response()->json($models, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Brand not found.'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
