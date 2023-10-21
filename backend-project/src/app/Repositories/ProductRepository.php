<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function find($id)
    {
        return $this->product->find($id);
    }
    public function all()
    {
        return $this->product->all();
    }

    public function getAllWithCategory()
    {
        return Product::with('categories')->get();
    }

    public function save($data)
    {
        $data->save();
        return $data->fresh();
    }
}