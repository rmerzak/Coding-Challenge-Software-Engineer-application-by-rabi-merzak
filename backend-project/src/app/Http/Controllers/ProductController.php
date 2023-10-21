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
        try {
            $productData = $this->productService->processProductData($request);

            $product = $this->productService->saveProductData($productData);

            $this->productService->attachCategories($request, $product);

            $result = [
                'status' => 200,
                'product' => $product,
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }
}