<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product1;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $products = Product1::with('category')->paginate(10);
        $productResource = ProductResource::collection($products)
            ->response()
            ->getData(true);

        return $this->ok(
            'Products retrieved successfully',
            $productResource
        );
    }

    public function show(Product1 $product)
    {
        $product->load('category');

        return $this->ok(
            'Product retrieved successfully',
            new ProductResource($product)
        );
    }

    public function queries()
    {
        $nameAndPrice = Product1::select('name', 'price')->get();
        $productsWithCategory = Product1::with('category')->get();
        $productsOrderedByPrice = Product1::select('id', 'name')
            ->orderBy('price', 'asc')
            ->get();
        $firstFiveProducts = Product1::limit(5)->get();
        $priceGreaterThanOrEqual = Product1::where('price', '>=', 3)->get();
        $electronics = Product1::whereHas('category', function ($query) {
            $query->where('name', 'Electronics');
        })->get();

        $totalPrice = Product1::sum('price');
        $averagePrice = number_format(Product1::avg('price'),2 ,'.','');
        $highestPrice = Product1::max('price');
        $lowestPrice = Product1::min('price');

        $totalPricePerCategory = Product1::join(
            'category1s',
            'product1s.category_id',
            '=',
            'category1s.id'
        )
            ->select('category1s.name', DB::raw('SUM(product1s.price) as total_price'))
            ->groupBy('category1s.name')
            ->get();
        $averagePricePerCategory = Product1::join(
            'category1s',
            'product1s.category_id',
            '=',
            'category1s.id'
        )
            ->select('category1s.name', DB::raw('AVG(product1s.price) as avg_price'))
            ->groupBy('category1s.name')
            ->get();
        $lowestPricePerCategory = Product1::join(
            'category1s',
            'product1s.category_id',
            '=',
            'category1s.id'
        )
            ->select('category1s.name', DB::raw('MIN(product1s.price) as min_price'))
            ->groupBy('category1s.name')
            ->get();
        $averagePriceSorted = Product1::join(
            'category1s',
            'product1s.category_id',
            '=',
            'category1s.id'
        )
            ->select('category1s.name', DB::raw('AVG(product1s.price) as avg_price'))
            ->groupBy('category1s.name')
            ->orderBy('avg_price', 'asc')
            ->get();
        $electronicsAndBooks = Product1::join(
            'category1s',
            'product1s.category_id',
            '=',
            'category1s.id'
        )
            ->whereIn('category1s.name', ['Electronics', 'Books'])
            ->select('category1s.name', DB::raw('AVG(product1s.price) as avg_price'))
            ->groupBy('category1s.name')
            ->get();

        $queryResults = [
            'name_and_price' => $nameAndPrice,
            'products_with_category' => $productsWithCategory,
            'products_ordered_by_price' => $productsOrderedByPrice,
            'first_five_products' => $firstFiveProducts,
            'price_greater_than_or_equal' => $priceGreaterThanOrEqual,
            'electronics' => $electronics,
            'total_price' => $totalPrice,
            'average_price' => $averagePrice,
            'highest_price' => $highestPrice,
            'lowest_price' => $lowestPrice,
            'total_price_per_category' => $totalPricePerCategory,
            'average_price_per_category' => $averagePricePerCategory,
            'lowest_price_per_category' => $lowestPricePerCategory,
            'average_price_sorted' => $averagePriceSorted,
            'electronics_and_books' => $electronicsAndBooks,
        ];

        return $this->success('Query results retrieved successfully', $queryResults);
    }
}
