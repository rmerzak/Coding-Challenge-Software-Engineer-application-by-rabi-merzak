<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;
use Illuminate\Http\UploadedFile;
class CreateProduct extends Command
{
    protected $signature = 'create:product';
    protected $description = 'Create a new product';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $data = [
            'name' => $this->ask('Enter the product name:'),
            'description' => $this->ask('Enter the product description:'),
            'price' => $this->ask('Enter the product price:'),
        ];
        $imagePath = $this->ask('Enter the path to the image file (leave empty if none):');
        if (!empty($imagePath) && file_exists($imagePath)) {
            $image = new UploadedFile($imagePath, pathinfo($imagePath, PATHINFO_FILENAME));
            $path = $image->store('images', 'public');
            $data['image'] = $path;
        } else {
            $data['image'] = 'no.png';
        }
        $productService = app(ProductService::class);
        $result = $productService->saveProductData($data);
        if ($result['status'] === 200) {
            $this->info('Product created successfully!');
        } else {
            $this->error('Product creation failed: ' . $result['error']);
        }
    }
}
