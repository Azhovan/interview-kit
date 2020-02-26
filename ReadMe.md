## Interview boilerplate kit
This package will help you speedup your development, when you are given a technical assignment.
Most of the time companies ask you to not to use any framework, since even very minimal frameworks have a lots of 
redundant functionality for those kind of assignments.

below functionalities are embedded in this kit:
- PHPUnit
- ORM and Migrations  (default database is sqlite)
- Routing, Controllers and validators
- Guzzle http client
- Fractal
- PHP dotenv

Which looks enough for doing any assignment.

   
### Application configuration
This kit is using `.env` file to define it's configurations. you can find it in the root of the project.
```bash
APP_URI=localhost:8000 # used to run integration tests suite, this should be same for application
DB_CONNECTION=sqlite 
DB_HOST= # sqlite host. default value is localhost
DB_DATABASE= # absolute path to sqlite file, default value is:  ./database/database.sqlite
```
### Run Kit `(With Docker)`
make sure you have Docker installed. all configurations (dockerfile, nginx) are located inside of `phpdocker/` folder.
Also you can find `docker-composer.yaml` in root of the project.

Run below commands 
- `docker-compose build && docker-compose up -d` 
- `docker exec -it project-php-fpm bash -c "composer install && composer dump-autoload -o && composer migrate"` 
