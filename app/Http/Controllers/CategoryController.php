<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\CategoryService;
use App\Models\Category;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return response()->json(data: $this->categoryService->all(), status: 200);
    }

    public function show(string $id)
    {
        $validator = Validator::make(['category_id' => $id], [
            'category_id' => ['required', 'uuid', 'exists:categories,id']
        ], [
            'category_id.required' => 'Поле обязательно для заполнения',
            'category_id.uuid' => 'Неверный формат идентификатора категории (UUID)',
            'category_id.exists' => 'Категории с таким идентификатором не существует'
        ]);

        if ($validator->fails()) { return response(status: 404); }

        return response()->json(data: $this->categoryService->get($id), status: 200);
    }

    public function store(Request $request)
    {
        $payload = $request->json()->all();

        $validator = Validator::make($payload, [
            'name' => ['required'],
            'description' => []
        ], [
            'name.required' => 'Поле обязательно для заполнения'
        ]);

        if ($validator->fails()) { return response()->json(data: $validator->errors(), status: 400); }

        $this->categoryService->create($validator->validated());

        return response(status: 204);
    }
    
    public function update(Request $request, string $id)
    {
        $payload = $request->json()->all();

        $validator = Validator::make(array_merge($payload, ['id' => $id]), [
            'id' => ['required', 'uuid', 'exists:categories,id'],
            'name' => [],
            'description' => []
        ]);

        if ($validator->fails()) { return response(status: 404); }

        $updated = $this->categoryService->update(Category::find($id), $validator->validated());
        
        return response()->json(data: $updated, status: 200);
    }
}
