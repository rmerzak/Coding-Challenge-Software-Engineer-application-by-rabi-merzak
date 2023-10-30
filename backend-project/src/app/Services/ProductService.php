<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;
use InvalidArgumentException;
use App\Http\Requests\ProductRequest;
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
        $result = $this->productRepository->save($product);

        return $product;
    }
    public function processProductData(ProductRequest $request)
    {
        $productData = $request->only(['name', 'description', 'price']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
            $productData['image'] = $path;
        } else {
            $productData['image'] = 'images/no.png';
        }
        return $productData;
    }

    public function attachCategories(ProductRequest $request, Product $product)
{
    if ($request->has('category_ids')) {
        $categoryIds = explode(',', $request->input('category_ids'));
        $categoryIds = array_map('intval', $categoryIds);
        $categoryIds = array_filter($categoryIds);
        foreach ($categoryIds as $categoryId) {
            $product->categories()->attach($categoryId);
        }
    }
}
}
