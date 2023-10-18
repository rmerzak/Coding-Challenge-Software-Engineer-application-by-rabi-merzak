<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function find($id)
    {
        return $this->product->find($id);
    }
    public function all()
    {
        return $this->product->all();
    }

    public function getAll()
    {
        return $this->product->get();
    }

    public function getAllWithCategory()
    {
        return Product::with('categories')->get();
    }

    public function getById($id)
    {
        return $this->product->where('id', $id)->get();
    }

    public function save($data)
    {
        $product = new $this->product;

        if ($data->hasFile('image')) {
            $filenameWithExt = $data->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $data->file('image')->guessClientExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $data->file('image')->storeAs('public/image', $fileNameToStore);
        } else {
            $fileNameToStore = 'no.png';
        }

        $product->name = $data->input('name');
        $product->description = $data->input('description');
        $product->price = $data->input('price');
        $product->image = $fileNameToStore;

        $product->save();

        return $product->fresh();
    }

    public function update($data, $id)
    {
        $product = $this->product->find($id);

        if (!$product) {
            throw new InvalidArgumentException('Product not found');
        }

        // $product->update([
        //     'name' => $data->input('name'),
        //     'description' => $data->input('description'),
        //     'price' => $data->input('price'),
        // ]);

        return $product;
    }

    public function delete($id)
    {
        $product = $this->product->find($id);
        if (!$product) {
            throw new InvalidArgumentException('Product not found');
        }
        $product->delete();
        return $product;
    }

}
