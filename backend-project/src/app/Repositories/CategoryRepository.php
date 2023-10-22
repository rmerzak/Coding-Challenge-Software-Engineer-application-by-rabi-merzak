<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function find($id)
    {
        return $this->category->find($id);
    }
    public function getAll()
    {
        return $this->category->all();
    }

    public function save($data)
    {
        $data->save();

        return $data->fresh();
    }
}
