<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function create(array $categoryData): void
    {
        Category::create($categoryData);
    }

    public function all(): array
    {
        return Category::all()->toArray();
    }

    public function get(string $id): array
    {
        return Category::find($id)->toArray();
    }

    public function update(Category $context, array $categoryData): array
    {
        $context->name = key_exists('name', $categoryData) && !is_null($categoryData['name']) ? $categoryData['name'] : $context->name; 
        $context->description = key_exists('description', $categoryData) ? $categoryData['description'] : $context->description;
        $context->save();

        return $context->toArray();
    }
}