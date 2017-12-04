# Laravel 5 Admin Amazing tokens
tokens - a package which allows you to monitor user tokens

## Require

- [adminamazing](https://github.com/selfrelianceme/adminamazing)

## How to install

Install via composer
```
composer require selfreliance/apitokens
```

Config, model
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

### Also you can connect the information block
Edit value blocks in config (config/adminamazing.php)
```
'blocks' => [
    //
    'countTokens' => 'Selfreliance\Apitokens\ApiTokensController@registerBlock',
]
```

And do not forget about
```php
php artisan migrate
```