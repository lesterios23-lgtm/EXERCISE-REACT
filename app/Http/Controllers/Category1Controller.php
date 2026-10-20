<?php

namespace App\Http\Controllers;

use App\Models\Category1;

class Category1Controller extends Controller
{
    public function index()
    {
        $category1s = Category1::all();

        return response()->json([
            'success' => true,
            'data' => $category1s,
        ]);
    }

    public function show(Category1 $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category,
        ]);
    }
}
