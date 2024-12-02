<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarModel;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all()->map(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'average_price' => $brand->averagePrice(),
            ];
        });

        return response()->json($brands);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:brands,name']);
        $brand = Brand::create(['name' => $request->name]);

        return response()->json($brand, 201);
    }

    public function models($id)
    {
        $models = CarModel::where('brand_id', $id)->get();
        return response()->json($models);
    }
}
