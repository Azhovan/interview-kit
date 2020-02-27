## PHP Interview boilerplate kit
This package will help you speed up your development if you are given a technical assignment.
Most of the time companies ask you not to use any framework in this case. even micro frameworks have a lot of 
redundant functionalities which do not look necessary

following functionalities are embedded in this kit:
- PHPUnit
- ORM and Migrations  (default database is SQLite)
- Routing, Controllers, and validators
- Guzzle Http client
- Fractal
- PHP dotenv

Which looks enough for doing any assignment.

    
### Application configuration
This app is using `.env` file to define it's configurations. you can find it in the root of the project.
```bash
APP_URI=localhost:8000 # used to run integration tests suite, this should be same for application
```
### Run Application `(With Docker)`
make sure you have Docker installed. all configurations (dockerfile, nginx) are located inside of `build/` folder.
Also you can find `docker-composer.yaml` in root of the project.

**Run below commands** 
- `docker-compose build && docker-compose up -d` 
- `docker exec -it dc-php-fpm bash -c "composer install && composer dump-autoload -o"` 

### Run tests `(integration & unit)`
Currently `13 tests, 19 assertions` are included.
if you are **using** `Docker` to run application, first make sure you have ran above commands, and then run
` vendor/bin/phpunit tests` which runs both `unit` and `integration` tests.
