# Laravel 5 Admin Amazing tokens
tokens - a package which allows you to monitor user tokens

## Require

- [adminamazing](https://github.com/selfrelianceme/adminamazing)

## How to install

Install via composer
```
composer require selfreliance/apitokens
```

Migrations
```php
php artisan vendor:publish --provider="Selfreliance\apitokens\ApiTokensServiceProvider" --tag="migrations" --force
```

And do not forget about
```php
php artisan migrate
```
