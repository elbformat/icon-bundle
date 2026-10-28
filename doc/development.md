## Local development
For local development you can use docker compose together with make.
```bash
docker compose run --rm php composer install
```

Enable xdebug inside the container
```bash
export XDEBUG_CONFIG="client_host=172.17.0.1 idekey=PHPSTORM"
export XDEBUG_MODE="debug"
```

Run tests
```bash
make phpunit
```

Run phpstan
```bash
make phpstan
```

Fix code styles
```bash
make php-cs-fixer
```

Open a shell
```bash
make shell
```

To test against a specific Ibexa version (like the CI matrix does), run
```bash
docker compose run --rm php composer require -W ibexa/core:"5.0.*" ibexa/admin-ui:"5.0.*"
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