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

        $productPaginator = $query->Paginate(10)->withQueryString();
        $productArray = $productPaginator->toArray();

        foreach ($productArray['data'] as &$product)
        {
            $previewPhoto = ProductPhoto::where('product_id', $product['id'])->where('is_preview', true)->first();
            $product['preview_photo_url'] = $previewPhoto ? Storage::url($previewPhoto->path) : null;
        }

        return $productArray;
    }

    public function get(string $id): array
    {
        $productModel = Product::where('id', $id)->with('measurement_unit:id,name')->with('specifications:id,name,value,product_id')->with('category:id,name')->with('photos:id,product_id,is_preview,path')->first();

        $productArray = $productModel->toArray();

        // Геренрация url для каждого фото продукта
        if (!is_null($productArray['photos']))
        {
            foreach ($productArray['photos'] as &$photo)
            {
                $photo['url'] = Storage::url($photo['path']);
            }
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

    public function update(array $productData)
    {
        $productModel = Product::find($productData['id']);

        $productModel->name = key_exists('name', $productData) && !is_null($productData['name']) ? $productData['name'] : $productModel->name;
        $productModel->description = key_exists('description', $productData) ? $productData['description'] : $productModel->description;
        $productModel->price = key_exists('price', $productData) && !is_null($productData['price']) ? $productData['price'] : $productModel->price;
        $productModel->measurement_unit_id = key_exists('measurement_unit_id', $productData) ? $productData['measurement_unit_id'] : $productModel->measurement_unit_id;
        $productModel->category_id = key_exists('category_id', $productData) && !is_null($productData['category_id']) ? $productData['category_id'] : $productModel->category_id;
        $productModel->save();

        // Обновление характеристик товара
        Specification::where('product_id', $productData['id'])->delete();
        if (key_exists('specifications', $productData))
        {
            foreach($productData['specifications'] as $specification)
            {
                Specification::create(array_merge($specification, ['product_id' => $productModel->id]));
            }
        }

        return $this->get($productModel->id);
    }

    public function delete(string $id)
    {
        $product = Product::where('id', $id)->with('photos:id,product_id,path')->first();

        foreach ($product->photos as $photo)
        {
            Storage::delete($photo->path);
        }

        $product->delete();
    }
}