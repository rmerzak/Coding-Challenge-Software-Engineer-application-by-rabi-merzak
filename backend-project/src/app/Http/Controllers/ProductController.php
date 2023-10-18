<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $products = $this->productService->getAll();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $result = ['status' => 200];
    try {
        $product = $this->productService->saveProductData($request);
        if ($request->has('category_ids')) {
            $categoryIds = explode(',', $request->input('category_ids'));

            $categoryIds = array_map('intval', $categoryIds);

            foreach ($categoryIds as $categoryId) {
                $product->categories()->attach($categoryId);
            }
        }

        $result['product'] = $product;
    } catch (Exception $e) {
        $result = [
            'status' => 500,
            'error' => $e->getMessage()
        ];
    }

    return response()->json($result, $result['status']);
}


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function create()
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}