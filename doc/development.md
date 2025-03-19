## Local development
For local development you can use docker-compose.
```bash
docker compose run php sh
composer install
```

Enable xdebug inside the container
```bash
export XDEBUG_CONFIG="client_host=172.17.0.1 idekey=PHPSTORM"
export XDEBUG_MODE="debug"
```

Run tests
```bash
vendor/bin/phpunit
```

Run static code analysis
```bash
vendor/bin/phpstan
```

Fix styles (from outside the container)
```bash
docker compose run phpcsfixer fix src
docker compose run phpcsfixer fix tests
```

## In-Place development
If you want to test out how it integrates into ibexa, it's the easiest way to integrate the bundle into your project directly.
By adding it as "vcs" your are able to push the changes you made right from your vendor folder.
Add the following to your `composer.json`
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/elbformat/icon-bundle"
    }
  ]
}
```
and then run `composer require --prefer-source elbformat/icon-bundle:dev-main`.

Make sure you have **git** installed inside docker, when usin a docker setup.