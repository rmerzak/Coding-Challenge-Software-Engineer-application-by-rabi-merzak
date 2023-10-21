<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\CreateProductRequest;

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
    public function store(CreateProductRequest $request)
    {
        $result = ['status' => 200];

        try {
            $productData = $request->validated();
            $productData = $request->only(['name', 'description', 'price', 'image']);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = $image->store('images', 'public');
                $productData['image'] = $path;
            } else {
                $productData['image'] = 'no.png';
            }
            $product = $this->productService->saveProductData($productData);
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
}