<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ProductPhotoService;

class ProductPhotoController extends Controller
{
    private ProductPhotoService $productPhotoService;

    public function __construct(ProductPhotoService $productPhotoService)
    {
        $this->productPhotoService = $productPhotoService;
    }

    public function store(string $productId)
    {
        // if ($request->missing(['preview-photo']) || $request->isNotFilled('preview-photo') || !$request->hasFile('preview-photo'))

        // // Сохранение preview фото товара
        // $previewPhoto = $request->file('preview-photo');
        // $path = Storage::putFile('product-photos', $previewPhoto);
        // $this->productPhotoService->create(productId: $created['id'], path: $path, isPreview: true);

        // // Сохранение фото товара
        // if($request->hasFile('photos'))
        // {
        //     foreach ($request->file('photos') as $photo)
        //     {
        //         $path = Storage::putFile('product-photos', $photo);
        //         $this->productPhotoService->create(productId: $created['id'], path: $path, isPreview: false);
        //     }
        // }
    }
}
