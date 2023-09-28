<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductsRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index(): JsonResponse
    {
        $product = $this->product->all();
        
        return response()->json(['product' => $product]);
    }

    public function create(CreateProductsRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'price', 'user_id']);

        $product = $this->product->create($data);

        $response = [
            'error' => false,
            'product' => $product
        ];

        return response()->json(['data' => $response]);
    }

    public function update(CreateProductsRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'price', 'user_id']);

        $product = $this->product->find($request->id);

        if (!$product) {
            return response()->json(['message' => 'The product with the id '.$request->id.' was not found!']);
        }

        $product->update($data);
        $product->save();

        $response = [
            'error' => false,
            'message' => 'Product data has been updated successfully!',
            'product' => $product
        ];

        return response()->json(['data' => $response]);
    }

    public function delete(Request $request): JsonResponse
    {
        $product = $this->product->find($request->id);

        if (!$product) {
            return response()->json(['message' => 'The product was not deleted because the id '.$request->id.' was not found!']);
        }

        $product->delete();

        $response = [
            'error' => false,
            'message' => 'The product with the id '.$request->id.' has been deleted successfully!'
        ];

        return response()->json(['data' => $response]);
    }
}
