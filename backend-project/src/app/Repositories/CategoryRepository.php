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
    public function all()
    {
        return $this->category->all();
    }

    public function getAll()
    {
        return $this->category->get();
    }
    public function getById($id)
    {
        return $this->category->where('id', $id)->get();
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
