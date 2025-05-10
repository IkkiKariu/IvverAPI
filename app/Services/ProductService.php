<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

use App\Models\Product;
use App\Models\Category;
use App\Models\Specification;
use App\Models\ProductPhoto;

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

        return $productCollection->map(function ($product) {
            // Получение preview photo товара
            $previewPhoto = ProductPhoto::where('product_id', $product->id)->where('is_preview', true)->first();

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'measurement_unit_id' => $product->measurement_unit_id,
                'measurement_unit' => $product->measurement_unit->toArray(),
                'category_id' => $product->category_id,
                'category' => $product->category->toArray(),
                'preview_photo_url' => $previewPhoto ? Storage::url($previewPhoto->path) : null
            ];
        })->toArray();
    }

    public function get(string $id): array
    {
        $productModel = Product::where('id', $id)->with('measurement_unit:id,name')->with('specifications:id,name,value,product_id')->with('category:id,name')->with('photos:id,product_id,is_preview,path')->first();

        $productArray = $productModel->toArray();

        // Геренрация url для каждого фото продукта
        foreach ($productArray['photos'] as &$photo)
        {
            $photo['url'] = Storage::url($photo['path']);
        }

        return $productArray;
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