# jroman00/localenv-example-php

A simple PHP application built as an example for localenv [`localenv`](https://github.com/jroman00/localenv)

## Getting Started

This application is not intended to be used on its own and should only be used as part of the [`localenv`](https://github.com/jroman00/localenv) ecosystem. See the [localenv installation instructions](https://github.com/jroman00/localenv/blob/master/README.md) to get started

## Technologies

* [PHP 7.3](https://secure.php.net/)
* [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/)
* [Slim](https://www.slimframework.com/)
* [PHPUnit](https://phpunit.de/)
* [Mockery](http://docs.mockery.io/en/latest/)
* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [EditorConfig](https://editorconfig.org/)

## Features

* Simple web framework
* Example routes:
  * `Hello World` home endpoint
  * Health endpoints (i.e. `health`, `ready`, and `version` endpoints)
* Example helper library (i.e. `RedisHelper`)
* Unit tests
* Linting

## Scripts

### Running a Shell

Once running via [`localenv`](https://github.com/jroman00/localenv), connect to the running container via:

```bash
docker-compose exec localenv-example-php sh
```

To bring up a new container instance, run:

```bash
docker-compose --rm run localenv-example-php sh
```

Once connected to the running container, you can run commands directly via `composer` (e.g. `composer run lint`, `composer run test`). See the `scripts` section of `composer.json` for the full list of available scripts
