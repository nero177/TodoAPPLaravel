## Todo List API

Install this repository locally and run ```docker-compose up```
Run tasks seeder in docker app container with 
```php artisan db:seed --class=TaskSeeder```

- **[Swagger Open API](https://app.swaggerhub.com/apis/EDWARDNERO2020/TodoAPITestTask/1.0.0#/)**

### Headers
Authorize via register or login routes and pass token in Authorization header.
```
Accept: application/json
Authorization: Bearer token
```