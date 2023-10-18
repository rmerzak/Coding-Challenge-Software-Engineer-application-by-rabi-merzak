<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;
use InvalidArgumentException;
class ProductServiceTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testGetAll()
    {
        $productRepository = Mockery::mock(ProductRepository::class);
        $productRepository->shouldReceive('getAllWithCategory')->once()->andReturn([]);

        $productService = new ProductService($productRepository);
        $result = $productService->getAll();
        $this->assertIsArray($result);
        $this->assertEquals(0, count($result));
    }

    public function testSaveProductData()
    {
        $productRepository = Mockery::mock(ProductRepository::class);
        $productRepository->shouldReceive('save')->once()->andReturn(['id' => 1]);

        $request = new Request([
            'name' => 'Test Product',
            'description' => 'Description',
            'price' => 10.99,
            'image' => null,
        ]);

        $productService = new ProductService($productRepository);

        $result = $productService->saveProductData($request);

        $this->assertIsArray($result);
        $this->assertEquals(1, $result['id']);
    }

    public function testSaveProductDataWithValidationFailure()
    {
        $productRepository = Mockery::mock(ProductRepository::class);
        $productService = new ProductService($productRepository);

        $request = new Request();
        $this->expectException(InvalidArgumentException::class);
        $productService->saveProductData($request);
    }

    public function testGetAllNonExistentProduct()
    {
        $productRepository = Mockery::mock(ProductRepository::class);
        $productRepository->shouldReceive('getAllWithCategory')->once()->andReturn(null);

        $productService = new ProductService($productRepository);

        $result = $productService->getAll();

        $this->assertNull($result);
    }
}