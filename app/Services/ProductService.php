<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\Specification;

class ProductService
{
    public function all(?string $categoryId=null): array
    {
        $query = Product::with('measurement_unit:id,name')->with('category:id,name')->select('id', 'name', 'price', 'category_id', 'measurement_unit_id');

        if($categoryId)
        {
            $query->where('category_id', $categoryId);
        }

        $productCollection = $query->get();

        return $productCollection->toArray();
    }

    public function get(string $id): array
    {
        $productModel = Product::where('id', $id)->with('specifications:id,name,value,product_id')->with('category:id,name')->first();

        return $productModel->toArray();
    }

    public function add(array $productData): array
    {
        $product = Product::create($productData);

        if (key_exists('specifications', $productData))
        {
            foreach($productData['specifications'] as $specification)
            {
                Specification::create(array_merge($specification, ['product_id' => $product->id]));
            }
        }

        return $this->get($product->id);
    }
}