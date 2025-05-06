<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Services\ProductService;
use App\Services\ProductPhotoService;

class ProductController extends Controller
{
    private ProductService $productService;
    private ProductPhotoService $productPhotoService;

    public function __construct(ProductService $productService, ProductPhotoService $productPhotoService)
    {
        $this->productService = $productService;
        $this->productPhotoService = $productPhotoService;
    }

    public function index(Request $request)
    {
        $categoryId = $request->query('category');

        if ($categoryId)
        {
            $validator = Validator::make(['category' => $categoryId], [
                'category' => ['uuid', 'exists:categories,id']
            ], [
                'category.uuid' => 'Неверный формат идентификатора категории',
                'category.exists' => 'Категории с таким иднтификатором не существует'
            ]);
    
            if ($validator->fails()) { return response()->json(data: $validator->errors(), status: 400); }
        }
        
        return response()->json(data: $this->productService->all(categoryId: $categoryId), status: 200);
    }

    public function show(string $id)
    {
        $validator = Validator::make(['product_id' => $id], [
            'product_id' => ['uuid', 'exists:products,id'] 
        ]);

        if ($validator->fails())  { return response()->json(data: $validator->errors(), status: 404); }

        return response()->json(data: $this->productService->get($id), status: 200);
    }

    public function store(Request $request)
    {
        if ($request->missing(['data', 'preview-photo']) || $request->isNotFilled(['data', 'preview-photo']) || !$request->hasFile('preview-photo')) 
        {
            response(status: 400);
        }

        $productData = json_decode(json: $request->input("data"), associative: true);

        // Проверка не невалидный JSON
        if (is_null($productData))
        {
            return response()->json(status: 400);
        }

        $validator = Validator::make($productData, [
            'name' => ['required', 'max:128'],
            'description' => [],
            'price' => ['required', 'decimal:2'],
            'measurement_unit_id' => ['uuid', 'exists:measurement_units,id'],
            'category_id' => ['required', 'uuid', 'exists:categories,id'],
            'specifications' => ['array'],
            'specifications.*.name' => ['required'],
            'specifications.*.value' => ['required']
        ], [
            'name.required' => 'Поле обязательно для заполнения',
            'name.max' => 'Превышено максимально допустимое количество символов (128)',
            'price.required' => 'Поле обязательно для заполнения',
            'price.decimal' => 'Значение должно быть десятичным числом с двумя разрядами в дробной части',
            'measurement_unit_id.required' => 'Поле обязательно для заполнения',
            'measurement_unit_id.uuid' => 'Неверный фоомат идентификатора (UUID)',
            'measurement_unit_id.exists' => 'Единицы измерения с таким идентификатором не существует',
            'category_id.required' => 'Поле обязательно для заполнения',
            'category_id.uuid' => 'Неверный формат идентификатора (UUID)',
            'category_id.exists' => 'Категории с таким идентификатором не существует',
            "specifications.array" => 'Значение должно быть массивом',
            "specifications.*.name.required" => "Поле обязательно для заполнения",
            "specifications.*.value.required" => "Поле обязательно для заполнения"
        ]);

        if ($validator->fails())
        {
            return response()->json(data: $validator->errors(), status: 400);
        }

        // Создание товара
        $created = $this->productService->add($validator->validated());
        
        // Сохранение preview фото товара
        $previewPhoto = $request->file('preview-photo');
        $path = Storage::putFile('product-photos', $previewPhoto);
        $this->productPhotoService->create(productId: $created['id'], path: $path, isPreview: true);

        // Сохранение фото товара
        if($request->hasFile('photos'))
        {
            foreach ($request->file('photos') as $photo)
            {
                $path = Storage::putFile('product-photos', $photo);
                $this->productPhotoService->create(productId: $created['id'], path: $path, isPreview: false);
            }
        }

        return response()->json(data: $created, status: 201);
    }
}