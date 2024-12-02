<?php

namespace App\Http\Controllers;

use App\Models\Model;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function store(Request $request, $brandId)
    {
        $request->validate([
            'name' => 'required|unique:models,name,NULL,id,brand_id,' . $brandId,
            'average_price' => 'nullable|numeric|min:100000'
        ]);

        $model = Model::create([
            'name' => $request->name,
            'brand_id' => $brandId,
            'average_price' => $request->average_price
        ]);

        return response()->json($model, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'average_price' => 'required|numeric|min:100000'
        ]);

        $model = Model::findOrFail($id);
        $model->update(['average_price' => $request->average_price]);

        return response()->json($model);
    }

    public function index(Request $request)
    {
        $query = Model::query();

        if ($request->has('greater')) {
            $query->where('average_price', '>', $request->greater);
        }
        if ($request->has('lower')) {
            $query->where('average_price', '<', $request->lower);
        }

        return response()->json($query->get());
    }
}
