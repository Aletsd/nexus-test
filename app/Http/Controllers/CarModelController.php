<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CarModelController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = CarModel::query();

            if ($request->has('greater') && !is_numeric($request->greater)) {
                return response()->json([
                    'message' => 'The parameter "greater" must be a valid number.'
                ], 400);
            }

            if ($request->has('lower') && !is_numeric($request->lower)) {
                return response()->json([
                    'message' => 'The parameter "lower" must be a valid number.'
                ], 400);
            }

            if ($request->has('greater')) {
                $query->where('average_price', '>', $request->greater);
            }
            if ($request->has('lower')) {
                $query->where('average_price', '<', $request->lower);
            }

            return response()->json($query->get(), 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request, $brandId)
    {
        try {
            $request->validate([
                'name' => 'required|unique:car_models,name,NULL,id,brand_id,' . $brandId,
                'average_price' => 'nullable|numeric|min:100000'
            ]);

            $CarModel = CarModel::create([
                'name' => $request->name,
                'brand_id' => $brandId,
                'average_price' => $request->average_price
            ]);

            return response()->json($CarModel, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'average_price' => 'required|numeric|min:100000'
            ]);

            $CarModel = CarModel::findOrFail($id);
            $CarModel->average_price = $request->average_price;
            $CarModel->save();

            return response()->json($CarModel, 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Car model not found.'
            ], 404);
        }
    }
}
