<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\ProductService;

class ProductController extends Controller
{
    private ProductService $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $categoryId = $request->query('category');

        $validator = Validator::make(['category' => $categoryId], [
            'category' => ['uuid', 'exists:categories,id']
        ]);

        if ($validator->fails()) { return response()->json(data: $validator->errors(), status: 400); }

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
        $payload = $request->json()->all();

        $validator = Validator::make($payload, [
            'name' => ['required', 'alpha_num'],
            'description' => [],
            'price' => ['required', 'decimal:2'],
            'measurement_unit_id' => ['required', 'uuid', 'exists:measurement_units,id'],
            'category_id' => ['']
        ]);

        if ($validator->fails())
        {
            return response()->json(data: $validator->errors(), status: 400);
        }

        $this->productService->add($validator->validated());

        return response(status: 204);
    }
}
