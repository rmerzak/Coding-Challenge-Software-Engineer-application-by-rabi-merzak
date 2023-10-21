<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;
use Illuminate\Http\UploadedFile;
use App\Repositories\CategoryRepository;
class CreateProduct extends Command
{
    protected $signature = 'create:product';
    protected $description = 'Create a new product';
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    public function handle()
    {
        try {
            $data = $this->gatherProductData();

            $productService = app(ProductService::class);
            $product = $productService->saveProductData($data);
            $categories = $this->categoryRepository->getAll();
            $categoryIdsInput = $this->askForCategoryIds($categories);
            $categoryIds = explode(',', $categoryIdsInput);
            $this->outputResult(200, 'Product created successfully!', $product);

        } catch (\Exception $e) {
            $this->outputResult(500, 'Product creation failed: ' . $e->getMessage());
        }
    }

    protected function gatherProductData()
    {
        $name = $this->ask('Enter the product name:');
        $description = $this->ask('Enter the product description:');
        $price = $this->ask('Enter the product price:');
        $imagePath = $this->ask('Enter the path to the image file (leave empty if none):');

        $data = [
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $this->storeImage($imagePath),
        ];

        return $data;
    }

    protected function storeImage($imagePath)
    {
        if (empty($imagePath) || !file_exists($imagePath)) {
            return 'no.png';
        }

        $image = new UploadedFile($imagePath, pathinfo($imagePath, PATHINFO_FILENAME));
        return $image->store('images', 'public');
    }

    protected function outputResult($status, $message, $product = null)
    {
        $result = ['status' => $status];

        if ($status === 200) {
            $result['product'] = $product;
            $this->info($message);
        } else {
            $result['error'] = $message;
            $this->error($message);
        }

        $this->info(json_encode($result));
    }
    protected function askForCategoryIds($categories)
    {
        $categoryIds = [];
        $categoriesList = [];
        foreach ($categories as $category) {
            $categoriesList[] = $category->id . ': ' . $category->name;
        }
        $categoryIdsInput = $this->ask('Select category IDs from the list below (comma-separated)[X,Y,...]:', implode(', ', $categoriesList));
        return $categoryIdsInput;
    }
}
