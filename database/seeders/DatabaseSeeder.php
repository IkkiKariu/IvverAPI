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

        $product = Product::create(['name' => 'Материнская плата GIGABYTE B550M AORUS ELITE', 'price' => '9499.00', 'measurement_unit_id' => $mUnit->id, 'category_id' => $category->id, 'description' => 'О товаре...']);
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


        $category = Category::create(['name' => 'Серверы']);

        $product = Product::create([
            'name' => 'Сервер Supermicro SYS-740GP-TNRT',
            'price' => '450999.00',
            // 'measurement_unit_id' => $mUnit->id,
            'category_id' => $category->id,
            'description' => 'Сервер Supermicro SYS-740GP-TNRT собран в корпусе типоразмера 5U (tower) и 
                предназначен для хранения больших объемов данных, а также обеспечения быстрого доступа к ним. 
                Быстродействие серверной сборки достигается за счет 2 предустановленных процессоров Intel Xeon Silver 4310 и памяти DDR4 емкостью 64 ГБ. 
                Серверная машина укомплектована памятью ECC с возможностью автоматической корректировки произвольных ошибок записи.
                В серверный системный блок Supermicro SYS-740GP-TNRT можно установить до 11 накопителей типов NVMe, SAS или SATA. 
                Предустановленные модули долговременной памяти в нем представлены одним накопителем SATA 2.5" SSD емкостью 480 ГБ. 
                Питание всех потребителей сборки постоянным током реализовано от 2 предустановленных БП. Общая выходная мощность установленных блоков питания – 2200 Вт.'
        ]);

        Specification::create(['product_id' => $product->id, 'name' => 'Форм-фактор', 'value' => '5U (tower)']);
        Specification::create(['product_id' => $product->id, 'name' => 'Модель процессоров', 'value' => 'Intel Xeon Silver 4310']);
        Specification::create(['product_id' => $product->id, 'name' => 'Тип оперативной памяти', 'value' => 'DDR4']);
        Specification::create(['product_id' => $product->id, 'name' => 'Ethernet порты', 'value' => 'LAN 10 Гбит/с x2']);
        Specification::create(['product_id' => $product->id, 'name' => 'Объем установленной оперативной памяти', 'value' => '64 ГБ']);

        $product = Product::create([
            'name' => 'Сервер Supermicro AS-1014S-WTRT',
            'price' => '769999.00',
            // 'measurement_unit_id' => $mUnit->id,
            'category_id' => $category->id,
            'description' => 'Сервер Supermicro AS-1014S-WTRT устанавливается в стойку и обладает монтажной высотой 1U. 
                Это однопроцессорная модель для организаций малого и среднего бизнеса с возможностью расширения оперативной памяти до 2000 ГБ. 
                24-ядерный процессор AMD EPYC 7352 с базовой частотой 2.3 ГГц поддерживает 48 потоков. 
                При выполнении любых задач на быстродействие CPU оказывают влияние 12-мегабайтный кэш L2 и 128-мегабайтный кэш L3. 
                Процессор поддерживает необходимую производительность системы при работе с любым программным обеспечением
                и взаимодействует с другими системными компонентами без задержек в обработке информации.'
        ]);
        
        Specification::create(['product_id' => $product->id, 'name' => 'Форм-фактор', 'value' => 'Rack']);
        Specification::create(['product_id' => $product->id, 'name' => 'Модель процессоров', 'value' => 'AMD EPYC 7352']);
        Specification::create(['product_id' => $product->id, 'name' => 'Тип оперативной памяти', 'value' => 'DDR4 RDIMM ECC']);
        Specification::create(['product_id' => $product->id, 'name' => 'Ethernet порты', 'value' => 'LAN 10 Гбит/с x2']);
        Specification::create(['product_id' => $product->id, 'name' => 'Объем установленной оперативной памяти', 'value' => '256 ГБ']);


        $category = Category::create(['name' => 'Разветвители и преобразователи видеосигнала']);

        $product = Product::create([
            'name' => 'Разветвитель Telecom TTS5020',
            'price' => '2999.00',
            // 'measurement_unit_id' => $mUnit->id,
            'category_id' => $category->id,
            'description' => 'При помощи разветвителя Telecom TTS5020 можно подключить к одному источнику цифрового сигнала до 4 дисплеев. 
                Для этого устройство, облаченное в тонкий корпус черного цвета, располагает 4 разъемами HDMI. 
                Выводимая на экран картинка порадует детализацией и натуральной цветопередачей благодаря разрешению 4K Ultra HD. 
                Самый динамичный видеоряд отображается плавно за счет частоты обновления 30 Гц. 
                Источником сигнала при использовании разветвителя Telecom TTS5020 может выступать медиаплеер, 
                ТВ-ресивер или любое другое устройство с разъемом HDMI версии 1.4.'
        ]);
        
        Specification::create(['product_id' => $product->id, 'name' => 'Питание', 'value' => 'от внешнего блока питания DC 5B']);
        Specification::create(['product_id' => $product->id, 'name' => 'Входы', 'value' => 'HDMI']);
        Specification::create(['product_id' => $product->id, 'name' => 'Модель', 'value' => 'Telecom TTS5020']);
        Specification::create(['product_id' => $product->id, 'name' => 'Передаваемый сигнал', 'value' => 'аудио, видео']);
        Specification::create(['product_id' => $product->id, 'name' => 'Страна-производитель', 'value' => 'Китай']);


        $category = Category::create(['name' => 'IP Камеры']);

        $product = Product::create([
            'name' => 'IP-камера HiWatch DS-I400(D) (2.8 мм)',
            'price' => '5899.00',
            'measurement_unit_id' => $mUnit->id,
            'category_id' => $category->id,
            'description' => 'IP-камера HiWatch DS-I400(D) (2.8 мм) выполнена в металлическом цилиндрическом корпусе с защитным козырьком и конструкцией IP67, 
                поэтому устойчива к неблагоприятным факторам внешней среды при уличном использовании. 
                Благодаря матрице CMOS Progressive Scan 4 Мп она создает четкое изображение в цветном или черно-белом режиме. 
                Подсветка EXIR с дальностью 30 м позволяет вести съемку в темное время суток.
                Система обнаружения движения с детектором способна начинать съемку только при распознавании движущихся объектов в поле зрения с целью экономии пространства в хранилище. 
                IP-камера HiWatch DS-I400(D) (2.8 мм) подключается по проводному интерфейсу RJ45 и поддерживает питание PoE. 
                Приложение Hik-Connect позволяет управлять устройством удаленно через приложение на мобильном устройстве.'
        ]);
        
        Specification::create(['product_id' => $product->id, 'name' => 'Тип', 'value' => 'IP-камера']);
        Specification::create(['product_id' => $product->id, 'name' => 'Материал корпуса', 'value' => 'металл']);
        Specification::create(['product_id' => $product->id, 'name' => 'Тип конструкции', 'value' => 'цилиндрическая']);
        Specification::create(['product_id' => $product->id, 'name' => 'Тип матрицы', 'value' => 'CMOS Progressive Scan']);
        Specification::create(['product_id' => $product->id, 'name' => 'Минимальная степень освещенности', 'value' => '0 лк, 0.01 лк']);
        Specification::create(['product_id' => $product->id, 'name' => 'Физический размер матрицы', 'value' => '1/3.0 дюйма']);

        $product = Product::create([
            'name' => 'IP-камера TP-Link Tapo C210',
            'price' => '4099.00',
            'measurement_unit_id' => $mUnit->id,
            'category_id' => $category->id,
            'description' => 'IP-камера TP-Link Tapo C210 – решение для дома или дачи. 
                Модель поддерживает обнаружение движения, может отправлять уведомления при нештатных ситуациях, оснащена микрофоном и динамиком для связи, 
                а также отличается высоким качеством изображения, что обусловлено CMOS-матрицей на 3 Мп. 
                Благодаря ей камера может обеспечить качественную и детализированную картинку в разрешении 2304x1296 пикселей с частотой до 15 кадр./с. 
                Также камера оснащена объективом с возможностью дистанционного управления наклоном и поворотом. 
                Благодаря этому, а также широким углам обзора вы всегда сможете видеть все, что происходит в помещении – ни одна деталь не ускользнет от ваших глаз. 
                Кроме того, за счет высокой светосилы и мощной ИК-подсветки камера позволит вести удобное наблюдение и качественную запись видео при плохой освещенности.'
        ]);
        
        Specification::create(['product_id' => $product->id, 'name' => 'Тип', 'value' => 'IP-камера']);
        Specification::create(['product_id' => $product->id, 'name' => 'Материал корпуса', 'value' => 'пластик']);
        Specification::create(['product_id' => $product->id, 'name' => 'Тип конструкции', 'value' => 'поворотная']);
        Specification::create(['product_id' => $product->id, 'name' => 'Тип матрицы', 'value' => 'CMOS']);
    }
}
