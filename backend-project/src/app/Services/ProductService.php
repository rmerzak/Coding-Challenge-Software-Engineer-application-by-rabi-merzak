<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

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

    public function saveProductData($request)
    {
        $validator = Validator::make($request->all(), [
            'name'=>'required',
           'description'=>'required',
            'price' => 'required',
            'image' => 'image|nullable|max:1999'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->productRepository->save($request);

        return $result;
    }
}
