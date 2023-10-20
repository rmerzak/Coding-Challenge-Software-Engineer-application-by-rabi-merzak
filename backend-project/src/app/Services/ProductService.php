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

    // public function saveProductData($request)
    // {
    //     $validator = Validator::make($request, [
    //         'name'=>'required',
    //        'description'=>'required',
    //         'price' => 'required',
    //         'image' => 'image|nullable|max:1999'
    //     ]);

    //     if ($validator->fails()) {
    //         throw new InvalidArgumentException($validator->errors()->first());
    //     }

    //     $result = $this->productRepository->save($request);

    //     return $result;
    // }

    public function saveProductData(array $productData)
    {
        $product = new Product();
        $product->name = $productData['name'];
        $product->description = $productData['description'];
        $product->price = $productData['price'];
        // $product->image = $productData['image'];
        if (isset($productData['image']) && $productData['image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $productData['image']->store('images', 'public');
            $product->image = $path;
        }

        //$result = $this->productRepository->save($request);
        $product->save();

        return $product;
    }
}
