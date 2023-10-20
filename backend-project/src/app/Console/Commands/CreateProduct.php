<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;
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
            $imageName = pathinfo($imagePath, PATHINFO_FILENAME);
            $extension = pathinfo($imagePath, PATHINFO_EXTENSION);
            $fileNameToStore = $imageName . '_' . time() . '.' . $extension;
            \Storage::disk('public')->put('images/' . $fileNameToStore, file_get_contents($imagePath));
        } else {
            $fileNameToStore = 'no.png';
        }
        $data['image'] = $fileNameToStore;
        //dd($data);
        $productService = app(ProductService::class);
        $result = $productService->saveProductData($data);
        //dd($result);
        if ($result['status'] === 200) {
            $this->info('Product created successfully!');
        } else {
            $this->error('Product creation failed: ' . $result['error']);
        }
    }
}
