<?php

namespace App\Services;

use App\Models\ProductPhoto;

class ProductPhotoService
{
    public function create(string $productId, string $path, bool $isPreview)
    {
        $productPhoto = new ProductPhoto();
        $productPhoto->product_id = $productId;
        $productPhoto->path = $path;
        $productPhoto->is_preview = $isPreview;
        $productPhoto->save();

        return $productPhoto->toArray();
    }

    public function delete(array $idList)
    {
        ProductPhoto::destroy($idList);
    }

    public function get(string $id)
    {
        return ProductPhoto::find($id)->toArray();
    }

    public function deletePreview(string $productId)
    {
        ProductPhoto::where('product_id', $productId)->where('is_preview', true)->first()->delete();
    }

    public function getPreview(string $productId): ?array
    {
        $preview = ProductPhoto::where('product_id', $productId)->where('is_preview', true)->first();

        return $preview ? $preview->toArray() : null;
    }
}