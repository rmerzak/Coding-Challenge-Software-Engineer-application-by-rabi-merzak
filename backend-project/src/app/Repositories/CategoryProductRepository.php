<?php

namespace App\Repositories;

use App\Models\CategoryProduct;

class CategoryProductRepository
{
    protected $categoryProduct;

    public function __construct(CategoryProduct $categoryProduct)
    {
        $this->categoryProduct = $categoryProduct;
    }

    public function find($id)
    {
        return $this->categoryProduct->find($id);
    }
    public function all()
    {
        return $this->categoryProduct->all();
    }

    public function getAll()
    {
        return $this->categoryProduct->get();
    }
    public function getById($id)
    {
        return $this->categoryProduct->where('id', $id)->get();
    }
}
