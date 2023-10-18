<?php

namespace App\Services;

use App\Repositories\CategoryProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CategoryProductService
{
    protected $categoryProductService;

    public function __construct(CategoryProductService $categoryProductService)
    {
        $this->categoryProductService = $categoryProductService;
    }

    public function getAll()
    {
        return $this->categoryProductService->getAll();
    }
}
