<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct1Request;
use App\Models\Product1;
use Illuminate\Http\JsonResponse;

class ProductActionController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Product1::with('category')->latest()->get(),
            200
        );
    }

    public function store(StoreProduct1Request $request): JsonResponse
    {
        $validated = $request->validated();
        $photo = $request->file('photo');
        unset($validated['photo']);

        if ($photo) {
            $path = $photo->store('products', 'public');
            $validated['photo'] = asset('storage/'.$path);
        }

        $product = Product1::create($validated)->load('category');

        return response()->json([
            'message' => 'Product created successfully!',
            'product' => $product,
        ], 201);
    }
}
