<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        $result = [];
        $numbers = [];

        for($i =1; $i <= 5; $i++)
        {
            $numbers[] = $i;
        }

        foreach($products as $product)
            {
                $result[] = [
                    'id'=>$product->id,
                    'name'=>$this->formatProductName($product->name),
                    'slug'=>$product->slug,
                    'category'=>$product->category,
                    'price'=>$product->price,
                    'quantity'=>$product->quantity,
                    'status'=>$product->status,
                ];
            }
            
            return response()->json([
                'status'=>true,
                'numbers'=>$numbers,
                'message'=>'Products retrieved successfully.',
                'data'=>$result
            ], 200);
    }

    public function show(string$slug)
    {
        $product=Product::where('slug', $slug)->first();

        if(!$product) 
            {
                return response()->json([
                    'status'=>false,
                    'message'=>'Product not found.'
                ],404);
            }

            return response()->json([
                'status'=>true,
                'message'=>'Product retrieved successfully.',
                'data'=>[
                    'id'=>$product->id,
                    'name'=>$this->formatProductName($product->name),
                    'slug'=>$product->slug,
                    'category'=>$product->category,
                    'price'=>$product->price,
                    'quantity'=>$product->quantity,
                    'status'=>$product->status,
                ]
            ], 200);
    }

    Private function formatProductName($name)
    {
        return ucwords(
            strtolower(trim($name))
        );
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
