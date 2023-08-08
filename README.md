# Preface

This project is an implementation of [Laravel 8 From Scratch](https://laracasts.com/series/laravel-8-from-scratch) from
Laracasts.

## Docker

All content related to how the Docker image was built can be found below.
Be advised that inside **_infra/**, you will find Dockerfile and docker-compose.yml implementations using Alpine.

- [_infra/](_infra)
- [_infra/Dockerfile](_infra/Dockerfile)
- [_infra/docker-composer.yml](_infra/docker-compose.yml)
- [_infra/configs/](_infra/configs/)
- [.dockerignore](.dockerignore)

## Vessel
Vessel was written to expose short versions of commands that are used too often
when debugging, developing code, and executing CI actions such as running
linters, fix-linters, and tests.

For example, without vessel the process of executing a Laravel command inside the container to create a model would be  something like `docker-compose exec -T app sh -c "cd /var/www/html && php artisan make:model User"` with vessel the same result can be achieved by executing `./vessel artisan make:model User`.

Another good example of vessel usage would be the up command. With `./vessel up` the docker-compose.yml file will be built, but also the **xdebug.ini** file will be created with the right configurations and your current IP address to make the usage of Xdebug possible. If you choose to start the container by running `docker-compose up` bear in mind that Xdebug will not work.

### Available vessel commands

| Command                        | Description                                          |
| ------------------------------ |------------------------------------------------------|
| ./vessel up                    | Initialize docker-compose stack                      |
| ./vessel down                  | Stop docker-compose stack                            |
| ./vessel bash                  | Access bash of the app container                     |
| ./vessel clean-all             | Prune all possible containers, volumes, and networks |
| ./vessel artisan <ANY_COMMAND> | Run any Laravel artisan command                      |
| ./vessel tinker                | Open a REPL for the Laravel framework                |
| ./vessel composer              | Run any composer command                             |
| ./vessel pest                  | Run test suite using Pest framework                  |
| ./vessel tests                 | Run test suite with code coverage                    |
| ./vessel linters               | Run linters                                          |
| ./vessel fix-linters           | Run linter fixer                                     |
| ./vessel update-dependencies   | Update composer dependencies                         |
