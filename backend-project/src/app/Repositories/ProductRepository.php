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

    public function getAll()
    {
        return $this->product->get();
    }

    public function getAllWithCategory()
    {
        return Product::with('categories')->get();
    }

    public function getById($id)
    {
        return $this->product->where('id', $id)->get();
    }

    public function save($data)
    {
        $data->save();
        return $data->fresh();
    }

    public function delete($id)
    {
        $product = $this->product->find($id);
        if (!$product) {
            throw new InvalidArgumentException('Product not found');
        }
        $product->delete();
        return $product;
    }

}
