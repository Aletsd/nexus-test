<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelController extends Controller
{
    public function store(Request $request, $brandId)
    {
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
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'average_price' => 'required|numeric|min:100000'
        ]);

        $CarModel = CarModel::findOrFail($id);
        $CarModel -> average_price = $request->average_price;
        $CarModel -> save();

        return response()->json($CarModel);
    }

    public function index(Request $request)
    {
        $query = CarModel::query();

        if ($request->has('greater')) {
            $query->where('average_price', '>', $request->greater);
        }
        if ($request->has('lower')) {
            $query->where('average_price', '<', $request->lower);
        }

        return response()->json($query->get());
    }
}
