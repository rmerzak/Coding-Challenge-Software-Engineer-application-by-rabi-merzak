<?php

namespace App\Http\Controllers;
use App\Services\CategoryService;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {   $category = $this->categoryService->getAll();
        return response()->json($category);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $result = ['status' => 200];
    try {
        $category = $this->categoryService->saveCategoryData($request);

        $result['category'] = $category;
    } catch (Exception $e) {
        $result = [
            'status' => 500,
            'error' => $e->getMessage()
        ];
    }

    return response()->json($result, $result['status']);
}


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
