<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\Specification;

class ProductService
{
    public function all(?string $categoryId=null): array
    {
        $query = Product::with('measurement_unit:id,name')->select('id', 'name', 'price', 'category_id', 'measurement_unit_id');

        if($categoryId)
        {
            $query->where('category_id', $categoryId);
        }

        $productCollection = $query->get();

        return $productCollection->toArray();
    }

    public function get(string $id): array
    {
        $productModel = Product::find($id)->with('specifications:id,name,value,product_id')->with('category:id, name')->get();

        return $productModel->toArray();
    }

    public function add(array $productData): void
    {
        $product = Product::create($productData);

        foreach($productData['specifications'] as $specification)
        {
            Specification::create(array_merge($specification, ['product_id' => $product->id]));
        }
    }
}