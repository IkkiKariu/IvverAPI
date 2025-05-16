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
        /* REMEMBER: 
            Очень топорная реализация сидера.
            Реализую таким образом, поскольку нужно создавать зависимые друг от друга сущности,
            а это самый прямой, быстрый способ и безопасный за счёт простой логики способ.
            К тому же, задача этого сидера просто заполнить БД некотороми правдаподобными данными для демонстраци работы frontend приложения.
        */

        $mUnit = MeasurementUnit::create(['name' => 'шт.']);

        $category = Category::create(['name' => 'Комьпютерные мыши']);

        $product = Product::create(['name' => 'Мышь беспроводная Logitech G PRO X SUPERLIGHT 2', 'price' => '15999.00', 'measurement_unit_id' => $mUnit->id, 'category_id' => $category->id]);
        Specification::create(['product_id' => $product->id, 'name' => 'Скорость (IPS)', 'value' => '500 IPS']);
        Specification::create(['product_id' => $product->id, 'name' => 'Тип сенсора мыши', 'value' => 'оптический светодиодный']);
        Specification::create(['product_id' => $product->id, 'name' => 'Максимальное разрешение датчика', 'value' => '32000 dpi']);


        $product = Product::create(['name' => 'Мышь проводная Razer Basilisk V3 [RZ01-04000100-R3M1]', 'price' => '4599.00', 'measurement_unit_id' => $mUnit->id, 'category_id' => $category->id]);
        Specification::create(['product_id' => $product->id, 'name' => 'Скорость (IPS)', 'value' => '650 IPS']);
        Specification::create(['product_id' => $product->id, 'name' => 'Тип сенсора мыши', 'value' => 'оптический светодиодный']);
        Specification::create(['product_id' => $product->id, 'name' => 'Максимальное разрешение датчика', 'value' => '26000 dpi']);
        Specification::create(['product_id' => $product->id, 'name' => 'Длина кабеля', 'value' => '1.8 м']);

        $product = Product::create(['name' => 'Мышь беспроводная Xiaomi Dual Mode Wireless Mouse Silent Edition', 'price' => '1599.00', 'measurement_unit_id' => $mUnit->id, 'category_id' => $category->id]);
        Specification::create(['product_id' => $product->id, 'name' => 'Интерфейс подключения', 'value' => 'Bluetooth, USB Type-A']);
        Specification::create(['product_id' => $product->id, 'name' => 'Тип сенсора мыши', 'value' => 'оптический светодиодный']);
        Specification::create(['product_id' => $product->id, 'name' => 'Максимальное разрешение датчика', 'value' => '1300 dpi']);
        

        $category = Category::create(['name' => 'Материнские платы']);

        $product = Product::create(['name' => 'Материнская плата GIGABYTE B550M AORUS ELITE', 'price' => '9499.00', 'measurement_unit_id' => $mUnit->id, 'category_id' => $category->id]);
        Specification::create(['product_id' => $product->id, 'name' => 'Форм-фактор', 'value' => 'Micro-ATX']);
        Specification::create(['product_id' => $product->id, 'name' => 'Сокет', 'value' => 'AM4']);
        Specification::create(['product_id' => $product->id, 'name' => 'Максимальная частота памяти', 'value' => '3200 МГц']);
        Specification::create(['product_id' => $product->id, 'name' => 'Поддержка NVMe', 'value' => 'есть']);
        Specification::create(['product_id' => $product->id, 'name' => 'Версия PCI Express накопителей', 'value' => '4.0']);

        $product = Product::create(['name' => 'Материнская плата MSI PRO Z790-P WIFI', 'price' => '17999.00', 'measurement_unit_id' => $mUnit->id, 'category_id' => $category->id]);
        Specification::create(['product_id' => $product->id, 'name' => 'Форм-фактор', 'value' => 'Standard-ATX']);
        Specification::create(['product_id' => $product->id, 'name' => 'Сокет', 'value' => 'LGA1700']);
        Specification::create(['product_id' => $product->id, 'name' => 'Максимальная частота памяти', 'value' => '3200 МГц']);
        Specification::create(['product_id' => $product->id, 'name' => 'Поддержка NVMe', 'value' => 'есть']);
        Specification::create(['product_id' => $product->id, 'name' => 'Версия PCI Express накопителей', 'value' => '4.0']);

        
    }
}
