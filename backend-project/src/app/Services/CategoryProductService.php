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
    protected $categoryProductRepository;

    public function __construct(CategoryProductRepository $categoryProductRepository)
    {
        $this->categoryProductRepository = $categoryProductRepository;
    }

    public function getAll()
    {
        return $this->categoryProductRepository->getAll();
    }
}
