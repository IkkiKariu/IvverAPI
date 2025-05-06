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
}