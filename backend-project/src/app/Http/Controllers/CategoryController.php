<?php

namespace App\Http\Controllers;
use App\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Resources\CategotyResource;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoryRequest;
class CategoryController extends Controller
{
    use HttpResponses;
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {   $category = $this->categoryService->getAll();
        return $this->handleResponse(compact('category'));
    }

    public function store(CategoryRequest $request)
    {
    try {
        $categoryData = $this->categoryService->processCategoryData($request);

        $category = $this->categoryService->saveCategoryData($categoryData);
        return $this->handleResponse((new CategotyResource($category)), 'Category Added Successfully!');
    } catch (Exception $e) {
        DB::rollBack();
        return $this->handleError($e->getMessage(), 500);
    }
}
}
