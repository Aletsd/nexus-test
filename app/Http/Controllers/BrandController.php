<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Model;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::with('models')->get()->map(function ($brand) {
            return [
                'id' => $brand->id,
                'name' => $brand->name,
                'average_price' => $brand->models->avg('average_price')
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
        $models = Model::where('brand_id', $id)->get();
        return response()->json($models);
    }
}
