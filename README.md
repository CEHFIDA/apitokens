# Laravel 5 Admin Amazing tokens
tokens - a package which allows you to monitor user tokens

## Require

- [adminamazing](https://github.com/selfrelianceme/adminamazing)

## How to install

Install via composer
```
composer require selfreliance/apitokens
```

Model, migrations
```php
php artisan vendor:publish --provider="Selfreliance\apitokens\ApiTokensServiceProvider" --force
```

Edit model User (App/User.php)
```php
class User extends Authenticatable
{
    public function wallets($order='asc')
    {
       return $this->hasMany('App\Models\Users_Wallets', 'user_id')->orderBy('id', $order);
    }	
}
```

And do not forget about
```php
php artisan migrate
```
