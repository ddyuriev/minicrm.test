## MiniCRM

Репозиторий:
```
git clone https://github.com/ddyuriev/minicrm.test.git
cd minicrm.test
```

Зависимости
```
composer install
npm install
npm run build
```

.env
```
cp .env.example .env
php artisan key:generate
```

миграции и сиды
```
php artisan migrate
php artisan db:seed
```


символическая ссылка
```
php artisan storage:link
```

### Тестовые данные
```
mngr@example.org
m1234567
```
Учетка админа,менеджера. Несколько записей клиентов, со связанными заявками.
Первым десяти заявкам создаются текстовые файлы для возможности проверить механизм скачивания.

### Пример кода вставки виджета
```
<iframe src="http://minicrm.test/widget" width="400" height="300" frameborder="0" style="position: fixed; z-index: 900; left: 10px; bottom: 20px;"></iframe>
```

### Примеры api
```
curl -X POST "http://minicrm.test/api/tickets" -H "Accept: application/json" -F "name=Иван Иванов" -F "email=ivan@example.com" -F "phone=+79001234567" -F "topic=Проблема с заказом" -F "text=Не пришёл заказ"

curl -X GET "http://minicrm.test/api/tickets/statistics"
```
