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
        $category = new $this->category;

        $category->name = $data->input('name');
        $category->parent_id = $data->input('parent_id');
        $category->save();

        return $category->fresh();
    }

    public function update($data, $id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            throw new InvalidArgumentException('Category not found');
        }

        return $category;
    }

    public function delete($id)
    {
        $category = $this->category->find($id);
        if (!$category) {
            throw new InvalidArgumentException('Category not found');
        }
        $category->delete();
        return $category;
    }
}
