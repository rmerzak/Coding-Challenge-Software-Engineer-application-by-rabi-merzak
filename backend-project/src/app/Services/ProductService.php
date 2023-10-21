<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Models\Product;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAllWithCategory();
    }

    public function saveProductData(array $productData)
    {
        $product = new Product();
        $product->name = $productData['name'];
        $product->description = $productData['description'];
        $product->price = $productData['price'];
        $product->image = $productData['image'];
        //$result = $this->productRepository->save($request);
        $product->save();

        return $product;
    }
}
