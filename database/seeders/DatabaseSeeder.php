<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\MeasurementUnit;
use App\Models\Product;
use App\Models\Specification;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $category = Category::create(['name' => 'Мыши']);
        $mUnit = MeasurementUnit::create(['name' => 'шт.']);
        $product = Product::create(['name' => 'Мышь беспроводная Logitech G PRO X SUPERLIGHT 2', 'price' => '15999.00', 'measurement_unit_id' => $mUnit->id, 'category_id' => $category->id]);
        
        Specification::create(['product_id' => $product->id, 'name' => 'Скорость (IPS)', 'value' => '500 IPS']);
        Specification::create(['product_id' => $product->id, 'name' => 'Тип сенсора мыши', 'value' => 'оптический светодиодный']);
        Specification::create(['product_id' => $product->id, 'name' => 'Максимальное разрешение датчика', 'value' => '32000 dpi']);
    }
}
