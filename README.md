## Запуск проекта

### 1) Подтянуть зависимости проекта
```
composer install
```

### 2) Настроить конфигурацию проекта

(находясь в корневой папке проекта)
```
cp .env.example .env
```

Задать значения следующим переменным окружения в файле .env:
```
DB_CONNECTION=pgsql
DB_HOST=[POSTGRES_HOST]
DB_PORT=[POSTGRES_PORT]
DB_DATABASE=ivver_db
DB_USERNAME=[POSTGRES_USER]
DB_PASSWORD=[USER_PASSWORD]
```

### 3) Создать базу данных
(psql)
```
create database ivver_db;
```

(в корневой папке проекта)
```
php artisan migrate --path=database\migrations\2025_04_25_191610_create_categories_table.php
```
```
php artisan migrate --path=database\migrations\2025_04_27_120436_create_measurement_units_table.php
```
```
php artisan migrate
```

### 4) Создать символьную сслыку на storage
```
php artisan storage:link
```

### 5) Запустить dev сервер
```
php artisan serve
```

## Опционально

### Заполнить БД тестовыми данными

(в корневой папке проекта)
```
php artisan db:seed
```
