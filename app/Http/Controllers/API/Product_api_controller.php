<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class Product_api_controller extends Controller
{
    public function index() {
        $products = $this->product_model::all();
        return Response::json($products, 200);
    }
    public function show($id) {
        $product = $this->product_model->findOrFail($id);
        return Response::json($product, 200);
    }
    public function destroy(Request $request, $id) {
        $this->product_model::where('id', $id)->delete();
        return Response::json(null, 204);
    }
    public function edit(Request $request, $id) {
        $product = $this->product_model->findOrFail($id);
        return Response::json($product, 200);
    }
    public function update(Request $request, $id) {
        $product = $this->product_model->findOrFail($id);
        $product->name = $product->name. ' ' . 'Updated By API';
        $product->save();
        return response()->json($product, 200);
    }
}
