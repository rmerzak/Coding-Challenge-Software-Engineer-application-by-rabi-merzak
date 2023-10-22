<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    use HttpResponses;

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAll();
        return $this->handleResponse(compact('products'));
    }

    public function store(ProductRequest $request)
    {
        try {
            $productData = $this->productService->processProductData($request);
            $product = $this->productService->saveProductData($productData);
            $this->productService->attachCategories($request, $product);
            return $this->handleResponse((new ProductResource($product)), 'Product Added Successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            return $this->handleError($e->getMessage(), 500);
        }
    }
}