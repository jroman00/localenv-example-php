# jroman00/localenv-example-php

A simple PHP application built as an example for localenv [`localenv`](https://github.com/jroman00/localenv)


<!-- @import "[TOC]" {cmd="toc" depthFrom=2 depthTo=6 orderedList=false} -->

<!-- code_chunk_output -->

- [Getting Started](#getting-started)
- [Technologies](#technologies)
- [Features](#features)
- [Scripts](#scripts)
  - [Running a Shell](#running-a-shell)

<!-- /code_chunk_output -->

---

## Getting Started

This application is not intended to be used on its own and should only be used as part of the [`localenv`](https://github.com/jroman00/localenv) ecosystem. See the [localenv installation instructions](https://github.com/jroman00/localenv/blob/master/README.md) to get started

## Technologies

* [PHP 7.3](https://secure.php.net/)
* [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/)
* [Slim](https://www.slimframework.com/)
* [PHPUnit](https://phpunit.de/)
* [Mockery](http://docs.mockery.io/en/latest/)
* [PHP\_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
* [EditorConfig](https://editorconfig.org/)

## Features

* Simple web framework
* Example routes:
  * `Hello world` home endpoint
  * Health endpoints (i.e. `health`, `ready`, and `version` endpoints)
* Example helper library (i.e. `RedisHelper`)
* Unit tests
* Linting

## Scripts

### Running a Shell

Once running via [`localenv`](https://github.com/jroman00/localenv), connect to a new container instance via:

```bash
make shell
```

Once connected to the running container, you can run commands directly via `composer` (e.g. `composer run lint`, `composer run test`). See the `scripts` section of `composer.json` for the full list of available scripts
