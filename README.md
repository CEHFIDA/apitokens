Laravel 5 Admin Amazing api tokens
======================
after install this packages, you need install base admin
[adminamazing](https://github.com/selfrelianceme/adminamazing)

-----------------
Install via composer
```
composer require selfreliance/apitokens
```

Add Service Provider to `config/app.php` in `providers` section
```php
Selfreliance\Iusers\ApiTokensServiceProvider::class,
```


Go to `http://myapp/admin/apitokens` to view admin amazing

**Move public fields** for view customization:

```
php artisan vendor:publish
``` 