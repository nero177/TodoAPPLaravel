## Todo List API

Install this repository locally and run ```docker-compose up```
Run tasks seeder in docker app container with 
```php artisan db:seed --class=TaskSeeder```

### Environment
create .env file from .env.example
```cp .env.example .env```

**DB configuration
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=
```

- **[Swagger Open API](https://app.swaggerhub.com/apis/EDWARDNERO2020/TodoAPITestTask/1.0.0#/)**

### Headers
Authorize via register or login routes and pass token in Authorization header.
```
Accept: application/json
Authorization: Bearer token
```


