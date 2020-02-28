## PHP Interview boilerplate kit
This package will help you speed up your development if you have been given a technical assignment.
Most of the time companies ask you to not to use any framework in their code challenges. 

following are embedded in this kit:
- PHPUnit 
- Laravel ORM and Migrations  (default database is SQLite)
- Laravel Routing, Controllers, and validators
- Guzzle Http client
- Fractal
- PHP dotenv

Which looks enough for doing any assignment.

    
### Application configuration
This app is using `.env` file to define it's configurations. you can find it in the root of the project.
```bash
APP_URI=localhost:8000 # used to run integration tests suite, this should be same for application
DB_CONNECTION= #sqlite or mysql
DB_HOST=localhost
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
DB_PORT=3306
```
### Run Application `(With Docker)`
make sure you have Docker installed. all configurations (dockerfile, nginx) are located inside of `build/` folder.
Also you can find `docker-composer.yaml` in root of the project.

**Run below commands** 
- `docker-compose build && docker-compose up -d` 
- `docker exec -it dc-php-fpm bash -c "composer install && composer dump-autoload -o"` 

### Run tests `(integration & unit)`
Currently `xx tests, xx assertions` are included.
if you are **using** `Docker` to run application, first make sure you have ran above commands, and then run
` vendor/bin/phpunit tests` which runs both `unit` and `integration` tests.

### Dependency Injection 
If you want to take advantage of dependency injection, you may define an array of dependencies
as below in `bootstrap/providers.php`
```php
$providers = [
    'Foo' => Foo::class,
    'Bar' => Bar::class
];
```
by now whenever you need a dependency, you can inject it as an parameter.

### Migrations
You may define you table structures in `database/migrations` directory. Just like laravel
if your migration class name is `AddUsersTable` the corresponding file name would be `add_users_table`.

#### Run migrations
You may run all your migrations by run `composer migrate` command.