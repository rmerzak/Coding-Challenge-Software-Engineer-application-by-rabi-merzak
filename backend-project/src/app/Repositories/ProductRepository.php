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
    public function getById($id)
    {
        return $this->product->where('id', $id)->get();
    }

    public function save($data)
    {
    }

    public function update($data, $id)
    {
    }

    public function delete($id)
    {
    }

}
