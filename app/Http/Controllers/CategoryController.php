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
            'name' => ['required', 'max:64'],
            'description' => []
        ], [
            'name.required' => 'Поле обязательно для заполнения',
            'name.max' => 'Превышено максимально допустимое количество символов (64)'
        ]);

        if ($validator->fails()) { return response()->json(data: $validator->errors(), status: 400); }

        return response()->json(data: $this->categoryService->create($validator->validated()), status: 201);
    }
    
    public function update(Request $request, string $id)
    {
        $payload = $request->json()->all();

        $validator = Validator::make(array_merge($payload, ['id' => $id]), [
            'id' => ['required', 'uuid', 'exists:categories,id'],
            'name' => ['max:64'],
            'description' => []
        ], [
            'name.max' => 'Превышено максимально допустимое количество символов (64)'
        ]);

        if ($validator->fails()) 
        {
            // REMEMBER: Сейчас будет костыль
            $messageBag = $validator->errors();
            
            return $messageBag->hasAny('id') ? response(status: 404) : response()->json(data: $messageBag, status: 400);
        }

        $updated = $this->categoryService->update(Category::find($id), $validator->validated());
        
        return response()->json(data: $updated, status: 200);
    }

    public function delete(Request $request, string $id)
    {
        $validator = Validator::make(['category_id' => $id], [
            'category_id' => ['required', 'uuid', 'exists:categories,id']
        ]);

        if ($validator->fails())
    {
            return response()->json(status: 200);
        }

        $this->categoryService->delete($validator->validated()['id']);

        return response()->json(status: 200);
    }
}
