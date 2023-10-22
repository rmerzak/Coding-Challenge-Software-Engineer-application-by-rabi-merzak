<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function processCategoryData(CategoryRequest $request)
    {
        $categoryData = $request->only(['name', 'parent_id']);
        return $categoryData;
    }
    public function saveCategoryData($categoryData)
    {
        $category = new Category();
        $category->name = $categoryData['name'];
        $category->parent_id = $categoryData['parent_id'];

        $result = $this->categoryRepository->save($category);

        return $category;
    }
}
