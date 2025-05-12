<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Services\ProductPhotoService;

class ProductPhotoController extends Controller
{
    private ProductPhotoService $productPhotoService;

    public function __construct(ProductPhotoService $productPhotoService)
    {
        $this->productPhotoService = $productPhotoService;
    }

    public function storeAll(Request $request, string $productId)
    {
        $payload = $request->all();

        $validator = Validator::make(array_merge($payload, ['product_id' => $productId]), [
            'product_id' => ['required', 'uuid', 'exists:products,id'],
            'preview' => ['required', 'image', 'mimes:jpeg,png,jpg,webp'],
            'photos' => ['array'],
            'photos.*' => ['image', 'mimes:jpeg,png,jpg,webp']
        ]);

        if ($validator->fails()) { return response()->json(data: $validator->errors(), status: 400); }

        // Cохранение preview фото продукта
        $path = Storage::putFile('product-photos', $validator->validated()['preview']);
        $this->productPhotoService->create($productId, $path, isPreview: true);

        // Сохранение остальных фото продукта
        if ($request->hasFile('photos'))
        {
            foreach($request->file('photos') as $photo)
            {
                $path = Storage::putFile('product-photos', $photo);
                $this->productPhotoService->create($productId, $path, isPreview: false);
            }
        }

        return response(status: 200);
    }

    public function storePreview(Request $request, string $productId)
    {
        $payload = $request->all();

        $validator = Validator::make(array_merge($payload, ['product_id' => $productId]), [
            'product_id' => ['required', 'uuid', 'exists:products,id'],
            'preview' => ['required', 'image', 'mimes:jpeg,png,jpg,webp']
        ]);

        if ($validator->fails()) { return response()->json(data: $validator->errors(), status: 400); }

        // Удаление предыдцщего preview фото продукта, если оно существует
        $currentPreview = $this->productPhotoService->getPreview($productId);
        if ($currentPreview)
        {
            Storage::delete($currentPreview['path']);
            $this->productPhotoService->deletePreview($productId);
        }

        // Cохранение preview фото продукта
        $path = Storage::putFile('product-photos', $validator->validated()['preview']);
        $this->productPhotoService->create($productId, $path, isPreview: true);

        return response()->json(status: 200);
    }

    public function store(Request $request, string $productId)
    {
        $payload = $request->all();

        $validator = Validator::make(array_merge($payload, ['product_id' => $productId]), [
            'product_id' => ['required', 'uuid', 'exists:products,id'],
            'photos' => ['array', 'required'],
            'photos.*' => ['image', 'mimes:jpeg,png,jpg,webp']
        ]);

        if ($validator->fails()) { return response()->json(data: $validator->errors(), status: 400); }

        // Сохранение фото продукта
        if ($request->hasFile('photos'))
        {
            foreach($request->file('photos') as $photo)
            {
                $path = Storage::putFile('product-photos', $photo);
                $this->productPhotoService->create($productId, $path, isPreview: false);
            }
        }

        return response(status: 200);
    }

    public function delete(Request $request)
    {
        $payload = $request->json()->all();

        $validator = Validator::make($payload, [
            'photos' => ['required', 'array'],
            'photos.*' => ['uuid', 'exists:product_photos,id']
        ]);

        if ($validator->fails()) { return response()->json(data: $validator->errors(), status: 400); }
        
        // Удаление фотографий
        foreach($validator->validated()['photos'] as $id)
        {
            Storage::delete($this->productPhotoService->get($id)['path']);
        }
        $this->productPhotoService->delete($validator->validated()['photos']);

        return response()->json(status: 200);
    }
}
